<?php

namespace App\Filament\Resources\PromotionsResource\Pages;

use App\Filament\Resources\PromotionsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePromotions extends CreateRecord
{
    protected static string $resource = PromotionsResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Promotion Created Successfully';
    }
}
