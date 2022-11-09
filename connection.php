<?php
    function connect(){ 
        $sql = new mysqli('localhost','root','','diary');
        return $sql;
    }
?>