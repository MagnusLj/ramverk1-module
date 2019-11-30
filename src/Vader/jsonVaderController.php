<?php

namespace Malm18\Vader;

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
class jsonVaderController implements ContainerInjectableInterface
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
    //     $IPHandler = new IPHandler();
    //     $IPInfo = $IPHandler->checkIP($theIP);
    //     $session = $this->di->session;
    //
    //     // var_dump($IPInfo);
    //
    //         // $json = [
    //         //     "ipaddress" => $IPInfo['ipaddress'], "hostname" => $IPInfo['hostname'],
    //         //     "type" => $IPInfo['ipaddress']
    //         // ];
    //         $json = json_encode($IPInfo, JSON_PRETTY_PRINT);
    //         $session->set("json", $json);
    //         $session->set("ipaddress", $IPInfo['ipaddress']);
    //         return $response->redirect("ip-json-checker/jsonResultPage");
    //         // var_dump($json);
    //     // Deal with the action and return a response.
    //     // return $json;
    // }






    public function indexActionGet()
    {
        $request = $this->di->request;
        $vader = $this->di->get("vader");
        $theIP = $this->di->get("request")->getGet("ip");
        $pastOrFuture = $this->di->get("request")->getGet("pastOrFuture");

        $IPHandler = new \Malm18\IPChecker\IPHandler();

        $coordinates = $vader->checkCoordinates($theIP);

        if ($coordinates) {
            $latitude = $coordinates['latitude'];
            $longitude = $coordinates['longitude'];

            // $IPInfo = $IPHandler->checkIP($theIP);

            // $IPInfo = $IPHandler->checkIP($theIP);

            $weather = $vader->checkWeather($latitude, $longitude, $pastOrFuture);

            // $largeMapLink = $IPHandler->largeMapLink($IPInfo['latitude'], $IPInfo['longitude']);

            $largeMapLink = ($latitude ? $IPHandler->largeMapLink($latitude, $longitude) : "");

            $weather2 = $vader->checkWeather2($weather);

        // $message = 'Hello '.($user->is_logged_in() ? $user->get('first_name') : 'Guest');

        // $IPInfo2 = array("time" => $weather2[0]['time'], "summary" => $weather2['summary'], "temperatureMin" => $weather2['temperatureMin'],
        // "temperatureMax" => $weather2['temperatureMax'], "precipProbability" => $weather2['precipProbability'], "windSpeed" => $weather2['windSpeed'],
        // "windBearing" => $weather2['windBearing'], "latitude" => $latitude, "longitude" => $longitude,
        // "map_link" => $largeMapLink);
        //
        // $json = json_encode($IPInfo2);

            $weather2['mapLink'] = $largeMapLink;
        } else {
            $weather2 = [];
            $weather2['data'] = "No result for you!";
        }
        return [$weather2];
    }

//     $var = 5;
// $var_is_greater_than_two = ($var > 2 ? true : false);


    public function jsonVaderActionGet() : object
    {
        // $session = $this->di->session;
        // // $session->set("ip1", "ip2");
        // $ip1 = $session->get("ip1");
        // $hostname = $session->get("hostname");
        // $type = $session->get("type");
        // var_dump($session);
        $IPHandler = new \Malm18\IPChecker\IPHandler();

        $ownIP = $IPHandler->checkOwnIP();

        $data = [
            "ownIP" => $ownIP
        ];
        // Add content as a view and then render the page
        $page = $this->di->get("page");
        // $data = [
        //     "content" => "HELLO!"
        // ];
        $page->add("vader/jsonVader", $data);
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
    //     // $IPHandler = $session->get("IPHandler");
    //     $request = $this->di->request;
    //     $response = $this->di->response;
    //     if ($request->getPost("ipsubmit")) {
    //     $theIP = $request->getPost("ip1");
    //     // $IPInfo = $IPHandler->checkIP($theIP);
    //     // $session->set("ip1", $IPInfo['ipaddress']);
    //     // $session->set("hostname", $IPInfo['hostname']);
    //     // $session->set("type", $IPInfo['type']);
    //
    //     return $response->redirect("ip-json-checker?ip=$theIP");
    // }
    // // elseif ($_POST["newRoll"] ?? false) {
    // }


    public function jsonVaderActionPost() : object
    {
           // $session = $this->di->session;
           $IPHandler = new \Malm18\IPChecker\IPHandler();
           $request = $this->di->request;
           $response = $this->di->response;
           $theIP = $request->getPost("ip1");
           $pastOrFuture = $request->getPost("pastOrFuture");

        // if (!is_null($theIP)) {
        //     $IPInfo = $IPHandler->checkIP($theIP);
        //      // $session->set("ip1", $IPInfo['ipaddress']);
        //      // $session->set("hostname", $IPInfo['hostname']);
        //      // $session->set("type", $IPInfo['type']);
        // }

           return $response->redirect("json-vader?ip=$theIP&pastOrFuture=$pastOrFuture");
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
