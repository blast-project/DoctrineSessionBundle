<?php
namespace Blast\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Input\ArrayInput;
/**
 * @todo remove this or not
 use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
 use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
 use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;
*/
use Symfony\Component\Console\Tester\CommandTester;

class BlastTest extends KernelTestCase
{
    /**
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
        // var_dump($cmdargs);
        
        $this->application->add($this->command);
        if (in_array(['--no-interaction'], $cmdargs)) {
            $cmdargs['--no-interaction'] = true;
        }
        $this->input = new ArrayInput($cmdargs);
        $this->output = new ConsoleOutput();
        
        $res = $this->command->run($this->input, $this->output);
        //  var_dump($res);
        return $res;
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

    protected function createDatabase()
    {
        $this->launchCommand([
            'command' => 'doctrine:database:create',
            '--if-not-exists' => true
          ]);
    }

    protected function createSchema()
    {
        $this->launchCommand([
            'command' => 'doctrine:schema:create',
        ]);
    }

    protected function validateSchema()
    {
        $this->launchCommand([
            'command' => 'doctrine:schema:validate'
        ]);
    }

    protected function updateSchema()
    {
        $this->launchCommand([
            'command' => 'doctrine:schema:update',
            '--force' => true
        ]);
    }
}
