<?php

namespace App\Filament\Resources\GuruTendikResource\RelationManagers;

use App\Models\TugasGuruTendik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TugasRelationManager extends RelationManager
{
    protected static string $relationship = 'tugas';

    protected static ?string $title = 'Beban Tugas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sekolah_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle(fn (TugasGuruTendik $record): string => "Beban Tugas {$record->gtk->nama}")
            ->columns([
                Tables\Columns\TextColumn::make('sekolah.nama')
                    ->label('Sekolah'),
                Tables\Columns\TextColumn::make('status_tugas')
                    ->label('Status Tugas'),
                Tables\Columns\TextColumn::make('mapel_ajar')
                    ->label('Mata Pelajaran'),
                Tables\Columns\TextColumn::make('jam_mengajar')
                    ->label('Jam Mengajar'),
                Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun'),
                Tables\Columns\TextColumn::make('semester')
                    ->label('Semester'),
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
