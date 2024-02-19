<?php

namespace php;

class utils
{

    public static function limpiarCadena(string $cadena)
    {

        $palabras = [
            "<script>", "</script>", "<script src",
            "<script type=", "SELECT * FROM", "SELECT ", " SELECT ",
            "DELETE FROM", "INSERT INTO", "DROP TABLE",
            "DROP DATABASE", "TRUNCATE TABLE", "SHOW TABLES",
            "SHOW DATABASES", "<?php", "?>", "--", "^", "<", ">",
            "==", "=", ";", "::"
        ];

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        foreach ($palabras as $palabra) {
            $cadena = str_ireplace($palabra, "", $cadena);
        }

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        return $cadena;
    }

    protected static function verificarDatos(string $filtro, string $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    }
}
