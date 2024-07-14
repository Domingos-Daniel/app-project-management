<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\RelationManagers\ChangesRelationManager;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Parallax\FilamentComments\Tables\Actions\CommentsAction;

use function Laravel\Prompts\error;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Funcional';
    protected static ?string $navigationLabel = 'Projeto';
    protected static ?string $pluralModelLabel = 'Projectos';
    protected static ?string $modelLabel = 'Projeto';


    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (!auth()->user()->hasPermissionTo('can_see_all_projects')) {
            $query->whereIn('id', function ($query) {
                $query->select('project_id')
                    ->from('project_users')
                    ->where('user_id', auth()->id());
            });
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique()
                    ->autocapitalize('words')
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
                Forms\Components\DatePicker::make('actual_end_date')
                    ->required()
                    ->closeOnDateSelection()
                    ->native(false)
                    ->prefixIcon('heroicon-o-calendar')
                    ->prefixIconColor('info')
                    ->displayFormat('d/m/Y')
                    ->default(now())
                    ->label("Data de Início"),

                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->closeOnDateSelection()
                    ->displayFormat('d/m/Y')
                    ->prefixIcon('heroicon-o-calendar')
                    ->prefixIconColor('info')
                    ->native(false)
                    ->afterOrEqual('actual_end_date')
                    ->label("Data de Fim / Previsão de Entrega"), 
                Forms\Components\TextInput::make('budget')
                    ->label("Orcamento")
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
                    ->color('info')
                    ->getStateUsing(
                        fn (Project $record) => User::find($record->supervisor_id)->name
                        )
                    ->label("Supervisor")
                    ->sortable(),
                Tables\Columns\TextColumn::make('assigned_to')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(
                        fn (Project $record): string => ProjectUser::where('project_id', $record->getKey())->first() ? 'success' : 'danger'
                    )
                    ->label("Atribuído a")
                    ->getStateUsing(
                        function (Project $record): string {
                        $projectUser = ProjectUser::where('project_id', $record->getKey())->first();
                        if ($projectUser) {
                            return $projectUser->user->name;
                        }
                        return 'Sem atribuição'; // Tratamento caso não encontre um usuário associado ao projeto
                    }),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->label("Data de Entrega")
                    ->sortable(),
                Tables\Columns\TextColumn::make('actual_end_date')
                    ->label("Data de Início")
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget')
                    ->numeric()
                    ->label("Orçamento")
                    ->badge()
                    ->getStateUsing(
                        fn (Project $record) => '$ ' . number_format($record->budget, 2, ',', '.')
                    )
                    ->color('success')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->icon(
                        function (Project $record): string {
                            if ($record->status == 'em andamento') {
                                return 'heroicon-o-exclamation-circle';
                            } else if ($record->status == 'terminado') {
                                return 'heroicon-o-check-circle';
                            } else {
                                return 'heroicon-o-x-circle';
                            }
                        }
                    )
                    ->label("Status")
                    ->badge()
                    ->color(
                        function (Project $record): string {
                            $hoje = date('Y-m-d');
                            if ($record->end_date < $hoje) {
                                return 'danger';
                            } else if ($record->end_date > $hoje) {
                                return 'warning';
                            } else {
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
                        } else {
                            return 'Terminado';
                        }
                    }),
                Tables\Columns\TextColumn::make('priority')
                    ->searchable()
                    ->label("Prioridade")
                    ->sortable()
                    ->badge()
                    ->badge()
                    ->icon(
                        function (Project $record): string {
                            if ($record->priority == 'baixa') {
                                return 'heroicon-o-exclamation-circle';
                            } elseif ($record->priority == 'media') {
                                return 'heroicon-o-bolt-slash';
                            } else {
                                return 'heroicon-o-bolt';
                            }
                        }
                    )
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
                CommentsAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => Auth::user()->hasPermissionTo('project_update')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                ComponentsSection::make('Informações do Projeto')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nome do Projeto')
                                    ->badge()
                                    ->weight(FontWeight::ExtraBold)
                                    ->size(TextEntrySize::Large),
                                TextEntry::make('supervisor.name')
                                    ->label('Supervisor')
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('user.name')
                                    ->label('Atribuido a')
                                    ->getStateUsing(function (Project $record): string {
                                        $projectUser = ProjectUser::where('project_id', $record->getKey())->first();
                                        if ($projectUser) {
                                            return $projectUser->user->name;
                                        }
                                        return 'Sem atribuição'; // Tratamento caso não encontre um usuário associado ao projeto
                                    })

                                    ->color('success')
                                    ->badge()
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('end_date')
                                    ->label('Data de Término')
                                    ->date(format: 'd/m/Y')
                                    ->color(
                                        function (Project $record): string {
                                            $hoje = date('Y-m-d');
                                            if (($record->end_date < $hoje) && ($record->status == 'em andamento')) {
                                                return 'danger';
                                            } else if (($record->end_date > $hoje) && ($record->status == 'em andamento')) {
                                                return 'warning';
                                            } else {
                                                return 'success';
                                            }
                                        }
                                    ),
                                TextEntry::make('actual_end_date')
                                    ->label('Data Inicio')
                                    ->date(format: 'd/m/Y')
                                    ->color('info'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('budget')
                                    ->label('Orçamento')
                                    ->getStateUsing(
                                        fn (Project $record) => '$ ' . number_format($record->budget, 2, ',', '.')
                                    )
                                    ->color('success'),
                                TextEntry::make('priority')
                                    ->label('Prioridade')
                                    ->badge()
                                    ->icon(
                                        function (Project $record): string {
                                            if ($record->priority == 'baixa') {
                                                return 'heroicon-o-exclamation-circle';
                                            } elseif ($record->priority == 'media') {
                                                return 'heroicon-o-bolt-slash';
                                            } else {
                                                return 'heroicon-o-bolt';
                                            }
                                        }
                                    )
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
                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->icon(
                                        function (Project $record): string {
                                            if ($record->status == 'em andamento') {
                                                return 'heroicon-o-exclamation-circle';
                                            } else if ($record->status == 'terminado') {
                                                return 'heroicon-o-check-circle';
                                            } else {
                                                return 'heroicon-o-x-circle';
                                            }
                                        }
                                    )
                                    ->color(
                                        function (Project $record): string {
                                            if ($record->status == 'em andamento') {
                                                return 'warning';
                                            } else if ($record->status == 'terminado') {
                                                return 'success';
                                            } else {
                                                return 'danger';
                                            }
                                        }
                                    ),
                            ]),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ChangesRelationManager::class,
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

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->name;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return ProjectResource::getUrl('view', ['record' => $record]);
    }
}
