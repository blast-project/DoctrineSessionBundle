<?php
namespace Blast\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;
/*
 * @todo remove this or not
 use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
 use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
 use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;
*/
use Symfony\Component\Console\Tester\CommandTester;

class BlastTest extends KernelTestCase
{
    /*
     * @todo: move this classe in a blast test bundle
     */

    protected $application;
    protected $input;
    protected $output;
    protected $command;
    

    protected function launchCommand(array $cmdargs)
    {
        static::bootKernel();
        $this->application = new Application(self::$kernel);
        
        // var_dump($this->application->all('doctrine'));


        $this->command = $this->application->find($cmdargs['command']);
        /* @todo find why or why not CommandTester */
        //        $this->command = new CommandTester($this->application->find($cmdargs['command']));

        // var_dump(gettype($this->command));
        // var_dump(get_class($this->command));
        
        $this->application->add($this->command);

        if (in_array(['--no-interaction'], $cmdargs)) {
            $cmdargs['--no-interaction'] = true;
        }
        // var_dump($cmdargs);
        
        $this->input = new ArrayInput($cmdargs);
        $this->output = new ConsoleOutput();
        
        $res = $this->command->run($this->input, $this->output);
        //  var_dump($res);
    }

    protected function cacheClear()
    {
        $this->launchCommand([
            'command' => 'cache:clear',
            '--no-warmup' => true
        ]);
    }

    
    protected function dropDatabase()
    {
        $this->launchCommand([
            'command' => 'doctrine:database:drop',
            '--if-exists' => true,
            '--force' => true
        ]);
    }

    /*
     * @todo remove this or not
    protected function dropDatabase()
    {
        static::bootKernel();
        $this->application = new Application(self::$kernel);
        $this->command = new DropDatabaseDoctrineCommand();
        $this->application->add($this->command);
        $this->input = new ArrayInput(array(
            'command' => 'doctrine:database:drop',
            '--if-exists' => true,
            '--force' => true,
        ));
        $this->command->run($this->input, new ConsoleOutput());
    }
    */

    protected function createDatabase()
    {
        $this->launchCommand([
            'command' => 'doctrine:database:create',
            '--if-not-exists' => true
            
        ]);
    }
    
    /*
     * @todo remove this or not
    protected function createDatabase()
    {
        static::bootKernel();
        $this->application = new Application(self::$kernel);
        $this->command = new CreateDatabaseDoctrineCommand();
        $this->application->add($this->command);
        $this->input = new ArrayInput(array(
            'command' => 'doctrine:database:create',
            '--if-not-exists' => true,
        ));
        $this->command->run($this->input, new ConsoleOutput());
    }
    */

    protected function createSchema()
    {
        $this->launchCommand([
            'command' => 'doctrine:schema:create',
        ]);
    }

    /*
     * @todo remove this or not
    protected function createSchema()
    {
        static::bootKernel();
        $this->application = new Application(self::$kernel);
        $this->command = new CreateSchemaDoctrineCommand();
        $this->application->add($this->command);
        $this->input = new ArrayInput(array(
            'command' => 'doctrine:schema:create',
        ));
        $this->command->run($this->input, new ConsoleOutput());
    }
    */

    protected function validateSchema()
    {
        $this->launchCommand([
            'command' => 'doctrine:schema:validate'
        ]);
    }
    
    /*
     * @todo remove this or not
    protected function validateSchema()
    {
        static::bootKernel();
        $this->application = new Application(self::$kernel);
        $this->command = new CreateSchemaDoctrineCommand();
        $this->application->add($this->command);
        $this->input = new ArrayInput(array(
        'command' => 'doctrine:schema:validate',
        ));
        $this->command->run($this->input, new ConsoleOutput());
    }
    */


    protected function updateSchema()
    {
        $this->launchCommand([
        'command' => 'doctrine:schema:update',
        '--force' => true
        ]);
    }
}
