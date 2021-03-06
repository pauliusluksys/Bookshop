<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use App\Models\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
          Book::class => BookPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update,delete-book', function (User $user, $bookId) {
        return (($user->id === Book::find($bookId)->user_id)||($user->role==='admin'));
        });

         Gate::define('update-book', function (User $user, Book $book) {
        return $user->id === $book->user_id;
        });
         Gate::define('create-book', function (User $user, Post $post) {
            return $user->role_id === 2;
        });
         Gate::define('admin-only', function (User $user) {
        return $user->role_id==1;
        });
    }
}

