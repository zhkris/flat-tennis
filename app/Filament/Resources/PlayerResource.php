<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Player;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PlayerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PlayerResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class PlayerResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'heroicon-s-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Fieldset::make('Championship stats')->schema([
                    TextInput::make('championship_wins')->label('Wins')->integer()->minValue(0)->maxValue(50)->step(1)->default(0),
                    TextInput::make('championship_loses')->label('Loses')->integer()->minValue(0)->maxValue(50)->step(1)->default(0),
                ])->hiddenOn('create'),
                Fieldset::make('Duel stats')->schema([
                    TextInput::make('duel_wins')->label('Wins')->integer()->minValue(0)->maxValue(50)->step(1)->default(0),
                    TextInput::make('duel_loses')->label('Wins')->integer()->minValue(0)->maxValue(50)->step(1)->default(0),
                ])->hiddenOn('create'),
                Fieldset::make('Game stats')->schema([
                    TextInput::make('game_wins')->label('Wins')->integer()->minValue(0)->maxValue(50)->step(1)->default(0),
                    TextInput::make('game_loses')->label('Wins')->integer()->minValue(0)->maxValue(50)->step(1)->default(0),
                ])->hiddenOn('create'),
                TextInput::make('earned_points')->integer()->minValue(0)->maxValue(50)->step(1)->default(0)->hiddenOn('create'),
                TextInput::make('lost_points')->integer()->minValue(0)->maxValue(50)->default(0)->step(1)->hiddenOn('create'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }
}
