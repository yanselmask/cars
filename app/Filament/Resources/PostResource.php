<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Custom\SEO;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make(__('Content'))
                    ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required(),
                            Forms\Components\TextInput::make('slug')
                                ->prefix(getPath('blog', true)),
                            Forms\Components\Textarea::make('description')
                                ->columnSpanFull(),
                            Forms\Components\Checkbox::make('is_featured'),
                            Forms\Components\Builder::make('content')
                            ->schema([
                                Forms\Components\Builder\Block::make('heading')
                                    ->schema([
                                        Forms\Components\TextInput::make('content')
                                            ->label('Heading')
                                            ->required(),
                                        Forms\Components\Select::make('level')
                                            ->options([
                                                'h1' => 'Heading 1',
                                                'h2' => 'Heading 2',
                                                'h3' => 'Heading 3',
                                                'h4' => 'Heading 4',
                                                'h5' => 'Heading 5',
                                                'h6' => 'Heading 6',
                                            ])
                                            ->required(),
                                    ])
                                    ->columns(2),
                                Forms\Components\Builder\Block::make('paragraph')
                                    ->schema([
                                        Forms\Components\Textarea::make('content')
                                            ->label('Paragraph')
                                            ->required(),
                                        Forms\Components\Radio::make('bold')
                                            ->boolean()
                                            ->default(false)
                                            ->label('Bold')
                                            ->required(),
                                    ]),
                                Forms\Components\Builder\Block::make('blockquote')
                                    ->schema([
                                        Forms\Components\Textarea::make('content')
                                            ->label(__('Content'))
                                            ->required(),
                                        Forms\Components\TextInput::make('author')
                                            ->label(__('Author')),
                                        Forms\Components\Radio::make('align')
                                            ->options([
                                                'text-start' => __('Left'),
                                                'text-center' => __('Center'),
                                                'text-end' => __('Right'),
                                            ])
                                            ->default('text-start')
                                            ->label(__('Align'))
                                            ->required(),
                                    ]),
                                Forms\Components\Builder\Block::make('image')
                                    ->schema([
                                        Forms\Components\FileUpload::make('url')
                                            ->label('Image')
                                            ->image()
                                            ->required(),
                                        Forms\Components\TextInput::make('alt')
                                            ->label('Alt text')
                                            ->required(),
                                    ]),
                                Forms\Components\Builder\Block::make('video')
                                ->schema([
                                    Forms\Components\TextInput::make('content')
                                        ->label(__('Video Link'))
                                        ->required(),
                                    Forms\Components\FileUpload::make('image')
                                        ->label(__('Image'))
                                        ->image()
                                        ->required(),
                                ]),
                                Forms\Components\Builder\Block::make('gallery')
                                    ->schema([
                                        Forms\Components\FileUpload::make('images')
                                            ->label(__('Images'))
                                            ->image()
                                            ->multiple()
                                            ->panelLayout('grid')
                                            ->reorderable()
                                            ->required(),
                                    ]),
                                Forms\Components\Builder\Block::make('listing')
                                    ->schema([
                                        Forms\Components\TextInput::make('title'),
                                        Forms\Components\Select::make('listings')
                                            ->multiple()
                                            ->maxItems(6)
                                            ->options(\App\Models\Listing::approved()->select('name', 'id')->get()->mapWithKeys(fn ($type) => [$type->id => $type->name]))
                                    ]),
                                Forms\Components\Builder\Block::make('map')
                                    ->schema([
                                        Forms\Components\TextInput::make('lat'),
                                        Forms\Components\TextInput::make('long'),
                                        Forms\Components\TextInput::make('title'),
                                        Forms\Components\Textarea::make('description'),
                                    ]),
                                Forms\Components\Builder\Block::make('partners')
                                    ->schema([
                                        Forms\Components\TextInput::make('title'),
                                        Forms\Components\Repeater::make('partners')
                                            ->schema([
                                                Forms\Components\FileUpload::make('image')
                                                    ->required(),
                                                Forms\Components\TextInput::make('link')
                                                    ->default('#'),
                                            ])
                                            ->cloneable()
                                            ->maxItems(10)
                                    ]),
                                Forms\Components\Builder\Block::make('app_mobile')
                                    ->schema([
                                        Forms\Components\TextInput::make('title'),
                                        Forms\Components\Textarea::make('description'),
                                        Forms\Components\TextInput::make('app_store_link')
                                            ->default('#'),
                                        Forms\Components\TextInput::make('google_play_link')
                                            ->default('#'),
                                        Forms\Components\FileUpload::make('image'),
                                    ]),
                                Forms\Components\Builder\Block::make('posts')
                                    ->schema([
                                        Forms\Components\TextInput::make('title'),
                                        Forms\Components\Select::make('ids')
                                            ->multiple()
                                            ->maxItems(6)
                                            ->options(\App\Models\Post::published()->select('name', 'id')->get()->mapWithKeys(fn ($post) => [$post->id => $post->name]))
                                    ]),
                            ])->collapsible(),
                            SEO::make()
                    ]),
                    Forms\Components\Tabs\Tab::make(__('Options'))
                    ->schema([
                                Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('category_id')
                                        ->relationship(name: 'category', titleAttribute: 'name'),
                                    \Filament\Forms\Components\SpatieTagsInput::make('tags'),
                                ]),
                            Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->options(Status::getLabels()),
                                Forms\Components\Select::make('user_id')
                                    ->relationship(name: 'user', titleAttribute: 'name')
                                    ->default(auth()->user()->id),
                                ]),
                                SpatieMediaLibraryFileUpload::make('featured_image')
                                    ->columnSpanFull(),
                    ])
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
