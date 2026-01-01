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
        $this->app->bind(
            'App\Repository\Fees_invoices\Fees_invoicesRepositoryInterface',
            'App\Repository\Fees_invoices\Fees_invoicesRepository'
        );
        $this->app->bind(
            'App\Repository\StudentAccount\StudentAccountRepositoryInterface',
            'App\Repository\StudentAccount\StudentAccountRepository'
        );
        $this->app->bind(
            'App\Repository\ReceiptStudent\ReceiptStudentRepositoryInterface',
            'App\Repository\ReceiptStudent\ReceiptStudentRepository'
        );
        $this->app->bind(
            'App\Repository\ProcessingFees\ProcessingFeesRepositoryInterface',
            'App\Repository\ProcessingFees\ProcessingFeesRepository'
        );$this->app->bind(
            'App\Repository\Payment\PaymentRepositoryInterface',
            'App\Repository\Payment\PaymentRepository'
        );
        ;$this->app->bind(
            'App\Repository\Attendance\AttendanceRepositoryInterface',
            'App\Repository\Attendance\AttendanceRepository'
        );
        ;$this->app->bind(
            'App\Repository\Subject\SubjectRepositoryInterface',
            'App\Repository\Subject\SubjectRepository'
        );
        ;$this->app->bind(
            'App\Repository\Quizzes\QuizzesRepositoryInterface',
            'App\Repository\Quizzes\QuizzesRepository'
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
