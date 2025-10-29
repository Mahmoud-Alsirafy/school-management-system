<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repository\Teacher\TeacherRepositoryInterface',
            'App\Repository\Teacher\TeacherRepository'
        );
        $this->app->bind(
            'App\Repository\Student\StudentRepositoryInterface',
            'App\Repository\Student\StudentRepository'
        );
         $this->app->bind(
            'App\Repository\Promotion\PromotionRepositoryInterface',
            'App\Repository\Promotion\PromotionRepository'
        );
        $this->app->bind(
            'App\Repository\Graduated\GraduatedRepositoryInterface',
            'App\Repository\Graduated\GraduatedRepository'
        );
        $this->app->bind(
            'App\Repository\Fees\FeesRepositoryInterface',
            'App\Repository\Fees\FeesRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
