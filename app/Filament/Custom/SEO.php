<?php

namespace App\Filament\Custom;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SEO
{
    public static function make(array $only = ['title', 'description', 'image', 'robots', 'author']): Section
    {
        return Section::make(__('Search Engine Optimize'))
            ->description(__('Setup meta title & description to make your site easy to discovered on search engines such as Google'))
            ->collapsible()
            ->collapsed()
            ->schema([
                Group::make(
                    Arr::only([
                        'title' => TextInput::make('title')
                            ->translateLabel()
                            ->label(__('SEO Title'))
                            ->helperText(function (?string $state): string {
                                return (string) Str::of(strlen($state))
                                    ->append(' / ')
                                    ->append(60 . ' ')
                                    ->append(Str::of(__('filament-seo::translations.characters'))->lower());
                            })
                            ->reactive()
                            ->columnSpan(2),
                        'description' => Textarea::make('description')
                            ->translateLabel()
                            ->label(__('SEO Description'))
                            ->helperText(function (?string $state): string {
                                return (string) Str::of(strlen($state))
                                    ->append(' / ')
                                    ->append(160 . ' ')
                                    ->append(Str::of(__('filament-seo::translations.characters'))->lower());
                            })
                            ->reactive()
                            ->columnSpan(2),
                        'image' => FileUpload::make('image')
                            ->translateLabel()
                            ->label(__('SEO Image'))
                            ->dehydrated(false)
                            ->columnSpan(2),
                        'robots' => Radio::make('robots')
                            ->translateLabel()
                            ->label(__('Index'))
                            ->options([
                                'all' => __('Index'),
                                'noindex' => __('No index')
                            ])
                            ->inline()
                            ->inlineLabel(false)
                            ->columnSpan(2),
                        'author' => TextInput::make('author')
                            ->translateLabel()
                            ->label(__('filament-seo::translations.author'))
                            ->default(auth()->user()->name)
                            ->columnSpan(2),
                    ], $only)
                )
                    ->afterStateHydrated(function (Group $component, ?Model $record) use ($only): void {
                        $component->getChildComponentContainer()->fill(
                            $record?->seo?->only($only) ?: []
                        );
                    })
                    ->statePath('seo')
                    ->dehydrated(false)
                    ->saveRelationshipsUsing(function (Model $record, array $state) use ($only): void {
                        $state = collect($state)->only($only)->map(fn ($value) => $value ?: null)->all();
                        if ($record->seo && $record->seo->exists) {
                            if($state['image'])
                            {
                                foreach ($state['image'] as $image) {
                                    $state['image'] = $image;
                                }
                            }
                            $record->seo()->update($state);
                        } else {
                            if($state['image'])
                            {
                                foreach ($state['image'] as $image) {
                                    $state['image'] = $image;
                                }
                            }
                            $record->seo()->create($state);
                        }
                    })
            ]);
    }
}
