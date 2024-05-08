<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchesResource\Pages;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchesResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?int $navigationSort = 4;



    public static function form(Form $form): Form
    {

        $days = [
            'Monday' => 'Monday',
            'Tuesday' => 'Tuesday',
            'Wednesday' => 'Wednesday',
            'Thursday' => 'Thursday',
            'Friday' => 'Friday',
            'Saturday' => 'Saturday',
            'Sunday' => 'Sunday'
        ];

        return $form
        ->schema([
            Section::make()
                ->schema([
                    Forms\Components\TextInput::make('branch_Name')->required(),
                    Forms\Components\Textarea::make('address')->required(),
                    Forms\Components\TextInput::make('phone')->required(),
                    Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('start_day')
                    ->label('Start Day')
                    ->options(array_combine($days, $days)),

                    Forms\Components\Select::make('end_day')
                        ->label('End Day')
                        ->options(array_combine($days, $days)),
                                ]),
                    Forms\Components\Grid::make(2)
                    ->schema([
                        TimePicker::make('opening_hours_from')
                        ->label('Opening Hours From')
                        ->seconds(false),
                        Forms\Components\TimePicker::make('opening_hours_to')
                        ->label('Opening Hours To ')
                        ->seconds(false)
                    ]),
                    Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('lat')
                    ->label('latitude'),

                    Forms\Components\TextInput::make('lng')
                        ->label('longitude')
                                ]),
                    Forms\Components\Toggle::make('status'),

                ])
                ])
                ->configure(function () {

                    if (request()->has('start_day') && request()->has('end_day')) {
                        request()->merge([
                            'opening_hours' => request('start_day') . ' - ' . request('end_day')
                        ]);
                    }
                });

    }
//   public static function getStateUsing(): callable
// {
//     return function ($record) {
//         Log::info('Record:', $record->toArray());
//         $startDay = $record->start_day;
//         $endDay = $record->end_day;

//         if (empty($startDay) && empty($endDay)) {
//             return 'No working days selected.';
//         }

//         return $startDay . ' - ' . $endDay;
//     };
// }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('branch_Name')->sortable(),
                TextColumn::make('address'),
                TextColumn::make('phone'),
                TextColumn::make('start_day'),
                TextColumn::make('end_day'),
                TextColumn::make('opening_hours_from'),
                TextColumn::make('opening_hours_to'),
                TextColumn::make('lat'),
                TextColumn::make('lng'),
                TextColumn::make('status'),
                // TextColumn::make('opening_hours')


            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }
    public static function getEloquentQuery():Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranches::route('/create'),
            'edit' => Pages\EditBranches::route('/{record}/edit'),
        ];
    }
}
