<?php

//Codigo de pacientes

require ("conexion.php");



class test{



    private $conexion;

    private $num_tests = 0;



   
   public function __construct()
{
   $this->conexion = obtenerConexion();
}




   function añadir_test( $tipo_test, $resultado, $id_paciente){



       try {

  
         $param_tipo_test = "";
         $param_resultado = "";
         $param_id_paciente ="";

           // Preparar y vincular parámetros

           $stmt = $this->conexion->prepare("INSERT INTO tests ( tipo_test, resultado, id_paciente  ) 
                                             VALUES (:tipo_test, :resultado, :id_paciente)");

           
            $stmt->bindParam(':tipo_test', $param_tipo_test);
            $stmt->bindParam(':resultado', $param_resultado);
            $stmt->bindParam(':id_paciente', $param_id_paciente);

            

       

           // Establecemos los parámetros y ejecutamos para insertar
    
           $param_tipo_test = $tipo_test;
           $param_resultado = $resultado;
           $param_id_paciente = $id_paciente;



           $stmt->execute();

   

    } catch(PDOException $e) {

           echo "Error: " . $e->getMessage();

    }



   }



function listar_tests(){

  
   try {
   
      $stmt = $this->conexion->prepare("SELECT id, tipo_test, resultado, id_paciente FROM tests");

      

       $stmt->execute();
      
       


   } catch(PDOException $e) {

   echo "Error: " . $e->getMessage();

   }

   return $stmt;



}

function listar_tests_paciente($id_paciente){

  
   try {
   
      $stmt = $this->conexion->prepare("SELECT id, tipo_test, resultado,id_paciente FROM tests WHERE id_paciente=".$id_paciente);


       $stmt->execute();
      
       


   } catch(PDOException $e) {

   echo "Error: " . $e->getMessage();

   }

   return $stmt;



}



function modificar_test($id, $tipo_test, $resultado){

   
   try {

    $id = "";
    $tipo_test = "";
    $resultado = "";

        // preparar y vincular parámetros

        $stmt = $this->conexion->prepare("UPDATE tests 
        SET tipo_test=:tipo_test, resultado=:resultado WHERE id=:id");

         $stmt->bindParam(':id', $id);
         $stmt->bindParam(':tipo_test', $tipo_test);
         $stmt->bindParam(':resultado', $resultado); 

        // establecemos los parámetros y ejecutamos para insertar
        $id=$id;
        $tipo_test = $tipo_test;
        $resultado = $resultado;



        $stmt->execute();



 } catch(PDOException $e) {

        echo "Error: " . $e->getMessage();

 }

   
  

}


function borrar_test($id){



   try {

      $id="";

       // preparar y vincular parámetros

       $stmt = $this->conexion->prepare("DELETE FROM tests WHERE id=:id");

       $stmt->bindParam(':id', $id);

       // Establecemos los parámetros y ejecutamos para insertar
       $id = $id;

  

       $stmt->execute();

} catch(PDOException $e) {

       echo "Error: " . $e->getMessage();

            }
        }

    }

/*
require_once ("conexion.php");



class test{



   private $conexion = "";

   public $numero_test = 0;



   function test()

   {

      $this->conexion = obtenerConexion();

   

   }


   
   function alta_test($tipo_test,$resultado,$id_paciente){



       try {

         

           // preparar y vincular parámetros

           $stmt = $this->conexion->prepare("INSERT INTO tests (tipo_test, resultado,id_paciente ) VALUES (:tipo_test, :resultado, :id_paciente)");

            $stmt->bindParam(':tipo_test', $tipo_test);

            $stmt->bindParam(':resultado', $resultado);

            $stmt->bindParam(':id_paciente', $id_paciente);

       

           // establecemos los parámetros y ejecutamos para insertar

           $tipo_test = $tipo_test;

           $resultado = $resultado;

           $id_paciente = $id_paciente;



           $stmt->execute();

   

    } catch(PDOException $e) {

           echo "Error: " . $e->getMessage();

    }



   }



function listar_test_por_paciente($id_paciente){

   try {

       $stmt = $this->conexion->prepare("SELECT t.id, tt.nombre, test, tipo, resultado, id_paciente FROM test t INNER JOIN tipos_test tt ON t.tipo = tt.id WHERE id_paciente=:id ORDER BY id ASC" ) ;
       $stmt->bindParam(':id', $id_paciente);

       // establecemos los parámetros y ejecutamos para insertar
       $id_paciente = $id_paciente;
       $stmt->execute();      

   } catch(PDOException $e) {

   echo "Error: " . $e->getMessage();

   }

   return $stmt;
}



function modificar_test($id,$tipo_test,$resultado){


try {

      
       $sql = "UPDATE test set tipo_test = '".$tipo_test."', resultado ='".$resultado."' WHERE id = ".$id;
       $stmt = $this->conexion->prepare($sql);

      

       $stmt->execute();



   } catch(PDOException $e) {

   echo "Error: " . $e->getMessage();

   }

   return $stmt;
  

}





function borrar_test($id){



   try {

         

       // preparar y vincular parámetros

       $stmt = $this->conexion->prepare("DELETE FROM test WHERE id=:id");

       $stmt->bindParam(':id', $id);

      

       // establecemos los parámetros y ejecutamos para insertar

       $id = $id;

  

       $stmt->execute();

} catch(PDOException $e) {

       echo "Error: " . $e->getMessage();

}





  

}





}


*/


?>