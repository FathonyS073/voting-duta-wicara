<?php

namespace App\Filament\Resources\Candidates\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CandidatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->size(50),

                TextColumn::make('name')
                    ->label('Nama Finalis')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('event.name')
                    ->label('Event')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->placeholder('-'),

                TextColumn::make('categories.name')
                    ->label('Kategori')
                    ->badge()
                    ->separator(',')
                    ->placeholder('-'),

                TextColumn::make('city')
                    ->label('Kabupaten / Kota')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),

                TextColumn::make('province')
                    ->label('Provinsi')
                    ->searchable()
                    ->toggleable()
                    ->placeholder('-'),

                TextColumn::make('total_votes')
                    ->label('Total Vote')
                    ->formatStateUsing(
                        fn ($state) =>
                            number_format(
                                (int) ($state ?? 0),
                                0,
                                ',',
                                '.'
                            ) . ' Vote'
                    )
                    ->weight('bold'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn ($state): string =>
                            $state ? 'Aktif' : 'Nonaktif'
                    )
                    ->color(
                        fn ($state): string =>
                            $state ? 'success' : 'danger'
                    ),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([

                SelectFilter::make('event_id')
                    ->label('Event')
                    ->relationship(
                        'event',
                        'name'
                    )
                    ->searchable()
                    ->preload(),

                SelectFilter::make('categories')
                    ->label('Kategori')
                    ->relationship(
                        'categories',
                        'name'
                    )
                    ->searchable()
                    ->preload(),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Nonaktif',
                    ]),
            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            ->defaultSort('created_at', 'desc');
    }
}