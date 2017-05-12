<?php

namespace  Blast\DoctrineSessionBundle\Tests\Functional;

use Blast\DoctrineSessionBundle\Handler\DoctrineORMHandler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;

class SessionTest extends KernelTestCase
{
    
    
    // protected $entitymanager;
    protected $registrymanager;
    protected $sessionclass;
    protected $doctrinehandler;
    protected $session;
    
    
    
    protected function setUp()
    {
        static::bootKernel();
        /*
         * SELECT table_name FROM information_schema.tables where TABLE_SCHEMA='travis' 
         *  select * from sf_session
         *  @todo: get result from database to check if session exist 
         */
        
        $this->registrymanager = static::$kernel
                                ->getContainer()
                                ->get('doctrine');
        $this->entitymanager = $this->registrymanager
                             ->getManager();
       
        $this->sessionclass = 'Blast\DoctrineSessionBundle\Entity\Session';
        
        $this->doctrinehandler = new DoctrineORMHandler($this->registrymanager, $this->sessionclass);

        
        /*
         * Need to disable cookies to avoid error
         * RuntimeException: Failed to start the session because headers have already been sent...
         * from NativeSessionStorage line 134
         */

        
        $this->storage = new NativeSessionStorage(['use_cookies' => false], $this->doctrinehandler);

        //        $this->storage = new NativeSessionStorage(['use_cookies' => false], new NativeSessionHandler());
        
        //$this->storage = new PhpBridgeSessionStorage();
        
        //$this->storage = new MockArraySessionStorage();

        /*
         * @todo: check if there is a bug without the phpunit  --process-isolation 
         * should it test on new session if already created and set is started
         */
        $this->session = new Session($this->storage);

        /*
          if (!$this->session->isStarted()) {
          $this->session->start();
          }
        */
    }

    public function tearDown()
    {
        // session_destroy();
    }


    public function testStart()
    {
        /*  $this->assertTrue($this->session->isStarted()); */
    }
    
    
    public function testSession()
    {
        //var_dump(session_status());
 
        //$session->destroy();
        //        var_dump($_SESSION);
        //var_dump($_SERVER);

        //        var_dump($session->getId());
        // set and get session attributes
        //$session->set('foo', 'bar');
        // $session->get('foo');
        
        // set flash messages
        // $session->getFlashBag()->add('zoo', 'far');
        // sleep(10);
        //        $session->destroy($session->getId());
        
        //        var_dump(session_status());
        // var_dump($this->storage->getSaveHandler()->isActive());
        // var_dump($session->isStarted());
        
        //$session->clear();
    }

  
    public function testSession2()
    {
        //$session = new Session($this->storage);
        //if (session_status() !== PHP_SESSION_ACTIVE) {
        //    $session->start();
        //}
        
        ///var_dump($session->getId());
    }

    public function testInvalidate()
    {
        /*
         * @todo: invalidate should work
         * $this->session->invalidate();
         */
    }
    public function testLifetime()
    {
        /*   var_dump($this->session->getMetadataBag()->getLifetime()); */
    }
    /**
     * @depends testStart
     */
    public function testClear()
    {
        $this->session->set('foo', 'bar');
        $this->assertEquals('bar', $this->session->get('foo'));
        $this->session->clear();
        $this->assertNull($this->session->get('foo'));
    }
}
