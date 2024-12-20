<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages\CreateTenant;
use App\Filament\Resources\TenantResource\Pages\EditTenant;
use App\Filament\Resources\TenantResource\Pages\ListTenants;
use App\Models\Tenant;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Tenants';

    public static function form(Form $form): Form
    {
        $baseDomain = config('app.domains');
        return $form
            ->schema([
                TextInput::make('id')
                    ->label('Tenant ID')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function (?string $state, callable $set) {
                        $set('domain', $state ? strtolower($state) : '');
                    }),

                TextInput::make('domain')
                    ->prefix('https://')
                    ->suffix($baseDomain)
                    ->label('SubDomain')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->disabled(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('domain')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTenants::route('/'),
            'create' => CreateTenant::route('/create'),
            'edit' => EditTenant::route('/{record}/edit'),
        ];
    }
}
