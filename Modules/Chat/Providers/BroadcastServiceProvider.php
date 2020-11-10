<?php

namespace Modules\Chat\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;


class BroadcastServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Broadcast::routes(['middleware' => 'chat']);

        require module_path('Chat').'/Http/channels.php';
    }

}
