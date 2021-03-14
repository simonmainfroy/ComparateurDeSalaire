<?php
        // list of celebrity
class CelebrityModel {
    
    public function getCelebrity($cat_id){
        $db	=	new	Database();
        return $db->sqlManyResults('
            SELECT celeb_id, celeb_name, celeb_picture, celeb_alt
            FROM celebrity
            
            WHERE cat_id = ?', [$cat_id]
        );
    }
    
    public function getOneCelebrity($celeb_id){
        $db	=	new	Database();
        return $db->sqlSingleResult('
        SELECT celeb_name, celeb_picture, celeb_salary, celeb_birthday, celeb_fortune, celeb_alt
        FROM celebrity
        WHERE celeb_id = ?', [$celeb_id]
        );
    }
}
