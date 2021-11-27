<!DOCTYPE html>

<html lang="en">

<head>

 <title>Pacientes COVID</title>

 <meta charset="utf-8">

 <meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

 <script src="pacientes.js"></script>

 <script>
//Modificar codigo ajax (mostrar test positivos y negativos)
function mostrarInfoPaciente(id) {


  if (id== "") {

    document.getElementById("informacion").innerHTML = "";

    return;

  } else {

    var xmlhttp = new XMLHttpRequest();

	   xmlhttp.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {
    	document.getElementById("informacion").innerHTML = this.responseText;

      }

    };

    xmlhttp.open("GET","getPaciente.php?id="+id,true);

    xmlhttp.send();

  }

}

</script>

<style>

  #ifecha{

    margin-left: 0.35cm;

  }

  #btnGuardar{

    margin-top: 0.25cm;

  }

  #divFecha{

    margin-top: 0.3cm;

  }

</style>

</head>

<body>



<?php

   require ("pacientes.php");

   $paciente = new paciente();



   if(isset($_REQUEST["operacion"])){

       if($_REQUEST["operacion"]=="alta")

       {

           $paciente->alta_paciente($_POST["nombre"],$_POST["apellidos"],$_POST["edad"],$_POST["direccion"],$_POST["telefono"],$_POST["fecha"]);

           mostrarListado($paciente->listar_pacientes(),-1);

       }

      

       else if($_REQUEST["operacion"]=="editar"){

         mostrarListado($paciente->listar_pacientes(),$_REQUEST["nume"]);

       }

       

       else if($_REQUEST["operacion"]=="modificar"){

         $paciente->modificar_paciente($_POST["nume"],$_POST["nombre"],$_POST["apellidos"],$_POST["edad"],$_POST["direccion"],$_POST["telefono"],$_POST["fecha"]);
         mostrarListado($paciente->listar_pacientes(),-1);

       }

       else if ($_REQUEST["operacion"]=="borrar") {

       $paciente->borrar_paciente($_REQUEST["nume"]);

       echo "<CENTER>Se ha borrado correctamente el paciente.</CENTER><P>";

       mostrarListado($paciente->listar_pacientes(),-1);

     }

    

   } 

   else // no hay operacion. Ejemplo: La primera vez que se entra

   {

     mostrarListado($paciente->listar_pacientes(),-1);

    

   }
   
   function calcularEdad($paciente){

    $fecha_nacimiento= new DateTime( $paciente['edad'] );
    $hoy = new DateTime();
    $annos = $hoy->diff($fecha_nacimiento);
    echo $annos->y;

   }


   function mostrarListado($pacientes_array,$elemento){





     $html='<div class="container">

   <h2>Pacientes COVID</h2>          

   <table class="table table-striped" id="tabla_pacientes">

     <thead>

       <tr>

         <th>ID</th>

         <th>NOMBRE</th>

         <th>APELLIDOS</th>

         <th>EDAD</th>

         <th>DIRECCION</th>

         <th>TELEFONO</th>

         <th>FECHA</th>

       </tr>

     </thead>

     <tbody>';

    

         $fila="";

         foreach($pacientes_array as $paciente){


           if($elemento != $paciente['id']){

             $fila='<tr id='.$paciente['id'].'>

             <td>'.$paciente['id'].'</td>

             <td>'.$paciente['nombre'].'</td>

             <td>'.$paciente['apellidos'].'</td>

             <td>'.$paciente['edad'].'</td>

             <td>'.$paciente['direccion'].'</td>

             <td>'.$paciente['telefono'].'</td>

             <td>'.$paciente['fecha'].'</td>

             <td>'.'<a href="javascript:mostrarInfoPaciente('.$paciente['id'].')" class="btn btn-primary"  role="button">Estado</a>'.'</td>

             <td>'.'<a href="listarTest.php?idPaciente='.$paciente['id'].'" class="btn btn-info" role="button">Ver</a>'.'</td>

             <td>'.'<a href="index.php?operacion=editar&nume='.$paciente['id'].'" class="btn btn-warning" role="button">Modificar</a>'.'</td>

             <td>'.'<a href="index.php?operacion=borrar&nume='.$paciente['id'].'" class="btn btn-danger" role="button">Eliminar</a>'.'</td>

           </tr>';

           }else{

             $fila='<tr><form method="POST" class="form-inline" action="index.php?operacion=modificar">

             <td>'.$paciente['id'].'</td>

             <td><input type="text" class="form-control" id="nombre" value="'.$paciente['nombre'].'" name="nombre" style="width:150px"></td>

             <td><input type="text" class="form-control" id="apellidos" value="'.$paciente['apellidos'].'" name="apellidos" style="width:150px"></td>

             <td><input type="date" id="edad" name="edad" value="'.$paciente['edad'].'" min="1910-01-01" max="'.date("Y-m-d").'"></td>

             <td><input type="text" class="form-control" id="direccion" value="'.$paciente['direccion'].'" name="direccion" style="width:200px"></td>

             <td><input type="text" class="form-control" id="direccion" value="'.$paciente['telefono'].'" name="telefono" style="width:150px"></td>

             <td><input type="date" id="fecha" name="fecha" value="'.$paciente['fecha'].'" min="2018-01-01" max="'.date("Y-m-d").'"></td>

             <td>'.'<input type="submit" class="btn btn-success"  value="Guardar" />'.'</td>

             <td>'.'<a href="index.php" class="btn btn-danger" role="button">Cancelar</a>'.'</td>

             <input type="hidden" name="nume" value="'.$elemento.'" />

             

             </form>

           </tr>';

           }

          

            $html=$html.$fila;

          } //fin del bucle for 

          $html=$html.'</tbody>

                       </table>

                       <div id="informacion">
                       
                       </div>

                     </div>';

          echo $html;

      }



 

   ?>



<div class="container">



 <form method="POST" class="form-inline" action="index.php?operacion=alta">

   <div class="form-group">

     <label for="nombre">Nombre:</label>

     <input type="text" class="form-control" id="nombre" placeholder="Introduzca el nombre" name="nombre">

   </div>

   <div class="form-group">

     <label for="apellidos">Apellidos:</label>

     <input type="text" class="form-control" id="apellidos" placeholder="Introduzca los apellidos" name="apellidos">

   </div>

   <div class="form-group">

     <label for="edad">Edad:</label>

     <input type="date" id="edad" name="edad" value="<?php 

      calcularEdad($edad);
     
     ?>" min="1910-01-01" max="<?php echo date("Y-m-d");?>">
   </div>

   <div class="form-group">

     <label for="direccion">Dirección:</label>

     <input type="text" class="form-control" id="direccion" placeholder="dirección" name="direccion">

   </div>

   <div class="form-group">

    <label for="telefono" id="lbTelefono">Teléfono:</label>

    <input type="tel" class="form-control" id="telefono" placeholder="Introduzca el número de teléfono" name="telefono">

  </div>

   <div id="divFecha" class="form-group">
    
     <label for="fecha">Fecha:</label> 
     
     <input type="date" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>" min="2018-01-01" max="<?php echo date("Y-m-d");?>">
   
   </div>


            <br>
            <!-- <button type="submit" class="btn btn-default">Guardar</button> -->
            <a href="javascript:guardar_paciente()" id="btnGuardar" class="btn btn-success" role="button">Guardar</a>

            <!--<a href="javascript:guardar_paciente()" id="btnGuardar" class="btn btn-success" onclick="
              calcularEdad($paciente)" role="button">Guardar</a>
    -->

        </form>

      </div>

    </div>



  </body>

</html>

        