<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogsResource\Pages;
use App\Filament\Resources\ActivityLogsResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Grid::make()
                    ->schema([

                    TextInput::make('id'),
                    TextInput::make('causer_type'),
                    TextInput::make('subject_type'),
                    TextInput::make('description'),
                    TextInput::make('created_at')
                    ->label('Logged At'),

                    ])

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                // TextColumn::make('causer_id')
                //     ->label('Logged By'),
                TextColumn::make('causer.name')
                    ->label('Logged By')
                    ->searchable(),
                TextColumn::make('description'),
                TextColumn::make('causer_type')
                    ->label('Model'),
                TextColumn::make('subject_type')
                    ->label('Model'),

                TextColumn::make('created_at')
                    ->label('Logged At')
                    ->dateTime('d-m-y')


            ])
            ->filters([
                Filter::make('Logged By')

                ->query(function (Builder $query) {
                     $value = request()->input('filter.logged_by');

                     return $query->whereHas('causer', function (Builder $query) use ($value) {
                        $query->where('name', 'like', '%' . $value . '%');
                    });
                }),

                SelectFilter::make('User')
                ->options(User::all()->pluck('name', 'id'))  // Get user names and ids
                ->query(function ($query, $value) { // Pass $value as an argument
                    $query->whereHas('causer', function (Builder $query) use ($value) {
                        $query->where('causer_id', $value);
                    });
                }),
            ])

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListActivityLogs::route('/'),
            // 'create' => Pages\CreateActivityLogs::route('/create'),
            'View' => Pages\ViewActivityLogs::route('/{record}'),
        ];
    }
    public function causer()
{
    return $this->belongsTo(User::class, 'causer_id');
}
}
