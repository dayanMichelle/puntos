<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/main.css">
</head>

<body>

  <nav>
    <a href="#first"><i class="far fa-user"></i></a>
    <a href="#second"><i class="fas fa-briefcase"></i></a>
    <a href="#third"><i class="far fa-file"></i></a>
    <a href="#fourth"><i class="far fa-address-card"></i></a>
  </nav>

  <div class='container'>

    <section id='first'>
    
      <div class="row">
        <form id="contact_form" action="buscar.php" method="POST" enctype="multipart/form-data">
          <label class="required" for="name">N° de cedula:</label><br />
          <input id="cedula_buscar" class="input" value="<?php
                                                          if (isset($cedula)) echo $cedula ?>" name="cedula_buscar" type="number" value="456789" size="30" /><br />

          <input id="submit_button" type="submit" value="Buscar cliente"/>
      </div>

      </form>
      <div id="after_submit"></div>
      <form id="contact_form" action="registro.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          <label class="required" for="name">N° de cedula:</label><br />
          <input id="name" class="input" value="<?php
                                                if (isset($cedula)) echo $cedula ?>" name="cedula" required type="number" value="" size="30" /><br />
          <span id="name_validation" class="error_message"></span>
        </div>
        <div class="row">
          <label class="required" for="name">Nombre completo:</label><br />
          <input id="name" class="input" value="<?php
                                                if (isset($cedula)) echo $cedula ?>" required name="nombre" type="text" value="" size="30" /><br />
          <span id="name_validation" class="error_message"></span>
        </div>
        <div class="row">
          <label class="required" for="email">email:</label><br />
          <input id="email" class="input" value="<?php
                                                  if (isset($cedula)) echo $cedula ?>" name="email" required type="text" value="" size="30" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <div class="row">
          <label class="required" for="email">Numero:</label><br />
          <input id="numero" class="input" value="<?php
                                                  if (isset($cedula)) echo $cedula ?>" name="numero" required type="text" value="" size="" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>


        <div class="row">
          <label class="required" for="email">Puntos:</label><br />
          <input id="email" class="input" name="puntos" type="text" value="0" readonly="readonly" size="30" /><br />
          <span id="email_validation" class="error_message"></span>
        </div>
        <input id="submit_button" type="submit" value="Agregar cliente" />
      </form>

    </section>

    <section id='second'>

      <div class="row">
        <div class="contenedor-2">

          <form method="post" class="puntos">
            <label class="required" for="name">N° de cedula:</label><br />
            <input id="cedula_buscar" class="input" value="<?php
                                                            if (isset($cedula_buscar)) echo $cedula_buscar ?>" name="cedula_buscar" type="number" value="<?php if (isset($_montofinal)) echo $_montofinal; ?>" size="30" /><br />


            <?php
            include("conexion.php");
            $cedula = 0;

            if (empty($_POST['cedula_buscar'])) {
              $cedula = 0;
            }
            if (!empty($_POST['cedula_buscar'])) {
              $cedula = $_POST['cedula_buscar'];
              $cedula = (int) $cedula;


              $cedula = $_POST['cedula_buscar'];
              $cedula = (int) $cedula;

              $consulta = "SELECT * FROM clientes WHERE id='$cedula'";
              $ejecutar = mysqli_query($conn, $consulta);
              $verFilas = mysqli_num_rows($ejecutar);
              $fila = mysqli_fetch_array($ejecutar);

              $puntos =  $fila[5];

              $resultado = mysqli_query($conn, $consulta);
              if ($resultado) {
                echo '
<table class="tabla-puntos">
<th>N° Cédula</th>
<td>' . $fila[0] . '</td>     
<th>Puntos</th>
<td>' . $fila[5] . '</td>

</tr>
</table>
';
              } else {
                echo "NO HAY ";
              }
            }

            ?>
            <input id="submit_button" type="submit" value="Ver puntos del cliente" />
          </form>
        </div>
        <div class="contenedor">

          <form id="contact_form-2" method="POST" enctype="multipart/form-data">
            <div class="row">
              <label class="required" for="name">N° de cedula:</label><br />
              <input id="name" class="input" value="<?php
                                                    if (isset($cedula)) echo $cedula ?>" name="cedula_buscar" required type="number" value="" size="30" /><br />
              <span id="name_validation" class="error_message"></span>
            </div>
            <div class="row">
              <label class="required" for="name">Monto:</label><br />
              <input id="name" class="input" value="<?php
                                                    if (isset($monto)) echo $monto ?>" required name="monto" type="number" value="" size="30" /><br />
              <span id="name_validation" class="error_message"></span>
            </div>



            <div class="row">
              <label class="required" for="email">Puntos a usar:</label><br />
              <input id="email" class="input" required name="puntos_usar" type="number" value="<?php if (isset($puntos_usar)) echo $puntos_usar ?>" size="30" /><br />
              <span id="email_validation" class="error_message"></span>
            </div>


            <input id="submit_button-agregar" type="submit" name="Agregar" value="Agregar compra" />
            <?php

            $cedula = 0;
            if (isset($_POST['cedula_buscar'])) {
              $cedula = $_POST['cedula_buscar'];
            }

            $monto = 0;
            $puntos_usar = 0;
            if (isset($_POST['monto'])) {
              $monto = $_POST['monto'];
              $monto = (int) $monto;
            }
            $cedula = (int) $cedula;

            $constPunto = 55;


            $consulta = "SELECT * FROM clientes WHERE id='$cedula'";
            $ejecutar = mysqli_query($conn, $consulta);
            $verFilas = mysqli_num_rows($ejecutar);
            $fila = mysqli_fetch_array($ejecutar);
            if (isset($_POST['puntos_usar'])) {
              $puntos_usar  = $_POST['puntos_usar'];
            }

            $montofinal = $monto - ($puntos_usar * $constPunto);

            $resultadototal = $fila[6] + $montofinal;
            $comprastales = $fila[4] + 1;
            $puntosdelcliente = $fila[5];
            if($fila[5]==nulL){
              $puntosdelcliente=0;
            }
            $totalpuntos = $puntosdelcliente - $puntos_usar;

            $puntosAsumar = ($montofinal * 1) / 1000;

            $puntosfinales = $totalpuntos + $puntosAsumar;
            #RODEONDEO PARA LOS PUNTOS 
            round($puntosAsumar, 0, PHP_ROUND_HALF_UP);

          

            $agregar = "UPDATE clientes SET total='$resultadototal', cantidadCompras='$comprastales',puntos='$puntosfinales' WHERE id='$cedula'";
            if (!isset($_POST['Agregar'])) {
            } else {
              
              //validacion para que el usuario no use mas puntos de los que no tiene
              if ($puntosdelcliente >= $puntos_usar) {
                $resultado = mysqli_query($conn, $agregar);
                echo "<script>alert('Compra exitosa'); 
                </script>";
              } else {
                echo "<script>alert('Los puntos a usar son mayores a los puntos del cliente'); 
                </script>";
              }

              //no mas botones porfavor
            }
            #Solo para dos botones

            ?>

            <form method="POST" class>
              <input id="submit_button" type="submit" value="Canjear" />
              <?php

              if ($puntosdelcliente >= $puntos_usar) {
                echo '
  <table class="comprar">
  <th>total</th>
  <td>' . $monto . '</td>
  <th>puntos</th>
  <td>' . $puntos_usar . '</td>
  <th>total</th>
  <td>' . $montofinal . '</td></table>
  ';
              } else {
                echo "<script>alert('Los puntos a usar son mayores a los puntos del cliente'); 
</script>";
              }



              ?>
            </form>
          </form>
        </div>

    </section>

    <section id='third'>
      <h1>Third</h1>
    </section>

    <section id='fourth'>
      <h1>Fourth</h1>




  </div>

  </section>
  </div>
  <script src='main.js'></script>
</body>

</html>