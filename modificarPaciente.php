<?php

require ("pacientes.php");
$paciente = new paciente();


if(isset($_POST['id']))
{
    $nombre = $_POST['id'];
}
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
    $nombre = $_POST['telefono'];
}
if(isset($_POST['fecha']))
{
    $fecha = $_POST['fecha'];
}

  $paciente->modificar_paciente($id,$nombre,$apellidos,$edad,$direccion,$telefono,$fecha);

  $html = '<tr>

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
?>