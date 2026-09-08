<?php

namespace App\Filament\Resources\Votes\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class VotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([


                TextColumn::make('candidate.name')
                    ->label('Finalis')
                    ->searchable(),


                TextColumn::make('category.name')
                    ->label('Kategori'),


                TextColumn::make('vote_amount')
                    ->label('Jumlah Vote')
                    ->numeric(),


                TextColumn::make('transaction.invoice_number')
                    ->label('Invoice'),


                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime(),

            ])
            ->defaultSort('created_at', 'desc');
    }
}