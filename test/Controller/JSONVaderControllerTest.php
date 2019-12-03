<?php

namespace Malm18\Vader;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IpcheckControllerTest.
 */
class JsonVaderControllerTest extends TestCase
{
    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;
        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->controller = new JsonVaderController();
        $this->controller->setDI($this->di);
        $session = $di->get("session");
    }





    /**
     * Test the route "index".
     */
    public function testIndexActionGet()
    {
        // Test action
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        // $session = $di->get("session");
        // $res = $this->controller->indexActionGet();
        // $this->assertIsObject($res);
        // $this->assertInstanceOf("Anax\Response\Response", $res);
        // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        // // Get body and compare results
        // $body = $res->getBody();
        // $this->assertContains("<title>Validate IP result | ramverk1</title>", $body);
        // $this->assertContains("<h1>Kolla en ip-adress</h1>", $body);
        // $this->assertContains("<h4>Text</h4>", $body);
        // $this->assertContains("<h4>JSON</h4>", $body);
        // $this->assertContains("<h4>Exempel</h4>", $body);
        $controller = $this->controller;
        $request = $this->di->get("request");
        $request->setGet("ip", "208.67.222.222");
        $request->setGet("pastOrFuture", "past");
        //testcases
        $res = $controller->indexActionGet();
        $this->assertIsArray($res);
    }


    /**
     * Test the route "index".
     */
    public function testIndexActionGet2()
    {
        // Test action
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        // $session = $di->get("session");
        // $res = $this->controller->indexActionGet();
        // $this->assertIsObject($res);
        // $this->assertInstanceOf("Anax\Response\Response", $res);
        // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        // // Get body and compare results
        // $body = $res->getBody();
        // $this->assertContains("<title>Validate IP result | ramverk1</title>", $body);
        // $this->assertContains("<h1>Kolla en ip-adress</h1>", $body);
        // $this->assertContains("<h4>Text</h4>", $body);
        // $this->assertContains("<h4>JSON</h4>", $body);
        // $this->assertContains("<h4>Exempel</h4>", $body);
        $controller = $this->controller;
        $request = $this->di->get("request");
        $request->setGet("ip", "oegariaäofkapokf");
        $request->setGet("pastOrFuture", "future");
        //testcases
        $res = $controller->indexActionGet();
        $this->assertIsArray($res);
    }


    /**
     * Test the route "index".
     */
    // public function testResultPageActionGet()
    // {
    //     // Test action
    //     // $session = $di->get("session");
    //     $res = $this->controller->resultPageActionGet();
    //     $this->assertIsObject($res);
    //     $this->assertInstanceOf("Anax\Response\Response", $res);
    //     $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    //     // Get body and compare results
    //     $body = $res->getBody();
    //     // $this->assertContains("<title>Validate IP result | ramverk1</title>", $body);
    //     // $this->assertContains("<h1>Här är resultatet</h1>", $body);
    //     // $this->assertContains("<h4>Text</h4>", $body);
    //     // $this->assertContains("<h4>JSON</h4>", $body);
    //     // $this->assertContains("<h4>Exempel</h4>", $body);
    // }


    // public function testResultPageActionGet()
    // {
    //     // Test action
    //     // $session = $di->get("session");
    //     $res = $this->controller->resultPageActionGet();
    //     // $this->assertIsObject($res);
    //     // $this->assertInstanceOf("Anax\Response\Response", $res);
    //     // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    //     // $this->assertInstanceOf("Anax\Request\Request", $res);
    //     // $this->assertInstanceOf("Anax\Request\RequestUtility", $res);
    //     // Get body and compare results
    //     // $body = $res->getBody();
    //     // $this->assertContains("<title>Validate IP result | ramverk1</title>", $body);
    //     // $this->assertContains("<h1>Här är resultatet för adressen</h1>", $body);
    //     // $this->assertContains("<h4>Text</h4>", $body);
    //     // $this->assertContains("<h4>JSON</h4>", $body);
    //     // $this->assertContains("<h4>Exempel</h4>", $body);
    // }


    /**
     * Test the route "indexPost".
     */
    public function testjsonVaderActionPost()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip1", "208.67.222.222");
        $request->setPost("pastOrFuture", "future");
        $res = $this->controller->jsonVaderActionPost();
        // $this->assertIsObject($res);
        // $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertEquals(null, $res->getBody());
        // $body = $res->getBody();
        // $xxx = "IPv4";
        // $this->assertContains($xxx, $body);
    }

    /**
     * Test the route "indexPost".
     */
    public function testjsonVaderActionPost2()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip1", "208.67.222.222");
        $request->setPost("pastOrFuture", "past");
        $res = $this->controller->jsonVaderActionPost();
        // $this->assertIsObject($res);
        // $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertEquals(null, $res->getBody());
        // $body = $res->getBody();
        // $xxx = "IPv4";
        // $this->assertContains($xxx, $body);
    }



    /**
     * Test the route "indexPost".
     */
    public function testIndexActionPost3()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip1", "Kramfors");
        $request->setPost("pastOrFuture", "future");
        $res = $this->controller->jsonVaderActionPost();
        // $this->assertIsObject($res);
        // $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertEquals(null, $res->getBody());
        // $body = $res->getBody();
        // $xxx = "IPv4";
        // $this->assertContains($xxx, $body);
    }


    /**
     * Test the route "indexPost".
     */
    public function testjsonVaderActionPost4()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip1", "Kramfors");
        $request->setPost("pastOrFuture", "past");
        $res = $this->controller->jsonVaderActionPost();
        // $this->assertIsObject($res);
        // $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertEquals(null, $res->getBody());
        // $body = $res->getBody();
        // $xxx = "IPv4";
        // $this->assertContains($xxx, $body);
    }


    public function testjsonVaderActionGet()
    {
        // $request = $this->di->get("request");
        // $response = $this->di->get("response");
        // $this->di->set("response", "\Anax\Response\Response");
        // $request->setPost("ip1", "Kramfors");
        // $request->setPost("pastOrFuture", "past");
        // $res = $this->controller->jsonVaderActionPost();
        // // $this->assertIsObject($res);
        // // $this->assertInstanceOf("\Anax\Response\Response", $res);
        // $this->assertEquals(null, $res->getBody());
        // $body = $res->getBody();
        // $xxx = "IPv4";
        // $this->assertContains($xxx, $body);
        $res = $this->controller->jsonVaderActionGet();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        // Get body and compare results
        $body = $res->getBody();
    }

    // public function testResultPageActionGet2()
    // {
    //     $request = $this->di->get("request");
    //     $response = $this->di->get("response");
    //     $session = $this->di->get("session");
    //     $this->di->set("response", "\Anax\Response\Response");
    //     // $request->setPost("ip1", "Kramfors");
    //     // $request->setPost("pastOrFuture", "past");
    //     $session->set("ip1", "Kramfors");
    //     $session->set("pastOrFuture", "past");
    //     $res = $this->controller->resultPageActionGet();
    //     // $this->assertIsObject($res);
    //     // $this->assertInstanceOf("\Anax\Response\Response", $res);
    //     $this->assertNotEquals(null, $res->getBody());
    //     // $body = $res->getBody();
    //     // $xxx = "IPv4";
    //     // $this->assertContains($xxx, $body);
    // }


    // public function testResultPageActionGet3()
    // {
    //     $request = $this->di->get("request");
    //     $response = $this->di->get("response");
    //     $session = $this->di->get("session");
    //     $this->di->set("response", "\Anax\Response\Response");
    //     // $request->setPost("ip1", "Kramfors");
    //     // $request->setPost("pastOrFuture", "past");
    //     $session->set("ip1", "Kramfors");
    //     $session->set("pastOrFuture", "future");
    //     $res = $this->controller->resultPageActionGet();
    //     // $this->assertIsObject($res);
    //     // $this->assertInstanceOf("\Anax\Response\Response", $res);
    //     $this->assertNotEquals(null, $res->getBody());
    //     // $body = $res->getBody();
    //     // $xxx = "IPv4";
    //     // $this->assertContains($xxx, $body);
    // }



    // public function testResultPageActionGet4()
    // {
    //     $request = $this->di->get("request");
    //     $response = $this->di->get("response");
    //     $session = $this->di->get("session");
    //     $this->di->set("response", "\Anax\Response\Response");
    //     // $request->setPost("ip1", "Kramfors");
    //     // $request->setPost("pastOrFuture", "past");
    //     $session->set("ip1", "airmfoianrfiomrfimaofnadofnv");
    //     $session->set("pastOrFuture", "future");
    //     $res = $this->controller->resultPageActionGet();
    //     // $this->assertIsObject($res);
    //     // $this->assertInstanceOf("\Anax\Response\Response", $res);
    //     $this->assertNotEquals(null, $res->getBody());
    //     // $body = $res->getBody();
    //     // $xxx = "IPv4";
    //     // $this->assertContains($xxx, $body);
    // }




    // public function testIndexActionPost3()
    // {
    //     $request = $this->di->get("request");
    //     $response = $this->di->get("response");
    //     $this->di->set("response", "\Anax\Response\Response");
    //     $request->setPost("ip1", "eklesiastitsminister");
    //     $res = $this->controller->indexActionPost();
    //     // $this->assertIsObject($res);
    //     // $this->assertInstanceOf("\Anax\Response\Response", $res);
    //     $this->assertEquals(null, $res->getBody());
    //     // $body = $res->getBody();
    //     // $xxx = "IPv4";
    //     // $this->assertContains($xxx, $body);
    // }


    // public function testIndexActionPost()
    // {
    //     global $di;
    //     // Setup di
    //     $di = new DIFactoryConfig();
    //     $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
    //     // Use a different cache dir for unit test
    //     $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
    //     // Test the controller action
    //     // Setup the controller
    //     $controller = new IPController();
    //     $controller->setDI($di);
    //     // $controller->initialize();
    //     $di->get("request")->setPost("ip", "8.8.8.8");
    //     $di->get("request")->setPost("doValidate", "Validate");
    //     $di->get("session")->set("ip", null);
    //     $di->get("session")->set("result", null);
    //     $di->get("session")->set("hostname", null);
    //     // Do the test and assert it
    //     $res = $controller->indexActionPost();
    //     $this->assertIsObject($res);
    //     $this->assertInstanceOf("Anax\Response\Response", $res);
    //     $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    //     $body = $res->getBody();
    //     $this->assertContains("Validate an IP address", $body);
    // }
}
