<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \Tooleks\Php\AvgColorPicker\Contracts\AvgColorPicker::class,
            \Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker::class
        );

        $this->app->bind(\Lib\ThumbnailsGenerator\Contracts\ThumbnailsGenerator::class, function () {
            return new \Lib\ThumbnailsGenerator\ThumbnailsGenerator(config('main.photo.thumbnails'));
        });

        $this->app->bind(
            \Lib\SiteMap\Contracts\Builder::class,
            \Lib\SiteMap\Builder::class
        );

        $this->app->bind(
            \Core\SiteMap\Contracts\SiteMap::class,
            \Core\SiteMap\SiteMap::class
        );

        $this->app->bind(
            \Lib\Rss\Contracts\Builder::class,
            \Lib\Rss\Builder::class
        );

        $this->app->bind(
            \Core\Rss\Contracts\RssFeed::class,
            \Core\Rss\RssFeed::class
        );
    }
}
