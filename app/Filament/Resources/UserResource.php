<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class UserResource extends Resource{

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Người dùng';

    protected static ?string $navigationGroup = 'Quản lý';


    protected static function getNavigationBadge()
    : ?string{
        return static::getModel()::count();
    }

    public static function form(Form $form)
    : Form{
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                                          ->label('Tên')
                                          ->required()
                                          ->maxLength(255),
                Forms\Components\TextInput::make('email')
                                          ->email()
                                          ->required()
                                          ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at')
                                               ->label('Xác thực Email'),
                Forms\Components\TextInput::make('password')
                                          ->label('Mật khẩu')
                                          ->password()
                                          ->required()
                                          ->maxLength(255),
            ]);
    }

    public static function table(Table $table)
    : Table{
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                                         ->label('Tên')
                ,
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('email_verified_at')
                                         ->label('Xác thực Email')
                                         ->dateTime(),
                //                Tables\Columns\TextColumn::make('created_at')
                //                                         ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                                         ->label('Cập nhật lần cuối')
                                         ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations()
    : array{
        return [
            //
        ];
    }

    public static function getPages()
    : array{
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view'   => Pages\ViewUser::route('/{record}'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
