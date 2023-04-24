<?php

class Conexion
{
    private $servidor = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $dbname = "richiliculas";


    function conex()
    {
        try {
            return new PDO("mysql:host=$this->servidor;dbname=$this->dbname;charset=utf8", $this->usuario, $this->clave);
        } catch (PDOException $e) {
            return "Error" . $e->getMessage();
        }
    }
}
class Paginacion extends Conexion
{
    private $pagactual;
    private $numresultados;
    private $resultadoporpag;
    private $indice;
    private $totalpag;
    private $conexion;
    private $buscar = false;
    private $nombre;
    private $orden;
    private $year;
    private $tabla = "peliculas";

    function __construct($resultadoporpag,$year)
    {
        $this->resultadoporpag = $resultadoporpag;
        $this->indice = 0;
        $this->pagactual = 1;
        $this->year = $year;
        $this->conexion = parent::conex();
        $this->calcularPag();
    }

    function calcularPag()
    {
        if($this->year == 2021){
            $stmt = $this->conexion->prepare("SELECT COUNT(*) as total FROM $this->tabla WHERE year = 2021");
        }elseif($this->year == 2022){
            $stmt = $this->conexion->prepare("SELECT COUNT(*) as total FROM $this->tabla WHERE year = 2022");
        }else{
            $stmt = $this->conexion->prepare("SELECT COUNT(*) as total FROM $this->tabla");
        }
        

        $stmt->execute();
        $this->numresultados = $stmt->fetch(PDO::FETCH_OBJ)->total;
        $this->totalpag = $this->numresultados / $this->resultadoporpag;

        if (isset($_GET['pagina'])) {
            $this->pagactual = $_GET['pagina'];
            $this->indice = ($this->pagactual - 1) * ($this->resultadoporpag);
        }
    }

    function mostrarCliente()
    {
        try {
            
            if ($this->buscar == true) {
                $name = $this->nombre;
                $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla WHERE name LIKE '%' :nombre '%'");
                $stmt->bindParam(":nombre", $name);
            } elseif ($this->orden == "1") {
                if ($this->year == 2021) {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla WHERE year = 2021 LIMIT $this->indice, $this->resultadoporpag ");
                } elseif ($this->year == 2022) {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla WHERE year = 2022 LIMIT $this->indice, $this->resultadoporpag ");
                } else {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla LIMIT $this->indice, $this->resultadoporpag ");
                }
            } elseif ($this->orden == "A") {
                if ($this->year == 2021) {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla WHERE year = 2021 ORDER BY name ASC LIMIT $this->indice, $this->resultadoporpag ");
                } elseif ($this->year == 2022) {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla WHERE year = 2022 ORDER BY name ASC LIMIT $this->indice, $this->resultadoporpag ");
                } else {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla ORDER BY name ASC LIMIT $this->indice, $this->resultadoporpag ");
                }
            } elseif ($this->orden == "Z") {
                if ($this->year == 2021) {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla WHERE year = 2021 ORDER BY name DESC LIMIT $this->indice, $this->resultadoporpag ");
                } elseif ($this->year == 2022) {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla WHERE year = 2022 ORDER BY name DESC LIMIT $this->indice, $this->resultadoporpag ");
                } else {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla ORDER BY name DESC LIMIT $this->indice, $this->resultadoporpag ");
                }
            } elseif ($this->orden == "N") {
                if ($this->year == 2021) {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla WHERE year = 2021 ORDER BY id DESC LIMIT $this->indice, $this->resultadoporpag ");
                } elseif ($this->year == 2022) {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla WHERE year = 2022 ORDER BY id DESC LIMIT $this->indice, $this->resultadoporpag ");
                } else {
                    $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla ORDER BY id DESC LIMIT $this->indice, $this->resultadoporpag ");
                }
            } else {
                $stmt = $this->conexion->prepare("SELECT * FROM $this->tabla LIMIT $this->indice, $this->resultadoporpag");
            }
            $stmt->execute();
            $registroarray = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if (count($registroarray) > 0) {
                echo '<div id="grande">
                <div id="peque">
                    <table id="tabla">';
                if (count($registroarray) % 3 == 0) {
                    $j = 0;
                    while ($j < count($registroarray) - 1) {
                        echo '
                    <tr>
                    <td>
                        <table class="film" border="1">
                            <tr>
                                <td colspan="2" class="img">
                                <img class="imagen"
                                src="' . $registroarray[$j]["url"] . '"
                                alt="IMG">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">' . $registroarray[$j]["name"] . '</td>
                            </tr>
                            <tr>
                                <td class="num">' . $registroarray[$j]["id"] . '</td>
                                <td>' . $registroarray[$j]["year"] . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="film" border="1">
                            <tr>
                                <td colspan="2" class="img">
                                    <img class="imagen"
                                        src="' . $registroarray[$j + 1]["url"] . '"
                                        alt="IMG">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">' . $registroarray[$j + 1]["name"] . '</td>
                            </tr>
                            <tr>
                                <td class="num">' . $registroarray[$j + 1]["id"] . '</td>
                                <td>' . $registroarray[$j + 1]["year"] . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="film" border="1">
                            <tr>
                                <td colspan="2" class="img">
                                    <img class="imagen"
                                        src="' . $registroarray[$j + 2]["url"] . '"
                                        alt="IMG">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">' . $registroarray[$j + 2]["name"] . '</td>
                            </tr>
                            <tr>
                                <td class="num">' . $registroarray[$j + 2]["id"] . '</td>
                                <td>' . $registroarray[$j + 2]["year"] . '</td>
                            </tr>
                        </table>
                    </td>
                </tr>';
                        $j = $j + 3;
                    }
                } else {


                    $j = 0;
                    while ($j < count($registroarray) - 2) {
                        echo '
                    <tr>
                    <td>
                        <table class="film" border="1">
                            <tr>
                                <td colspan="2" class="img">
                                    <img class="imagen" src="' . $registroarray[$j]["url"] . '" alt="IMG">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">' . $registroarray[$j]["name"] . '</td>
                            </tr>
                            <tr>
                                <td class="num">' . $registroarray[$j]["id"] . '</td>
                                <td>' . $registroarray[$j]["year"] . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="film" border="1">
                            <tr>
                                <td colspan="2" class="img">
                                    <img class="imagen"
                                        src="' . $registroarray[$j + 1]["url"] . '"
                                        alt="IMG">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">' . $registroarray[$j + 1]["name"] . '</td>
                            </tr>
                            <tr>
                                <td class="num">' . $registroarray[$j + 1]["id"] . '</td>
                                <td>' . $registroarray[$j + 1]["year"] . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="film" border="1">
                            <tr>
                                <td colspan="2" class="img">
                                    <img class="imagen"
                                        src="' . $registroarray[$j + 2]["url"] . '"
                                        alt="IMG">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">' . $registroarray[$j + 2]["name"] . '</td>
                            </tr>
                            <tr>
                                <td class="num">' . $registroarray[$j + 2]["id"] . '</td>
                                <td>' . $registroarray[$j + 2]["year"] . '</td>
                            </tr>
                        </table>
                    </td>
                </tr>';
                        $j = $j + 3;
                    }
                    $x = count($registroarray) - round(count($registroarray) / 3) * 3;
                    switch ($x) {
                        case 1:
                            echo '
                            <tr>
                    <td>
                        <table class="film" border="1">
                            <tr>
                                <td colspan="2" class="img">
                                    <img class="imagen" src="' . $registroarray[$j]["url"] . '" alt="IMG">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">' . $registroarray[$j]["name"] . '</td>
                            </tr>
                            <tr>
                                <td class="num">' . $registroarray[$j]["id"] . '</td>
                                <td>' . $registroarray[$j]["year"] . '</td>
                            </tr>
                        </table>
                    </td></tr>
                            ';
                            break;
                        default:
                            echo '
                            <tr>
                            <td>
                        <table class="film" border="1">
                            <tr>
                                <td colspan="2" class="img">
                                    <img class="imagen" src="' . $registroarray[$j]["url"] . '" alt="IMG">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">' . $registroarray[$j]["name"] . '</td>
                            </tr>
                            <tr>
                                <td class="num">' . $registroarray[$j]["id"] . '</td>
                                <td>' . $registroarray[$j]["year"] . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="film" border="1">
                            <tr>
                                <td colspan="2" class="img">
                                    <img class="imagen" src="' . $registroarray[$j + 1]["url"] . '" alt="IMG">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">' . $registroarray[$j + 1]["name"] . '</td>
                            </tr>
                            <tr>
                                <td class="num">' . $registroarray[$j + 1]["id"] . '</td>
                                <td>' . $registroarray[$j + 1]["year"] . '</td>
                            </tr>
                        </table>
                    </td></tr>
                            ';
                            break;
                    }
                }
                echo '</table>
                </div>
            </div>';
            } else {
                echo "<div id='nodiv'><p id='no'>NO HAY DATOS</p></div>";
            }
        } catch (PDOException $e) {
            echo "Error" . $e->getMessage();
        }
    }

    function buscar($nombre)
    {
        $this->nombre = $nombre;
        $this->buscar = true;
    }

    function orden($orden)
    {
        $this->orden = $orden;
    }


    function numeritos()
    {
        echo "<div id='contain'><div id='dentro'><table class='cuadraos'><tr>";
        for ($i = 0; $i < $this->totalpag; $i++) {
            if ($i == $this->pagactual - 1) {
                echo "<td id='colorea'><a href='?pagina=" . ($i + 1) . "'>" . ($i + 1) . "</a></td>";
            } else {
                echo "<td><a href='?pagina=" . ($i + 1) . "'>" . ($i + 1) . "</a></td>";
            }
        }
        echo "</tr></table></div></div>";
    }
}
