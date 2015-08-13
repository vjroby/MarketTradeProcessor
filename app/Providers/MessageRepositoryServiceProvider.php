<?php
/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:57
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class MessageRepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\MessageRepositoryInterface',
            'App\Repositories\EloquentMessageRepository'
        );
    }
} // end of class