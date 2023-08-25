<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pegawai;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PegawaiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PegawaiResource\RelationManagers;
use App\Filament\Resources\PegawaiResource\RelationManagers\WorkExperienceRelationManager;
use Filament\Resources\RelationManagers\RelationManager;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $recordTitleAttribute = 'Pegawai';

    protected static ?string $navigationGroup = 'Akun';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Detail Akun';

    // protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('user_id')->relationship('user','name')
                            ->label(__('Username')),
                        TextInput::make('nomor_telepon')
                            ->label(__('Telepon'))->numeric(),
                        Textarea::make('alamat')
                            ->rows(10)
                            ->cols(20)
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable()->sortable()->label(__('ID')),
                TextColumn::make('user.name')->searchable()->sortable()->label(__('Username')),
                TextColumn::make('nomor_telepon')->searchable()->sortable()->label(__('Nomor Telepon')),
                TextColumn::make('alamat')->searchable()->sortable()->limit(12)
            ])
            ->filters([
                SelectFilter::make('user')->relationship('user','name')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            // RelationManagers\WorkExperiencesRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPegawais::route('/'),
            'create' => Pages\CreatePegawai::route('/create'),
            'edit' => Pages\EditPegawai::route('/{record}/edit'),
        ];
    }    
}
