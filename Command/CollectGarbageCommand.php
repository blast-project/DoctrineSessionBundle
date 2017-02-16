<?php
namespace Blast\DoctrineSessionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CollectGarbageCommand extends ContainerAwareCommand
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('blast:session:collect-garbage');
        $this->setDescription('Deletes expired sessions.');
    }
    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('blast_doctrine_session.handler.doctrine_orm')->gc(null);
    }
}