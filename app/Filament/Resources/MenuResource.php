<?php

namespace App\Filament\Resources;

use App\Enums\Target;
use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Z3d0X\FilamentFabricator\Models\Page;

class MenuResource extends Resource
{
    use Translatable;
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("title")->autofocus()->required(),
                Forms\Components\TextInput::make("redirect"),
                Forms\Components\Checkbox::make("visible"),
                Forms\Components\Select::make("target")
                    ->label("Target")
                    ->options(Target::getTargetArray()),
                Forms\Components\Select::make("page_id")
                    ->label("Page")
                    ->options(Page::all()->pluck('title', 'id'))
                    ->searchable(),
                CuratorPicker::make('image_name')->relationship('image', 'id'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([])
            ->filters([
                //
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
            'index' => Pages\MenuTree::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
