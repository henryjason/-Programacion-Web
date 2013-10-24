<?php
 
class funciones_BD {
 
    private $config;
 
    // constructor

    function __construct($pConfig) {

        $cadena_config = file_get_contents($pConfig); // obtenemos la cadena json en formato string
        $this->config =json_decode($cadena_config,true);  // decodificamos al formato json 
     
    }
 
    // destructor
    function __destruct() {
 
    }
 
    /**
     * agregar nuevo usuario
     */
   




public function Consult_test($conexion) {

$cont = 0;

echo "+++++++++++++++++++++++++++++++++++++++++++++++ \n";
echo "+Consultando test para el: " . date("d-m-Y h:i:s" . "+\n");
echo "+++++++++++++++++++++++++++++++++++++++++++++++ \n \n";
   


$result = mysql_query("SELECT  `id` ,  `group_id` ,  `description` ,  `application_date` ,  `status` ,  `term_in_minutes` ,  `percent` ,  `comments` 
FROM  `test` 
WHERE TIMESTAMPDIFF( MINUTE , SYSDATE( ) ,  `application_date` ) <=0
AND  `status` = 1
LIMIT 0 , 30");

 if ($result) {


        // check for successful store

 while ($row = mysql_fetch_row($result)){ 

    $cont = $cont + 1;

echo "Resultado Test N: " . $cont . "\n \n";

$array = array();

$array['Id'] = ("$row[0]");
$array['group_id'] = ("$row[1]");
$array['description'] = ("$row[2]");
$array['application_date'] = ("$row[3]");
$array['status'] = ("$row[4]");
$array['term_in_minutes'] = ("$row[5]");
$array['percent'] = ("$row[6]");   
$array['comments'] = ("$row[7]");  

print_r($array); 

$this->GetStudent($row[1]);

    }


    } else {

            echo "Error al ejecutar consulta \n";
        }
}


public function GetStudent($id_group){

 $cont = 0;


$array_student = array();
require_once 'student.php';


$result = mysql_query("SELECT g.id AS id_grupo, g.professor_id, p.email AS email_profesor, r.id AS id_register, s.id, s.first_name, s.last_name, s.email AS email_student
FROM  `group` g,  `registration` r,  `student` s,  `professor` p
WHERE g.`id` = '$id_group'
AND r.`group_id` = '$id_group'
AND s.`id` = r.`id` 
AND P.`id` = g.`professor_id` 
LIMIT 0 , 30");

 if ($result) {


        // Informacion solo para mostrar x consola.

 while ($row = mysql_fetch_row($result)){ 

//creo la instancia de la class student
$student = new student("$row[0]", "$row[1]", "$row[2]", "$row[3]", "$row[4]", "$row[5]", "$row[6]", "$row[7]");
//agrego el objeto creado al array
$array_student[] = $student;


$cont = $cont + 1;

echo "Resultado student N: " . $cont . "\n \n";

$array = array();

$array['Id Group'] = ("$row[0]");
$array['Id profesor'] = ("$row[1]");
$array['email profesor'] = ("$row[2]");
$array['Id register'] = ("$row[3]");
$array['Id student'] = ("$row[4]");
$array['first_name'] = ("$row[5]");
$array['last_name'] = ("$row[6]");
$array['email student'] = ("$row[7]");   

print_r($array); 

    }


    } else {

            echo "Error al ejecutar consulta \n";
        }

$this->EnviarCorreo($array_student);

}



/*

public function GetGroup($id_group){

    $cont = 0;

$result = mysql_query("SELECT  `id` ,  `course_id` ,  `quarter` ,  `professor_id` ,  `group_number` ,  `created_at` ,  `enabled` 
FROM  `group` 
WHERE `id` = '$id_group'
LIMIT 0 , 30");

 if ($result) {


        // check for successful store

 while ($row = mysql_fetch_row($result)){ 

$cont = $cont + 1;

echo "Resultado Group N: " . $cont . "\n \n";

$array = array();

$array['Id Group'] = ("$row[0]");
$array['course_id'] = ("$row[1]");
$array['quarter'] = ("$row[2]");
$array['professor_id'] = ("$row[3]");
$array['group_number'] = ("$row[4]");
$array['created_at'] = ("$row[5]");
$array['enabled'] = ("$row[6]");   

print_r($array); 

$this->GetRegistrate($row[0]);

    }


    } else {

            echo "Error al ejecutar consulta \n";
        }


}



public function GetRegistrate($id_group){

    $cont = 0;

$result = mysql_query("SELECT `id`, `student_id` FROM `registration` WHERE `group_id` = '$id_group' LIMIT 0 , 30");

 if ($result) {


        // check for successful store

 while ($row = mysql_fetch_row($result)){ 

      $cont = $cont + 1;

       echo "Resultado Student registrados N: " . $cont . "\n \n";

 $result2 = mysql_query("SELECT `id`, `first_name`, `username`, `last_name`, `document_number`, `password`, `is_admin`, `email`, `created_at`, `updated_at` FROM `student` WHERE `id` = '$row[1]' LIMIT 0 , 30");

      $row2 = mysql_fetch_row($result2);

$array = array();

$array['id'] = ("$row2[0]");
$array['first_name'] = ("$row2[1]");
$array['username'] = ("$row2[2]");
$array['last_name'] = ("$row2[3]");
$array['document_number'] = ("$row2[4]");
$array['is_admin'] = ("$row2[6]");
$array['email'] = ("$row2[7]");
$array['created_at'] = ("$row2[8]");

print_r($array); 



    }


    } else {

            echo "Error al ejecutar consulta \n";
        }


}

*/
 
function EnviarCorreo($lista_student){

$cont = 0;

require_once("PHPMailer_v5.1/class.phpmailer.php");
//require('PHPMailer_v5.1/class.smtp.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Host = $this->config['ConfigEmail']['email_smtp_host']; // SMTP a utilizar. Por ej. smtp.elserver.com
$mail->Username = $this->config['ConfigEmail']['email_smtp_user']; // Correo completo a utilizar
$mail->Password = $this->config['ConfigEmail']['email_smtp_pass']; // Contraseña
$mail->Port = $this->config['ConfigEmail']['email_smtp_port']; // Puerto a utilizar


$mail->From = $this->config['Correo']['email_from']; // Desde donde enviamos (Para mostrar)
$mail->FromName = $this->config['Correo']['email_from_name'];

foreach ($lista_student as $obj_student) {

//$cont = $cont + 1;

$mail->AddAddress($obj_student->Getemail_student(), $obj_student->Getfirst_name()); // Esta es la dirección a donde enviamos



//if($this->config['ConfigEmail']['email_batch_limit']  == $cont){

//}// $this->config['ConfigEmail']['email_batch_limit']  == $cont

}//forech



$mail->IsHTML(true); // El correo se envía como HTML
$mail->Subject = "Curriculum Vitaee"; // Este es el titulo del email.
$body = "Hola mundo. Esta es la primer línea<br />";
$body .= "Acá continuo el <strong>mensaje</strong>";
$mail->Body = $body; // Mensaje a enviar
//$mail->AltBody = "Hola mundo. Esta es la primer línean Acá continuo el mensaje"; // Texto sin html
//$mail->AddAttachment("search_user.png", "search_user.png");
$exito = $mail->Send(); // Envía el correo.

if($exito){
echo "El correo fue enviado correctamente";
}else{
echo "Hubo un inconveniente. Contacta a un administrador";

}


} // end function


  
}
 
?>
