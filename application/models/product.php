<?php     class Product extends Model{
        //private $db;

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  construct <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
////        public function __construct(){
////            $this = new Database();
////        }
//

        
        
//        /*>>>>>>>>>>>>>>>>>>>>>*/
//        #<---> allProducts <--->#
//        /*<<<<<<<<<<<<<<<<<<<<<*/
        public function getAllPro($active=''){
            if($active==''){
                $act = "";
            }else {
                $act = "WHERE products.active=$active";
            }
            
            $this->query("SELECT products.*, users.full_name as creator,
            categories.cat_name,manufactures.man_name FROM products
            INNER JOIN users ON products.user = users.user_id
            INNER JOIN categories ON products.cat = categories.cat_id
            INNER JOIN manufactures ON products.man = manufactures.man_id
            $act 
            ");
            $products = $this->resultSet();
           if($products){
               return $products;
           }else {
               return false;
           }
        }


        public function search($searched){
            $this->query("SELECT products.*, users.full_name as creator,
            categories.cat_name,manufactures.man_name  FROM products
            INNER JOIN users ON products.user = users.user_id
            INNER JOIN categories ON products.cat = categories.cat_id
            INNER JOIN manufactures ON products.man = manufactures.man_id
            WHERE name LIKE '%$searched%'");
            // $this->bind(':searched',$searched);
            $results = $this->resultSet();
            if($results){
                return $results;
            }else {
                return false;
            }
        }
        /*>>>>>>>>>>>>>>>>>>>>>>>>*/
        #<--->products by cat<--->#
        /*<<<<<<<<<<<<<<<<<<<<<<<*/
        public function getProByCat($catedgory){
            $this->query("SELECT products.*, users.full_name as creator,
            categories.cat_name,manufactures.man_name  FROM products
            INNER JOIN users ON products.user = users.user_id
            INNER JOIN categories ON products.cat = categories.cat_id
            INNER JOIN manufactures ON products.man = manufactures.man_id
            WHERE cat=:cat AND products.active=1
            ");
            $this->bind(':cat',$catedgory);
            $products = $this->resultSet();
           if($products){
               return $products;
           }else {
               return false;
           }
        }

        /*>>>>>>>>>>>>>>>>>>>>>>>>*/
        #<--->products by man<--->#
        /*<<<<<<<<<<<<<<<<<<<<<<<*/
        public function getProByMan($man){
            $this->query("SELECT products.*, users.full_name as creator,
            categories.cat_name,manufactures.man_name  FROM products
            INNER JOIN users ON products.user = users.user_id
            INNER JOIN categories ON products.cat = categories.cat_id
            INNER JOIN manufactures ON products.man = manufactures.man_id
            WHERE man=:man AND products.active=1
            ");
            $this->bind(':man',$man);
            $products = $this->resultSet();
           if($products){
               return $products;
           }else {
               return false;
           }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->     add    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function add(
            $name,$desc,$user,$cat,$man,$image,$price,$size,$color
            ){
            $this->query(
                "INSERT INTO products 
                (name,description,user,cat,man,active
                ,image
                ,price,size,color)
            VALUES 
            (:name,:description,:user,:cat,:man,0,
            :image,
            :price,:size,:color)
            ");
            $this->bind(':name',$name);
            $this->bind(':description',$desc);
            $this->bind(':user',$user);
            $this->bind(':cat',$cat);
            $this->bind(':man',$man);
            $this->bind(':image',$image);
            $this->bind(':price',$price);
            $this->bind(':size',$size);
            $this->bind(':color',$color);
            $this->execute();
        }

         /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   update   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function update(
            $id,$name,$desc,$user,$img,$cat,$man,$price,$size,$color
            ){
            $this->query("UPDATE products SET 
            name=:name,description=:description,user=:user,cat=:cat,
            man=:man,price=:price,size=:size,color=:color,image=:image
            WHERE product_id=:product_id
            ");
            $this->bind(':product_id',$id);
            $this->bind(':name',$name);
            $this->bind(':description',$desc);
            $this->bind(':user',$user);
            $this->bind(':cat',$cat);
            $this->bind(':man',$man);
            $this->bind(':image',$img);
            $this->bind(':price',$price);
            $this->bind(':size',$size);
            $this->bind(':color',$color);
            $this->execute();
        }

        public function show($id){
            $this->query("SELECT products.*, users.full_name as creator,
            categories.cat_name as cat_name,manufactures.man_name 
            as man_name FROM products 
            INNER JOIN users ON products.user = users.user_id
            INNER JOIN categories ON products.cat = categories.cat_id
            INNER JOIN manufactures ON products.man = manufactures.man_id
            WHERE product_id=:product_id");
            $this->bind(':product_id',$id);
            $product = $this->single();
            return $product;
        }

        

        public function findProName($name,$id = ''){
            $this->query("SELECT product_id FROM products 
            WHERE name =:name AND product_id != :product_id");
            $this->bind(':name',$name);
            $this->bind(':product_id',$id);
            $this->execute();
            return $this->rowCount();
        }

        public function delete($id){
            $this->query("DELETE FROM products WHERE product_id=:id");
            $this->bind(':id',$id);
            return $this->execute();
        }

        public function activate($id){
            $this->query("UPDATE products SET active  = 1 WHERE product_id=:id");
            $this->bind(':id',$id);
            return $this->execute();
        }

        public function inActivate($id){
            $this->query("UPDATE products SET active  = 0 WHERE product_id=:id");
            $this->bind(':id',$id);
            return $this->execute();
        }

        public function addGallary($id,$img){
            $this->query("INSERT INTO gallary(image_name,product_id)
            VALUES(:image_name,:product_id)");
            $this->bind(':product_id',$id);
            $this->bind(':image_name',$img);
            return $this->execute();
        }

        public function getGallary($id){
            $this->query("SELECT * FROM gallary WHERE 
            product_id=:product_id ");
            $this->bind(':product_id',$id);
            return $this->resultSet();
        }

        public function deleteGallaryImage($id){
            $this->query("DELETE FROM gallary WHERE image_id=:image_id");
            $this->bind(':image_id',$id);
            return $this->execute();
        }

        public function deleteGallary($id){
            $this->query("DELETE FROM gallary WHERE product_id=:product_id");
            $this->bind(':product_id',$id);
            return $this->execute();
        }
////
    }