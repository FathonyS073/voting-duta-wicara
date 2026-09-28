<?php

namespace App\Filament\Resources\PaymentLogs;

use App\Filament\Resources\PaymentLogs\Pages\ListPaymentLogs;
use App\Filament\Resources\PaymentLogs\Schemas\PaymentLogForm;
use App\Filament\Resources\PaymentLogs\Tables\PaymentLogsTable;
use App\Models\PaymentLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PaymentLogResource extends Resource
{
    protected static ?string $model = PaymentLog::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Payment Logs';

    protected static ?string $modelLabel = 'Payment Log';

    protected static ?string $pluralModelLabel = 'Payment Logs';


    public static function form(Schema $schema): Schema
    {
        return PaymentLogForm::configure($schema);
    }


    public static function table(Table $table): Table
    {
        return PaymentLogsTable::configure($table);
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT LOG HANYA UNTUK MONITORING
    |--------------------------------------------------------------------------
    */

    public static function canCreate(): bool
    {
        return false;
    }


    public static function canEdit(Model $record): bool
    {
        return false;
    }


    public static function canDelete(Model $record): bool
    {
        return false;
    }


    public static function canDeleteAny(): bool
    {
        return false;
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => ListPaymentLogs::route('/'),
        ];
    }
}