<?php namespace Leverage\Commander\Events; 

use Illuminate\Events\Dispatcher as Event;
use Illuminate\Log\Writer;

class EventDispatcher {


    /**
     * Laravel's native EventDispatcher
     *
     * @var Event
     */
    private $event;
    /**
     * Laravel's logger
     *
     * @var Writer
     */
    private $log;

    function __construct(Event $event, Writer $log)
    {
        $this->event = $event;
        $this->log = $log;
    }

    public function dispatch(array $events)
    {
        foreach($events as $event) {
            $eventName = $this->getEventName( $event );

            $this->event->fire( $eventName, $event);

            $this->log->info("$eventName was fired");
        }
    }

    /**
     * Fetch the namespaced event name.
     *
     * @param $event
     *
     * @return mixed
     */
    protected function getEventName($event)
    {
        return str_replace( '\\', '.', get_class( $event ) );
    }
}