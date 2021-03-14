<?php
session_start();
require_once('config.inc.php');

spl_autoload_register(function($className){
    $className = lcfirst($className); 
    
    if(is_file('class/'.$className.'.class.php')) {
        require_once('class/'.$className.'.class.php');
    }
});

if(array_key_exists("erreur", $_SESSION)){
    $testSession = 1;
    var_dump('$testSession');
}
else{
    // Looking for all the category in our bdd
    $listCategories = new CategoryModel();
    $listCategory = $listCategories->getCategory(); 

include 'html/index.html';
}