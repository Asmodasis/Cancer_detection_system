<?php

class Image{
    // database connection and table name
    private $conn;
    private $table_name = "images";
 
    // object properties
    public $id;
    public $patient_id;
	public $note;
    public $cancerous;
	public $url;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read linked notes
    function read($var){
    
        // select all query
        $query = "SELECT
                    `id`, `patient_id`, `note`, `cancerous`, `url`, `created`
                FROM
                    images
				WHERE
					patient_id = '$var'
                ORDER BY
                    id DESC";
    
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
                    `id`, `patient_id`, `note`, `cancerous`, `url`, `created`
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
    
        /*if($this->isAlreadyExist()){
            return false;
        }*/
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`patient_id`, `note`, `cancerous`, `url`, `created`)
                  VALUES
                        ('".$this->patient_id."', '".$this->note."', '".$this->cancerous."', '".$this->url."', '".$this->created."')";
    
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
                    patient_id='".$this->patient_id."', note='".$this->note."', cancerous='".$this->cancerous."', url='".$this->url."', created='".$this->created."'
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
/*
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
    }*/
}