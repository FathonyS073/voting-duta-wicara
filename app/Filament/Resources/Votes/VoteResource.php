<?php

namespace App\Filament\Resources\Votes;

use App\Filament\Resources\Votes\Pages\ListVotes;
use App\Filament\Resources\Votes\Schemas\VoteForm;
use App\Filament\Resources\Votes\Tables\VotesTable;
use App\Models\Vote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class VoteResource extends Resource
{
    protected static ?string $model = Vote::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Votes';

    protected static ?string $modelLabel = 'Vote';

    protected static ?string $pluralModelLabel = 'Votes';

    protected static ?string $recordTitleAttribute = 'id';


    public static function form(Schema $schema): Schema
    {
        return VoteForm::configure($schema);
    }


    public static function table(Table $table): Table
    {
        return VotesTable::configure($table);
    }


    /*
    |--------------------------------------------------------------------------
    | VOTE HANYA UNTUK MONITORING
    |--------------------------------------------------------------------------
    */

    public static function canCreate(): bool
    {
        return false;
    }


    public static function canEdit(Model $record): bool
    {
        return false;
    }


    public static function canDelete(Model $record): bool
    {
        return false;
    }


    public static function canDeleteAny(): bool
    {
        return false;
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
            'index' => ListVotes::route('/'),
        ];
    }
}