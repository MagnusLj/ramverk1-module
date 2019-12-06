<?php

namespace Malm18\IPChecker;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IpcheckControllerTest.
 *
 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
 *
 */
class IPJsonControllerTest extends TestCase
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
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
        // $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->controller = new IPJsonController();
        $this->controller->setDI($this->di);
        $session = $di->get("session");
    }





    /**
     * Test the route "index".
     */
    // public function testIndexActionGet()
    // {
    //     // Test action
    //     // $session = $di->get("session");
    //     $res = $this->controller->indexActionGet();
    //     $this->assertIsArray($res);
    //     // $this->assertInstanceOf("Anax\Response\Response", $res);
    //     // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    //     // Get body and compare results
    //     // $body = $res->getBody();
    //     // // $this->assertContains("<title>Validate IP result | ramverk1</title>", $body);
    //     // $this->assertContains("<h1>Kolla en ip-adress</h1>", $body);
    //     // $this->assertContains("<h4>Text</h4>", $body);
    //     // $this->assertContains("<h4>JSON</h4>", $body);
    //     // $this->assertContains("<h4>Exempel</h4>", $body);
    // }

 //    public function testIndexActionGet()
 // {
 //     // global $di;
 //     // // Setup di
 //     // $di = new DIFactoryConfig();
 //     // $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
 //     // // Use a different cache dir for unit test
 //     // $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
 //     // Test the controller action
 //     // Setup the controller
 //     $controller = new IPJsonController();
 //     // $controller->setDI($di);
 //     // $controller->initialize();
 //     // Do the test and assert it
 //     $res = $controller->indexActionGet();
 //     $this->assertIsObject($res);
 //     $this->assertInstanceOf("Anax\Response\Response", $res);
 //     $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
 //     // $body = $res->getBody();
 //     // $this->assertContains("The API", $body);
 // }

 // public function testIndexActionGet()
 // {
 //     $res = $this->controller->indexActionGet();
 //     $this->assertInternalType("array", $res);
 //
 //     $json = $res[0];
 //     $exp = "db is active";
 //     $this->assertContains($exp, $json["message"]);
 // }

    public function testIndexActionGet()
    {
        $controller = $this->controller;
        $request = $this->di->get("request");
        //testcases
        $res = $controller->indexActionGet();
        $this->assertIsArray($res);
    }

    // public function testIndexActionGet2() : object
    // {
    //     $controller = $this->controller;
    //     $request = $this->di->get("request");
    //     $request->setGet("ip", "2001:0db8:85a3:0000:0000:8a2e:0370:7334");
    //   $res = $controller->indexActionGet();
    //   var_dump($res);
    //   $this->assertIsArray($res[0]);
    //   // $this->assertArrayHasKey("region_name", $res[0]);
    //
    // }

    /**
     * Test the route "index".
     */
    // public function testIpJsonCheckerActionGet()
    // {
    //     // Test action
    //     // $session = $di->get("session");
    //     $res = $this->controller->ipJsonCheckerActionGet();
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


    public function testIpJsonCheckerActionGet()
    {
        // Test action
        // $session = $di->get("session");
        $res = $this->controller->ipJsonCheckerActionGet();
        // $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        // Get body and compare results
        // $body = $res->getBody();
        //
        // $exp = "Här är resultatet";
        // $this->assertContains($exp, $body);
        // $this->assertContains("<title>Validate IP result | ramverk1</title>", $body);
        // $this->assertContains("<h1>Här är resultatet</h1>", $body);
        // $this->assertContains("<h4>Text</h4>", $body);
        // $this->assertContains("<h4>JSON</h4>", $body);
        // $this->assertContains("<h4>Exempel</h4>", $body);
    }


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
    public function testIpJsonCheckerActionPost()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip1", "208.67.222.222");
        $res = $this->controller->ipJsonCheckerActionPost();
        // $this->assertIsObject($res);
        // $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertEquals(null, $res->getBody());
        // $body = $res->getBody();
        // $xxx = "IPv4";
        // $this->assertContains($xxx, $body);
    }


    public function testIpJsonCheckerActionPost2()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip1", "thisisnotanipaddress");
        $res = $this->controller->ipJsonCheckerActionPost();
        // $this->assertIsObject($res);
        // $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertEquals(null, $res->getBody());
        // $body = $res->getBody();
        // $xxx = "IPv4";
        // $this->assertContains($xxx, $body);
    }


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
