<?php
require __DIR__ . '/autoload.php';
?>

<html>
  <head>
    <meta charset="UTF-8" />
  </head>
  <body>
	<p>Iveskite prisijungimo duomenis, kuriuos norite saugoti</p>
    <form method="post" action="<?php echo htmlspecialchars("insert.php");?>">
      pavadinimas: <input name="loginName" /><br />
      Slaptažodis: <input name="sitePassword" /><br />
      <input type="submit" />
    </form>
  </body>
</html>