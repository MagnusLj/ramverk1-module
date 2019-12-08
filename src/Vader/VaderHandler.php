<?php

namespace Malm18\Vader;

class VaderHandler
{


    // public function parenting()
    // {
    //     return "I am your father";
    // }




    public function checkCoordinates($theIP)
    {
        if (filter_var($theIP, FILTER_VALIDATE_IP)) {
            $coordinates = [];
            $url = 'http://api.ipstack.com/';
            $keys = require ANAX_INSTALL_PATH . "/config/keys.php";
            $apiKey = $keys["ipstackKey"];
            $requestUrl = $url . $theIP . '?access_key=' . $apiKey;
            $curl = curl_init($requestUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, [
        //   'X-RapidAPI-Host: kvstore.p.rapidapi.com',
        //   'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
        //   'Content-Type: application/json'
        // ]);
            $response = curl_exec($curl);
            $response2 = json_decode($response, true);
            curl_close($curl);

            $coordinates['latitude'] = strval($response2['latitude']);
            $coordinates['longitude'] = strval($response2['longitude']);
            // echo $response . PHP_EOL;
            return $coordinates;
        } else {
            $coordinates = [];
            // $response = array("type" => "not valid ip", "ip" => "", "latitude"=> "", "longitude"=> "",
            // "city" => "", "country_name" => "", "region_name" => "", "continent_name" => "", "location['country_code']" => "");
            // // $response2 = json_decode($response, true);
            // return $response;
            $url1 = 'https://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=';

            // $keys = require ANAX_INSTALL_PATH . "/config/keys.php";
            // $this->ipstackKey = $keys["ipstackKey"];
            // $apiKey = $this->ipstackKey;
            $requestUrl = $url1 . $theIP . '&format=json&limit=1&email=a@b.se';
            // $requestUrl = 'https://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=bakery+in+berlin+wedding&format=json&limit=1&email=a@b.se';
            $curl = curl_init($requestUrl);
            // if ($curl) {
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, [
        //   'X-RapidAPI-Host: kvstore.p.rapidapi.com',
        //   'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
        //   'Content-Type: application/json'
        // ]);
            $response = curl_exec($curl);

            if (strlen($response) > 10) {
                $response2 = json_decode($response, true);
                curl_close($curl);
                $coordinates['latitude'] = $response2[0]['lat'];
                $coordinates['longitude'] = $response2[0]['lon'];
            }
            // echo $response . PHP_EOL;
            return $coordinates;
        }
        // }
    }




    // public function checkWeather($latitude, $longitude)
    // {
    //
    //     $url1 = 'https://api.darksky.net/forecast/';
    //
    //     $keys = require ANAX_INSTALL_PATH . "/config/keys.php";
    //     $apiKey = $keys["darkskyKey"];
    //     $endStuff = '?exclude=minutely,hourly,currently,alerts,flags&extend=daily&lang=sv&units=si';
    //     $requestUrl = $url1 . $apiKey . "/" . $latitude . "," . $longitude . $endStuff;
    //     // $requestUrl = 'https://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=bakery+in+berlin+wedding&format=json&limit=1&email=a@b.se';
    //     $curl = curl_init($requestUrl);
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // // curl_setopt($curl, CURLOPT_HTTPHEADER, [
    // //   'X-RapidAPI-Host: kvstore.p.rapidapi.com',
    // //   'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
    // //   'Content-Type: application/json'
    // // ]);
    //     $response = curl_exec($curl);
    //     $response2 = json_decode($response, true);
    //     curl_close($curl);
    //     // $coordinates['latitude'] = $response2[0]['lat'];
    //     // $coordinates['longitude'] = $response2[0]['lon'];
    //     // echo $response . PHP_EOL;
    //     return $response2;
    //
    //     // $coordinates = "Latitud: " . $latitude . ", longitud: " . $longitude;
    //     // return $coordinates;
    // }



    public function checkWeather($latitude, $longitude, $pastOrFuture)
    {

        $url1 = 'https://api.darksky.net/forecast/';

        $keys = require ANAX_INSTALL_PATH . "/config/keys.php";
        $apiKey = $keys["darkskyKey"];
        $endStuff = '?exclude=minutely,hourly,currently,alerts,flags&extend=daily&lang=sv&units=si';

        if ($pastOrFuture=="future") {
            $requestUrl = $url1 . $apiKey . "/" . $latitude . "," . $longitude . $endStuff;
            // $requestUrl = 'https://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=bakery+in+berlin+wedding&format=json&limit=1&email=a@b.se';
            $curl = curl_init($requestUrl);
            // if ($curl) {
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, [
        //   'X-RapidAPI-Host: kvstore.p.rapidapi.com',
        //   'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
        //   'Content-Type: application/json'
        // ]);
            $response = curl_exec($curl);
            $response2 = json_decode($response, true);
            curl_close($curl);
            // $coordinates['latitude'] = $response2[0]['lat'];
            // $coordinates['longitude'] = $response2[0]['lon'];
            // echo $response . PHP_EOL;
            return $response2['daily']['data'];
        // }
        } else {
        // array of curl handles
            $multiCurl = array();
            // data to be returned
            $response = array();
            // multi handle
            $mhbutlonger = curl_multi_init();




        // for ($i=0; $i < 30; $i++) {
        //     $unixTime = time() - ($i * 24 * 60 * 60);
        //     $multiRequests[] = $url1 . $apiKey . "/" . $latitude . "," . $longitude . ','.$unixTime . $endStuff;
        // }





            for ($i=0; $i < 30; $i++) {
                $unixTime = time() - ($i * 24 * 60 * 60);
                $requestUrl = $url1 . $apiKey . "/" . $latitude . "," . $longitude . ','. $unixTime . $endStuff;
                $multiCurl[$i] = curl_init();
                curl_setopt($multiCurl[$i], CURLOPT_URL, $requestUrl);
                curl_setopt($multiCurl[$i], CURLOPT_HEADER, 0);
                curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER, 1);
                curl_multi_add_handle($mhbutlonger, $multiCurl[$i]);
            }
            $index=null;
            do {
                curl_multi_exec($mhbutlonger, $index);
            } while ($index > 0);
        // get content and remove handles
            foreach ($multiCurl as $k => $ch) {
                $response[$k] = curl_multi_getcontent($ch);
                curl_multi_remove_handle($mhbutlonger, $ch);
            }
            // close
            curl_multi_close($mhbutlonger);

            // $response2 = json_decode($response, true);

            // $daily = [];
            // $anArray = [];
            // $data = [];
            $data2 = [];
            $i=0;
            foreach ($response as $item) {
                $data = json_decode($item, true);
                $data2[$i] = $data['daily']['data'][0];
                // $data[$i] = $item;
                $i=$i+1;
            }
            // $daily['data'] = $data;
            // $anArray['daily'] = $daily;

            // return $data[0]['daily']['data'];
            // $response2 = json_decode($data, true);
            return $data2;
        }
    }





//     public function checkPastWeather($latitude, $longitude)
// {
//     $url1 = 'https://api.darksky.net/forecast/';
//
//     $keys = require ANAX_INSTALL_PATH . "/config/keys.php";
//     $apiKey = $keys["darkskyKey"];
//     $endStuff = '?exclude=minutely,hourly,currently,alerts,flags&extend=daily&lang=sv&units=si';
//
//     $multiRequests = [];
//     #future weather
//     if ($this->time === "future") {
//         for ($i=0; $i < 7; $i++) {
//             $unixTime = time() + ($i * 24 * 60 * 60);
//             $multiRequests[] = 'https://api.darksky.net/forecast/'.$accessKey .'/'.$details['latitude'].','.$details['longitude'].','.$unixTime.'?exclude=minutely,hourly,daily,flags';
//         }
//     }
//     #previous weather
//     if ($this->time === "past") {
//         for ($i=0; $i < 30; $i++) {
//             $unixTime = time() - ($i * 24 * 60 * 60);
//             $multiRequests[] = 'https://api.darksky.net/forecast/'.$accessKey .'/'.$details['latitude'].','.$details['longitude'].','.$unixTime.'?exclude=minutely,hourly,daily,flags';
//         }
//     }
//     $weather = $this->requester->multiRequest($multiRequests);
//     foreach ($weather as $key => $value) {
//         $weather[$key] = json_decode(stripslashes($value), true);
//     }
//     return $weather;
// }





    public function checkWeather2($weather)
    {
        $weather2 = [];
        $locale = 'sv_SE.utf8';
        setlocale(LC_TIME, $locale);
        $i=0;
        foreach ($weather as $day) {
            // array_push($weather2, $day['time']);
            $unixTimestamp = $day['time'];
            $datetime = date('Y-m-d l', $unixTimestamp);
            $datetime2 = strftime('%A %d %B', strtotime($datetime));

            // $unixTimestamp = $day['time'];
            // $datetime = date('Y-m-d l', $unixTimestamp);
            // $datetime2 = strftime('%A %d %B', strtotime($datetime));

            // $datetime2 = $datetime->format('d/m');
            // $weather2[$i] = (['day'] => [$day]);
            $weather2[$i]['time'] = $datetime2;
            $weather2[$i]['summary'] = $day['summary'];
            $weather2[$i]['temperatureMin'] = round($day['temperatureMin']);
            $weather2[$i]['temperatureMax'] = round($day['temperatureMax']);
            $weather2[$i]['precipProbability'] = 100 * ($day['precipProbability']);
            // $weather2[$i]['precipType'] = $day['precipType'];
            $weather2[$i]['windSpeed'] = round($day['windSpeed']);
            $weather2[$i]['windBearing'] = $day['windBearing'];
            // array_push($weather2, $datetime2);
            $i=$i+1;
        }
        return $weather2;
    }

//     foreach($inputs['test']['order'] as $test){
//         echo $test;
//
// }

    // echo $yummy->toppings[2]->id

//     foreach($arr as $key => &$val){
//     $val['color'] = 'red';
// }


    // $unixTimestamp = $_POST['timestamp'];
    // $datetime = new DateTime("@$unixTimestamp");
    // // Display GMT datetime
    // echo $datetime->format('d-m-Y H:i:s');


    // public function minLong($longitude)
    // {
    //
    //     $minLong = floatval($longitude)-0.6427;
    //     return $minLong;
    // }
    //
    // public function maxLong($longitude)
    // {
    //
    //     $maxLong = floatval($longitude)+0.6427;
    //     return $maxLong;
    // }
    //
    // public function minLat($latitude)
    // {
    //
    //     $minLat = (floatval($latitude)) - 0.260;
    //     return $minLat;
    // }
    //
    // public function maxLat($latitude)
    // {
    //
    //     $maxLat = (floatval($latitude)) + 0.260;
    //     return $maxLat;
    // }


    // public function mapLink($latitude, $longitude, $minLat, $maxLat, $minLong, $maxLong)
    // {
    //                 https://www.openstreetmap.org/export/embed.html?bbox=-6.8860333396912%2C53.093889465332%2C-5.6006333396912%2C53.613889465332&amp;layer=mapnik&amp;marker=53.353889465332%2-6.2433333396912
    //     // $link = "https://www.openstreetmap.org/export/embed.html?bbox=12.669982910156252%2C55.56592203025787%2C13.955383300781252%2C56.08506381314523&amp;layer=mapnik&amp;marker=55.82635894724891%2C13.31268310546875"
    //
    //     $link = "https://www.openstreetmap.org/export/embed.html?bbox=" . $minLong . "%2C" . $minLat . "%2C" . $maxLong . "%2C" . $maxLat . "&amp;layer=mapnik&amp;marker=" . $latitude . "%2C" . $longitude;
    //
    //     return $link;
    // }

    // public function mapLink($latitude, $longitude, $minLat, $maxLat, $minLong, $maxLong)
    // {
    //     if ($latitude) {
    //         $link = "https://www.openstreetmap.org/export/embed.html?bbox=" . $minLong . "%2C" . $minLat . "%2C" . $maxLong . "%2C" . $maxLat . "&amp;layer=mapnik&amp;marker=" . $latitude . "%2C" . $longitude;
    //     } else {
    //         $link = "https://www.openstreetmap.org/export/embed.html?bbox=-0.64%2C85%2C0.64%2C90&amp;layer=mapnik&amp;marker=87.5%2C0";
    //     }
    //
    //     return $link;
    // }
    //
    // public function largeMapLink($latitude, $longitude)
    // {
    //     if ($latitude) {
    //         $link = "https://www.openstreetmap.org/?mlat=" . $latitude . "&amp;mlon=" . $longitude . "#map=10/" . $latitude . "/" . $longitude;
    //     // <a href="https://www.openstreetmap.org/?mlat=55.8264&amp;mlon=13.3127#map=10/55.8264/13.3127">
    //     } else {
    //         $link = "https://www.openstreetmap.org";
    //     }
    //     return $link;
    // }


    // public function checkOwnIP()
    // {
    //     $remoteAddr = isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR']:'127.0.0.1';
    //     return $remoteAddr;
    // }
}
