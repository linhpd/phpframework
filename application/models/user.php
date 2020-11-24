<?php 

    class User extends Model{
        private $db;

//        public function __construct(){
//            $this = new Database();
//        }

        public function register($fullname, $email,$img, $hashedPassword,$vkey){
           
            $this->query(
                    "INSERT INTO users (full_name,email,image,password,verified,vkey,admin,active)
                    VALUES (:full_name,:email,:image,:password,0,:vkey,0,0)
                    ");

            $this->bind(':full_name',$fullname);
            $this->bind(':email',$email);
            $this->bind(':image',$img);
            $this->bind(':password',$hashedPassword);
            $this->bind(':vkey',$vkey);
            $this->execute();
        }

        public function login($email,$password){
            $this->query("SELECT * FROM users WHERE email =:email");
            $this->bind(':email',$email);
            $user = $this->single();
            
            $hashedPassword = $user->password;
            if(password_verify($password,$hashedPassword)){
                return $user;
            }else{
                return false;
            }
        }

        public function show($id){
            $this->query("SELECT * FROM users WHERE user_id=:user_id");
            $this->bind(':user_id',$id);
            $user = $this->single();
            return $user;
        }

        public function update($id,$name,$email,$password){
            $this->query("UPDATE users SET full_name=:full_name
            ,email=:email,password=:password WHERE user_id=:user_id");
            $this->bind(':full_name',$name);
            $this->bind(':email',$email);
            $this->bind(':password',$password);
            $this->bind(':user_id',$id);
            $this->execute();
        }
        

        public function notVerified($email){
            $this->query("SELECT * FROM users WHERE email =:email");
            $this->bind(':email',$email);
            $row = $this->single();
            $verified = $row->verified;
            if($verified == 0){
                return true;
            }else {
                return false;
            }
        }

        public function findUserByEmail($email,$id=''){
            $this->query("SELECT * FROM users WHERE 
            email =:email AND user_id != :user_id");
            $this->bind(':email',$email);
            $this->bind(':user_id',$id);
            $this->execute();
            if($this->rowCount() > 0){
                return true;
            }else{
                return false;
            };
        }

        public function forgotP($email,$vkey){
            $this->query("SELECT `user_id` FROM `users` WHERE `email` = :email");
            $this->bind(':email', $email);
            $this->execute();
            $row = $this->rowCount();
            if($row != 0 ){
                
                $this->query("UPDATE users SET vkey = :vkey , 
                token_expire = DATE_ADD(NOW(), INTERVAL 60 MINUTE)
                WHERE email=:email");
                $this->bind(':email', $email);
                $this->bind(':vkey', $vkey);
                if($this->execute()){
                    return true;
                }else {
                    return false;
                }
            }
        }
        
        public function resetP($vkey,$password){
            
            $this->query("SELECT user_id FROM users WHERE 
            vkey =:vkey AND token_expire > NOW()");
            $this->bind(':vkey',$vkey);
            $this->execute();
            $row = $this->rowCount();
            if($row > 0){
                $this->query("UPDATE users SET password =:password
                WHERE vkey=:vkey");
                $this->bind(':vkey',$vkey);
                $this->bind(':password',$password);
                if($this->execute()){
                    return true;
                }else {
                    return false;
                };
                }else{
                return false;
            } 
        }
       
 

        public function selectVkey($email,$vkey){
            $this->query("SELECT * FROM users WHERE vkey=:vkey AND email=:email");
            $this->bind(':vkey',$vkey);
            $this->bind(':email',$email);
            $userData = $this->single();
            $user = $this->rowCount();
            if ($user > 0) {
                $this->query("UPDATE users SET verified = 1 WHERE vkey=:vkey AND email=:email");
                $this->bind(':vkey',$vkey);
                $this->bind(':email',$email);
                $user1 =  $this->execute();
                if($user1){
                    return $userData;
                }else {
                    return false;
                }
            } else {
            return false;
            }
            
            
        }

        public function userData($name,$user_id){
            $this->query("SELECT * FROM users WHERE user_id=:user_id AND full_name=:full_name");
            $this->bind(':user_id',$user_id);
            $this->bind(':full_name',$name);
            $user = $this->single();
            if($user){
                return $user;
            }else{
                return false;
            }
        }

        public function avatar($id, $img){
            $this->query("UPDATE users SET image = :image
            WHERE user_id=:user_id");
            $this->bind(':image',$img);
            $this->bind(':user_id',$id);
            return $this->execute();
        }
        
    }