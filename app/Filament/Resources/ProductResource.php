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

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Sản phẩm';

    protected static ?string $navigationGroup = 'Quản lý';

    protected static function getNavigationBadge()
    : ?string{
        return static::getModel()::count();
    }

    public static function form(Form $form)
    : Form{
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                                       ->label('Danh mục')
                                       ->relationship('category', 'name',
                                           fn(Builder $query) => $query
                                               ->where('status', '=', 1)
                                               ->where('type', '=', 'sanpham'))
                                       ->required(),
                Forms\Components\Select::make('brand_id')
                                       ->label('Thương hiệu')
                                       ->relationship('brand', 'name',
                                           fn(Builder $query) => $query->where('status', '=', 1))
                                       ->required(),
                Forms\Components\TextInput::make('name')
                                          ->label('Tên sản phẩm')
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
                                          ->label('Giá')
                                          ->required(),
                Forms\Components\FileUpload::make('image')
                                           ->label('Hình ảnh')
                                           ->required(),
                Forms\Components\RichEditor::make('description')
                                           ->label('Mô tả')
                                           ->required(),
                Forms\Components\Textarea::make('summary')
                                         ->label('Nội dung tóm tắt')
                                         ->required()
                                         ->maxLength(65535),
                Forms\Components\Toggle::make('featured')
                                       ->label('Nổi bật')
                                       ->required(),
                Forms\Components\Toggle::make('status')
                                       ->label('Trạng thái')
                                       ->required(),
            ]);
    }

    public static function table(Table $table)
    : Table{
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                                         ->label('Danh mục'),
                Tables\Columns\TextColumn::make('brand.name')
                                         ->label('Thương hiệu'),
                Tables\Columns\TextColumn::make('name')
                                         ->label('Tên sản phẩm'),
                //                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('price')
                                         ->label('Giá')
                                         ->money('vnd'),
                Tables\Columns\ImageColumn::make('image')
                                          ->label('Hình ảnh'),
                //                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('summary')
                                         ->label('Tóm tắt nội dung'),
                Tables\Columns\IconColumn::make('featured')
                                         ->label('Nổi bật')
                                         ->boolean(),
                Tables\Columns\IconColumn::make('status')
                                         ->label('Trạng thái')
                                         ->boolean(),
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
