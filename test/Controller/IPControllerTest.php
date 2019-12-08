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
class IPControllerTest extends TestCase
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
        // $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
        $this->controller = new IPController();
        $this->controller->setDI($this->di);
        $session = $di->get("session");
    }





    /**
     * Test the route "index".
     */
    public function testIndexActionGet()
    {
        // Test action
        // $session = $di->get("session");
        $res = $this->controller->indexActionGet();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        // Get body and compare results
        $body = $res->getBody();
        // $this->assertContains("<title>Validate IP result | ramverk1</title>", $body);
        // $this->assertContains("<h1>Kolla en ip-adress</h1>", $body);
        // $this->assertContains("<h4>Text</h4>", $body);
        // $this->assertContains("<h4>JSON</h4>", $body);
        // $this->assertContains("<h4>Exempel</h4>", $body);
    }


    /**
     * Test the route "index".
     */
    public function testResultPageActionGet()
    {
        // Test action
        // $session = $di->get("session");
        // $res = $this->controller->resultPageActionGet();

        $session = $this->di->get("session");
        $session->set("ip1", "208.67.222.222");
        $res = $this->controller->resultPageActionGet();

        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        // Get body and compare results
        $body = $res->getBody();
        // $this->assertContains("<title>Validate IP result | ramverk1</title>", $body);
        // $this->assertContains("<h1>Här är resultatet</h1>", $body);
        // $this->assertContains("<h4>Text</h4>", $body);
        // $this->assertContains("<h4>JSON</h4>", $body);
        // $this->assertContains("<h4>Exempel</h4>", $body);
    }


    /**
     * Test the route "index".
     */
    public function testResultPageActionGet2()
    {
        // Test action
        // $session = $di->get("session");
        // $res = $this->controller->resultPageActionGet();

        $session = $this->di->get("session");
        $session->set("ip1", "2");
        $res = $this->controller->resultPageActionGet();

        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        // Get body and compare results
        $body = $res->getBody();
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
    public function testIndexActionPost()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip1", "208.67.222.222");
        $res = $this->controller->indexActionPost();
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
    public function testIndexActionPost2()
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $this->di->set("response", "\Anax\Response\Response");
        $request->setPost("ip1", "2a03:2880:f21a:e5:face:b00c::4420");
        $res = $this->controller->indexActionPost();
        // $this->assertIsObject($res);
        // $this->assertInstanceOf("\Anax\Response\Response", $res);
        $this->assertEquals(null, $res->getBody());
        // $body = $res->getBody();
        // $xxx = "IPv4";
        // $this->assertContains($xxx, $body);
    }

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
