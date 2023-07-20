<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class BrandResource extends Resource{

    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
            'index' => Pages\ManageBrands::route('/'),
        ];
    }
}
