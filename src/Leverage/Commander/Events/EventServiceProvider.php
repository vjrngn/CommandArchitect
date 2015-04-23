<?php namespace Leverage\Commander\Events; 

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $listeners = $this->app[ 'config' ]->get( 'hotelier.listeners' );

        foreach ($listeners as $listener)
        {
            $this->app[ 'events' ]->listen( 'Hotelier.*', $listener );
        }
    }
}