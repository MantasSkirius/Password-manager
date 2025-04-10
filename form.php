<?php
require __DIR__ . '/autoload.php';
?>

<html>
  <head>
    <meta charset="UTF-8" />
  </head>
  <body>
	<p>Iveskite prisijungimo duomenis</p>
    <form method="post" action="<?php echo htmlspecialchars("index.php");?>">
      Pradinis skaičius: <input name="username" /><br />
      Galutinis skaičius: <input type="password" name="password" /><br />
      <input type="submit" />
    </form>
  </body>
</html>


