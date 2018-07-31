<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: Papers
        Gate::define('paper_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('paper_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('paper_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('paper_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('paper_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Reviews
        Gate::define('review_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('review_create', function ($user) {
            return in_array($user->role_id, [1, 3, 5]);
        });
        Gate::define('review_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('review_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('review_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Arts
        Gate::define('art_access', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('art_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('art_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('art_view', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('art_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: User actions
        Gate::define('user_action_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

    }
}
