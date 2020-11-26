<?php 

    class Admin extends Model{
//        private $db;
//
//        public function __construct(){
//            $this->db = new Database();
//        }

        public function login($email,$password){
            $this->query("SELECT * FROM users WHERE email =:email AND admin = 1");
            $this->bind(':email',$email);
            $user = $this->single();
            if($user){
                $hashedPassword = $user->password;
                if(password_verify($password,$hashedPassword)){
                    return $user;
                }else{
                    return false;
                }
            }
        }
        

        public function findUserByEmail($email){
            $this->query("SELECT * FROM users WHERE email =:email");
            $this->bind(':email',$email);
            $this->execute();
            if($this->rowCount() > 0){
                return true;
            }else{
                return false;
            };
        }

        
    }