<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class CategoryResource extends Resource{

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Danh mục';

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
                                          ->reactive()
                                          ->afterStateUpdated(function (Closure $set, $state){
                                              $set('slug', Str::slug($state));
                                          })
                                          ->required()
                                          ->maxLength(2048),
                Forms\Components\TextInput::make('slug')
                                          ->required()
                                          ->maxLength(2048),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('type')
                                          ->required()
                                          ->maxLength(255),
                Forms\Components\Toggle::make('status')
                                       ->required(),
            ]);
    }

    public static function table(Table $table)
    : Table{
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\IconColumn::make('status')
                                         ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                                         ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                                         ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages()
    : array{
        return [
            'index' => Pages\ManageCategories::route('/'),
        ];
    }
}
