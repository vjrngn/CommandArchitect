<?php namespace Leverage\Commander;

interface CommandBusInterface {

    /**
     * Execute the command
     *
     * @param $command
     */
    public function execute($command);

}