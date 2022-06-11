<?php 
session_start(); 


foreach ($_SESSION['InputData'] as $key => $value) {
    
    echo $key . ' : ' . $value  .$btn_del="<input type='button' value='delete'>" .'<br>';
    
    function data_delete(){
        unset($_SESSION['InputData']);
    }
}
