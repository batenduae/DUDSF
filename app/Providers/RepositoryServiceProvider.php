<?php

namespace App\Providers;

use App\Contracts\MemberContract;
use App\Contracts\MenuContract;
use App\Repositories\MemberRepository;
use App\Repositories\MenuRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        MenuContract::class     =>  MenuRepository::class,
        MemberContract::class   =>  MemberRepository::class,

    ];
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface,$implementation);
        }
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
