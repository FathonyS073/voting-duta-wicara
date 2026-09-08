<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([


                ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular(),


                TextColumn::make('name')
                    ->label('Nama Event')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date(),


                TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date(),


                IconColumn::make('status')
                    ->label('Aktif')
                    ->boolean(),


            ])
            ->defaultSort('created_at', 'desc');
    }
}