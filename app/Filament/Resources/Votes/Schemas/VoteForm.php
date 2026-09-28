<?php

namespace App\Filament\Resources\Votes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('event_id')
                    ->label('Event')
                    ->relationship(
                        'event',
                        'name'
                    )
                    ->disabled(),

                Select::make('transaction_id')
                    ->label('Transaction')
                    ->relationship(
                        'transaction',
                        'invoice_number'
                    )
                    ->disabled(),

                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship(
                        'category',
                        'name'
                    )
                    ->disabled(),

                Select::make('candidate_id')
                    ->label('Finalis')
                    ->relationship(
                        'candidate',
                        'name'
                    )
                    ->disabled(),

                TextInput::make('vote_amount')
                    ->label('Jumlah Vote')
                    ->disabled(),

            ]);
    }
}