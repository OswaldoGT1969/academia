<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Models\Quiz;
use Filament\Actions;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $modelLabel = 'Cuestionario';
    protected static ?string $pluralModelLabel = 'Cuestionarios';
    protected static ?string $navigationLabel = 'Cuestionarios';

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-clipboard-document-check';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('course_id')
                    ->label('Curso')
                    ->relationship('course', 'title')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('title')
                    ->label('Título del Cuestionario')
                    ->required(),
                Forms\Components\TextInput::make('passing_score')
                    ->label('Puntuación Mínima (0-100)')
                    ->numeric()
                    ->default(80)
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),

                Section::make('Preguntas')
                    ->schema([
                        Forms\Components\Repeater::make('questions')
                            ->relationship()
                            ->label('Preguntas')
                            ->schema([
                                Forms\Components\TextInput::make('question_text')
                                    ->label('Texto de la Pregunta')
                                    ->required(),
                                Forms\Components\Repeater::make('options')
                                    ->relationship()
                                    ->label('Opciones (Respuestas)')
                                    ->schema([
                                        Forms\Components\TextInput::make('option_text')
                                            ->label('Respuesta')
                                            ->required(),
                                        Forms\Components\Toggle::make('is_correct')
                                            ->label('¿Es Correcta?')
                                            ->default(false),
                                    ])
                                    ->grid(2)
                                    ->minItems(2)
                                    ->required(),
                            ])
                            ->orderColumn('order')
                            ->collapsed()
                            ->itemLabel(fn (array $state): ?string => $state['question_text'] ?? null),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.title')
                    ->label('Curso')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('passing_score')
                    ->label('Min. Aprobación'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
