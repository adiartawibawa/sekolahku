<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SarprasBangunanResource\Pages;
use App\Filament\Resources\SarprasBangunanResource\RelationManagers;
use App\Models\SarprasBangunan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SarprasBangunanResource extends Resource
{
    protected static ?string $model = SarprasBangunan::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    // protected static ?string $navigationParentItem = 'Management Sekolah';

    protected static ?string $navigationGroup = 'Sarpras';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sekolah_id')
                    ->label('Sekolah')
                    ->relationship('sekolah', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('jenis_prasarana_id')
                    ->label('Jenis Prasarana')
                    ->relationship('prasarana', 'name')
                    ->required(),
                Forms\Components\Select::make('tanah_id')
                    ->label('No. Sertifikat Tanah')
                    ->relationship('tanah', 'no_sertifikat')
                    ->required(),
                Forms\Components\TextInput::make('kode_bangunan')
                    ->label('Kode Bangunan')
                    ->maxLength(25),
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Bangunan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('panjang')
                    ->label('Panjang Bangunan')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lebar')
                    ->label('Lebar Bangunan')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('luas_tapak_bangunan')
                    ->label('Luas Tapak Bangunan')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('kepemilikan')
                    ->label('Kepemilikan')
                    ->options([
                        'Milik' => 'Milik',
                        'Sewa' => 'Sewa',
                        'Pinjam' => 'Pinjam',
                        'Bukan Milik' => 'Bukan Milik',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('peminjam_meminjamkan')
                    ->label('Peminjam/yang meminjamkan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nilai_aset')
                    ->label('Nilai Aset')
                    ->numeric(),
                Forms\Components\TextInput::make('jml_lantai')
                    ->label('Jumlah Lantai')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tahun_bangun')
                    ->label('Tahun Dibangun')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_sk_pemakai')
                    ->label('Tanggal SK Pemakai')
                    ->required(),
                Forms\Components\TextInput::make('volume_pondasi')
                    ->label('Volume Pondasi')
                    ->numeric(),
                Forms\Components\TextInput::make('volume_sloop')
                    ->label('Volume Sloop')
                    ->numeric(),
                Forms\Components\TextInput::make('panjang_kuda')
                    ->label('Panjang Kuda - Kuda')
                    ->numeric(),
                Forms\Components\TextInput::make('panjang_kaso')
                    ->label('Panjang Kaso')
                    ->numeric(),
                Forms\Components\TextInput::make('panjang_reng')
                    ->label('Panjang Reng')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_tutup_atap')
                    ->label('Luas Tutup Atap')
                    ->numeric(),
                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sekolah.id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_prasarana_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanah.id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_bangunan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('panjang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lebar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_tapak_bangunan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kepemilikan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('peminjam_meminjamkan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nilai_aset')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jml_lantai')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun_bangun')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_sk_pemakai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('volume_pondasi')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('volume_sloop')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('panjang_kuda')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('panjang_kaso')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('panjang_reng')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_tutup_atap')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListSarprasBangunans::route('/'),
            'create' => Pages\CreateSarprasBangunan::route('/create'),
            'view' => Pages\ViewSarprasBangunan::route('/{record}'),
            'edit' => Pages\EditSarprasBangunan::route('/{record}/edit'),
        ];
    }
}
