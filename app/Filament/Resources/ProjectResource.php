<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Funcional';
    protected static ?string $navigationLabel = 'Projeto';
    protected static ?string $pluralModelLabel = 'Projectos';
    protected static ?string $modelLabel = 'Projeto';

    protected static ?int $navigationSort = 1;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->autofocus()   
                    ->label("Nome")
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label("Descrição")
                    ->columnSpanFull(),
                Forms\Components\Select::make('supervisor_id')
                    ->label("Supervisor")
                    ->options(User::all()->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->required()                
                    ->native(false),

                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\DatePicker::make('actual_end_date'),
                Forms\Components\TextInput::make('budget')
                    ->numeric(),
                Forms\Components\Select::make('status')
                    ->required()              
                    ->native(false)
                    ->label("Status")
                    ->options([
                        'em andamento' => 'em andamento',
                    ])
                    ->default('em andamento')
                    ->searchable()
                    ->disabled(true),
                Forms\Components\Select::make('priority')
                    ->required()              
                    ->native(false)
                    ->label("Prioridade")
                    ->options([
                        'baixa' => 'baixa',
                        'media' => 'media',
                        'alta' => 'alta',
                    ])
                    ->default('media')
                    ->searchable(),
            ]);
    }

    
    
        
    public static function table(Table $table): Table
    {  
        $hoje = date('Y-m-d');

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label("Nome")
                    ->sortable(),
                Tables\Columns\TextColumn::make('supervisor_id')
                    ->searchable()
                    ->badge()
                    ->getStateUsing(fn (Project $record) => User::find($record->supervisor_id)->name)
                    ->label("Supervisor")
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('actual_end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->label("Status")
                    ->badge()
                    ->color(
                        function (Project $record): string {
                            $hoje = date('Y-m-d');
                            if ($record->end_date < $hoje) {
                                return 'danger';
                            } else if ($record->end_date > $hoje) {
                                return 'warning';
                            }else{
                                return 'success';
                            }
                        }
                    )
                    ->getStateUsing(function (Project $record) {
                        $hoje = date('Y-m-d');
                        if ($record->end_date < $hoje) {
                            return 'Expirado';
                        } else if ($record->end_date > $hoje) {
                            return 'Em andamento';
                        }else{
                            return 'Terminado';
                        }
                    }),
                Tables\Columns\TextColumn::make('priority')
                    ->searchable()
                    ->label("Prioridade")
                    ->sortable()
                    ->badge()
                    ->color(
                        function (Project $record): string {
                            if ($record->priority == 'baixa') {
                                return 'success';
                            } elseif ($record->priority == 'media') {
                                return 'warning';
                            } else {
                                return 'danger';
                            }
                        }
                    ),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
