<?php



require_once ("conexion.php");



class tiposTest{



   //private $cnx = "";



   function tiposTest()

   {

      $this->cnx = obtenerConexion();

     

   }




function obtener_tipos_test(){

   try {

      $cnx = obtenerConexion();

      // Establecemos el modo de error de PDO para que salten excepciones

      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $cnx->prepare("SELECT id, nombreTest FROM tipos_test");

     

      $stmt->execute();



  } catch(PDOException $e) {

  echo "Error: " . $e->getMessage();

  }

  return $stmt;

   /*
   try {
      
      $stmt = $cnx->prepare("SELECT id, nombreTest FROM tipos_test");
      //$stmt = $this->cnx->prepare("SELECT id, nombreTest FROM tipos_test");
       
       $stmt->execute();      

   } catch(PDOException $e) {

   echo "Error: " . $e->getMessage();

   }

   return $stmt;

   */
}











}





?>