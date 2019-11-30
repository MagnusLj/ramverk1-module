<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Sverige får väder</h1>

<!-- <h1>Guess my number</h1> -->


<p>Skriv in en ip-adress eller en plats, välj om du vill se framåt eller bakåt och tryck på Kolla för att få information om läderveken.</p>







<form method="post">
    <input type="radio" name="pastOrFuture" value="future" checked> en vecka framåt<br>
    <input type="radio" name="pastOrFuture" value="past"> 30 dagar bakåt<br><br>
    <input type="text" name="ip1">
    <input type="submit" name="ipsubmit" value="Kolla">
</form>
