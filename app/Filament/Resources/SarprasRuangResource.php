<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SarprasRuangResource\Pages;
use App\Filament\Resources\SarprasRuangResource\RelationManagers;
use App\Models\SarprasRuang;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SarprasRuangResource extends Resource
{
    protected static ?string $model = SarprasRuang::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Sarpras';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sekolah_id')
                    ->relationship('sekolah', 'id')
                    ->required(),
                Forms\Components\TextInput::make('referensi_ruang_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('bangunan_id')
                    ->relationship('bangunan', 'id')
                    ->required(),
                Forms\Components\TextInput::make('kode_ruang')
                    ->maxLength(25),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('registrasi_ruang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lantai_ke')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('panjang')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lebar')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('luas')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('kapasitas')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('luas_plester')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_plafond')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_dinding')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_daun_jendela')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_daun_pintu')
                    ->numeric(),
                Forms\Components\TextInput::make('panjang_kusen')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_tutup_lantai')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_instalasi_listrik')
                    ->numeric(),
                Forms\Components\TextInput::make('jumlah_instalasi_listrik')
                    ->numeric(),
                Forms\Components\TextInput::make('panjang_instalasi_air')
                    ->numeric(),
                Forms\Components\TextInput::make('jumlah_instalasi_air')
                    ->numeric(),
                Forms\Components\TextInput::make('panjang_drainase')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_finish_struktur')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_finish_plafond')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_finish_dinding')
                    ->numeric(),
                Forms\Components\TextInput::make('luas_finish_kjp')
                    ->numeric(),
                SpatieMediaLibraryFileUpload::make('foto_ruang')
                    ->label('Foto Kondisi Ruangan')
                    ->multiple()
                    ->reorderable()
                    ->collection('ruangs')
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
                Tables\Columns\TextColumn::make('referensi_ruang_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bangunan.id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_ruang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('registrasi_ruang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lantai_ke')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('panjang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lebar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kapasitas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_plester')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_plafond')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_dinding')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_daun_jendela')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_daun_pintu')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('panjang_kusen')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_tutup_lantai')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_instalasi_listrik')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_instalasi_listrik')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('panjang_instalasi_air')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_instalasi_air')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('panjang_drainase')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_finish_struktur')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_finish_plafond')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_finish_dinding')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_finish_kjp')
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
            'index' => Pages\ListSarprasRuangs::route('/'),
            'create' => Pages\CreateSarprasRuang::route('/create'),
            'view' => Pages\ViewSarprasRuang::route('/{record}'),
            'edit' => Pages\EditSarprasRuang::route('/{record}/edit'),
        ];
    }
}
