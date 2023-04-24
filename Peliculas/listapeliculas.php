<?php
session_start();

if (isset($_POST['enviar'])) {
    $_SESSION['num'] = $_POST['num'];
    $_SESSION['orden'] = $_POST['orden'];
    $_SESSION['year'] = $_POST['year'];
}

if (isset($_SESSION['num'])) {
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
            background-color: transparent;
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
            z-index: 1;
        }

        .cuadraos td {
            font-size: 1.5em;
            background-color: #cc3000;
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
            z-index: 12;
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
            text-align: center;
            z-index: 12;
        }

        #submenutabla {
            background-color: transparent;
            height: 50px;
            width: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            z-index: 12;
        }

        #submenutabla div {
            height: 50px;
            width: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            z-index: 12;
        }

        #submenutabla div:hover {
            background-color: #e63600;
            z-index: 12;
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
            top: 120px;
            left: 50%;
            transform: translate(-50%);
        }

        #colorea {
            background-color: red;
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
                            <div style="background-color: #e63600;">
                                <span>PELICULAS
                                </span>
                            </div>
                        </a>
                    </td>

                    <td>
                        <a href="buscar.php" style="text-decoration:none;">
                            <div>
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
        </div>
    </div>
    <a href="#menu"><div id="flecha"><img src="./img/flecha.png" alt="" width="60px"></div></a>
</body>

</html>
<?php
include_once("peliculas.php");
print_r($_SESSION['num']);

if (isset($_SESSION['num'])) {
    $num = $_SESSION['num'];
} else {
    $num = 6;
}

if (isset($_SESSION['orden'])) {
    $orden = $_SESSION['orden'];
} else {
    $orden = "X";
}

if (isset($_SESSION['year'])) {
    $year = $_SESSION['year'];
} else {
    $year = "X";
}
print_r($_SESSION['num']);
print_r($_SESSION['orden']);
print_r($_SESSION['year']);
$c = new Paginacion($num, $year);
$c->orden($orden);

$c->numeritos();

$c->mostrarCliente();


}else{
    header("location:index.php");
}