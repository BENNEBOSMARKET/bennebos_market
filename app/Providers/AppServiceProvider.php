<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\SocialUserResolver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;

class AppServiceProvider extends ServiceProvider
{

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
    */
    public $bindings = [
        SocialUserResolverInterface::class => SocialUserResolver::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */

        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

        // if ( Schema::hasTable('languages') ){
        //     $currentLanguage = DB::table('languages')->first();

        //     if($currentLanguage){
        //         App::setLocale($currentLanguage->current_language);
        //     }
        // }

        // ProductCollection::withoutWrapping();
        // SliderCollection::withoutWrapping();
        Schema::defaultStringLength(191);
        //css loading problem after ssl certificate
        // if(env("APP_ENV") != "local"){
        //     URL::forceScheme("https");
        // }
    }
}
