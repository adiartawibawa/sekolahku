<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SekolahResource\Pages;
use App\Filament\Resources\SekolahResource\RelationManagers;
use App\Models\Sekolah;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SekolahResource extends Resource
{
    protected static ?string $model = Sekolah::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Management Sekolah';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('npsn')
                    ->label('NPSN')
                    ->required()
                    ->maxLength(8),
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Sekolah')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('sekolah_forms_code')
                    ->label('Bentuk Sekolah')
                    ->relationship(name: 'bentuk', titleAttribute: 'code')
                    ->required(),
                Forms\Components\Select::make('desa_code')
                    ->label('Desa')
                    ->relationship(name: 'desa', titleAttribute: 'name')
                    ->searchable()
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return "{$record->name} / {$record->getKecamatanNameAttribute()}";
                    })
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status Sekolah')
                    ->options([
                        'Negeri' => 'Negeri',
                        'Swasta' => 'Swasta',
                    ]),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->maxLength(65535),
                SpatieMediaLibraryFileUpload::make('images')
                    ->label('Foto Sekolah')
                    ->multiple()
                    // ->responsiveImages()
                    ->collection('sekolahs')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('meta')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('npsn')
                    ->label('NPSN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sekolah_forms_code')
                    ->label('Bentuk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('desa.name')
                    ->searchable(),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListSekolahs::route('/'),
            'create' => Pages\CreateSekolah::route('/create'),
            'view' => Pages\ViewSekolah::route('/{record}'),
            'edit' => Pages\EditSekolah::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            SekolahResource\Widgets\SekolahOverview::class,
            SekolahResource\Widgets\SekolahCustomOverview::class,
        ];
    }
}
