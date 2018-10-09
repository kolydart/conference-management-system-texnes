<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use gateweb\common\Presenter;

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

        // Auth gates for: backend
        Gate::define('backend_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });

        // Auth gates for: attend_delete
        Gate::define('attend_delete', function ($user,$paper) {
            return ($paper->attend()->where('id',$user->id)->count()) ? true : false;
        });

        // Auth gates for: attend_create
        Gate::define('attend_create', function ($user,$paper) {
            $max_user_attends = 7;
            $capacity = $paper->capacity();
            if(
                Gate::denies('attend_delete',$paper)
                && Presenter::left($paper->type,10) == 'Εργαστήριο'
                && $paper->attend()->count() < $capacity
                && $user->attend()->count() < $max_user_attends
            ){
                return true;
            }else{
                return false;
            }
        });

        // Auth gates for: attend_delete_backend (admins only)
        Gate::define('attend_delete_backend', function ($user, $paper, $attendee) {
            return ($paper->attend()->where('id',$attendee->id)->count() && in_array($user->role_id, [1, 3, 4])) ? true : false;
        });

        // Auth gates for: Sessions
        Gate::define('session_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('session_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('session_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('session_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('session_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });

        // Auth gates for: Rooms
        Gate::define('room_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('room_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('room_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('room_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('room_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });

        // Auth gates for: Papers
        Gate::define('paper_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('paper_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('paper_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('paper_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('paper_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Fullpaper
        Gate::define('fullpaper_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('fullpaper_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('fullpaper_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('fullpaper_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('fullpaper_delete', function ($user) {
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
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Content management
        Gate::define('content_management_access', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Content pages
        Gate::define('content_page_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('content_page_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('content_page_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('content_page_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('content_page_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Content categories
        Gate::define('content_category_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('content_category_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('content_category_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('content_category_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('content_category_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Content tags
        Gate::define('content_tag_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('content_tag_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('content_tag_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('content_tag_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('content_tag_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Management
        Gate::define('management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Lunch
        Gate::define('lunch_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('lunch_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('lunch_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('lunch_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('lunch_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Availability
        Gate::define('availability_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('availability_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('availability_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('availability_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5]);
        });
        Gate::define('availability_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });

        // Auth gates for: Colors
        Gate::define('color_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('color_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('color_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('color_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('color_delete', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });

        // Auth gates for: Messages
        Gate::define('message_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('message_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('message_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('message_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('message_delete', function ($user) {
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

        // Auth gates for: Activitylog
        Gate::define('activitylog_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('activitylog_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('activitylog_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('activitylog_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Loguseragent
        Gate::define('loguseragent_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('loguseragent_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('loguseragent_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('loguseragent_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
