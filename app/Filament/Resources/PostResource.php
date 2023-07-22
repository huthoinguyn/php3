<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostResource extends Resource{

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $navigationLabel = 'Bài viết';

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
                                           fn(Builder $query) => $query->where('status', '=', 1)
                                                                       ->where('type', '=',
                                                                           'baiviet'))
                                       ->required(),
                Forms\Components\TextInput::make('title')
                                          ->label('Tiêu đề')
                                          ->reactive()
                                          ->afterStateUpdated(function (Closure $set, $state){
                                              $set('slug', Str::slug($state));
                                          })
                                          ->required()
                                          ->maxLength(2048),
                Forms\Components\TextInput::make('slug')
                                          ->required()
                                          ->maxLength(2048),
                Forms\Components\FileUpload::make('thumbnail')
                                           ->label('Hình ảnh'),
                Forms\Components\RichEditor::make('body')
                                           ->label('Nội dung')
                                           ->required(),
                Forms\Components\DateTimePicker::make('published_at')
                                               ->label('Ngày đăng tải'),
                Forms\Components\Select::make('user_id')
                                       ->label('Người đăng')
                                       ->relationship('user', 'name')
                                       ->required(),
                Forms\Components\Toggle::make('active')
                                       ->label('Kích hoạt')
                                       ->required(),
            ]);
    }

    public static function table(Table $table)
    : Table{
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                                         ->label('Danh mục'),
                Tables\Columns\TextColumn::make('title')
                                         ->label('Tiêu đề'),
                //                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\ImageColumn::make('thumbnail')
                                          ->label('Hình ảnh'),
                Tables\Columns\TextColumn::make('body')->html()
                                         ->label('Nội dung'),
                Tables\Columns\TextColumn::make('published_at')
                                         ->label('Ngày đăng tải')
                                         ->dateTime(),
                Tables\Columns\TextColumn::make('user.name')
                                         ->label('Tác giả'),
                Tables\Columns\IconColumn::make('active')
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
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view'   => Pages\ViewPost::route('/{record}'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
