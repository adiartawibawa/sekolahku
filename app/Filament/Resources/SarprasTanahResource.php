<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SarprasTanahResource\Pages;
use App\Filament\Resources\SarprasTanahResource\RelationManagers;
use App\Models\SarprasTanah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SarprasTanahResource extends Resource
{
    protected static ?string $model = SarprasTanah::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'Sarpras';

    protected static ?int $navigationSort = 1;

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
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Sertipikat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_sertifikat')
                    ->label('No. Sertipikat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('panjang')
                    ->label('Panjang Tanah')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lebar')
                    ->label('Lebar Tanah')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('luas')
                    ->label('Luas Tanah')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('luas_tersedia')
                    ->label('Luas Tanah Tersedia')
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
                Forms\Components\TextInput::make('njop')
                    ->label('NJOP')
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
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_sertifikat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('panjang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lebar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_tersedia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kepemilikan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('njop')
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSarprasTanahs::route('/'),
        ];
    }
}
