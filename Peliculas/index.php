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

        #formul {
            top: 70px;
            position: absolute;
        }

        #formul input {
            width: 250px;
            height: 30px;
            border: 2px solid black;
        }

        #formul select {
            width: 250px;
            height: 30px;
            border: 2px solid black;
        }

        #formul input[type=submit] {
            background-color: #cc3000;
            color: black;
            cursor: pointer;
        }

        span {
            color: black;
            font-size: 1.5em;
        }


        
        #menurelativo{
            position: absolute;
            height: 100px;
            left: 0px;
            right: 0px;
            top: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #menurelativotabla{
            background-color: transparent;
            height: 100px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        #menurelativotabla td{
            height: 140px;
            width: 300px;
        }
    </style>
</head>

<body>
    <div id="menu">
        <div id="menurelativo">
            <table  id="menurelativotabla" >
                <tr>
                    <td><div><img src="./img/richis.png" alt="" width="700px"></div></td>
                    <td><div><img src="./img/peliculas.png" alt="" width="700px"></div></td>
                </tr>
            </table>
        </div>

        <div id="submenu">
            <table id="submenutabla">
                <tr>
                    <td>
                        <a href="index.php" style="text-decoration:none;">
                            <div style="background-color: #e63600;" class="hover">
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
            <div id="formul">
                <form action="" method="post">
                    <p>Numero de peliculas por pagina</p>
                    <input type="number" name="num" min="6" placeholder="Numero de peliculas por pagina" required /><br>
                    <p>Orden de peliculas</p>
                    <select name="orden">
                        <option value="1">1-999</option>
                        <option value="A">A-Z</option>
                        <option value="Z">Z-A</option>
                        <option value="N">999-1</option>
                    </select><br>
                    <p>Peliculas por año</p>
                    <select name="year">
                        <option value="todas">2021-2022 (Todas)</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                    </select><br>
                    <p></p>
                    <input type="submit" name="enviar" value="Aceptar" formaction="listapeliculas.php"/>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php

