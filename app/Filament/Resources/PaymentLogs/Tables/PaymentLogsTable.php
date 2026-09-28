<?php

namespace App\Filament\Resources\PaymentLogs\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PaymentLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('transaction.invoice_number')
                    ->label('Invoice')
                    ->searchable()
                    ->copyable()
                    ->weight('bold')
                    ->placeholder('-'),

                TextColumn::make('transaction.candidate.name')
                    ->label('Finalis')
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('gateway')
                    ->label('Gateway')
                    ->badge()
                    ->formatStateUsing(
                        fn (?string $state): string =>
                            $state ? strtoupper($state) : '-'
                    )
                    ->color('info'),

                TextColumn::make('status')
                    ->label('Status Midtrans')
                    ->badge()
                    ->formatStateUsing(
                        fn (?string $state): string => match ($state) {
                            'settlement' => 'Settlement',
                            'capture' => 'Capture',
                            'pending' => 'Pending',
                            'deny' => 'Deny',
                            'cancel' => 'Cancel',
                            'expire' => 'Expire',
                            'refund' => 'Refund',
                            'partial_refund' => 'Partial Refund',
                            default => $state ? ucfirst($state) : '-',
                        }
                    )
                    ->color(
                        fn (?string $state): string => match ($state) {
                            'settlement', 'capture' => 'success',
                            'pending' => 'warning',
                            'deny', 'cancel', 'expire' => 'danger',
                            'refund', 'partial_refund' => 'info',
                            default => 'gray',
                        }
                    ),

                TextColumn::make('response')
                    ->label('Payload')
                    ->formatStateUsing(
                        fn ($state): string =>
                            is_array($state)
                                ? json_encode(
                                    $state,
                                    JSON_UNESCAPED_SLASHES |
                                    JSON_UNESCAPED_UNICODE
                                )
                                : (string) $state
                    )
                    ->limit(70)
                    ->wrap()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Diterima')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([

                SelectFilter::make('gateway')
                    ->label('Gateway')
                    ->options([
                        'midtrans' => 'Midtrans',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'settlement' => 'Settlement',
                        'capture' => 'Capture',
                        'pending' => 'Pending',
                        'deny' => 'Deny',
                        'cancel' => 'Cancel',
                        'expire' => 'Expire',
                        'refund' => 'Refund',
                        'partial_refund' => 'Partial Refund',
                    ]),

                Filter::make('tanggal')
                    ->label('Tanggal')
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
                                        $query->whereDate(
                                            'created_at',
                                            '>=',
                                            $date
                                        )
                                )
                                ->when(
                                    $data['sampai'] ?? null,
                                    fn (Builder $query, $date): Builder =>
                                        $query->whereDate(
                                            'created_at',
                                            '<=',
                                            $date
                                        )
                                );
                        }
                    ),
            ])

            ->defaultSort('created_at', 'desc');
    }
}