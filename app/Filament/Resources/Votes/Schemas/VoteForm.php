<?php

namespace App\Filament\Resources\Votes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;


class VoteForm
{

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Select::make('transaction_id')
                    ->label('Transaction')
                    ->relationship(
                        'transaction',
                        'invoice_number'
                    )
                    ->required(),


                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship(
                        'category',
                        'name'
                    )
                    ->required(),


                Select::make('candidate_id')
                    ->label('Finalis')
                    ->relationship(
                        'candidate',
                        'name'
                    )
                    ->required(),


                TextInput::make('vote_amount')
                    ->label('Jumlah Vote')
                    ->numeric()
                    ->required(),


            ]);
    }

}