<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Pendapatan 7 Hari Terakhir';

    protected function getData(): array
    {
        $startDate = now()->subDays(6)->startOfDay();
        $endDate = now()->endOfDay();

        $transactions = Transaction::query()
            ->where('payment_status', 'paid')
            ->whereBetween('paid_at', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($transaction) {
                return Carbon::parse($transaction->paid_at)
                    ->format('Y-m-d');
            });

        $labels = [];
        $revenues = [];

        $period = CarbonPeriod::create(
            $startDate->copy()->startOfDay(),
            $endDate->copy()->startOfDay()
        );

        foreach ($period as $date) {
            $dateKey = $date->format('Y-m-d');

            $labels[] = $date->format('d M');

            $revenues[] = (int) (
                $transactions
                    ->get($dateKey, collect())
                    ->sum('total_amount')
            );
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $revenues,
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],

            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}