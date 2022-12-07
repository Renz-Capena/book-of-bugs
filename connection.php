<?php
    function connect(){ 
        $sql = new mysqli('localhost','root','','bugs');
        return $sql;
    }
?>