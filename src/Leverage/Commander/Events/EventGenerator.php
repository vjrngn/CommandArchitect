<?php namespace Leverage\Commander\Events; 

trait EventGenerator {

    /**
     * The collection of events raised by the application
     *
     * @var array
     */
    protected $pendingEvents = [];

    /**
     * Append events and store it for future release
     *
     * @param $event
     */
    public function raise($event)
    {
        $this->pendingEvents[] = $event;
    }

    /**
     * Release all pending events.
     *
     * @return array
     */
    public function releaseEvents()
    {
        $events = $this->pendingEvents;

        $this->pendingEvents = [];

        return $events;
    }

}