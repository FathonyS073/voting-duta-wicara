<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('event.name')
                    ->label('Event')
                    ->searchable()
                    ->sortable()
                    ->limit(35)
                    ->placeholder('-'),

                TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('vote_price')
                    ->label('Harga / Vote')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                TextColumn::make('candidates_count')
                    ->label('Finalis')
                    ->formatStateUsing(
                        fn ($state) =>
                            number_format(
                                (int) ($state ?? 0),
                                0,
                                ',',
                                '.'
                            ) . ' Finalis'
                    )
                    ->alignCenter(),

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
                    ->weight('bold')
                    ->alignCenter(),

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