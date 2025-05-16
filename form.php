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
      Vardas: <input name="username" /><br />
      Slaptažodis: <input required type="password" name="password" /><br />
      <input type="hidden" name="doRegister" value="FALSE" /><!--Hidden input reikia, kad doRegister kintamasis turėtų FALSE pradinę reikšmę.-->
      Registruotis? <input type="checkbox" name="doRegister" value="TRUE"/><br/>
      <input type="submit" />
    </form>
  </body>
</html>