<?php

namespace Malm18\IPChecker;

class IPHandler
{


    /**
    * Check active.
    *
    */
    // public function checkIP($theIP)
    // {
    //     $theIP2 = $theIP . " svansen";
    //     return $theIP2;
    // }

    // public function checkIP2($theIP)
    // {
    //     $hostname = "";
    //     $type = "";
    //
    //
    //     if (filter_var($theIP, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
    //         $type = "IPv6";
    //         $hostname = gethostbyaddr("$theIP");
    //     } elseif (filter_var($theIP, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
    //         $type = "IPv4";
    //         $hostname = gethostbyaddr("$theIP");
    //     } else {
    //         $type = "Inte riktig IP-adress";
    //     }
    //
    //     $ipInfo = array("ipaddress"=>$theIP, "hostname"=>$hostname, "type"=>$type);
    //     return $ipInfo;
    // }


    public function checkIP($theIP)
    {
        if (filter_var($theIP, FILTER_VALIDATE_IP)) {
            $url = 'http://api.ipstack.com/';
            $keys = require ANAX_INSTALL_PATH . "/config/keys.php";
            // $this->ipstackKey = $keys["ipstackKey"];
            // $apiKey = $this->ipstackKey;
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
            // echo $response . PHP_EOL;
            return $response2;
        } else {
            $response = array("type" => "not valid ip", "ip" => "", "latitude"=> "", "longitude"=> "",
            "city" => "", "country_name" => "", "region_name" => "", "continent_name" => "", "location['country_code']" => "");
            // $response2 = json_decode($response, true);
            return $response;
        }
    }


    public function minLong($longitude)
    {

        $minLong = floatval($longitude)-0.6427;
        return $minLong;
    }

    public function maxLong($longitude)
    {

        $maxLong = floatval($longitude)+0.6427;
        return $maxLong;
    }

    public function minLat($latitude)
    {

        $minLat = (floatval($latitude)) - 0.260;
        return $minLat;
    }

    public function maxLat($latitude)
    {

        $maxLat = (floatval($latitude)) + 0.260;
        return $maxLat;
    }


    // public function mapLink($latitude, $longitude, $minLat, $maxLat, $minLong, $maxLong)
    // {
    //                 https://www.openstreetmap.org/export/embed.html?bbox=-6.8860333396912%2C53.093889465332%2C-5.6006333396912%2C53.613889465332&amp;layer=mapnik&amp;marker=53.353889465332%2-6.2433333396912
    //     // $link = "https://www.openstreetmap.org/export/embed.html?bbox=12.669982910156252%2C55.56592203025787%2C13.955383300781252%2C56.08506381314523&amp;layer=mapnik&amp;marker=55.82635894724891%2C13.31268310546875"
    //
    //     $link = "https://www.openstreetmap.org/export/embed.html?bbox=" . $minLong . "%2C" . $minLat . "%2C" . $maxLong . "%2C" . $maxLat . "&amp;layer=mapnik&amp;marker=" . $latitude . "%2C" . $longitude;
    //
    //     return $link;
    // }

    public function mapLink($latitude, $longitude, $minLat, $maxLat, $minLong, $maxLong)
    {
        if ($latitude) {
            $link = "https://www.openstreetmap.org/export/embed.html?bbox=" . $minLong . "%2C" . $minLat . "%2C" . $maxLong . "%2C" . $maxLat . "&amp;layer=mapnik&amp;marker=" . $latitude . "%2C" . $longitude;
        } else {
            $link = "https://www.openstreetmap.org/export/embed.html?bbox=-0.64%2C85%2C0.64%2C90&amp;layer=mapnik&amp;marker=87.5%2C0";
        }

        return $link;
    }

    public function largeMapLink($latitude, $longitude)
    {

        if ($latitude) {
            $link = "https://www.openstreetmap.org/?mlat=" . $latitude . "&amp;mlon=" . $longitude . "#map=10/" . $latitude . "/" . $longitude;
        // <a href="https://www.openstreetmap.org/?mlat=55.8264&amp;mlon=13.3127#map=10/55.8264/13.3127">
        }
        return $link;
    }


    public function checkOwnIP()
    {
        $remoteAddr = isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR']:'127.0.0.1';
        return $remoteAddr;
    }




// echo "http://api.ipstack.com/130.235.136.64?access_key=d1efc4cc23a8b14dfad565ee6bde80b8";

    // /**
    // * Check active.
    // *
    // * @return variable , variable
    // */
    // public function active($computer, $human)
    // {
    //     if ($computer->value() > $human->value()) {
    //         $computer->setActive(true);
    //         return $computer->getName();
    //     } else {
    //         $human->setActive(true);
    //         return $human->getName();
    //     }
    // }


    // /**
    // * Check active in another way.
    // *
    // * @return variable , variable
    // */
    // public function getActive($computer, $human)
    // {
    //     if ($computer->getActive() == true) {
    //         return $computer->getName();
    //     }
    //     return $human->getName();
    // }



    // /**
    // * Check active in yet another way.
    // *
    // * @return string , string
    // */
    // public function getActive2($computer, $human)
    // {
    //     if ($human->getTotalScore() >= 100) {
    //         $human->setWinner();
    //         return "pig/gameOver";
    //     } elseif ($computer->getTotalScore() >= 100) {
    //         $computer->setWinner();
    //         return "pig/gameOver";
    //     } else {
    //         if ($computer->getActive() == true) {
    //             return "pig/playC";
    //         } elseif ($human->getActive() == true) {
    //             if ($human->getDie1() !==1 && $human->getDie2() !==1) {
    //                 return "pig/playH";
    //             } else {
    //                 return "pig/playC";
    //             }
    //         }
    //     }
    // }

   // /**
   //  * mainRoll.
   //  *
   //  * @return void , void
   //  */
   //  public function mainRoll($human, $computer)
   //  {
   //      if ($computer->getActive() == true) {
   //          $computer->setActive(false);
   //          $human->setActive(true);
   //      } else {
   //          // $human->setTotalScore($human->getTotalScore + $human->getTurnScore);
   //          $computer->setActive(true);
   //          $human->setActive(false);
   //      }
   //      $computer->setTotalScore($computer->getTotalScore() + $computer->getTurnScore());
   //      $human->setTotalScore($human->getTotalScore() + $human->getTurnScore());
   //      $computer->setTurnScore(0);
   //      $human->setTurnScore(0);
   //      $computer->setRolls(0);
   //      $human->setRolls(0);
   //      $human->setDie1(null);
   //      $human->setDie2(null);
   //      $computer->setDie1(null);
   //      $computer->setDie2(null);
   //  }


    // /**
    //  * mainRoll.
    //  *
    //  * @return void , void
    //  */
    // public function mainRoll2($human, $computer)
    // {
    //     if ($computer->getActive() !== true) {
    //         $human->roll2();
    //         $human->setRolls($human->getRolls() + 1);
    //         if ($human->getDie1() !==1 && $human->getDie2() !==1) {
    //             $human->setTurnScore($human->getTurnScore() + $human->getDiceSum());
    //         } else {
    //             $human->setTurnScore(0);
    //         }
    //     }
    // }


    // /**
    //  * mainRoll.
    //  *
    //  * @return void , void
    //  */
    // public function computerRoll($computer, $human)
    // {
    //     $totalHuman = $human->getTotalScore();
    //     if ($computer->getActive() == true) {
    //         do {
    //             $computer->roll2();
    //             $computer->setRolls($computer->getRolls() + 1);
    //             $computer->setTurnScore($computer->getTurnScore() + $computer->getDiceSum());
    //         } while ($computer->rollOrNot($totalHuman) > 1 && ($computer->getDie1() !==1 && $computer->getDie2() !==1));
    //         if ($computer->getDie1() ==1 || $computer->getDie2() ==1) {
    //             $computer->setTurnScore(0);
    //         }
    //     }
    // }


    // /**
    //  * isWinner
    //  * @return string , isWinner
    //  */
    //
    // public function isWinner2($human, $computer)
    // {
    //     if ($human->isWinner() == true) {
    //         return $human->getName();
    //     } else {
    //         return $computer->getName();
    //     }
    // }
}
