<?php

class dataase
{
    /**********MYSQL PARAMETERS**********/
    protected $mySQL;
    protected $msSQL;
    private $myHostname = "localhost";
    private $myDbname = "procurementsforgrants";
    private $myUsername = "grantsadmin";
    private $myPWD = "kMzAyYzNmM";
    /************************************/

    function __construct(){
        try{
            error_reporting(-1);
            error_reporting(E_ALL);
            $this->mySQL = mssql_connect("192.168.253.10\dbtsu,51093","it","ictsu123")or die("kavshiri araa bzt");
            mssql_select_db("dbtsu",$this->mySQL) or die("kavshiri araa 2");
        }catch (Exception $e){
            dei(print_r($e->getMessage()));
        }
        /***************MYSQL CONNECT****************/
        try {
            $opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'", PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $this->mySQL =new PDO ("mysql:host=".$this->myHostname.";dbname=".$this->myDbname.";", $this->myUsername, $this->myPWD,$opt);
            $this->mySQL->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (Exception $myE) {
            die( print_r( $myE->getMessage() ) );
        }
        /********************************************/
    }

}