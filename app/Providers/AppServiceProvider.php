<?php

namespace App\Providers;

use App\Models\UserActivity;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Services\User\UserServiceImplement;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Repositories\Product\ProductRepositoryImplement;
use App\Repositories\Category\CategoryRepositoryImplement;
use App\Repositories\ProductAttribute\ProductAttributeRepository;
use App\Repositories\StockTransaction\StockTransactionRepository;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryImplement;
use App\Repositories\StockTransaction\StockTransactionRepositoryImplement;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierRepositoryImplement;
use App\Repositories\UserActivity\UserActivityRepository;
use App\Repositories\UserActivity\UserActivityRepositoryImplement;
use App\Services\Attribute\AttributeService;
use App\Services\Attribute\AttributeServiceImplement;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceImplement;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceImplement;
use App\Services\StockTransaction\StockTransactionService;
use App\Services\StockTransaction\StockTransactionServiceImplement;
use App\Services\Supplier\SupplierService;
use App\Services\Supplier\SupplierServiceImplement;
use App\Services\UserActivity\UserActivityService;
use App\Services\UserActivity\UserActivityServiceImplement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepositoryImplement::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryImplement::class);
        $this->app->bind(ProductRepository::class, ProductRepositoryImplement::class);
        $this->app->bind(ProductAttributeRepository::class, ProductAttributeRepositoryImplement::class);
        $this->app->bind(StockTransactionRepository::class, StockTransactionRepositoryImplement::class);
        $this->app->bind(SupplierRepository::class, SupplierRepositoryImplement::class);
        $this->app->bind(UserActivityRepository::class, UserActivityRepositoryImplement::class);

        $this->app->bind(UserService::class, UserServiceImplement::class);
        $this->app->bind(ProductService::class, ProductServiceImplement::class);
        $this->app->bind(CategoryService::class, CategoryServiceImplement::class);
        $this->app->bind(SupplierService::class, SupplierServiceImplement::class);
        $this->app->bind(AttributeService::class, AttributeServiceImplement::class);
        $this->app->bind(StockTransactionService::class, StockTransactionServiceImplement::class);
        $this->app->bind(UserActivityService::class, UserActivityServiceImplement::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
