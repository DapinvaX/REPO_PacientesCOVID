<?php

require ("pacientes.php");

$paciente = new paciente();


if(isset($_POST['nombre']))
{
    $nombre = $_POST['nombre'];
}
if(isset($_POST['apellidos']))
{
    $apellidos = $_POST['apellidos'];
}
if(isset($_POST['edad']))
{
    $edad = $_POST['edad'];
}
if(isset($_POST['direccion']))
{
    $direccion = $_POST['direccion'];
}
if(isset($_POST['telefono']))
{
    $telefono = $_POST['telefono'];
}
if(isset($_POST['fecha']))
{
    $fecha = $_POST['fecha'];
}

  $id = $paciente->alta_paciente($nombre,$apellidos,$edad,$direccion,$telefono,$fecha);

  echo $id;

 /* $html = '<tr>

  <td>'.$id.'</td>

  <td>'.$nombre.'</td>

  <td>'.$apellidos.'</td>

  <td>'.$edad.'</td>

  <td>'.$direccion.'</td>

  <td>'.$telefono.'</td>

  <td>'.$fecha.'</td>

  <td>'.'<a href="index.php?operacion=editar&nume='.$id.'" class="btn btn-info" role="button">Modificar</a>'.'</td>

  <td>'.'<a href="index.php?operacion=borrar&nume='.$id.'" class="btn btn-danger" role="button">Eliminar</a>'.'</td>

  <td>'.'<a href="listarTest.php?idPaciente='.$id.'" class="btn btn-warning" role="button">Ver</a>'.'</td>

  </tr>';
  echo $html;
 */


    
?>