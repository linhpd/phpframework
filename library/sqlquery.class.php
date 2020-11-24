<?php //
//
//class SQLQuery {
//    protected $_dbHandle;
//    protected $_result;
//    public $_table;
//    /** Connects to database **/
//
//    function connect($servername, $username, $password, $dbname) {
//        //echo $servername." ". $username." " . $password." ". $dbname;
//        try{
//            $this->_dbHandle = new PDO("mysql:host=$servername;dbname=$dbname", $username,$password);
//        } catch (Exception $ex) {
//            printf("error: ".$ex->getMessage().'<br>');
//        }
//        $this->_dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        
//        
//    }
//
//    /** Disconnects from database **/
//
//    function disconnect() {
//        $this->_dbHandle=null;
//    }
//    
//    function selectAll() {
//        $query='select * from '.$this->_table;
//        return $this->query($query, array());
//    }
//    
//    function select($id, $field) {
//    	//$stmt = $this->_dbHandle->prepare('select * from `'.$this->_table.'`where `id` = \''.mysqli_real_escape_string($this->_dbHandle,$id).'\'');
//    	$query='select * from '.$this->_table.' where '.$field.' = ?';
//        
//        return $this->query($query, array($id), 1);
//    }
//
//    function search($value, $field){
//        $query='select * from '.$this->_table.' where '.$field.' like ?';
//        
//        
//        return $this->query($query, array('%'.$value.'%'));
//    }
//    /** Custom SQL Query **/
//
//    function query($query, $arrayValue, $singleResult = 0) {
//
//        $this->_result = $this->_dbHandle->prepare($query);
//        $this->_result->execute($arrayValue);
//        
//        //echo var_dump($arrayValue);
//        if (preg_match("/select/i", $query)) {
//            $result = array();
//            $table = array();
//            $field = array();
//            $tempResults = array();
//            $numOfFields = $this->_result->columnCount();
//            for ($i = 0; $i < $numOfFields; ++$i) {
//                array_push($table, $this->_result->getColumnMeta($i)["table"]);
//                array_push($field, $this->_result->getColumnMeta($i)["name"]);
//            }
//            //echo var_dump($table);
//            //echo var_dump($field);
//
//            while ($row = $this->_result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
//                for ($i = 0; $i < $numOfFields; ++$i) {
//                    $table[$i] = trim(ucfirst($table[$i]), "s");
//                    $tempResults[$table[$i]][$field[$i]] = $row[$i];
//                }
//                if ($singleResult == 1) {
//                    $this->result = null;
//                    return $tempResults;
//                }
//                array_push($result, $tempResults);
//            }
//            
//            
//            return($result);
//        }$stmt=null;
//    }
//
//    /** Get number of rows **/
//    function getNumRows() {
//        return mysqli_num_rows($this->_result);
//    }
//
//    /** Free resources allocated by a query **/
//
//    function freeResult() {
//        mysqli_free_result($this->_result);
//    }
//
//    /** Get error string **/
//
//    function getError() {
//        return mysqli_error($this->_dbHandle);
//    }
//}

    class SQLQuery{
    
        private $conn;
        private $stmt;
        private $error;

        public function connect($host, $user, $pass, $dbname){
            // Set DSN
            $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
            $options = array(
              PDO::ATTR_PERSISTENT => true,
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
      
            // Create PDO instance
            try{
              $this->conn = new PDO($dsn, $user, $pass, $options);
              //echo $dsn;
            } catch(PDOException $e){
              $this->error = $e->getMessage();
              echo $this->error;
            }
          }
// Prepare statement with query
public function query($sql){
  $this->stmt = $this->conn->prepare($sql);
}

// Bind values
public function bind($param, $value, $type = null){
  if(is_null($type)){
    switch(true){
      case is_int($value):
        $type = PDO::PARAM_INT;
        break;
      case is_bool($value):
        $type = PDO::PARAM_BOOL;
        break;
      case is_null($value):
        $type = PDO::PARAM_NULL;
        break;
      default:
        $type = PDO::PARAM_STR;
    }
  }

    $this->stmt->bindValue($param, $value, $type);
  }

  // Execute the prepared statement
  public function execute(){
    return $this->stmt->execute();
  }

  // Get result set as array of objects
  public function resultSet(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Get single record as object
  public function single(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  public function insertById(){
    $this->execute();
    return $this->stmt = $this->conn->lastInsertId();
  }

  // Get row count
  public function rowCount(){
    return $this->stmt->rowCount();
  }
  
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
//        public function getProByCat($catedgory){
//            $this->query("SELECT products.*, users.full_name as creator,
//            categories.cat_name,manufactures.man_name  FROM products
//            INNER JOIN users ON products.user = users.user_id
//            INNER JOIN categories ON products.cat = categories.cat_id
//            INNER JOIN manufactures ON products.man = manufactures.man_id
//            WHERE cat=:cat AND products.active=1
//            ");
//            $this->bind(':cat',$catedgory);
//            $products = $this->resultSet();
//           if($products){
//               return $products;
//           }else {
//               return false;
//           }
//        }
//
//        /*>>>>>>>>>>>>>>>>>>>>>>>>*/
//        #<--->products by man<--->#
//        /*<<<<<<<<<<<<<<<<<<<<<<<*/
//        public function getProByMan($man){
//            $this->query("SELECT products.*, users.full_name as creator,
//            categories.cat_name,manufactures.man_name  FROM products
//            INNER JOIN users ON products.user = users.user_id
//            INNER JOIN categories ON products.cat = categories.cat_id
//            INNER JOIN manufactures ON products.man = manufactures.man_id
//            WHERE man=:man AND products.active=1
//            ");
//            $this->bind(':man',$man);
//            $products = $this->resultSet();
//           if($products){
//               return $products;
//           }else {
//               return false;
//           }
//        }
//
//
//        /*>>>>>>>>>>>>>>>>>>>>*/
//        #<--->     add    <--->#
//        /*<<<<<<<<<<<<<<<<<<<<*/
//        public function add(
//            $name,$desc,$user,$cat,$man,$image,$price,$size,$color
//            ){
//            $this->query(
//                "INSERT INTO products 
//                (name,description,user,cat,man,active
//                ,image
//                ,price,size,color)
//            VALUES 
//            (:name,:description,:user,:cat,:man,0,
//            :image,
//            :price,:size,:color)
//            ");
//            $this->bind(':name',$name);
//            $this->bind(':description',$desc);
//            $this->bind(':user',$user);
//            $this->bind(':cat',$cat);
//            $this->bind(':man',$man);
//            $this->bind(':image',$image);
//            $this->bind(':price',$price);
//            $this->bind(':size',$size);
//            $this->bind(':color',$color);
//            $this->execute();
//        }
//
//         /*>>>>>>>>>>>>>>>>>>>>*/
//        #<--->   update   <--->#
//        /*<<<<<<<<<<<<<<<<<<<<*/
//        public function update(
//            $id,$name,$desc,$user,$img,$cat,$man,$price,$size,$color
//            ){
//            $this->query("UPDATE products SET 
//            name=:name,description=:description,user=:user,cat=:cat,
//            man=:man,price=:price,size=:size,color=:color,image=:image
//            WHERE product_id=:product_id
//            ");
//            $this->bind(':product_id',$id);
//            $this->bind(':name',$name);
//            $this->bind(':description',$desc);
//            $this->bind(':user',$user);
//            $this->bind(':cat',$cat);
//            $this->bind(':man',$man);
//            $this->bind(':image',$img);
//            $this->bind(':price',$price);
//            $this->bind(':size',$size);
//            $this->bind(':color',$color);
//            $this->execute();
//        }
//
//        public function show($id){
//            $this->query("SELECT products.*, users.full_name as creator,
//            categories.cat_name as cat_name,manufactures.man_name 
//            as man_name FROM products 
//            INNER JOIN users ON products.user = users.user_id
//            INNER JOIN categories ON products.cat = categories.cat_id
//            INNER JOIN manufactures ON products.man = manufactures.man_id
//            WHERE product_id=:product_id");
//            $this->bind(':product_id',$id);
//            $product = $this->single();
//            return $product;
//        }
//
//        
//
//        public function findProName($name,$id = ''){
//            $this->query("SELECT product_id FROM products 
//            WHERE name =:name AND product_id != :product_id");
//            $this->bind(':name',$name);
//            $this->bind(':product_id',$id);
//            $this->execute();
//            return $this->rowCount();
//        }
//
//        public function delete($id){
//            $this->query("DELETE FROM products WHERE product_id=:id");
//            $this->bind(':id',$id);
//            return $this->execute();
//        }
//
//        public function activate($id){
//            $this->query("UPDATE products SET active  = 1 WHERE product_id=:id");
//            $this->bind(':id',$id);
//            return $this->execute();
//        }
//
//        public function inActivate($id){
//            $this->query("UPDATE products SET active  = 0 WHERE product_id=:id");
//            $this->bind(':id',$id);
//            return $this->execute();
//        }
//
//        public function addGallary($id,$img){
//            $this->query("INSERT INTO gallary(image_name,product_id)
//            VALUES(:image_name,:product_id)");
//            $this->bind(':product_id',$id);
//            $this->bind(':image_name',$img);
//            return $this->execute();
//        }
//
//        public function getGallary($id){
//            $this->query("SELECT * FROM gallary WHERE 
//            product_id=:product_id ");
//            $this->bind(':product_id',$id);
//            return $this->resultSet();
//        }
//
//        public function deleteGallaryImage($id){
//            $this->query("DELETE FROM gallary WHERE image_id=:image_id");
//            $this->bind(':image_id',$id);
//            return $this->execute();
//        }
//
//        public function deleteGallary($id){
//            $this->query("DELETE FROM gallary WHERE product_id=:product_id");
//            $this->bind(':product_id',$id);
//            return $this->execute();
//        }
        
}