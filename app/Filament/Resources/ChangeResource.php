<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChangeResource\Pages;
use App\Filament\Resources\ChangeResource\RelationManagers;
use App\Models\Change;
use App\Models\Project;
use App\Models\User;
use Dotenv\Util\Str;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChangeResource extends Resource
{ 
    protected static ?string $model = Change::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-up-down';
    protected static ?string $navigationGroup = 'Funcional';
    protected static ?String $navigationLabel = 'Alteração';
    protected static ?string $pluralModelLabel = 'Alterações';
    protected static ?string $modelLabel = 'Alteração';

    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->required()
                    ->autofocus()
                    ->label("Projecto")
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->options(
                        Project::all()->pluck('name', 'id')->toArray()
                    ),
                Forms\Components\Select::make('user_id')
                    ->label("Utilizador")
                    ->options(User::all()->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label("Título")
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->label("Descrição")
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('timestamp')
                    ->label("Data de Alteração")
                    ->displayFormat('d/m/Y H:i:s')
                    ->default(now())
                    ->required(),
                Forms\Components\TextInput::make('attachment')
                    ->maxLength(255)
                    ->label("Anexo"),
                Forms\Components\Textarea::make('reason')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project_id')
                    ->getStateUsing(
                        fn (Change $record) => Project::find($record->project_id)->name
                    )
                    ->sortable()
                    ->searchable()
                    ->label("Projecto"),
                Tables\Columns\TextColumn::make('user_id')
                    ->getStateUsing( fn (Change $record) => User::find($record->user_id)->name)
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->label("Utilizador"),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->label("Título")
                    ->searchable(),
                Tables\Columns\TextColumn::make('timestamp')
                    ->dateTime()
                    ->label("Data de Alteração")
                    ->sortable(),
                Tables\Columns\IconColumn::make('approved')
                    ->boolean()
                    ->label("Aprovação"),
                // Tables\Columns\TextColumn::make('attachment')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListChanges::route('/'),
            'create' => Pages\CreateChange::route('/create'),
            'view' => Pages\ViewChange::route('/{record}'),
            'edit' => Pages\EditChange::route('/{record}/edit'),
        ];
    }
}
