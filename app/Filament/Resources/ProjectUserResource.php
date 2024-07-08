<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectUserResource\Pages;
use App\Filament\Resources\ProjectUserResource\RelationManagers;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectUserResource extends Resource
{
    protected static ?string $model = ProjectUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';
    protected static ?string $navigationGroup = 'Funcional';
    protected static ?string $navigationLabel = 'Atribuir Projecto';
    protected static ?string $pluralModelLabel = 'Atribuir Projectos';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->required()
                    ->autofocus()
                    ->native(false)
                    ->options(
                        Project::all()->pluck('name', 'id')->toArray()
                    ),
                Forms\Components\Select::make('user_id')
                    ->label("Utilizador")
                    ->options(User::all()->pluck('name', 'id'))
                    ->preload()
                    ->native(false)
                    ->searchable(),
                Forms\Components\DatePicker::make('assigned_at')
                    ->required()
                    ->displayFormat('d/m/Y H:i:s')
                    ->default(now()),
                Forms\Components\Select::make('role')
                    ->required()
                    ->label("Cargo")
                    ->options(
                        Role::all()->pluck('name', 'id')->toArray()
                    )
                    ->preload()
                    ->native(false),
                Forms\Components\TextInput::make('hours_allocated')
                    ->numeric()
                    ->label("Horas Alocadas"),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->label("Activo"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project_id')
                    ->searchable()
                    ->sortable()
                    ->label("Projecto")
                    ->getStateUsing(
                        fn (ProjectUser $record) => Project::find($record->project_id)->name
                    ),
                Tables\Columns\TextColumn::make('user_id')
                    ->searchable()
                    ->label("Utilizador")
                    ->sortable()
                    ->getStateUsing(
                        fn (ProjectUser $record) => User::find($record->user_id)->name
                    )
                    ->sortable(),
                Tables\Columns\TextColumn::make('assigned_at')
                    ->date()
                    ->searchable()
                    ->label("Data de Atribuição")
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')

                    ->getStateUsing(
                        fn (ProjectUser $record) => Role::find($record->role)->name
                    )
                    ->label("Cargo")
                    ->searchable(),
                Tables\Columns\TextColumn::make('hours_allocated')
                    ->numeric()
                    ->label("Horas Alocadas")
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label("Activo"),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProjectUsers::route('/'),
        ];
    }
}
