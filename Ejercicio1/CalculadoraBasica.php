<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Marina Vega Fernández" />
    <title>Práctica 04| Software y Estándares para la Web</title>
    <link rel="stylesheet" type="text/css" href="CalculadoraBasica.css" />
</head>

<body>
    <header>
        <h1>Calculadora Básica</h1>
    </header>
    <main>
        <?php
        session_start();

        class CalculadoraBasica
        {
            private $memory;
            private $display;


            public function __construct()
            {
                $this->memory = 0;
                $this->display = '';
            }


            public function getDisplay(): string
            {
                return $this->display;
            }

            public function display($digit)
            {
                if ($this->display === '0') {
                    $this->display = $digit;
                } else {
                    $this->display .= $digit;
                }
            }

            public function cleanDisplay()
            {
                $this->display = "0";
            }

            public function result()
            {
                try {
                    $this->display = eval("return $this->display;");
                    $this->memory = 0;
                } catch (Exception $e) {
                    echo '<script>alert("Error")</script>';
                }
            }

            public function addMemory()
            {
                try {
                    $this->memory += eval("return $this->display;");
                    $this->cleanDisplay();
                } catch (Exception $e) {
                    echo '<script>alert("Error")</script>';
                }
            }

            public function minusMemory()
            {
                try {
                    $this->memory -= eval("return $this->display;");
                    $this->cleanDisplay();
                } catch (Exception $e) {
                    echo '<script>alert("Error")</script>';
                }
            }

            public function showMemory()
            {
                try {
                    $this->display = $this->memory;
                    $this->memory = 0;
                } catch (Exception $e) {
                    echo '<script>alert("Error")</script>';
                }
            }
        }

        if (!isset($_SESSION['calculator'])) {
            $_SESSION['calculator'] = new CalculadoraBasica();
        }
        $calculator = $_SESSION['calculator'];

        if ($_GET) {
            if (isset($_GET["display"]) && "" != $_GET["display"]) {
                switch ($_GET["display"]) {
                    case 'mrc':
                        $calculator->showMemory();
                        break;
                    case 'm-':
                        $calculator->minusMemory();
                        break;
                    case 'm+':
                        $calculator->addMemory();
                        break;
                    case '=':
                        $calculator->result();
                        break;
                    case 'C':
                        $calculator->cleanDisplay();
                        break;
                    default:
                        $calculator->display($_GET["display"]);
                }
            }
        }
        ?>

        
        <?php
        echo '<label for="viewer">Visor</label><input type="text" id="viewer" value="' . $calculator->getDisplay() . '" disabled/>'
        ?>
        <form>

            <input type="submit" class="memory" value="mrc" name="display" />
            <input type="submit" class="memory" value="m-" name="display" />
            <input type="submit" class="memory" value="m+" name="display" />
            <input type="submit" class="operation" value="/" name="display" />

            <input type="submit" class="number" value="7" name="display" />
            <input type="submit" class="number" value="8" name="display" />
            <input type="submit" class="number" value="9" name="display" />
            <input type="submit" class="operation" value="*" name="display" />

            <input type="submit" class="number" value="4" name="display" />
            <input type="submit" class="number" value="5" name="display" />
            <input type="submit" class="number" value="6" name="display" />
            <input type="submit" class="operation" value="-" name="display" />

            <input type="submit" class="number" value="1" name="display" />
            <input type="submit" class="number" value="2" name="display" />
            <input type="submit" class="number" value="3" name="display" />
            <input type="submit" class="operation" value="+" name="display" />

            <input type="submit" class="number" value="0" name="display" />
            <input type="submit" class="number" value="." name="display" />
            <input type="submit" class="number" value="C" name="display" />
            <input type="submit" class="operation" value="=" name="display" />

        </form>


    </main>

</body>