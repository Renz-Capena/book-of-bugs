<?php
    function connect(){ 
        $sql = new mysql('localhost','root','','diary');
        return $sql;
    }
?>