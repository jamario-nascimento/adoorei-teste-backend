<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\Interfaces\BaseRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Base
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);

        // Produto
        $this->app->bind(\Modules\Produto\Repositories\Interfaces\ProdutoRepositoryInterface::class, \Modules\Produto\Repositories\ProdutoRepository::class);
        $this->app->bind(\Modules\Produto\Services\Interfaces\ProdutoServiceInterface::class, \Modules\Produto\Services\ProdutoService::class);

        // Venda
        $this->app->bind(\Modules\Venda\Repositories\Interfaces\VendaRepositoryInterface::class, \Modules\Venda\Repositories\VendaRepository::class);
        $this->app->bind(\Modules\Venda\Services\Interfaces\VendaServiceInterface::class, \Modules\Venda\Services\VendaService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
