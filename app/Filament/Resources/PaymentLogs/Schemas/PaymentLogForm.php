<?php

namespace App\Filament\Resources\PaymentLogs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PaymentLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('transaction_id')
                    ->required()
                    ->numeric(),
                TextInput::make('gateway')
                    ->default(null),
                TextInput::make('status')
                    ->default(null),
                Textarea::make('response')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
