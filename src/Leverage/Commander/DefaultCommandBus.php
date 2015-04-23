<?php namespace Leverage\Commander;

use Illuminate\Foundation\Application;

class DefaultCommandBus implements CommandBusInterface {


    /**
     * @var CommandTranslator
     */
    private $translator;

    /**
     * @var Application
     */
    private $app;

    /**
     * @param CommandTranslator $translator
     * @param Application       $app
     */
    public function __construct(CommandTranslator $translator, Application $app)
    {
        $this->translator = $translator;
        $this->app = $app;
    }

    /**
     * Execute the command.
     * @param $command
     *
     * @throws \Exception
     */
    public function execute($command)
    {
        $handler = $this->translator->toCommandHandler($command);

        $this->app->make($handler)->handle($command);
    }
}