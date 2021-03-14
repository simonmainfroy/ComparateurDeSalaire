$(function() { 
    // Timer/s for salary :
           
		var intervalID ;	
		var timeSeconde = 0; 
		var celebSalarySecond = $('h2').data('celeb');
        var userSalarySecond = $('h2').data('user');
		
		function setTimer() {
		    intervalID = window.setInterval(countSecond, 1000);
		}    
        
        function countSecond (){
            var countCelebSalarySecond;
            var countUserSalarySecond;
            
            timeSeconde= timeSeconde + 1;
            countCelebSalarySecond = Math.round(celebSalarySecond * timeSeconde);
            countUserSalarySecond = Math.round((userSalarySecond * timeSeconde)*100)/100;
            $('span#showTimerCeleb').remove();
            $('span#showTimerUser').remove();
            $('span#showTimerSecond').remove();
            
            $('span#timerCeleb').append('<span id="showTimerCeleb">'+ countCelebSalarySecond +' €</span>'); // Celeb € /s
            $('span#timerUser').append('<span id="showTimerUser">'+ countUserSalarySecond +' €</span>'); // User € /s
            $('span#timerSecond').append('<span id="showTimerSecond">'+ timeSeconde +' secondes </span>');  // Time s
            
            return timeSeconde;   
        } 
        
        setTimer();
}); 