<?php
require_once('../config.inc.php');

spl_autoload_register(function($className){
    $className = lcfirst($className);
    
    if(is_file('../class/'.$className.'.class.php')) {
        require_once('../class/'.$className.'.class.php');
    }
});

// We get the celebrities from the cageorie id
      
    $cat_id = $_POST['categoryId'];
    
    $clbrequest = new CelebrityModel();
    $listCelebrity = $clbrequest->getCelebrity($cat_id); 
    echo json_encode($listCelebrity);
    
   