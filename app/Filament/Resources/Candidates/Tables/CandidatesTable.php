<?php

namespace App\Filament\Resources\Candidates\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class CandidatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([


                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(),


                TextColumn::make('name')
                    ->label('Nama Finalis')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('city')
                    ->label('Asal')
                    ->searchable(),


                TextColumn::make('event.name')
                    ->label('Event'),


                IconColumn::make('status')
                    ->label('Aktif')
                    ->boolean(),

            ])
            ->defaultSort('created_at', 'desc');
    }
}