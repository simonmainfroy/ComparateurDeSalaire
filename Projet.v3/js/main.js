$(function() { 
    
    var celebId;
    var dataIdCategorie=0;
    var boutonSubmit = $('#button_choice');
    
    // Function list of celebrity/category
    $('button.button_category').click(function() {
   
        var  idCategory = $(this).data('id');
            //Send the category id to get the celeb list
        $.ajax({
              method: "POST",
              url: "php/celebrity.php",
              data: { categoryId: idCategory }, 
              dataType: 'JSON'
        })
        .done(function(listCelebrity){
                    
                    //delete the previous list
                $('div.showCelebrity').remove();
                
                    //Create the new list
                for(var i=0; i<listCelebrity.length; i++){ 
                    
                        $('#list_celebrity').append("<div class='showCelebrity' > <h3>"+  listCelebrity[i].celeb_name + "</h3> <input type='radio' value='"+listCelebrity[i].celeb_id+"' id='"+listCelebrity[i].celeb_id +"' name='celeb' class='checkboxCSS' data-id=\""+listCelebrity[i].celeb_id +
                        "\" required ><label for ='"+listCelebrity[i].celeb_id +"'<div><img src='img/"+listCelebrity[i].celeb_picture+"' alt='"+listCelebrity[i].celeb_alt +"' class='pictureCeleb'></div></label></div>");
                }
        });
    });
    
    $('.button_categorie').click(function() {
        dataIdCategorie = $(this).data('id');
        return dataIdCategorie;
    });

	$('#button_choice').click(function(e) {
  
       if (!verifForm()) { // if false = error form
            e.preventDefault(); // event(submit) desactivate
       }
    });    
            
   function verifForm (){
        var erreurSalary = 0;
        var highSalary = 0;
        var erreurCeleb = 0;
        
        if($('input[name=celeb]').is(':checked') == false) {
            erreurCeleb++;
        }
        
        $('input[required]').each(function() {
            var valeurSalary = $(this).val();
            if(valeurSalary == ''){
                erreurSalary++;    
            }
            else if(valeurSalary > 1500000){
                highSalary++;    
            }
        });
        if(erreurCeleb > 0 ) {
            $('.removeAlert').remove();
            $('#alertJS').append("<p class='removeAlert'> Veuillez indiquer votre célébrité </p>");
            return false;
        }
        else if(erreurSalary > 0) {
            $('.removeAlert').remove();
            $('#alertJS').append("<p class='removeAlert'> Veuillez indiquer votre salaire annuel </p>");
            return false;
        }
        else if(highSalary > 0){
            $('.removeAlert').remove();
            $('#alertJS').append("<p class='removeAlert'> Il y a un zéro de trop ? </p>");
            return false;
        }
        else if (dataIdCategorie = 0){
            $('.removeAlert').remove();
            $('#alertJS').append("<p class='removeAlert'> Veuillez cliquer sur une catégorie pour choisir une célébrité </p>");
            return false;
        }
        else {
            return true; // if true form submit
        }
    } 

}); 