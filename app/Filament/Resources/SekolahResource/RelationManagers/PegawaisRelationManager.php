<?php

namespace App\Filament\Resources\SekolahResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PegawaisRelationManager extends RelationManager
{
    protected static string $relationship = 'pegawais';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('guru_tendik_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('guru_tendik_id')
            ->columns([
                Tables\Columns\TextColumn::make('gtk.nuptk')
                    ->label('NUPTK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gtk.nama')
                    ->label('Nama Pegawai')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('gtk.kepegawaian.status_kepegawaian')
                    ->label('Status Kepegawaian')
                    ->sortable(),
                Tables\Columns\TextColumn::make('gtk.nip')
                    ->label('NIP')
                    ->searchable(),
                Tables\Columns\IconColumn::make('gtk.kepegawaian.is_kepsek')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Kepala Sekolah')
                    ->sortable(),
                Tables\Columns\TextColumn::make('gtk.kepegawaian.jenis_ptk')
                    ->label('Jenis PTK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gtk.tugas.mapel_ajar')
                    ->label('Mapel Ajar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gtk.kepegawaian.bidang_studi_pendidikan')
                    ->label('Bidang Studi Pendidikan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gtk.gender')
                    ->label('Jenis Kelamin'),
                Tables\Columns\TextColumn::make('gtk.no_telp')
                    ->label('No. Telepon'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
