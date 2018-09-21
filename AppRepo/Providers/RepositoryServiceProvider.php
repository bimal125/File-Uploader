<?php
namespace AppRepo\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
      	$this->app->bind(
            'AppRepo\Repository\FileRepositoryInterface',
            'AppRepo\Repository\Eloquent\FileEloquentRepository'
        );
    }
    
}