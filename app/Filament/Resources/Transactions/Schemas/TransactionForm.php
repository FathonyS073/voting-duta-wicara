<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('invoice_number')
                    ->label('Invoice')
                    ->disabled(),

                Select::make('event_id')
                    ->label('Event')
                    ->relationship('event', 'name')
                    ->disabled(),

                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->disabled(),

                Select::make('candidate_id')
                    ->label('Finalis')
                    ->relationship('candidate', 'name')
                    ->disabled(),

                TextInput::make('customer_name')
                    ->label('Nama Customer')
                    ->disabled(),

                TextInput::make('customer_email')
                    ->label('Email Customer')
                    ->disabled(),

                TextInput::make('customer_phone')
                    ->label('No. Telepon')
                    ->disabled(),

                TextInput::make('vote_amount')
                    ->label('Jumlah Vote')
                    ->disabled(),

                TextInput::make('total_amount')
                    ->label('Total Bayar')
                    ->prefix('Rp')
                    ->disabled(),

                TextInput::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->disabled(),

                TextInput::make('payment_status')
                    ->label('Status Pembayaran')
                    ->disabled(),

                TextInput::make('payment_reference')
                    ->label('Midtrans Reference')
                    ->disabled(),

                TextInput::make('paid_at')
                    ->label('Waktu Pembayaran')
                    ->disabled(),
            ]);
    }
}