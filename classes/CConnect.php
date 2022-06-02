<?php
/**
 * @author Gulam Kabirulla
 * @copyright 2016
 */
?>
<?php
    session_start();
    class Connect{
        private $con;
        function __construct() {
            $this->con=new mysqli("supermarket","root","","undefined");
            $this->con->set_charset("utf-8");
        }
        function getConnection()
        {
            return $this->con;
        }
    }
?>