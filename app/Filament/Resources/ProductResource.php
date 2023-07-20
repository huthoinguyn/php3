<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductResource extends Resource{

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form)
    : Form{
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                                       ->relationship('category', 'name',
                                           fn(Builder $query) => $query
                                               ->where('status', '=', 1)
                                               ->where('type', '=', 'sanpham'))
                                       ->required(),
                Forms\Components\Select::make('brand_id')
                                       ->relationship('brand', 'name',
                                           fn(Builder $query) => $query->where('status', '=', 1))
                                       ->required(),
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
                Forms\Components\TextInput::make('price')
                                          ->required(),
                Forms\Components\FileUpload::make('image')
                                           ->required(),
                Forms\Components\RichEditor::make('description')
                                           ->required(),
                Forms\Components\Textarea::make('summary')
                                         ->required()
                                         ->maxLength(65535),
                Forms\Components\Toggle::make('featured')
                                       ->required(),
                Forms\Components\Toggle::make('status')
                                       ->required(),
            ]);
    }

    public static function table(Table $table)
    : Table{
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('brand.name'),
                Tables\Columns\TextColumn::make('name'),
                //                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\ImageColumn::make('image'),
                //                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('summary'),
                Tables\Columns\IconColumn::make('featured')
                                         ->boolean(),
                Tables\Columns\IconColumn::make('status')
                                         ->boolean(),
                //                Tables\Columns\TextColumn::make('created_at')
                //                                         ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                                         ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            //            'view'   => Pages\ViewProduct::route('/{record}'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

}
