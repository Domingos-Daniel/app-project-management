<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ChangesRelationManager extends RelationManager
{
    protected static string $relationship = 'changes';


    protected static ?string $recordTitleAttribute = 'title';

    protected static bool $isLazy = false;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Título'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('Descrição'),
                Forms\Components\Select::make('approved')
                    ->options([
                        '1' => 'Sim',
                        '0' => 'Não',
                    ])
                    ->label('Aprovado'),
                Forms\Components\TextInput::make('timestamp')
                    ->required()
                    ->label('Data e Hora'),
                Forms\Components\Textarea::make('reason')
                    ->label('Razão'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->sortable()
                    ->searchable(),
                BooleanColumn::make('approved')
                    ->label('Aprovado')
                    ->sortable(),
                TextColumn::make('timestamp')
                    ->label('Data e Hora')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    

    
}
