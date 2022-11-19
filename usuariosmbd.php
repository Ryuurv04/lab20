
<?php
class usuariomdb{
private $client;
private $host;
private $user;
private $pswd;
private $database;
private $collection;
private $document;

function __construct(){
    $this->host="localhost:27017";
    $this->use="";
    $this->pswd="";
    $this->database="usuarios_api";
    $this->collection="usuarios";
    $this->conectarmongodb();
}

public function conectarmongodb(){
    try{
        $this->client=new MongoDB\Driver\Manager("mongodb://".$this->host);
    }
    catch(Exception $e){
        die("Ocurrio la siguiente excepcion al tratar de conectarse a la base de datos: ".$e->getMessage());
    }
}

public function insertarRegistro($nombre,$apellido,$email,$edad){

    try{
        $this->document=new MongoDB\Driver\BulkWrite;
        $doc=['_id'=>new Mongo\BSON\ObjectID, 'nombre'=>"$nombre",'apellido'=>"$apellido",'email'=>"$email",'edad'=>intval($edad)];

        $this->document->insert($doc);
        $this->client->executeBulkWrite($this->database.'.'.$this->collection, $this->document);
    }
    catch(Exception $e){
        echo"Ocurrio la siguiente excepcion al tratar de guardar los datos: ",  $e->getMessage();

    }
}
public function obtenerRegistros(){

    try{
        $query=new MongoDB\Driver\Query;
        $rows= $this->client->executeQuery($this->database.'.'.$this->collection, $query);
        
        foreach($rows as $row){
            echo"ID: $row->_id - Nombre Completo: $row->nombre $row->apellido - Email: $row->email - Edad: $row->edad <br>";
        }
        
    }
    catch(Exception $e){
        echo"Ocurrio la siguiente excepcion al tratar de leer los registros: ",  $e->getMessage();

    }
}


}

?>