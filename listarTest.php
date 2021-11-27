<!DOCTYPE html>

<html lang="en">

<head>

 <title>Test COVID</title>

 <meta charset="utf-8">

 <meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<script>

function insertarTestPaciente() {

    idpaciente = document.getElementById("paciente");
    tipo = document.getElementById("tipo");
    resultado = document.getElementById("resultado");

  

    var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

        filaTestNuevo = '<tr><td>'+id+'</td><td>'+nombre+'</td><td>'+apellidos+'</td><td>'+edad+'</td><td>'+direccion+'</td><td>'+telefono+'</td></tr>';
    	document.getElementById("tabla_listado_tests").innerHTML = filaTestNuevo;

      }

    };

    xmlhttp.open("GET","insertarTestPaciente.php?idPaciente="+idpaciente+"&tipo="+tipo+"&resultado="+resultado+",true");

    xmlhttp.send();

  

}

</script>

<style>
.positivo{
  background-color: WHITE;
}

.negativo{
  background-color: WHITE;
}

.separacion{
  margin-left: 3em;
}

#btnAtras{
  margin-top: 0.01cm;
  margin-left: auto;
}

#btnDeshacer{
  margin-left: auto;
}

#btnGuardar{

  margin-left: 0.20cm;

}
#botones{

  margin-left: 10.35cm;
  

}
#btnAtras:hover {
  color:#FFFFFF;
  background-color: rgba(57, 57, 57, 1);
  transition: all 0.2s ease;
}

#btnDeshacer:hover {
  color:#FFFFFF;
  background-color: rgba(57, 57, 57, 1);
  transition: all 0.2s ease;
}




</style>

<body>

<?php

require_once ("test.php");
require_once ("tiposTest.php");


   $test = new test();
   
   $idPaciente;
  

   if(isset($_GET['idPaciente']))
   {
       $idPaciente = $_GET['idPaciente'];
   }

   if(isset($_POST['paciente']))
   {
       $idPaciente = $_POST['paciente'];
   }

  


   echo "<h2>TEST COVID</h2>";
   echo "<h3>ID Paciente:".$idPaciente."</h3>";


   if(isset($_REQUEST["operacion"])){

       if($_REQUEST["operacion"]=="alta")

       {

            
           $test->añadir_test($_POST["tipo"],$_POST["resultado"],$_POST["paciente"]);
           mostrarListado($test->listar_tests_paciente($idPaciente),-1,$idPaciente);
           

       }

      

       else if($_REQUEST["operacion"]=="editar"){

         mostrarListado($test->listar_tests_paciente($idPaciente),$_REQUEST["nume"],$idPaciente);

       }

       

       else if($_REQUEST["operacion"]=="modificar"){

         $test->modificar_test($_POST["nume"],$_POST["tipo"],$_POST["resultado"]);
         mostrarListado($test->listar_tests_paciente($idPaciente),-1,$idPaciente);

       }

       else if ($_REQUEST["operacion"]=="borrar") {

       $test->borrar_test($_REQUEST["nume"]);

       echo "<CENTER>Se ha borrado correctamente el test.</CENTER><P>";

       mostrarListado($test->listar_tests_paciente($idPaciente),-1,$idPaciente);


       $test->borrar_test($_REQUEST["nume"]);
           mostrarListado($test->listar_tests_paciente($idPaciente),-1,$idPaciente);

     }

    

   } 
   else{

    mostrarListado($test->listar_tests_paciente($idPaciente),-1,$idPaciente);

   } 

   function mostrarListado($test_array,$elemento,$paciente){

      

     $html='<div class="container">

   
   <table id="tabla_listado_tests" class="table">

     <thead>

       <tr>

         <th>NÚMERO</th>

         <th>TIPO</th>

         <th>RESULTADO</th>

       </tr>

     </thead>

     <tbody>';

    

         $fila="";
   
         //$total_test = $test_array->rowCount();
         $total_test = 1;

         foreach($test_array as $test){


           if($elemento != $test['id']){

            $icono="";
            $estiloFila="";
            
            if($test['resultado']=='1'){
                $icono="./iconos/icono+.png";
                $estiloFila="positivo";

            }else{
                $icono="./iconos/icono-.png";
                $estiloFila="negativo";
                
            }


             $fila='<tr class="'.$estiloFila.'">

             <td>'.$total_test.'</td>

             
            <td>'.$test['tipo_test'].'</td> 

             <td><img src="'.$icono.'" width="20px" height="20px"/></td>

             <td>'.'<a href="listarTest.php?operacion=editar&nume='.$test['id'].'&idPaciente='.$paciente.'" class="btn btn-info" role="button">Modificar</a>'.'</td>

             <td>'.'<a href="listarTest.php?operacion=borrar&nume='.$test['id'].'&idPaciente='.$paciente.'" class="btn btn-danger" role="button">Eliminar</a>'.'</td>


           </tr>';

           }else{
            $estiloFilaM="";
            if($test['resultado']==1){
                
                $estiloFilaM="positivo";

            }else{
                
                $estiloFilaM="negativo";
                
            }

             $fila='<tr class="'.$estiloFilaM.'"><form method="POST" class="form-inline" action="listarTest.php?operacion=modificar">

             <td>'.$total_test.'</td>

             <td>';

             $fila=$fila.'<select name="tipo">';
            
               $tipos_test = new tiposTest(); 

                $listaTipoTest = $tipos_test ->obtener_tipos_test();
                
                foreach($listaTipoTest as $tipo_test){
                  $seleccion = '';
                  if($tipo_test['id']==$test['tipo_test']){
                    $seleccion = 'selected';
                  }
                  $fila = $fila. ' <option value="'.$tipo_test['id'].'" '.$seleccion.' >'.$tipo_test['nombreTest'].'</option>';
 
                }
                $fila=$fila.'</select></td>';
              
              $checkPositivo='';
              $checkNegativo='';
              if($test['resultado']=='1'){
                $checkPositivo = 'checked';
              }else{
                $checkNegativo = 'checked';
              }

              
             $fila = $fila.'<td><input type="radio" id="POSITIVO" name="resultado" value="1" '.$checkPositivo.'>
             <label for="POSITIVO">POSITIVO</label>
             <input type="radio" id="NEGATIVO" name="resultado" value="0" '.$checkNegativo.'>
             <label for="NEGATIVO">NEGATIVO</label></td>';  

             

             $fila = $fila.'<td>'.'<input type="submit" class="btn btn-success"  value="Grabar" />'.'</td>

             <td>'.'<a href="listarTest.php?idPaciente='.$paciente.'" class="btn btn-danger" role="button">Cancelar</a>'.'</td>

             <input type="hidden" id="paciente" name="paciente" value="'.$paciente.'" />
             <input type="hidden" id="nume" name="nume" value="'.$test['id'].'" />

            

             </form>

           </tr>';

          

           }

          
           //$total_test--;
           $total_test++;
            $html=$html.$fila;

          } //fin del bucle for 

          $html=$html.'</tbody>

                       </table>

                     </div>';

          echo $html;

      }



 

?>



<div class="container">

<div class="well"><h3>Nuevo test</h3>

 <form method="POST" class="form-inline" action="listarTest.php?operacion=alta">

   <div class="form-group">
   Tipo: <select class="form-control" name="tipo">
<?php
$tipos_test = new tiposTest(); 

$listaTipoTest = $tipos_test ->obtener_tipos_test();  

foreach($listaTipoTest as $tipo){
    echo ' <option value="'.$tipo['id'].'">'.$tipo['nombreTest'].'</option>';

    
}

?>
  </select>
  
   </div>

   <div class="form-group separacion">

   <label id="lbResultado" for="NEGATIVO">Resultado:&nbsp;&nbsp;</label>
   <input type="radio" id="POSITIVO" name="resultado" value="1">
  <label for="POSITIVO">POSITIVO</label>
  <input type="radio" id="NEGATIVO" name="resultado" value="0" >
  <label for="NEGATIVO">NEGATIVO</label>
  
   </div>
  
   <input type="hidden" name="paciente" value="<?php echo $idPaciente ?>" />

    <button id="btnGuardar" type="submit" class="btn btn-success">Guardar</button>

   
  
  

          </form>
    
        </div>

      </div>
      <div id="botones">

          <input id="btnAtras" type="button" class="btn btn-outline-dark" onclick="window.location.href='./index.php'" value="Atrás">
          <input id="btnDeshacer" type="button" class="btn btn-outline-dark" onclick="history.back()" name="deshacer" value="Deshacer">
         
      </div>
      
    </div>


  </body>

</html>