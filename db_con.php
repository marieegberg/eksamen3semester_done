<?php 
session_start();

const HOSTNAME = 'localhost'; // server navn
const MYSQLUSER = 'root'; // super bruger (remote har man særskilte database brugere)
const MYSQLPASS = 'root'; // bruger password
const MYSQLDB = '3semester_eksamen'; // database navn 


$con = new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);

$con->set_charset('utf-8');


if($con->connect_error){ 
	die($con->connect_error);
}

?>