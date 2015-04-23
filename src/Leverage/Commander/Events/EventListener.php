<?php namespace Leverage\Commander\Events; 

use ReflectionClass;

class EventListener {


    /**
     * Handle the released events.
     *
     * @param $event
     *
     * @return mixed
     */
    public function handle($event)
    {
        $eventName = $this->getEventName( $event );

        if( $this->listenerIsRegistered( $eventName ) )
        {
            return call_user_func( [ $this, "when{$eventName}" ], $event );
        }
    }

    /**
     * Fetch event name
     *
     * @param $event
     *
     * @return string
     */
    private function getEventName($event)
    {
        return ( new ReflectionClass( $event ) )->getShortName();
    }

    /**
     * Check if event listener is registered in the child class.
     *
     * @param $eventName
     *
     * @return bool
     */
    protected function listenerIsRegistered($eventName)
    {
        $method = "when{$eventName}";

        return method_exists( $this, $method );
    }
}