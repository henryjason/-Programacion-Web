
<?php


/*LOGIN*/

// crea la variable conexion y llama al metodo encargado de realizar la conexion
$conexion = conectarBD($argv[1]);





require_once 'funciones_bd.php';
$db = new funciones_BD($argv[1]);

 

$db->Consult_test($conexion);  


  

// metodo conectar a base de datos, recibe por parametro la ruta del archivo de configuracion.
function conectarBD($ruta)  {     

$cadena_config = file_get_contents($ruta); // obtenemos la cadena json en formato string
$json_a=json_decode($cadena_config,true);  // decodificamos al formato json 


// obenemos la configuracion de la base de datos desde la cadena json
$DB_HOST =  $json_a['ConfigDatabase']['DB_HOST'];
$DB_USER =  $json_a['ConfigDatabase']['DB_USER'];
$DB_PASSWORD = $json_a['ConfigDatabase']['DB_PASSWORD'];
$DB_DATABASE =  $json_a['ConfigDatabase']['DB_DATABASE'];

// requerido para conectar ala base de datos
  require_once 'connectbd.php';
$pConexion;
        // connecting to database

$Con = new DB_Connect();
$pConexion = $Con->connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);

// return el objeto de conexion.
return $pConexion;

}





 function  pruebaJson($ruta){


$string = file_get_contents($ruta);
$json_a=json_decode($string,true);

echo  $json_a['ConfigDatabase']['DB_HOST'];
echo  $json_a['ConfigDatabase']['DB_USER'];
echo  $json_a['ConfigDatabase']['DB_PASSWORD'];
echo  $json_a['ConfigDatabase']['DB_DATABASE'];

}   
 

?>
