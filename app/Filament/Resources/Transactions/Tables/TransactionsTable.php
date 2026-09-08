<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('invoice_number')
                    ->label('Invoice')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('candidate.name')
                    ->label('Finalis')
                    ->searchable(),


                TextColumn::make('category.name')
                    ->label('Kategori'),


                TextColumn::make('vote_amount')
                    ->label('Jumlah Vote')
                    ->numeric(),


                TextColumn::make('total_amount')
                    ->label('Total Bayar')
                    ->money('IDR'),


                BadgeColumn::make('payment_status')
                    ->label('Status Pembayaran')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                    ]),

            ])
            ->defaultSort('created_at', 'desc');
    }
}