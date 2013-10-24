<?php

class student {
 
private $id_group;
private $id_profesor;
private $email_profesor;
private $id_register;
private $id_student;
private $first_name;
private $last_name;
private $email_student;   


 function __construct($pid_group, $pid_profesor, $pemail_profesor, $pid_register, $pid_student, $pfirst_name, $plast_name, $pemail_student) {

        $this->id_group = $pid_group;
        $this->id_profesor = $pid_profesor;
        $this->email_profesor= $pemail_profesor;
        $this->id_register = $pid_register;
        $this->id_student = $pid_student ;
        $this->first_name = $pfirst_name;
        $this->last_name = $plast_name;
        $this->email_student = $pemail_student;  
     
    }


    public function Getid_group(){

    	return $this->id_group;
    }

    public function Getid_profesor(){

    	return $this->id_profesor;
    }

    public function Getemail_profesor(){

    	return $this->email_profesor;
    }


    public function Getid_register(){

    	return $this->id_register;
    }

    public function Getid_student(){

    	return   $this->id_student;
    }

    public function Getfirst_name(){

    	return $this->first_name;
    }

    public function Getlast_name(){

    	return $this->last_name;
    }

    public function Getemail_student(){

    	return $this->email_student;
    }


    




    




}   
 

?>