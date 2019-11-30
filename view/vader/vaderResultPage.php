<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


// echo $maxLat . " ";
// echo $latitude . " ";
// echo $minLat . " ";
// echo $maxLong . " ";
// echo $longitude . " ";
// echo $minLong . " ";
// echo $mapLink;

?><h1>Here are the results for <?= $ip1 ?></h1>

<!-- <h1>Guess my number</h1> -->

<meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' *.mycdn.com *openstreetmap.org* 'unsafe-inline';">


<p>Type: <?= $type ?></p>
<p>City: <?= $city ?></p>
<p>Region: <?= $region_name ?></p>
<p>Country: <?= $country_name ?></p>
<p>Continent: <?= $continent_name ?></p>
<p>Position: Latitude <?= $latitude ?>, longitude <?= $longitude ?></p>

<a href="https://darksky.net/poweredby/">Powered by Darksky</a>


<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=<?= $mapLink ?> style="border: 1px solid black"></iframe><br/>
<!-- <small><a href="https://www.openstreetmap.org/?mlat=55.8264&amp;mlon=13.3127#map=10/55.8264/13.3127">Visa större karta</a></small> -->

<!-- <form method="post"> lat  55: 0.260   0,2587
                          long 13: 0,6427  0,6427
    <input type="text" name="ip1">
    <input type="submit" name="ip1" value="Kolla">
</form> -->
