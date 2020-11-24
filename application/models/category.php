<?php 

    class Category extends Model{
       // private $db;

//        public function __construct(){
//            $this = new Database();
//        }

        public function getAllCat($active=''){
            if($active==''){
                $sql = "";
            }else {
                $sql = "WHERE categories.active=$active";
            }
            $this->query("SELECT categories.*, users.full_name as
            creator  FROM categories INNER JOIN users ON 
            categories.cat_user = users.user_id $sql");
            $categories = $this->resultSet();
            if($categories){
                return $categories;
            }else {
                return false;
            }
        }

        public function search($searched){
            $this->query("SELECT categories.*, users.full_name as
            creator  FROM categories INNER JOIN users ON 
            categories.cat_user = users.user_id WHERE cat_name LIKE
            '%$searched%'");
            // $this->bind(':searched',$searched);
            $results = $this->resultSet();
            if($results){
                return $results;
            }else {
                return false;
            }
        }

        public function add($cat_name,$cat_user,$description){
            $this->query("INSERT INTO 
            categories (cat_name,cat_user,active,description)
            VALUES (:cat_name,:cat_user,0,:description)");
            $this->bind(':cat_name',$cat_name);
            $this->bind(':cat_user',$cat_user);
            $this->bind(':description',$description);
            $this->execute();
        }

        public function update($id,$name,$description){
            $this->query("UPDATE categories SET cat_name=:cat_name
            ,description=:description WHERE cat_id=:cat_id");
            $this->bind(':cat_name',$name);
            $this->bind(':description',$description);
            $this->bind(':cat_id',$id);
            $this->execute();
        }

        public function show($id){
            $this->query("SELECT categories.*, users.full_name as
            creator  FROM categories INNER JOIN users ON 
            categories.cat_user = users.user_id WHERE cat_id=:cat_id");
            $this->bind(':cat_id',$id);
            $category = $this->single();
            return $category;
        }

        

        public function findCatName($cat_name,$cat_id = ''){
            $this->query("SELECT cat_id FROM categories 
            WHERE cat_name =:cat_name AND cat_id != :cat_id");
            $this->bind(':cat_name',$cat_name);
            $this->bind(':cat_id',$cat_id);
            $this->execute();
            return $this->rowCount();
        }

        public function delete($id){
            $this->query("DELETE FROM categories WHERE cat_id=:id");
            $this->bind(':id',$id);
            return $this->execute();
        }

        public function activate($id){
            $this->query("UPDATE categories SET active  = 1 WHERE cat_id=:id");
            $this->bind(':id',$id);
            return $this->execute();
        }

        public function inActivate($id){
            $this->query("UPDATE categories SET active  = 0 WHERE cat_id=:id");
            $this->bind(':id',$id);
            return $this->execute();
        }


    }