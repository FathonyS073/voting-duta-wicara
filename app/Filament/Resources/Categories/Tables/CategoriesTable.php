<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([


                TextColumn::make('event.name')
                    ->label('Event')
                    ->searchable(),


                TextColumn::make('name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('vote_price')
                    ->label('Harga Vote')
                    ->money('IDR'),


                IconColumn::make('status')
                    ->label('Aktif')
                    ->boolean(),

            ])
            ->defaultSort('created_at', 'desc');
    }
}