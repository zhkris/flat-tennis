<?php

namespace App\Filament\Resources\ChampionshipResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DuelsRelationManager extends RelationManager
{
    protected static string $relationship = 'duels';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('player_one_id')
                    ->label('Player One')
                    ->relationship('playerOne', 'name'),
                Select::make('player_two_id')
                    ->label('Player Two')
                    ->relationship('playerTwo', 'name'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('playerOne.name'),
                Tables\Columns\TextColumn::make('playerTwo.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
