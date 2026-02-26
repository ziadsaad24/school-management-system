<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServieceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repository\TeacherRepositoryInterface',
            'App\Repository\TeacherRepository',
            
        );
        $this->app->bind(
            'App\Repository\StudentRepositoryInterface',
            'App\Repository\StudentRepository',
            
        );
         $this->app->bind(
            'App\Repository\PromotionRepositoryInterface',
            'App\Repository\PromotionRepository',
            
        );
        $this->app->bind(
            'App\Repository\GraduatedRepositoryInterface',
            'App\Repository\GraduatedRepository',
            
        );
        $this->app->bind(
            'App\Repository\FeesRepositoryInterface',
            'App\Repository\FeesRepository',
            
        );
        $this->app->bind(
            'App\Repository\FeeinvoicesRepositoryInterface',
            'App\Repository\FeeinvoicesRepository',
            
        );
        $this->app->bind(
             'App\Repository\ReceiptRepositoryInterface',
                        'App\Repository\ReceiptRepository',
        );
       $this->app->bind(
    'App\Repository\ProcessingFeeRepositoryInterface',
    'App\Repository\ProcessingFeeRepository'
);
       $this->app->bind(
    'App\Repository\PaymentRepositoryInterface',
    'App\Repository\PaymentRepository'
);

    $this->app->bind(
    'App\Repository\AttendanceRepositoryInterface',
    'App\Repository\AttendanceRepository'
);
    $this->app->bind(
    'App\Repository\SubjectRepositoryInterface',
    'App\Repository\SubjectRepository'
);
    $this->app->bind(
    'App\Repository\ExamRepositoryInterface',
    'App\Repository\ExamRepository'
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
