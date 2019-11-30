<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Check an ip address</h1>

<!-- <h1>Guess my number</h1> -->


<p>Enter the ip address below (your ip address is defaulted in) and hit Check to be enlightened.</p>





<form method="post">
    <input type="text" name="ip1" value=<?= $ownIP ?>>
    <input type="submit" name="ipsubmit" value="Check">
</form>
