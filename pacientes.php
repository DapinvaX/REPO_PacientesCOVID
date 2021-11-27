<?php



require ("conexion.php");



class paciente{



    private $conexion;

    private $numero_pacientes = 0;



   /*function paciente()

   {

      $this->conexion = obtenerConexionBD();

     

   }*/

   public function __construct()
{
   $this->conexion = obtenerConexion();
}



function listar_pacientes(){

  
   try {
   
      $stmt = $this->conexion->prepare("SELECT id, nombre, apellidos, edad, direccion, telefono, fecha FROM pacientes");

      

       $stmt->execute();
      
       


   } catch(PDOException $e) {

   echo "Error: " . $e->getMessage();

   }

   return $stmt;



}


   function alta_paciente($nombre, $apellidos, $edad, $direccion, $telefono, $fecha){



       try {

         
         $nombre_paciente = "";
         $apellidos_paciente = "";
         $edad_paciente = "";
         $direccion_paciente = "";
         $telefono_paciente = "";
         $fecha_paciente = "";

           // preparar y vincular parámetros

           $stmt = $this->conexion->prepare("INSERT INTO pacientes (nombre, apellidos, edad, direccion, telefono, fecha ) 
                                             VALUES (:nombre, :apellidos, :edad, :direccion, :telefono, :fecha)");


            $stmt->bindParam(':nombre', $nombre_paciente);

            $stmt->bindParam(':apellidos', $apellidos_paciente);

            $stmt->bindParam(':edad', $edad_paciente);

            $stmt->bindParam(':direccion', $direccion_paciente);

            $stmt->bindParam(':telefono', $telefono_paciente);

            $stmt->bindParam(':fecha', $fecha_paciente);

       

           // establecemos los parámetros y ejecutamos para insertar

           $nombre_paciente = $nombre;
           $apellidos_paciente = $apellidos;
           $edad_paciente = $edad;
           $direccion_paciente = $direccion;
           $telefono_paciente = $telefono;
           $fecha_paciente = $fecha;



           $stmt->execute();

   

    } catch(PDOException $e) {

           echo "Error: " . $e->getMessage();

    }



   }


function obtener_paciente_por_id($id){

  
   try {
   
      $stmt = $this->conexion->prepare("SELECT id, nombre, apellidos, edad, direccion, telefono, fecha FROM pacientes WHERE id=".$id);

      

       $stmt->execute();
      
       


   } catch(PDOException $e) {

   echo "Error: " . $e->getMessage();

   }

   return $stmt;



}



function modificar_paciente($id, $nombre, $apellidos, $edad, $direccion, $telefono, $fecha){

   
   try {

      $id_paciente = "";
      $nombre_paciente = "";
      $apellidos_paciente = "";
      $edad_paciente = "";
      $direccion_paciente = "";
      $telefono_paciente = "";
      $fecha_paciente = "";

        // preparar y vincular parámetros

        $stmt = $this->conexion->prepare("UPDATE pacientes 
        SET nombre=:nombre,apellidos=:apellidos,edad=:edad,direccion=:direccion,telefono=:telefono,fecha=:fecha 
        WHERE id=:id");

         $stmt->bindParam(':id', $id_paciente);
         $stmt->bindParam(':nombre', $nombre_paciente);
         $stmt->bindParam(':apellidos', $apellidos_paciente);
         $stmt->bindParam(':edad', $edad_paciente);
         $stmt->bindParam(':direccion', $direccion_paciente);
         $stmt->bindParam(':telefono', $telefono_paciente);  
         $stmt->bindParam(':fecha', $fecha_paciente);    

        // establecemos los parámetros y ejecutamos para insertar
        $id_paciente = $id;
        $nombre_paciente = $nombre;
        $apellidos_paciente = $apellidos;
        $edad_paciente = $edad;
        $direccion_paciente = $direccion;
        $telefono_paciente = $telefono;
        $fecha_paciente = $fecha;



        $stmt->execute();



 } catch(PDOException $e) {

        echo "Error: " . $e->getMessage();

 }

   
  

}


function borrar_paciente($id){



   try {

      $id_paciente="";

       // preparar y vincular parámetros

       $stmt = $this->conexion->prepare("DELETE FROM pacientes WHERE id=:id");

       $stmt->bindParam(':id', $id_paciente);

      

       // establecemos los parámetros y ejecutamos para insertar

       $id_paciente = $id;

  

       $stmt->execute();

} catch(PDOException $e) {

       echo "Error: " . $e->getMessage();

}





  

}





}





?>
