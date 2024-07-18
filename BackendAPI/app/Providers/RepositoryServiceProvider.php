<?php

namespace App\Providers;

use App\Repositories\BooksRepository;
use App\Repositories\MembersRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PeminjamanRepository;
use App\Repositories\Interfaces\BooksInterface;
use App\Repositories\Interfaces\MembersInterface;
use App\Repositories\Interfaces\PeminjamanInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BooksInterface::class, BooksRepository::class);
        $this->app->bind(MembersInterface::class, MembersRepository::class);
        $this->app->bind(PeminjamanInterface::class, PeminjamanRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
