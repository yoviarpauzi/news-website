<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Models\Category;
use Filament\Forms\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\FileUpload;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('categories')
                    ->multiple()
                    ->relationship('categories', 'name')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->columnSpanFull()
                    ->afterStateUpdated(function ($state, $set, $get, $record) {
                        if ($record) {
                            $record->categories()->sync($state);
                        }
                    }),
                TextInput::make('title')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100)
                    ->autocapitalize('words')
                    ->columnSpanFull(),
                FileUpload::make('thumbnail')
                    ->required()
                    ->image()
                    ->imagePreviewHeight('300')
                    ->disk('public')
                    ->directory('attachments')
                    ->visibility('public')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('attachments')
                    ->fileAttachmentsVisibility('public'),
                Section::make('Publishing')
                    ->description('Setting for publishing this post.')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->default('draft')
                            ->required()
                            ->live(),
                        DateTimePicker::make('published_at')
                            ->hidden(fn(Get $get) => $get('status') !== 'published')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => implode(' ', array_slice(explode(' ', $state), 0, 3)) . '...'),
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => implode(' ', array_slice(explode('-', $state), 0, 3)) . '...'),
                TextColumn::make('status')
                    ->icon(fn(string $state): string => match ($state) {
                        'draft' => 'heroicon-o-pencil',
                        'published' => 'heroicon-o-check-circle',
                    })->color(fn(string $state): string => match ($state) {
                        'draft' => 'info',
                        'published' => 'success',
                        default => 'gray',
                    })
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
