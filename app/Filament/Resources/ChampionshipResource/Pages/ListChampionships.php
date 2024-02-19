<?php

namespace App\Filament\Resources\ChampionshipResource\Pages;

use App\Filament\Resources\ChampionshipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChampionships extends ListRecords
{
    protected static string $resource = ChampionshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
