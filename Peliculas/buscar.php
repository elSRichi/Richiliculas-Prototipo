<?php
session_start();
?>
<!DOCTYPE html>

<head>
    <style>
        html,
        body {

            margin: 0px;
            background-color: #F2F2F2;
        }

        #contain {
            background-color: red;
            height: 10vh;
        }

        #dentro {
            background-color: green;
            margin: 0;
            display: flex;
            justify-content: center;

        }

        .cuadraos {
            position: absolute;
            top: 160px;
            height: 50px;
        }

        .cuadraos td {
            font-size: 1.5em;
            background-color: blue;
            width: 30px;
            text-align: center;
        }

        .cuadraos a {
            text-decoration: none;
            color: black;
        }

        #menu {
            position: absolute;
            height: 150px;
            left: 0px;
            right: 0px;
            top: 0px;
            background-color: #b32a00;
        }

        #submenu {
            position: absolute;
            z-index: 9;
            background-color: #cc3000;
            right: 0px;
            left: 0px;
            top: 100px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center
        }

        #submenutabla {
            background-color: transparent;
            height: 50px;
            width: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        #submenutabla div {
            height: 50px;
            width: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center
        }

        #submenutabla div:hover {
            background-color: #e63600;
        }

        .film {
            text-align: center;
            width: 500px;
            background-color: #ffd9cc;
            height: 600px;
            border: 2px solid black;
            border-collapse: collapse;
        }

        .img {
            height: 500px;
        }

        .imagen {
            height: 480px;
            width: auto;
        }

        .num {
            width: 250px;
        }

        #grande {
            position: relative;
            background-color: red;
        }

        #peque {
            position: absolute;
            top: 220px;
            left: 50%;
            transform: translate(-50%);
        }

        #formul {
            top: 70px;
            position: absolute;
        }

        #formul input {
            width: 250px;
            height: 30px;
            border: 2px solid black;
        }


        #nodiv {
            position: absolute;
            top: 250px;
            left: 0px;
            right: 0px;
            text-align: center;
        }

        span {
            color: black;
            font-size: 1.5em;
        }



        #menurelativo {
            position: absolute;
            height: 100px;
            left: 0px;
            right: 0px;
            top: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #menurelativotabla {
            background-color: transparent;
            height: 100px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        #menurelativotabla td {
            height: 140px;
            width: 300px;
        }


        #flecha{
            position: fixed;
            background-color: transparent;
            left: 10px;
            bottom: 10px;
            height: 60px;
            width: 60px;
        }
    </style>
</head>

<body>
    <div id="menu">
        <div id="menurelativo">
            <table id="menurelativotabla">
                <tr>
                    <td>
                        <div><img src="./img/richis.png" alt="" width="700px"></div>
                    </td>
                    <td>
                        <div><img src="./img/peliculas.png" alt="" width="700px"></div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="submenu">
            <table id="submenutabla">
                <tr>
                    <td>
                        <a href="index.php" style="text-decoration:none;">
                            <div class="hover">
                                <span>INICIO
                                </span>
                            </div>
                        </a>
                    </td>

                    <td>
                        <a href="listapeliculas.php" style="text-decoration:none;">
                            <div>
                                <span>PELICULAS
                                </span>
                            </div>
                        </a>
                    </td>

                    <td>
                        <a href="buscar.php" style="text-decoration:none;">
                            <div style="background-color: #e63600;">
                                <span>BUSCAR
                                </span>
                            </div>
                        </a>
                    </td>

                    <td>
                        <a href="./historia.html" style="text-decoration:none;">
                            <div>
                                <span>OTROS
                                </span>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
            <div id="formul">
                <form action="" method="post">
                    <input type="text" name="nombre" />
                </form>
            </div>
        </div>
    </div>
    <a href="#menu"><div id="flecha"><img src="./img/flecha.png" alt="" width="60px"></div></a>
</body>

</html>
<?php

include_once("peliculas.php");
$c = new Paginacion(999, "x");
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $c->buscar($nombre);
}
$c->mostrarCliente();
print_r($_SESSION['num']);
print_r($_SESSION['orden']);
print_r($_SESSION['year']);
