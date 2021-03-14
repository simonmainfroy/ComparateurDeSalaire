<?php
require_once('../config.inc.php');

spl_autoload_register(function($className){
    $className = lcfirst($className);
    
    if(is_file('../class/'.$className.'.class.php')) {
        require_once('../class/'.$className.'.class.php');
    }
});

    if(array_key_exists("celeb", $_POST)
    && array_key_exists("userSalary", $_POST)
    ){
        $celeb_id = $_POST['celeb']; // : Id Celeb to ask BDD :
        $clbrequest = new CelebrityModel();
        $celebInfo = $clbrequest->getOneCelebrity($celeb_id);
        
        //User Salary and Celeb Salary /Year
        $userSalary = $_POST['userSalary'];
        $celebSalary = $celebInfo['celeb_salary'];
        
        // Celeb info
        $celebFortune = $celebInfo['celeb_fortune'];
        $celebName = $celebInfo['celeb_name'];
        $celebPicture = $celebInfo['celeb_picture'];
        $celebAlt = $celebInfo['celeb_alt'];
        
        $getCelebPicture = "../img/".$celebPicture;
        
        // Const to calc salary h/m/s
        $calculSalaryHour = 12410;
        $calculSalaryMinute = 525600;
        $calculSalarySecond = 31536000;
        
        // Celeb Salary h/m/s
        $celebSalaryHour = round($celebSalary/$calculSalaryHour);
        $celebSalaryMinute = round($celebSalary/$calculSalaryMinute);
        $celebSalarySecond = round(($celebSalary/$calculSalarySecond),2);
        
        // User Salary h/m/s
        $userSalaryHour = round($userSalary/$calculSalaryHour);
        $userSalaryMinute = round(($userSalary/$calculSalaryMinute),2);
        $userSalarySecond = round(($userSalary/$calculSalarySecond),4);
        
        
        
        // Minute Celeb -> Salary User
        $minutesNeededCeleb = ceil($userSalary / $celebSalaryMinute);
        
        // € / Video
        $videoCeleb = $celebSalaryMinute * 2;
        $videoUser = $userSalaryMinute * 2;
        
        
        // Salary / km / earth
        $celebSalaryKm = ceil($celebSalary/1000/40000);
        $userSalaryKm = ceil($userSalary/1000);
        // Function pick destination for user
          
        function pickDestination (){
            $userSalary = $_POST['userSalary'];
            $userSalaryKm = ceil($userSalary/1000);
            $userKmDescription;
            
            if ($userSalaryKm <= 15) {
                $userKmDescription = "Lyon - Saint Priest";
                return $userKmDescription;
            }
            else if($userSalaryKm <= 35) {
                $userKmDescription = "allez - retour de Lyon jusqu'au lac de Miribel";
                return $userKmDescription;
            }
            else if($userSalaryKm <= 60) {
                $userKmDescription = "Lyon - Saint Etienne";
                return $userKmDescription;
            }
            else if($userSalaryKm <= 100) {
                $userKmDescription = "Lyon - Annecy";
                return $userKmDescription;
            }
            else if($userSalaryKm <= 150) {
                $userKmDescription = "Lyon - Clermont-Ferrand";
                return $userKmDescription;
            }
            else if($userSalaryKm <= 200) {
                $userKmDescription = "Lyon - Nîmes";
                return $userKmDescription;
            }
            else if($userSalaryKm <= 300) {
                $userKmDescription = "Lyon - Marseille";
                return $userKmDescription;
            }
            else if($userSalaryKm <= 450) {
                $userKmDescription = "Lyon - Paris";
                return $userKmDescription;
            }
            else {
                $userKmDescription = "erreur";
                return $userKmDescription;
            }
                
        }
        $runDestination = pickDestination();
        $calculYearNeededFortune = ceil($celebFortune / $userSalary );
        $calculMultiplicationSalary = round($celebSalary / $userSalary);
        
        // user life salary -> 50 ans / -> time for celeb
        $userLifeSalary = $userSalary * 50;
        $calculHourCelebULS = round(($userLifeSalary / $celebSalaryHour),2); 
           
        include '../html/traitement.html';
    }
    else {
       
        header('Location:../index.php');
    }