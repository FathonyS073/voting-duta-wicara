<?php

namespace App\Filament\Resources\PaymentLogs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('transaction_id')
                    ->label('Transaction')
                    ->relationship(
                        'transaction',
                        'invoice_number'
                    )
                    ->disabled(),

                TextInput::make('gateway')
                    ->label('Gateway')
                    ->disabled(),

                TextInput::make('status')
                    ->label('Status')
                    ->disabled(),

                Textarea::make('response')
                    ->label('Response / Payload')
                    ->rows(12)
                    ->disabled()
                    ->columnSpanFull(),

            ]);
    }
}