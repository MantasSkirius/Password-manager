<?php
require __DIR__ . '/autoload.php';
?>

<html>
  <head>
    <meta charset="UTF-8" />
  </head>
  <body>
  <h4>Registracija</h4>
  <p>Vardas jau užtimtas. Rinkitės kitą.</p>
	<p>Iveskite prisijungimo duomenis</p>
    <form method="post" action="<?php echo htmlspecialchars("index.php");?>">
      Vardas: <input name="username" /><br />
      Slaptažodis: <input type="password" name="password" /><br />
      Registruotis? <input type="checkbox" name="doRegister"/><br/>
      <input type="submit" />
    </form>
  </body>
</html>


