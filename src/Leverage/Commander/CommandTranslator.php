<?php namespace Leverage\Commander;

class CommandTranslator {

    /**
     * Translate the command to it's companion handler class
     *
     * @param $command
     *
     * @return mixed
     * @throws \Exception
     */
    public function toCommandHandler($command)
    {
        $commandHandler = $this->replace('Command', 'CommandHandler', $command );

        if( !class_exists( $commandHandler ) )
        {
            $message = "Command Handler {$commandHandler} does not exist";

            throw new \Exception( $message );
        }

        return $commandHandler;
    }

    /**
     * Translate the command to it's validator
     *
     * This allows for decorating the command with
     * validator to easily handle validation.
     *
     * @param $command
     * @return mixed
     */
    public function toCommandValidator($command)
    {
        return $this->replace('Command', 'Validator', $command);
    }

    /**
     * Find and replace terms in a string.
     *
     * @param $term String
     * @param $replacement String
     * @param $context
     *
     * @return mixed
     */
    protected function replace($term, $replacement, $context)
    {
        return str_replace( $term, $replacement, get_class( $context ) );
    }
}