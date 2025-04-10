<?php

spl_autoload_register(function ($class) {
  $prefix = 'App\\';
  $baseDir = __DIR__ . '/App/';
  if (str_starts_with($class, $prefix)) {
      $file = $baseDir . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
      if (file_exists($file)) {
          require $file;
      }
  }
});

?>