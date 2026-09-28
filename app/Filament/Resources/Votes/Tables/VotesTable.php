<?php

namespace App\Filament\Resources\Votes\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('event.name')
                    ->label('Event')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->placeholder('-'),

                TextColumn::make('candidate.name')
                    ->label('Finalis')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->placeholder('-'),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),

                TextColumn::make('transaction.invoice_number')
                    ->label('Invoice')
                    ->searchable()
                    ->copyable()
                    ->placeholder('-'),

                TextColumn::make('vote_amount')
                    ->label('Jumlah Vote')
                    ->numeric()
                    ->suffix(' Vote')
                    ->sortable(),

                TextColumn::make('transaction.total_amount')
                    ->label('Nilai Transaksi')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->placeholder('-'),

                TextColumn::make('transaction.payment_status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn (?string $state): string => match ($state) {
                            'paid' => 'Berhasil',
                            'pending' => 'Pending',
                            'failed' => 'Gagal',
                            default => $state ? ucfirst($state) : '-',
                        }
                    )
                    ->color(
                        fn (?string $state): string => match ($state) {
                            'paid' => 'success',
                            'pending' => 'warning',
                            'failed' => 'danger',
                            default => 'gray',
                        }
                    ),

                TextColumn::make('created_at')
                    ->label('Waktu Masuk')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])

            ->filters([

                SelectFilter::make('event_id')
                    ->label('Event')
                    ->relationship('event', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('candidate_id')
                    ->label('Finalis')
                    ->relationship('candidate', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                Filter::make('tanggal')
                    ->label('Tanggal Vote')
                    ->schema([
                        DatePicker::make('dari')
                            ->label('Dari'),

                        DatePicker::make('sampai')
                            ->label('Sampai'),
                    ])
                    ->query(
                        function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['dari'] ?? null,
                                    fn (Builder $query, $date): Builder =>
                                        $query->whereDate('created_at', '>=', $date)
                                )
                                ->when(
                                    $data['sampai'] ?? null,
                                    fn (Builder $query, $date): Builder =>
                                        $query->whereDate('created_at', '<=', $date)
                                );
                        }
                    ),
            ])

            ->defaultSort('created_at', 'desc');
    }
}