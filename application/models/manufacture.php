<?php 

    class Manufacture extends Model{
     

//        public function __construct(){
//            $this = new Database();
//        }

        public function getAllMan($active=''){
            if($active==''){
                $sql = "";
            }else {
                $sql = "WHERE manufactures.active=$active";
            }
            $this->query("SELECT manufactures.*, users.full_name as
            creator  FROM manufactures INNER JOIN users ON 
            manufactures.man_user = users.user_id $sql");
            $manufactures = $this->resultSet();
           if($manufactures){
               return $manufactures;
           }else {
               return false;
           }
        }


        public function search($searched){
            $this->query("SELECT manufactures.*, users.full_name as
            creator  FROM manufactures INNER JOIN users ON 
            manufactures.man_user = users.user_id WHERE man_name LIKE
            '%$searched%'");
            // $this->bind(':searched',$searched);
            $results = $this->resultSet();
            if($results){
                return $results;
            }else {
                return false;
            }
        }



        public function add($man_name,$man_user,$description){
            $this->query("INSERT INTO 
            manufactures (man_name,man_user,active,description)
            VALUES (:man_name,:man_user,0,:description)");
            $this->bind(':man_name',$man_name);
            $this->bind(':man_user',$man_user);
            $this->bind(':description',$description);
            $this->execute();
        }

        public function update($id,$name,$description){
            $this->query("UPDATE manufactures SET man_name=:man_name
            ,description=:description WHERE man_id=:man_id");
            $this->bind(':man_name',$name);
            $this->bind(':description',$description);
            $this->bind(':man_id',$id);
            $this->execute();
        }

        public function show($id){
            $this->query("SELECT manufactures.*, users.full_name as
            creator  FROM manufactures INNER JOIN users ON 
            manufactures.man_user = users.user_id WHERE man_id=:man_id");
            $this->bind(':man_id',$id);
            $manufacture = $this->single();
            return $manufacture;
        }

        

        public function findManName($man_name,$man_id = ''){
            $this->query("SELECT man_id FROM manufactures 
            WHERE man_name =:man_name AND man_id != :man_id");
            $this->bind(':man_name',$man_name);
            $this->bind(':man_id',$man_id);
            $this->execute();
            return $this->rowCount();
        }

        public function delete($id){
            $this->query("DELETE FROM manufactures WHERE man_id=:id");
            $this->bind(':id',$id);
            return $this->execute();
        }

        public function activate($id){
            $this->query("UPDATE manufactures SET active  = 1 WHERE man_id=:id");
            $this->bind(':id',$id);
            return $this->execute();
        }

        public function inActivate($id){
            $this->query("UPDATE manufactures SET active  = 0 WHERE man_id=:id");
            $this->bind(':id',$id);
            return $this->execute();
        }


    }