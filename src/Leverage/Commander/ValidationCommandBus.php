<?php namespace Leverage\Commander;

use Illuminate\Foundation\Application;

class ValidationCommandBus implements CommandBusInterface {


    /**
     * @var Application
     */
    private $app;
    /**
     * @var DefaultCommandBus
     */
    private $commandBus;
    /**
     * @var CommandTranslator
     */
    private $translator;

    public function __construct(Application $app, DefaultCommandBus $commandBus, CommandTranslator $translator)
    {
        $this->app = $app;
        $this->commandBus = $commandBus;
        $this->translator = $translator;
    }


    /**
     * Execute the command
     *
     * @param $command
     */
    public function execute($command)
    {
        $validatorClass = $this->translator->toCommandValidator( $command );


        if( class_exists( $validatorClass ) )
        {
            $this->call( $validatorClass )->validate( $command );
        }

        return $this->commandBus->execute( $command );
    }

    /**
     * @param $validatorClass
     *
     * @return mixed
     */
    protected function call($validatorClass)
    {
        return $this->app->make( $validatorClass );
    }
}