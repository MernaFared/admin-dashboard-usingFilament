<?php

namespace App\Filament\Resources\Components;

// use Filament\Resources\Forms\Components\Component;

use Filament\Forms\Components\Component;
use Illuminate\Support\Str;

class WorkingDaysInput extends Component
{
    public function getPropertyName()
    {
        return Str::of(parent::getPropertyName())
            ->before('ToInput');
    }

    public function getComponent(): string
    {
        return 'input';
    }

    public function gt()
    {
        return parent::getLabel();
    }

    public function getDefaultValue()
    {
        return parent::getDefaultValue();
    }

    public function getValue($data)
    {
        return parent::getValue($data);
    }
}
