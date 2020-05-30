<?php
/*
    Denne fil på serveren er gemt UDENFOR root. 
    Helt præcist er den gemt på samme niveau som mappen public_html
    pga sikkerhed, da filen ikke er tilgengelig for fremmede
*/

// På serveren er parametre "de rigtige", og ikke localhost
$connection = new mysqli('localhost', 'root', '', 'iamgregorj');

if($connection->connect_error)
{
    /* exit i stedet for die - da jeg ikke har behov for at fremmede ser fejlbeskeden, 
    som kunne afsløre mere end jeg har lyst til */
    exit("Something weird happened.");
}

//Function from Robi Nixon, page 238 - sker kun hvis der er INGEN forbindelse til db
function mysqli_fatal_error()
  {
      echo <<<_END
      We are sorry, but something went wrong when trying to connect.
      The error message we got was:
      <p>Fatal Error<p>
      Please  <a href="javascript:history.back()">go back to where you came</a> and
      try again. If you are still having problems,
      please <a href="https://twitter.com/IAmGregorJ" target="_blank" rel="noopener noreferrer">
      contact the administrator</a>. Thank you.
_END;
  }
?>