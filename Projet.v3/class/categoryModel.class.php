<?php
        // list of category
class CategoryModel {
    public function getCategory(){
        $db	=	new	Database();
        return $db->sqlManyResults('
            SELECT	cat_name, cat_id
            FROM category
            ORDER BY cat_id
        ');
     
    }
}