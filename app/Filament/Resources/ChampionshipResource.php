<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChampionshipResource\Pages;
use App\Filament\Resources\ChampionshipResource\RelationManagers;
use App\Filament\Resources\ChampionshipResource\RelationManagers\DuelsRelationManager;
use App\Models\Championship;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChampionshipResource extends Resource
{
    protected static ?string $model = Championship::class;

    protected static ?string $navigationIcon = 'heroicon-s-megaphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            DuelsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChampionships::route('/'),
            'create' => Pages\CreateChampionship::route('/create'),
            'edit' => Pages\EditChampionship::route('/{record}/edit'),
        ];
    }
}
