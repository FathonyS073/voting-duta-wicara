<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class TransactionStatusChart extends ChartWidget
{
    protected ?string $heading = 'Status Transaksi';

    protected function getData(): array
    {
        $counts = Transaction::query()
            ->selectRaw('payment_status, COUNT(*) as total')
            ->whereIn('payment_status', [
                'paid',
                'pending',
                'failed',
            ])
            ->groupBy('payment_status')
            ->pluck('total', 'payment_status');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => [
                        (int) ($counts['paid'] ?? 0),
                        (int) ($counts['pending'] ?? 0),
                        (int) ($counts['failed'] ?? 0),
                    ],

                    'backgroundColor' => [
                        '#16A34A',
                        '#F59E0B',
                        '#DC2626',
                    ],

                    'borderColor' => [
                        '#FFFFFF',
                        '#FFFFFF',
                        '#FFFFFF',
                    ],

                    'borderWidth' => 2,
                ],
            ],

            'labels' => [
                'Berhasil',
                'Pending',
                'Gagal',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}