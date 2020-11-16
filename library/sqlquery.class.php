<?php

class SQLQuery {
    protected $_dbHandle;
    protected $_result;
    public $_table;
    /** Connects to database **/

    function connect($servername, $username, $password, $dbname) {
        //echo $servername." ". $username." " . $password." ". $dbname;
        try{
            $this->_dbHandle = new PDO("mysql:host=$servername;dbname=$dbname", $username,$password);
        } catch (Exception $ex) {
            printf("error: ".$ex->getMessage().'<br>');
        }
        $this->_dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
    }

    /** Disconnects from database **/

    function disconnect() {
        $this->_dbHandle=null;
    }
    
    function selectAll() {
        $query='select * from '.$this->_table;
        return $this->query($query, array());
    }
    
    function select($id, $field) {
    	//$stmt = $this->_dbHandle->prepare('select * from `'.$this->_table.'`where `id` = \''.mysqli_real_escape_string($this->_dbHandle,$id).'\'');
    	$query='select * from '.$this->_table.' where '.$field.' = ?';
        
        return $this->query($query, array($id), 1);
    }

    function search($value, $field){
        $query='select * from '.$this->_table.' where '.$field.' like ?';
        
        
        return $this->query($query, array('%'.$value.'%'));
    }
    /** Custom SQL Query **/

    function query($query, $arrayValue, $singleResult = 0) {

        $this->_result = $this->_dbHandle->prepare($query);
        $this->_result->execute($arrayValue);
        
        //echo var_dump($arrayValue);
        if (preg_match("/select/i", $query)) {
            $result = array();
            $table = array();
            $field = array();
            $tempResults = array();
            $numOfFields = $this->_result->columnCount();
            for ($i = 0; $i < $numOfFields; ++$i) {
                array_push($table, $this->_result->getColumnMeta($i)["table"]);
                array_push($field, $this->_result->getColumnMeta($i)["name"]);
            }
            //echo var_dump($table);
            //echo var_dump($field);

            while ($row = $this->_result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                for ($i = 0; $i < $numOfFields; ++$i) {
                    $table[$i] = trim(ucfirst($table[$i]), "s");
                    $tempResults[$table[$i]][$field[$i]] = $row[$i];
                }
                if ($singleResult == 1) {
                    $this->result = null;
                    return $tempResults;
                }
                array_push($result, $tempResults);
            }
            
            
            return($result);
        }$stmt=null;
    }

    /** Get number of rows **/
    function getNumRows() {
        return mysqli_num_rows($this->_result);
    }

    /** Free resources allocated by a query **/

    function freeResult() {
        mysqli_free_result($this->_result);
    }

    /** Get error string **/

    function getError() {
        return mysqli_error($this->_dbHandle);
    }
}
