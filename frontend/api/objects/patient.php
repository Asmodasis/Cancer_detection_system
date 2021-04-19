<?php

class Patient{
    // database connection and table name
    private $conn;
    private $table_name = "patients";
 
    // object properties
    public $id;
    public $name;
	public $phone;
    public $gender;
	public $health_condition;
	public $doctor_id;
	public $nurse_id;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read link patients
    function read($sessionID, $sessionRole){
		
		// select all query for admin role
		if($sessionRole == 1){
			$query = "SELECT
						`id`, `name`, `phone`, `gender`, `health_condition`, `doctor_id`, `nurse_id`, `created`
					FROM
						patients
					ORDER BY
						id DESC";
		}
		
        // select all query for doctor role
		if($sessionRole == 2){
			$query = "SELECT
						`id`, `name`, `phone`, `gender`, `health_condition`, `doctor_id`, `nurse_id`, `created`
					FROM
						patients
					WHERE
						doctor_id = '$sessionID'
					ORDER BY
						id DESC";
		}
		
		// select all query for nurse role
		if($sessionRole == 3){
			$query = "SELECT
						`id`, `name`, `phone`, `gender`, `health_condition`, `doctor_id`, `nurse_id`, `created`
					FROM
						patients
					WHERE
						nurse_id = '$sessionID'
					ORDER BY
						id DESC";
		}
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single patient data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `id`, `name`, `phone`, `gender`, `health_condition`, `doctor_id`, `nurse_id`, `created`
                FROM
                    " . $this->table_name . " 
                WHERE
                    id= '".$this->id."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create patient
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`name`, `phone`, `gender`, `health_condition`, `doctor_id`, `nurse_id`, `created`)
                  VALUES
                        ('".$this->name."', '".$this->phone."', '".$this->gender."', '".$this->health_condition."', '".$this->doctor_id."', '".$this->nurse_id."', '".$this->created."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update patient 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', phone='".$this->phone."', gender='".$this->gender."', health_condition='".$this->health_condition."', doctor_id='".$this->doctor_id."', nurse_id='".$this->nurse_id."'
                WHERE
                    id='".$this->id."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete patient
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    id= '".$this->id."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->name."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}