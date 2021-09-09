<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class UpdateLastSignInAt
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    private $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->last_login_at = $event->user->current_login_at ?? Carbon::now();
        $event->user->current_login_at = Carbon::now();

        $event->user->last_login_ip = $event->user->current_login_ip ?? $this->request->ip(); 
        $event->user->current_login_ip = $this->request->ip();

        $event->user->save();
    }
}
