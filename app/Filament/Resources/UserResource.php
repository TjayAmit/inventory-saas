<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationBadgeTooltip = 'The number of users';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')->image()->columnSpan(2),
                Forms\Components\TextInput::make('last_name')->required()->reactive(),
                Forms\Components\TextInput::make('first_name')->required()->reactive(),
                Forms\Components\TextInput::make('middle_name'),
                Forms\Components\TextInput::make('ext_name'),
                Forms\Components\TextInput::make('email')->required()->email(),
                Forms\Components\TextInput::make('password')->required()->password(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'deactivated' => 'Deactivated',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('address'),
                Forms\Components\Select::make('roles')
                    ->label('Roles')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Image')->circular(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('first_name')->searchable()->default('N/A'),
                Tables\Columns\TextColumn::make('middle_name')->searchable()->default('N/A'),
                Tables\Columns\TextColumn::make('last_name')->searchable()->default('N/A'),
                Tables\Columns\TextColumn::make('ext_name')->searchable()->default('N/A'),
                Tables\Columns\CheckboxColumn::make('email_verified_at')->label('Verified'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'deactivated' => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'deactivated' => 'Deactivated',
                    ])
                    ->column('status')
            ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
