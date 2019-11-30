<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Sverige får väder (json)</h1>

<!-- <h1>Guess my number</h1> -->


<p>Skriv in en ip-adress eller en plats, välj om du vill se framåt eller bakåt och tryck på Kolla för att få information om läderveken.</p>






<form method="post">
    <input type="radio" name="pastOrFuture" value="future" checked> en vecka framåt<br>
    <input type="radio" name="pastOrFuture" value="past"> 30 dagar bakåt<br><br>
    <input type="text" name="ip1">
    <input type="submit" name="ipsubmit" value="Kolla">
</form>

<h3>Testlänkar</h3>

<a href="../json-vader?ip=208.67.222.222&pastOrFuture=future">208.67.222.222 framåt</a><br><br>

<a href="../json-vader?ip=208.67.222.222&pastOrFuture=past">208.67.222.222 bakåt</a><br><br>

<a href="../json-vader?ip=kramfors&pastOrFuture=future">Kramfors framåt</a><br><br>

<a href="../json-vader?ip=Kramfors&pastOrFuture=past">Kramfors bakåt</a><br>

<h3>Instruktioner</h3>

<p>Du kan använda länkarna ovan eller ändra adressen i webbläsaren så att den slutar på <br>'/json-vader?ip=&lt;ip-adress eller plats&gt;&pastOrFuture=&lt;future&gt;.<br>Vill du istället för väderprognos se tidigare väder så byt future mot past.</p>
