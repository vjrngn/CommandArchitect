<?php namespace Leverage\Commander;

interface CommandHandler {

    /**
     * Handle the command
     *
     * @param $command
     */
    public function handle($command);

}