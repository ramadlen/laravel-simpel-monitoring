<?php

namespace App\Filament\Resources;
use App\Models\StatusEnum;
use App\Filament\Resources\MonitoringResource\Pages;
use App\Filament\Resources\MonitoringResource\RelationManagers;
use App\Models\Monitoring;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonitoringResource extends Resource
{
    protected static ?string $model = Monitoring::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationLabel = 'unit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Select::make('unit')
                ->options(
                    collect(StatusEnum::cases())
                        ->mapWithKeys(fn ($unit) => [$unit->value => ucfirst($unit->name)])
                        ->toArray()
                )
                    ->label('unit')
                    // ->options(StatusEnum::options(StatusEnum::class)) // Menggunakan enum sebagai pilihan
                    ->required()
                    ->default(StatusEnum::RawatInap->value),
                Forms\Components\TextInput::make('no_rm_yangdibatalkan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('perihal_pembatalan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit')  // Gunakan EnumColumn jika kolomnya enum
                    ->label('unit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_rm_yangdibatalkan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('perihal_pembatalan')
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
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
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
    public static function getNavigationLabel(): string
    {
        return 'unit';
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMonitorings::route('/'),
            'create' => Pages\CreateMonitoring::route('/create'),
            'edit' => Pages\EditMonitoring::route('/{record}/edit'),
        ];
    }
}
