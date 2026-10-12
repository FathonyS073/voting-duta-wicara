<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class PaymentSettings extends Page
{
    protected string $view = 'filament.pages.payment-settings';

    protected static ?string $navigationLabel = 'Pengaturan Pembayaran';

    protected static ?string $title = 'Pengaturan Pembayaran';

    protected static ?int $navigationSort = 99;

    public ?array $data = [];


    public function mount(): void
    {
        $this->form->fill([
            'manual_qris_enabled' =>
                Setting::getValue('manual_qris_enabled', '1') === '1',

            'manual_qris_merchant_name' =>
                Setting::getValue(
                    'manual_qris_merchant_name',
                    'Vooters'
                ),

            'manual_qris_image' =>
                Setting::getValue('manual_qris_image'),

            'manual_qris_instruction' =>
                Setting::getValue(
                    'manual_qris_instruction',
                    'Scan QRIS dan masukkan nominal pembayaran sesuai total transaksi yang tertera.'
                ),

            'midtrans_enabled' =>
                Setting::getValue('midtrans_enabled', '0') === '1',
        ]);
    }


    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | QRIS MANUAL
                |--------------------------------------------------------------------------
                */

                Section::make('QRIS Manual')
                    ->description(
                        'Pembayaran manual menggunakan QRIS statis dan verifikasi bukti pembayaran oleh admin.'
                    )
                    ->schema([

                        Toggle::make('manual_qris_enabled')
                            ->label('Aktifkan QRIS Manual')
                            ->helperText(
                                'Jika aktif, customer dapat memilih QRIS Manual pada halaman pembayaran.'
                            )
                            ->default(true),

                        TextInput::make('manual_qris_merchant_name')
                            ->label('Nama Merchant')
                            ->placeholder('Vooters')
                            ->required()
                            ->maxLength(100),

                        FileUpload::make('manual_qris_image')
                            ->label('Gambar QRIS')
                            ->helperText(
                                'Upload QRIS statis yang akan digunakan customer. Maksimal 2 MB.'
                            )
                            ->disk('public')
                            ->directory('payment/qris')
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->maxSize(2048)
                            ->imagePreviewHeight('300')
                            ->openable()
                            ->downloadable(),

                        Textarea::make('manual_qris_instruction')
                            ->label('Instruksi Pembayaran')
                            ->placeholder(
                                'Scan QRIS dan masukkan nominal pembayaran sesuai total transaksi.'
                            )
                            ->required()
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),


                /*
                |--------------------------------------------------------------------------
                | PAYMENT GATEWAY
                |--------------------------------------------------------------------------
                */

                Section::make('Payment Gateway')
                    ->description(
                        'Integrasi pembayaran otomatis menggunakan Midtrans.'
                    )
                    ->schema([

                        Toggle::make('midtrans_enabled')
                            ->label('Aktifkan Midtrans')
                            ->helperText(
                                'Jika nonaktif, customer akan melihat Payment Gateway sebagai Coming Soon.'
                            )
                            ->default(false),

                    ])
                    ->columns(1),

            ])
            ->statePath('data');
    }


    protected function getHeaderActions(): array
    {
        return [

            Action::make('save')
                ->label('Simpan Pengaturan')
                ->icon('heroicon-o-check')
                ->color('primary')
                ->action(fn () => $this->save()),

        ];
    }


    public function save(): void
    {
        $data = $this->form->getState();


        /*
        |--------------------------------------------------------------------------
        | Bersihkan QRIS lama jika diganti / dihapus
        |--------------------------------------------------------------------------
        */

        $oldQrisImage =
            Setting::getValue('manual_qris_image');

        $newQrisImage =
            $data['manual_qris_image'] ?? null;


        if (
            $oldQrisImage &&
            $oldQrisImage !== $newQrisImage &&
            Storage::disk('public')->exists($oldQrisImage)
        ) {
            Storage::disk('public')->delete($oldQrisImage);
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan QRIS Manual
        |--------------------------------------------------------------------------
        */

        Setting::setValue(
            'manual_qris_enabled',
            !empty($data['manual_qris_enabled']) ? '1' : '0'
        );

        Setting::setValue(
            'manual_qris_merchant_name',
            $data['manual_qris_merchant_name']
        );

        Setting::setValue(
            'manual_qris_image',
            $newQrisImage
        );

        Setting::setValue(
            'manual_qris_instruction',
            $data['manual_qris_instruction']
        );


        /*
        |--------------------------------------------------------------------------
        | Simpan Payment Gateway
        |--------------------------------------------------------------------------
        */

        Setting::setValue(
            'midtrans_enabled',
            !empty($data['midtrans_enabled']) ? '1' : '0'
        );


        /*
        |--------------------------------------------------------------------------
        | Notification
        |--------------------------------------------------------------------------
        */

        Notification::make()
            ->title('Pengaturan pembayaran berhasil disimpan')
            ->success()
            ->send();
    }
}