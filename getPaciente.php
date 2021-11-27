<?php 

require ("pacientes.php");
$paciente = new paciente();


   if(isset($_GET["id"])){
    $idPaciente = $_GET["id"];
    
   }

   $resultado = $paciente->obtener_paciente_por_id($idPaciente);

   $html = "";
   foreach($resultado as $datosPaciente){
       // $html .= $datosPaciente['nombre']." - ".$datosPaciente['apellidos']." - ".$datosPaciente['edad']." - ".$datosPaciente['direccion']." - ".$datosPaciente['telefono']." - ".$datosPaciente['fecha'];
        $html .= 
        "<table class='table table-striped table-inverse table-responsive'>
            <thead class='thead-inverse'>
                <tr>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>EDAD</th>
                    <th>DIRECCION</th>
                    <th>TELEFONO</th>
                    <th>FECHA</th>
                </tr>
                </thead>
                <tbody >
                    <tr>
                        <td scope='row'>
                        ".$datosPaciente['nombre']."
                        </td>
                        <td>
                        ".$datosPaciente['apellidos']."
                        </td>
                        <td>
                        ".$datosPaciente['edad']."
                        </td>
                        <td>
                        ".$datosPaciente['direccion']."
                        </td>
                        <td>
                        ".$datosPaciente['telefono']."
                        </td>
                        <td>
                        ".$datosPaciente['fecha']."
                        </td>
                    </tr>
            </tbody>
    </table>";
   }

   //echo "EXISTE EL PACIENTE CON id:".$idPaciente;
   echo $html;

?>