<?php

namespace App\Filament\Resources\Transactions\Schemas;


use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;


class TransactionForm
{

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                TextInput::make('invoice_number')
                    ->label('Invoice')
                    ->default(fn () => 'INV-' . time())
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


                TextInput::make('total_amount')
                    ->label('Total Bayar')
                    ->numeric()
                    ->required(),


                Select::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending'=>'Pending',
                        'paid'=>'Paid',
                        'failed'=>'Failed',
                    ])
                    ->default('pending')
                    ->required(),


            ]);
    }

}