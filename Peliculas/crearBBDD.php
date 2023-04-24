<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$dbname = "richiliculas";

/* CREAR BASE DE DATOS */
try {
    $conn = new PDO("mysql:host=$servidor;dbname=$dbname;charset=utf8", $usuario, $clave);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    try {
        $conn = new PDO("mysql:host=$servidor", $usuario, $clave);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE richiliculas;
                        USE richiliculas;
                        CREATE TABLE peliculas (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                name VARCHAR(500),
                                url VARCHAR(500),
                                year INT,
                                num INT);";
        $conn->exec($sql);
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
    }
}
$conn = null;


/* INSERTAR DATOS 
try {
    $conn = new PDO("mysql:host=$servidor;dbname=$dbname;charset=utf8", $usuario, $clave);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $archivolee = fopen("peliculas.txt", "rb");
    if ($archivolee == true) {
        while (feof($archivolee) == false) {
            $stmt = $conn->prepare("INSERT INTO peliculas (name) VALUES (:name)");

            $name = fgets($archivolee);

            $stmt->bindParam(":name", $name);

            $stmt->execute();
        }
        fclose($archivolee);
    }
} catch (PDOException $e) {
    echo "Error" . $e->getMessage();
}
$conn = null;

*/
try {
    $conn = new PDO("mysql:host=$servidor;dbname=$dbname;charset=utf8", $usuario, $clave);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $year = 2021;
    $i=1;
    $arch = fopen("peliculas.txt", "rb");
    if ($arch == true) {
        while (!feof($arch)) {
            $stmt = $conn->prepare("INSERT INTO peliculas (name,url,year,num) VALUES (:name,:url,:year,:num)");



            $linea = fgetcsv($arch, 1000, ';');
            if ($linea) {
                $name = $linea[0];
                if (isset($linea[1])) {
                    $url = $linea[1];
                }
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":url", $url);
                $stmt->bindParam(":year", $year);
                $stmt->bindParam(":num", $i);
                $stmt->execute();
                $i++;
            }
        }
        fclose($arch);
    }

    $year = 2022;
    $i=1;
    $arch = fopen("peliculas2.txt", "rb");
    if ($arch == true) {
        while (!feof($arch)) {
            $stmt = $conn->prepare("INSERT INTO peliculas (name,url,year,num) VALUES (:name,:url,:year,:num)");



            $linea = fgetcsv($arch, 1000, ';');
            if ($linea) {
                $name = $linea[0];
                if (isset($linea[1])) {
                    $url = $linea[1];
                }
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":url", $url);
                $stmt->bindParam(":year", $year);
                $stmt->bindParam(":num", $i);
                $stmt->execute();
                $i++;
            }
        }
        fclose($arch);
    }
} catch (PDOException $e) {
    echo "Error" . $e->getMessage();
}
$conn = null;
