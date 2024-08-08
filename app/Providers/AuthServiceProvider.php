<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Travel;
use App\Models\User;
use App\Models\Step;


// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        Gate::define('travel_checker', function (User $user, Travel $travel) {

            return $user->id === $travel->user_id;
        });

        Gate::define('step_checker', function (User $user, Step $step) {
            $travel = Travel::where('id', $step->travel_id)->first();

            return $user->id === $travel->user_id;
        });
    }
}
