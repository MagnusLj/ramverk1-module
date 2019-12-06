<?php

namespace Malm18\IPChecker;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample JSON controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 */
class IPJsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    // /**
    //  * @var string $db a sample member variable that gets initialised
    //  */
    // private $db = "not active";



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    // }



    // /**
    //  * This is the index method action, it handles:
    //  * GET METHOD mountpoint
    //  * GET METHOD mountpoint/
    //  * GET METHOD mountpoint/index
    //  *
    //  * @return array
    //  */
    // public function indexActionGet() : array
    // {
    //     // Deal with the action and return a response.
    //     $json = [
    //         "message" => __METHOD__ . ", \$db is {$this->db}",
    //     ];
    //     return [$json];
    // }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
         */
    // public function indexActionGet()
    // {
    //     // $request = $this->di->get("request");
    //     $request = $this->di->request;
    //     $response = $this->di->response;
    //     $theIP = $this->di->get("request")->getGet("ip");
    //     // var_dump($theIP);
    //
    //     $ipHandler = new IpHandler();
    //     $ipInfo = $ipHandler->checkIP($theIP);
    //     $session = $this->di->session;
    //
    //     // var_dump($ipInfo);
    //
    //         // $json = [
    //         //     "ipaddress" => $ipInfo['ipaddress'], "hostname" => $ipInfo['hostname'],
    //         //     "type" => $ipInfo['ipaddress']
    //         // ];
    //         $json = json_encode($ipInfo, JSON_PRETTY_PRINT);
    //         $session->set("json", $json);
    //         $session->set("ipaddress", $ipInfo['ipaddress']);
    //         return $response->redirect("ip-json-checker/jsonResultPage");
    //         // var_dump($json);
    //     // Deal with the action and return a response.
    //     // return $json;
    // }






    public function indexActionGet()
    {
        // $request = $this->di->request;
        $theIP = $this->di->get("request")->getGet("ip");

        $ipHandler = new IPHandler();
        // $ipInfo = $ipHandler->checkIP($theIP);

        $ipInfo = $ipHandler->checkIP($theIP);

        // $largeMapLink = $ipHandler->largeMapLink($ipInfo['latitude'], $ipInfo['longitude']);

        $largeMapLink = ($ipInfo['latitude'] ? $ipHandler->largeMapLink($ipInfo['latitude'], $ipInfo['longitude']) : "");

        // $message = 'Hello '.($user->is_logged_in() ? $user->get('first_name') : 'Guest');

        $ipInfo2 = array("ip address" => $ipInfo['ip'], "type" => $ipInfo['type'], "city" => $ipInfo['city'],
        "country" => $ipInfo['country_name'], "region_name" => $ipInfo['region_name'], "continent_name" => $ipInfo['continent_name'],
        "latitude" => $ipInfo['latitude'], "longitude" => $ipInfo['longitude'],
        "map_link" => $largeMapLink);
        //
        // $json = json_encode($ipInfo2);

        return [$ipInfo2];
    }

//     $var = 5;
// $var_is_greater_than_two = ($var > 2 ? true : false);


    public function ipJsonCheckerActionGet() : object
    {
        // $session = $this->di->session;
        // // $session->set("ip1", "ip2");
        // $ip1 = $session->get("ip1");
        // $hostname = $session->get("hostname");
        // $type = $session->get("type");
        // var_dump($session);
        $ipHandler = new IPHandler();

        $ownIP = $ipHandler->checkOwnIP();

        $data = [
            "ownIP" => $ownIP
        ];
        // Add content as a view and then render the page
        $page = $this->di->get("page");
        // $data = [
        //     "content" => "HELLO!"
        // ];
        $page->add("ipChecker/ipJsonChecker", $data);
        // $page->add("anax/v2/article/default", $data, "sidebar-left");
        // $page->add("anax/v2/article/default", $data, "sidebar-right");
        // $page->add("anax/v2/article/default", $data, "flash");
        return $page->render();
    }


    // public function ipJsonCheckerActionPost() : object
    // {
    //
    //
    //     // $session = $this->di->session;
    //     // $ipHandler = $session->get("IpHandler");
    //     $request = $this->di->request;
    //     $response = $this->di->response;
    //     if ($request->getPost("ipsubmit")) {
    //     $theIP = $request->getPost("ip1");
    //     // $ipInfo = $ipHandler->checkIP($theIP);
    //     // $session->set("ip1", $ipInfo['ipaddress']);
    //     // $session->set("hostname", $ipInfo['hostname']);
    //     // $session->set("type", $ipInfo['type']);
    //
    //     return $response->redirect("ip-json-checker?ip=$theIP");
    // }
    // // elseif ($_POST["newRoll"] ?? false) {
    // }


    public function ipJsonCheckerActionPost() : object
    {
           // $session = $this->di->session;
           // $ipHandler = new IpHandler();
           $request = $this->di->request;
           $response = $this->di->response;
           $theIP = $request->getPost("ip1");

        // if (!is_null($theIP)) {
        //     $ipInfo = $ipHandler->checkIP($theIP);
        //     $ipInfo = $ipInfo . "röv";
        //      // $session->set("ip1", $ipInfo['ipaddress']);
        //      // $session->set("hostname", $ipInfo['hostname']);
        //      // $session->set("type", $ipInfo['type']);
        // }

           return $response->redirect("ip-json-checker?ip=$theIP");
    }

    // public function jsonResultPageActionGet() : object
    // {
    //
    //
    //     $session = $this->di->session;
    //     $ipaddress = $session->get("ipaddress");
    //     $json = $session->get("json");
    //
    //     $page = $this->di->get("page");
    //
    //     $data = [
    //         "ipaddress" => $ipaddress,
    //         "json" => $json
    //     ];
    //
    //     $page->add("ipChecker/jsonResultPage", $data);
    //
    //     return $page->render();
    // // } elseif ($_POST["newRoll"] ?? false) {
    // }

    // /**
    //  * This sample method dumps the content of $di.
    //  * GET mountpoint/dump-app
    //  *
    //  * @return array
    //  */
    // public function dumpDiActionGet() : array
    // {
    //     // Deal with the action and return a response.
    //     $services = implode(", ", $this->di->getServices());
    //     $json = [
    //         "message" => __METHOD__ . "<p>\$di contains: $services",
    //         "di" => $this->di->getServices(),
    //     ];
    //     return [$json];
    // }



    // /**
    //  * Try to access a forbidden resource.
    //  * ANY mountpoint/forbidden
    //  *
    //  * @return array
    //  */
    // public function forbiddenAction() : array
    // {
    //     // Deal with the action and return a response.
    //     $json = [
    //         "message" => __METHOD__ . ", forbidden to access.",
    //     ];
    //     return [$json, 403];
    // }
}
