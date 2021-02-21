<?php
include ("conexion.php");

$cedula = 0;
if (isset($_POST['cedula_buscar'])) {
  $cedula = $_POST['cedula_buscar'];
}

$monto = 0;
$puntos_usar = 0;
if (isset($_POST['monto'])) {
  $monto = $_POST['monto'];
}
$cedula = (int) $cedula;




$consulta = "SELECT * FROM clientes WHERE id='$cedula'";
$ejecutar = mysqli_query($conn, $consulta);
$verFilas = mysqli_num_rows($ejecutar);
$fila = mysqli_fetch_array($ejecutar);
if (isset($_POST['puntos_usar'])) {
  $puntos_usar  = $_POST['puntos_usar'];
}
$montofinal=0;
$puntosfinales=0;
$comprastales=0;
$puntosdelcliente=$fila[5];
$bono = 0;
$resultadototal = 0;

$agregar = "UPDATE clientes SET total='$montofinal', cantidadCompras='$comprastales',puntos='$puntosfinales' WHERE id='$cedula'";
if (!isset($_POST['Agregar'])) {
  
} else {

  if ($puntosdelcliente < $puntos_usar){

    echo "<script>alert('Estas usando mas puntos de los que tienes'); 
    </script>";
    echo "<script>
    window.location='/Diego/index.php#second';</script>";

  }



  //validacion para que el usuario no use mas puntos de los que no tiene
  if($_POST['puntos_usar']==0){
    
    $comprastales = $fila[4] + 1;
    
    $puntosAsumar = $monto / 12000;
    
    $montofinal = $monto + $fila[6];

    $puntosdelcliente = $fila[5];
    
    $puntosfinales = $puntosdelcliente + $puntosAsumar;
    $agregar = "UPDATE clientes SET total='$montofinal', cantidadCompras='$comprastales',puntos='$puntosfinales' WHERE id='$cedula'";

    $resultado = mysqli_query($conn, $agregar);
    echo "<script>alert('Compra exitosa,  total a pagar: ' + $monto); 
    </script>";
    echo "<script>
    window.location='/Diego/index.php#second';</script>";

  }else if ($puntosdelcliente >= $puntos_usar) {

    

   
    if ($puntos_usar == 15) {

      $bono = 10000;
      $monto = $monto - $bono;

      $puntosdelcliente = $fila[5];


      $comprastales = $fila[4] + 1;

    
      $puntosAsumar = $monto / 12000;
    
      $montofinal = $monto + $fila[6];

      $puntosdelcliente = $puntosdelcliente - 15;
    
      $puntosfinales = $puntosdelcliente + $puntosAsumar;
      $agregar = "UPDATE clientes SET total='$montofinal', cantidadCompras='$comprastales',puntos='$puntosfinales' WHERE id='$cedula'";

      $resultado = mysqli_query($conn, $agregar);  
      echo "<script>alert('Compra exitosa, total a pagar: ' + $monto); 
      </script>";
      echo "<script>
      window.location='/Diego/index.php#second';</script>";
    
  }else if($puntos_usar == 25) {

    $bono = 20000;
    $monto = $monto - $bono;

    $puntosdelcliente = $fila[5];


    $comprastales = $fila[4] + 1;

  
    $puntosAsumar = $monto / 12000;
  
    $montofinal = $monto + $fila[6];

    $puntosdelcliente = $puntosdelcliente - 25;
  
    $puntosfinales = $puntosdelcliente + $puntosAsumar;
    $agregar = "UPDATE clientes SET total='$montofinal', cantidadCompras='$comprastales',puntos='$puntosfinales' WHERE id='$cedula'";

    $resultado = mysqli_query($conn, $agregar);  
    echo "<script>alert('Compra exitosa, total a pagar: ' + $monto); 
    </script>";
    echo "<script>
    window.location='/Diego/index.php#second';</script>";
  
  }else if ($puntos_usar == 35) {

    $bono = 30000;
    $monto = $monto - $bono;

    $puntosdelcliente = $fila[5];


    $comprastales = $fila[4] + 1;

  
    $puntosAsumar = $monto / 12000;
  
    $montofinal = $monto + $fila[6];

    $puntosdelcliente = $puntosdelcliente - 35;
  
    $puntosfinales = $puntosdelcliente + $puntosAsumar;
    $agregar = "UPDATE clientes SET total='$montofinal', cantidadCompras='$comprastales',puntos='$puntosfinales' WHERE id='$cedula'";

    $resultado = mysqli_query($conn, $agregar);  
    echo "<script>alert('Compra exitosa, total a pagar: ' + $monto); 
    </script>";
    echo "<script>
    window.location='/Diego/index.php#second';</script>";
  
  } else if ($puntos_usar != 15 || $puntos_usar != 25 || $puntos_usar != 35) {
    echo "<script>alert('no estas canjeando correctamente el bono'); </script>";
    echo "<script>
    window.location='/Diego/index.php#second';</script>";
  }

  
}

}
