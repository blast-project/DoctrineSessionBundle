<?php

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;

use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;

/*
 * @todo : check if we can do it in a composer script or something more simple
 */

if (file_exists($file = __DIR__.'/../Resources/App/AppKernel.php')) {
    require_once $file;


    $kernel = new AppKernel('test', true); // create a "test" kernel
    $kernel->boot();
    
    $application = new Application($kernel);

    // add the database:drop command to the application and run it
    $command = new DropDatabaseDoctrineCommand();
    $application->add($command);
    $input = new ArrayInput(array(
        'command' => 'doctrine:database:drop',
        '--if-exists' => true,
        '--force' => true,
     ));
    $command->run($input, new ConsoleOutput());
    
    // add the database:create command to the application and run it
    $command = new CreateDatabaseDoctrineCommand();
    $application->add($command);
    $input = new ArrayInput(array(
        'command' => 'doctrine:database:create',
        '--if-not-exists' => true,
    ));
    $command->run($input, new ConsoleOutput());


    // let Doctrine create the database schema (i.e. the tables)
    $command = new CreateSchemaDoctrineCommand();
    $application->add($command);
    $input = new ArrayInput(array(
        'command' => 'doctrine:schema:create',
    ));
    $command->run($input, new ConsoleOutput());
}
