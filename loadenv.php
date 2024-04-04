<?php 
    error_log("Cargando variables de entorno");

   if (file_exists(__DIR__ . '/.env')) {
        error_log("Archivo .env encontrado");

      $env = file(__DIR__ . '/.env');
      foreach ($env as $line) {
          if (trim($line) === '') continue; // Ignora líneas vacías
          list($name, $value) = explode('=', $line, 2);
          $name = trim($name);
          $value = trim($value);
          if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
              putenv(sprintf('%s=%s', $name, $value));
              $_ENV[$name] = $value;
              $_SERVER[$name] = $value;

              error_log(sprintf('Variable de entorno cargada: %s', $name));

              error_log(sprintf('Valor: %s', $value));
          }
      }
  }
  
?>