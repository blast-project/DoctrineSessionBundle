<?php

namespace  Blast\DoctrineSessionBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

use Blast\DoctrineSessionBundle\Handler\DoctrineORMHandler;
use Symfony\Component\HttpFoundation\Session\Session;

/*
 * @todo: check if Entity\Session why (it need to) implement SessionInterface
use Blast\DoctrineSessionBundle\Entity\Session;
*/

/*
 * for test on session implementation only
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Doctrine\ORM\Query\ResultSetMapping;
*/

use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Needed as php allow only one session by process
 * @runTestsInSeparateProcesses
 */
class SessionTest extends KernelTestCase
{
    
    
    protected $entitymanager;
    protected $registrymanager;
    protected $sessionclass;
    protected $doctrinehandler;
    protected $session;
    protected $sessionid;
    
    protected function getArrayFromDb($sessionId)
    {
               /* to be able to get data from database */
        $this->session->save();
        //$this->entitymanager->clear();
        //$this->entitymanager->flush();
        
        $query = $this->registrymanager->getRepository($this->sessionclass)
               ->createQueryBuilder('s')
               ->select()
               ->where('s.sessionId = :session_id')
               ->setParameter("session_id", $sessionId)
               ->getQuery();

        $arrayRes = $query->getArrayResult();
        return $arrayRes;
    }
    
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

        //$this->storage = new NativeSessionStorage(['use_cookies' => false], new NativeSessionHandler());
        //$this->storage = new PhpBridgeSessionStorage();
        //$this->storage = new MockArraySessionStorage();

        /*
         * @todo: check if there is a bug without the phpunit  --process-isolation 
         * should it test on new session if already created and set is started
         */
        $this->session = new Session($this->storage);
       
        //        if (!$this->session->isStarted()) {
        //      if (!$this->storage->isStarted()) {
        $this->session->start();
        $this->sessionid = $this->session->getId();

        // }
    }

    public function tearDown()
    {
    }


    public function testIsStarted()
    {
        /*
         *@todo check if isStarted is well implemented
         */
        $this->assertTrue($this->session->isStarted());
    }
    
    
    public function testIsSessionInDB()
    {
        $array_res = $this->getArrayFromDb($this->sessionid);
 
        //$this->assertEquals($this->session->getId(), $array_res[0]['sessionId']);
        $this->assertArrayHasKey('createdAt', $array_res[0]);
        $this->assertArrayHasKey('expiresAt', $array_res[0]);
        $this->assertArraySubset(['sessionId' => $this->sessionid], $array_res[0]);

        //         var_dump($array_res);

        /*
          if (function_exists('xdebug_disable')) {
          xdebug_disable();
          var_dump($query->getArrayResult());
          }
        */
        
        /*
          $session_db_line = $this
          ->entitymanager
          ->getRepository($this->sessionclass)
          ->findBy(array('sessionId' => $this->sessionid));
          
          var_dump($session_db_line);
        */
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
        //   var_dump($this->session->getMetadataBag()->getLifetime());
        // var_dump($this->session->getMetadataBag());
    }
   
    public function testClearSession()
    {
        $this->session->set('foo', 'bar');
        $this->assertEquals('bar', $this->session->get('foo'));
        $this->session->clear();
        $this->assertNull($this->session->get('foo'));
    }

    public function testClearStorage()
    {
        $this->session->set('foo', 'bar');
        $this->assertEquals('bar', $this->session->get('foo'));
        $this->storage->clear();
        $this->assertNull($this->session->get('foo'));
    }


    public function testGc()
    {
        /*
         * @todo : check if param is used or not
         */
        //    $this->session->setExpiresAt(new \DateTime());
        /*        var_dump($this->getArrayFromDb($this->sessionid));
               $this->doctrinehandler->gc(0);
        var_dump($this->getArrayFromDb($this->sessionid));
        */
    }

    public function testDestroy()
    {
        $this->assertCount(1, $this->getArrayFromDb($this->sessionid));
        $this->doctrinehandler->destroy($this->sessionid);
        $this->assertCount(0, $this->getArrayFromDb($this->sessionid));
    }
}
