<?php

namespace App\Providers;

use App\Models\Audit;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Course;
use App\Models\Module;
use App\Policies\AuditPolicy;
use App\Policies\CoursePolicy;
use App\Policies\ModulePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
