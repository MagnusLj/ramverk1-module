<?php
namespace Malm18\IPChecker;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IPController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet() : object
    {
        // $session = $this->di->session;
        $ipHandler = new IpHandler();

        $ownIP = $ipHandler->checkOwnIP();



        $data = [
            "ownIP" => $ownIP
        ];

        // Add content as a view and then render the page
        $page = $this->di->get("page");

        $page->add("ipChecker/ipChecker", $data);

        return $page->render();
    }



    public function indexActionPost() : object
    {
        $session = $this->di->session;
        // $ipHandler = new IpHandler();
        $request = $this->di->request;
        $response = $this->di->response;
        $theIP = $request->getPost("ip1");

        if (!is_null($theIP)) {
            // $ipInfo = $ipHandler->checkIP($theIP);
            // $ipInfo2 = json_decode($ipInfo, true);
            // $ipInfo3 = gettype($ipInfo);
            // echo $ipInfo3;
            // var_dump(json_decode($ipInfo, true));
            // var_dump($ipInfo2);
            // var_dump($ipInfo['ip']);
            $session->set("ip1", $theIP);
            // $session->set("hostname", $ipInfo['hostname']);
            // $session->set("type", $ipInfo['type']);
            // $session->set("latitude", $ipInfo['latitude']);
            // $session->set("longitude", $ipInfo['longitude']);
            // $session->set("city", $ipInfo['city']);
            // $session->set("country_name", $ipInfo['country_name']);
        }

           return $response->redirect("ip-checker/resultpage");
    }



    public function resultPageActionGet() : object
    {

        // $session->set("latitude", $ipInfo['latitude']);
        // $session->set("longitude", $ipInfo['longitude']);
        // $session->set("city", $ipInfo['city']);
        // $session->set("country_name", $ipInfo['country_name']);

        $session = $this->di->session;

        $theIP = $session->get("ip1");

        $ipHandler = new IpHandler();

        $ipInfo = $ipHandler->checkIP($theIP);

        $latitude = $ipInfo['latitude'];
        $longitude = $ipInfo['longitude'];
        $minLong = $ipHandler->minLong($ipInfo['longitude']);
        $maxLong = $ipHandler->maxLong($ipInfo['longitude']);
        $minLat = $ipHandler->minLat($ipInfo['latitude']);
        $maxLat = $ipHandler->maxLat($ipInfo['latitude']);

        // echo("$latitude");
        // echo($latitude);

        $mapLink = $ipHandler->mapLink($latitude, $longitude, $minLat, $maxLat, $minLong, $maxLong);

        // $var = 5;
        // $var_is_greater_than_two = ($var > 2 ? true : false);

        // var_dump($ipInfo);
        // $session->set("ip1", "ip2");

        // $hostname = $session->get("hostname");
        // $city = $session->get("city");
        // $country_name = $session->get("country_name");
        // $latitude = $session->get("latitude");
        // $longitude = $session->get("longitude");
        // $type = $session->get("type");

        // var_dump($session);
        $data = [
            "ip1" => $theIP,
            "city" => $ipInfo['city'],
            "country_name" => $ipInfo['country_name'],
            "latitude" => $ipInfo['latitude'],
            "longitude" => $ipInfo['longitude'],
            "mapLink" => $mapLink,
            "continent_name" => $ipInfo['continent_name'],
            "region_name" => $ipInfo['region_name'],
            // "calling_code" => $ipInfo['location']['calling_code'],
            "type" => $ipInfo['type']
        ];
        // Add content as a view and then render the page
        $page = $this->di->get("page");
        // $data = [
        //     "content" => "HELLO!"
        // ];
        $page->add("ipChecker/resultPage", $data);
        // $page->add("anax/v2/article/default", $data, "sidebar-left");
        // $page->add("anax/v2/article/default", $data, "sidebar-right");
        // $page->add("anax/v2/article/default", $data, "flash");
        return $page->render();
    }
}
