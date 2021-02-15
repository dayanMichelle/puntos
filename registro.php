<?php
include ("conexion.php");

$nombre =$_POST["nombre"];
$id =$_POST["cedula"];
$email =$_POST["email"];
$numero =$_POST["numero"];

$insertar = "INSERT INTO clientes (id,nombre,numero,correo)
VALUES ('$id','$nombre','$numero','$email')";



$resultado=mysqli_query($conn,$insertar);


if($resultado){
    echo "<script>alert('Se ha registrado el usuario con éxito');
    
    window.location='/Diego/index.php#second'</script>";

}else{
    echo "<script>alert('No se puede registrar'); window.history.go(-1);
    </script>";
}
?>