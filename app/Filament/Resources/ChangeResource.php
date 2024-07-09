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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Actions as InfolistActions;
use Filament\Infolists\Components\Actions\Action as InfoListAction;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Infolists\Infolist;

use Filament\Support\Enums\FontWeight;

class ChangeResource extends Resource
{
    protected static ?string $model = Change::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-up-down';
    protected static ?string $navigationGroup = 'Funcional';
    protected static ?String $navigationLabel = 'Alteração';
    protected static ?string $pluralModelLabel = 'Alterações';
    protected static ?string $modelLabel = 'Alteração';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (!auth()->user()->hasPermissionTo('can_see_all_projects')) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        $user = Auth::user();

        if ($user->hasPermissionTo('can_see_all_projects')) {
            $projects = Project::pluck('name', 'id')->toArray();
        } else {
            $projectIds = DB::table('project_users')
                ->where('user_id', $user->id)
                ->pluck('project_id')
                ->toArray();

            $projects = Project::whereIn('id', $projectIds)->pluck('name', 'id')->toArray();
        }

        // Obter os IDs dos usuários relacionados aos projetos
        $userIds = DB::table('project_users')
            ->whereIn('project_id', array_keys($projects))
            ->pluck('user_id')
            ->toArray();

        // Obter os nomes dos usuários
        $users = User::where('id', $userIds)->pluck('name', 'id')->toArray();

        return $form
            ->schema([
                Wizard::make([
                    Step::make('Projecto e Utilizador')
                        ->schema([
                            Select::make('project_id')
                                ->required()
                                ->autofocus()
                                ->label("Projecto")
                                ->native(false)
                                ->preload()
                                ->searchable()
                                ->options($projects),
                            Select::make('user_id')
                                ->label("Utilizador")
                                ->options($users)
                                ->default($user->id)
                                //->disabled()
                                ->preload()
                                ->searchable()
                                ->required()
                                ->native(false),
                        ]),
                    Step::make('Detalhes do Projecto')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->label("Título")
                                ->minLength(5)
                                ->maxLength(255),
                            MarkdownEditor::make('description')
                                ->required()
                                ->label("Descrição")
                                ->columnSpanFull(),
                        ]),
                    Step::make('Informações Adicionais')
                        ->schema([
                            DateTimePicker::make('timestamp')
                                ->label("Data de Alteração")
                                ->displayFormat('d/m/Y H:i:s')
                                ->default(now())
                                ->required(),
                            FileUpload::make('attachment')
                                ->label("Anexo (PDF, PNG, JPG, etc.)")
                                ->image()
                                ->disk('public')
                                ->multiple()
                                ->acceptedFileTypes(['application/pdf', 'image/*'])
                                ->maxSize(1024 * 1024) // 1MB
                                ->directory('attachments')
                                ->imageEditor()
                                ->imageEditorMode(2)
                                ->reorderable(),
                            Textarea::make('reason')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
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
                    ->getStateUsing(fn (Change $record) => User::find($record->user_id)->name)
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
                Tables\Actions\EditAction::make()
                    ->visible(
                        //fn (Change $record) => !$record->approved
                        function (Change $record) {
                            $user = Auth::user();
                            return $user->can('can_see_all_projects');
                        }
                    ),
                Action::make('approve')
                    ->label('Aprovar')
                    ->icon('heroicon-o-check-circle')
                    ->action(function (Change $record) {
                        $record->approved = true;
                        $record->save();
                    })
                    ->requiresConfirmation()
                    ->color('success')
                    ->visible(
                        //fn (Change $record) => !$record->approved
                        function (Change $record) {

                            $user = Auth::user();
                            return !$record->approved && $user->can('can_approve');
                        }
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Action::make('approveSelected')
                        ->label('Aprovar Selecionados')
                        ->action(
                            function (Collection $records) {
                                foreach ($records as $record) {
                                    $record->approved = true;
                                    $record->save();
                                }
                            }
                        )
                        ->requiresConfirmation()
                        ->visible(
                            function (Collection $records) {
                                $user = Auth::user();
                                return $user->can('can_approve');
                            }
                        )
                        ->icon('heroicon-o-check-circle')
                        ->requiresConfirmation()
                        ->color('success'),
                ]),

            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informações do Projeto')
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextEntry::make('project.name')
                                    ->label('Projecto')
                                    ->badge()
                                    ->color('success')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextEntrySize::Large),
                                TextEntry::make('user.name')
                                    ->label('Utilizador')
                                    ->weight(FontWeight::Bold)
                                    ->badge(),
                            ])
                            ->columns(2),
                    ])
                    ->columns(1),

                Section::make('Detalhes da Alteração')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Título')
                            ->weight(FontWeight::Bold)
                            ->size(TextEntrySize::Large)
                            ->badge()
                            ->color('info')
                            ->extraAttributes(['class' => 'font-bold text-lg']),
                        
                        TextEntry::make('description')
                            ->label('Descrição')
                            ->html()
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'prose']),
                        
                        TextEntry::make('reason')
                            ->label('Motivo')
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'text-gray-700']),
                        
                        TextEntry::make('timestamp')
                            ->label('Data de Alteração')
                            ->extraAttributes(['class' => 'text-gray-500']),
                    ])
                    ->columns(1),

                Section::make('Status da Aprovação')
                    ->schema([
                        TextEntry::make('approved')
                            ->label('Aprovação')
                            ->weight(FontWeight::Bold)
                            ->icon(fn (Change $record) => $record->approved ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->badge()
                            ->getStateUsing(fn (Change $record) => $record->approved ? 'Aprovado' : 'Pendente')
                            ->color(fn (Change $record) => $record->approved ? 'success' : 'danger')
                            ->extraAttributes(['class' => 'text-gray-500'])
                            ->visible(fn (Change $record) => $record->approved ? 'Aprovado' : 'Pendente'),
                            ])
                    ->columns(1),

                Section::make('Anexos')
                    ->schema([
                        ImageEntry::make('attachment')
                            ->label('Anexo')
                            ->square()
                            ->disk('public')
                            ->extraAttributes(['class' => 'rounded-md shadow border border-gray-300 dark:border-gray-700 dark:bg-gray-900'])
                            ->columnSpanFull()
                            ->extraImgAttributes([
                                'alt' => 'Anexos da Alteração',
                                'loading' => 'lazy',
                            ])
                            ->width('100%')
                            ->height('full'),
                    ])
                    ->columns(1),

                Section::make('Ações')
                    ->visible(
                        function (Change $record) {
                            $user = Auth::user();
                            return !$record->approved && $user->can('can_approve');
                        }
                    )
                    ->schema([
                        InfolistActions::make([
                            InfoListAction::make('approve')
                                ->label('Aprovar Alteração')
                                ->icon('heroicon-o-check-circle')
                                ->requiresConfirmation()
                                ->action(function (Change $record) {
                                    $record->approved = true;
                                    $record->save();
                                })
                                ->color('success')
                                ->visible(function (Change $record) {
                                    $user = Auth::user();
                                    return !$record->approved && $user->can('can_approve');
                                }),
                        ]),
                    ])
                    ->columns(1),
            ])
            ->columns(2);
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
