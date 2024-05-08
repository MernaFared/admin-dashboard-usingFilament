<?php

namespace App\Filament\Resources\PromotionsResource\Pages;

use App\Filament\Resources\PromotionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPromotions extends EditRecord
{
    protected static string $resource = PromotionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Promosion updated Successfully ' ;
    }
}
