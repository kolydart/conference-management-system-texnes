<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

trait FilterByUser
{
    protected static function bootFilterByUser()
    {
        if (! app()->runningInConsole() && auth('api')->check()) {
            $user = auth('api')->user();

            static::creating(function ($model) use ($user) {
                $model->created_by_id = $user->id;
            });

            $all_role_id = config('quickadmin.can_see_all_records_role_id');
            $model = class_basename(self::class);

            if (in_array($all_role_id, $user->role->pluck('id')->toArray())) {
                if (Session::get($model . '.filter', 'all') == 'my') {
                    Session::put($model . '.filter', 'my');
                    $scoped = true;
                } else {
                    Session::put($model . '.filter', 'all');
                    $scoped = false;
                }
            } else {
                $scoped = true;
            }

            if ($scoped) {
                if (((new static)->getTable()) == 'users') {
                    static::addGlobalScope('created_by_id', function (Builder $builder) use ($user) {
                        $builder->where('created_by_id', $user->id)
                            ->orWhere('id', $user->id);
                    });
                } else {
                    static::addGlobalScope('created_by_id', function (Builder $builder) use ($user) {
                        $builder->where('created_by_id', $user->id);
                    });
                }
            }
        }
    }
}
