<?php

namespace App\Providers;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        view()->composer('*', function($view) {
            $unread = 0;
            if(Auth::check()) {
                $conversations = Conversation::where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id())->get();

                foreach ($conversations as $conversation) {
                    $messages = $conversation->messages->where("sender_id", '!=', Auth::id())->where('read', false);
                    $unread += count($messages);
                }

            }
            view()->share('unread', $unread);
        });
    }
}
