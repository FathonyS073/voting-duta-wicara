<?php

namespace App\Filament\Resources\Candidates\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CandidateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Finalis')
                    ->schema([

                        Select::make('event_id')
                            ->label('Event')
                            ->relationship(
                                'event',
                                'name'
                            )
                            ->live()
                            ->searchable()
                            ->preload()
                            ->required(),

                        CheckboxList::make('categories')
                            ->label('Kategori')
                            ->relationship(
                                name: 'categories',
                                titleAttribute: 'name',
                                modifyQueryUsing: function ($query, $get) {

                                    $eventId = $get('event_id');

                                    if (!$eventId) {
                                        return $query->whereRaw('1 = 0');
                                    }

                                    return $query->where(
                                        'event_id',
                                        $eventId
                                    );
                                }
                            )
                            ->columns(2)
                            ->required(),

                        TextInput::make('name')
                            ->label('Nama Finalis')
                            ->required()
                            ->maxLength(255),

                        FileUpload::make('photo')
                            ->label('Foto Finalis')
                            ->image()
                            ->disk('public')
                            ->directory('candidates')
                            ->visibility('public'),

                    ])
                    ->columns(2),


                Section::make('Data Profil')
                    ->schema([

                        TextInput::make('city')
                            ->label('Kabupaten / Kota')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('province')
                            ->label('Provinsi')
                            ->default('Jawa Timur')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('education')
                            ->label('Pendidikan')
                            ->maxLength(255),

                        Textarea::make('bio')
                            ->label('Profil Singkat')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('achievement')
                            ->label('Prestasi')
                            ->rows(4)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),


                Section::make('Visi dan Misi')
                    ->schema([

                        Textarea::make('vision')
                            ->label('Visi')
                            ->rows(4),

                        Textarea::make('mission')
                            ->label('Misi')
                            ->rows(4),

                    ])
                    ->columns(2),


                Section::make('Media Sosial')
                    ->schema([

                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->maxLength(255),

                        TextInput::make('tiktok')
                            ->label('TikTok')
                            ->maxLength(255),

                    ])
                    ->columns(2),


                Section::make('Status')
                    ->schema([

                        Toggle::make('status')
                            ->label('Finalis Aktif')
                            ->default(true),

                    ]),

            ]);
    }
}