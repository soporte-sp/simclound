<?php 
header('Content-Type: text/html; charset=utf-8');
require_once "conexion.php";
require_once "out.model.php";

class planes {

    private $typeSimCard;
    private $destination;
    private $typeDestination;
    private $priceDollar;
    private $description;
    private $internalCode;
    private $status;
    private $idPlan;
    private $plan;

    public function __construct($objectData)
    {
        $this->typeSimCard = isset($objectData->typeSimCard) ? $objectData->typeSimCard : null;
        $this->destination = isset($objectData->destination) ? $objectData->destination : null;
        $this->typeDestination = isset($objectData->typeDestination) ? $objectData->typeDestination : null;
        $this->priceDollar = isset($objectData->priceDollar) ? $objectData->priceDollar : null;
        $this->description = isset($objectData->description) ? $objectData->description : null;
        $this->internalCode = isset($objectData->internalCode) ? $objectData->internalCode : null;
        $this->status = isset($objectData->status) ? $objectData->status : null;
        $this->idPlan = isset($objectData->idPlan) ? $objectData->idPlan: null;
        $this->plan = isset($objectData->plan) ? $objectData->plan: null;
    }

    public function getDestination(){
        $query = Conexion::conectar()->prepare("SELECT * FROM destinos ORDER BY nombre_destino ASC");
        $query->execute();
        $result = $query->fetchAll();
        (new out)->return($result);
    }

    public function getTablePlans(){
        $sql = "SELECT 
                    planes.id, planes.tiposimcard, 
                    destinos.nombre_destino AS destino, 
                    planes.tipodeplan, planes.preciodolares,
                    planes.descripcion, planes.codigointerno,
                    planes.estado FROM planes INNER JOIN destinos 
                    ON planes.destino = destinos.id ORDER BY planes.id DESC;";

        $query = Conexion::conectar()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        (new out)->return($result);
    }

    public function insertDestination(){
        $sql = "INSERT INTO planes(tiposimcard, destino, tipodeplan, preciodolares, descripcion,codigointerno,estado) 
                VALUES (:tiposim, :destino, :tipoplan, :preciodolar, :descripcion, :codigointerno, :estado)";
        $query = Conexion::conectar()->prepare($sql);

        $query->bindParam(":tiposim", $this->typeSimCard, PDO::PARAM_STR);
        $query->bindParam(":destino", $this->destination, PDO::PARAM_STR);
        $query->bindParam(":tipoplan", $this->typeDestination, PDO::PARAM_STR);
        $query->bindParam(":preciodolar", $this->priceDollar, PDO::PARAM_STR);
        $query->bindParam(":descripcion", $this->description, PDO::PARAM_STR);
        $query->bindParam(":codigointerno", $this->internalCode, PDO::PARAM_STR);
        $query->bindParam(":estado", $this->status, PDO::PARAM_INT);

        if($query->execute()){
			(new out)->return(array("ERROR" => "0000", "MESSAGE" => "registro exitoso", "RESULT" => true));	
		}else{
            (new out)->return(array("ERROR" => $query->errorInfo(), "MESSAGE" => "registro no exitoso", "RESULT" => false));	
		}
		$query = null;
    }

    public function getPlan(){
        $sql = "SELECT 
                    planes.id, planes.tiposimcard,
                    destinos.nombre_destino AS destino, 
                    planes.tipodeplan, planes.preciodolares,
                    planes.descripcion, planes.codigointerno,
                    planes.estado FROM planes INNER JOIN destinos 
                    ON planes.destino = destinos.id WHERE planes.id = $this->idPlan;";
        $query = Conexion::conectar()->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        (new out)->return($result);
    }

    public function editDestination(){
        $sql = "UPDATE planes SET 
            tipodeplan = :tipodeplan ,
            preciodolares = :preciodolares, 
            descripcion = :descripcion, 
            codigointerno = :codigointerno
            WHERE id = :id";

        $query = Conexion::conectar()->prepare($sql);

		$query -> bindParam(":id", $this->idPlan, PDO::PARAM_STR);
		$query -> bindParam(":tipodeplan", $this->typeDestination, PDO::PARAM_STR);
		$query -> bindParam(":preciodolares", $this->priceDollar, PDO::PARAM_STR);
		$query -> bindParam(":descripcion", $this->description, PDO::PARAM_STR);
		$query -> bindParam(":codigointerno", $this->internalCode, PDO::PARAM_STR);

        if($query->execute()){
			(new out)->return(array("ERROR" => "0000", "MESSAGE" => "Plan Modificado", "RESULT" => true));	
		}else{
            (new out)->return(array("ERROR" => $query->errorInfo(), "MESSAGE" => "Plan No Modificado", "RESULT" => false));	
		}
		$query = null;
    }

    public function deleteDestination(){
        $sql = "UPDATE planes SET estado = :estado WHERE id = :id";
        $query = Conexion::conectar()->prepare($sql);

		$query -> bindParam(":id", $this->idPlan, PDO::PARAM_STR);
		$query -> bindParam(":estado", $this->status, PDO::PARAM_INT);

        if($query->execute()){
			(new out)->return(array("RESULT" => true));	
		}else{
            (new out)->return(array("ERROR" => $query->errorInfo(), "RESULT" => false));	
		}
		$query = null;	
    }
    public function activateDestination(){
        $sql = "UPDATE planes SET estado = :estado WHERE id = :id";
        $query = Conexion::conectar()->prepare($sql);

		$query -> bindParam(":id", $this->idPlan, PDO::PARAM_STR);
		$query -> bindParam(":estado", $this->status, PDO::PARAM_INT);

        if($query->execute()){
			(new out)->return(array("RESULT" => true));	
		}else{
            (new out)->return(array("ERROR" => $query->errorInfo(), "RESULT" => false));	
		}
		$query = null;
    }

    public function getDestinoSimSelect(){
        $sql = "SELECT DISTINCT nombre_destino, destinos.id as destino FROM planes INNER JOIN destinos WHERE tiposimcard = '$this->typeSimCard' AND destinos.id = planes.destino;";
        $query = Conexion::conectar()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        (new out)->return($result);
    }

    public function getDestinoPlanSelect(){
        $sql = "SELECT tipodeplan FROM planes WHERE destino = '$this->destination' AND tiposimcard LIKE '$this->typeSimCard' AND estado = 0;";
        $query = Conexion::conectar()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        (new out)->return($result);
    }

    public function getDescriptionAndPrice(){
        $sql = "SELECT preciodolares,descripcion FROM planes WHERE tiposimcard LIKE '$this->typeSimCard' AND destino = $this->destination AND tipodeplan LIKE '$this->plan'";
        $query = Conexion::conectar()->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        (new out)->return($result);

    }

}
?>