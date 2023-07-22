<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextWidgetResource\Pages;
use App\Filament\Resources\TextWidgetResource\RelationManagers;
use App\Models\TextWidget;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TextWidgetResource extends Resource{

    protected static ?string $model = TextWidget::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form)
    : Form{
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                                          ->required()
                                          ->maxLength(255),
                Forms\Components\TextInput::make('title')
                                          ->label('Tiêu đề')
                                          ->required()
                                          ->maxLength(2048),
                Forms\Components\FileUpload::make('image')
                                           ->label('Hình ảnh'),
                Forms\Components\RichEditor::make('description')
                                           ->label('Mô tả')
                                           ->maxLength(65535),
                Forms\Components\Toggle::make('active')
                                       ->label('Kích hoạt')
                                       ->required(),
            ]);
    }

    public static function table(Table $table)
    : Table{
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key'),
                Tables\Columns\TextColumn::make('title')
                                         ->label('Tiêu đề'),
                Tables\Columns\ImageColumn::make('image')
                                          ->label('Hình ảnh'),
                //                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\IconColumn::make('active')
                                         ->label('Kích hoạt')
                                         ->boolean(),
                //                Tables\Columns\TextColumn::make('created_at')
                //                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                                         ->label('Cập nhật lần cuối')
                                         ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //                Tables\Actions\ViewAction::make(),
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
            'index'  => Pages\ListTextWidgets::route('/'),
            'create' => Pages\CreateTextWidget::route('/create'),
            //            'view' => Pages\ViewTextWidget::route('/{record}'),
            'edit'   => Pages\EditTextWidget::route('/{record}/edit'),
        ];
    }
}
