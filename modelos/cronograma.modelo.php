<?php

require_once "conexion.php";  
  
class ModeloCronogramas{  

/*=================================== ==========
	MOSTRAR SIMCARD
	=============================================*/
	static public function mdlMostrarCronogramas($tabla, $item, $valor){

	if($item != null){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

	}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();
	}

	}

} 

/* class Cronograma{

	private $fechaInicial;
	private $fechaFinal;
	public function __construct($objectData){
		$this->fechaInicial = isset($objectData->fechaInicial) ? $objectData->fechaInicial : null;
		$this->fechaFinal = isset($objectData->fechaFinal) ? $objectData->fechaFinal : null;
	}


	public function RangoFechasVentasCronograma($valor, $perfil, $valor1, $perfil1)
	{
				//vendedor
		if ($perfil != null) {

			if ($this->fechaInicial == null) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE  vendedor = :perfil");

				$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else if ($this->fechaInicial == $this->fechaFinal) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE vendedor = :perfil AND fechallegada like '%$this->fechaFinal%'");

				$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else {

				$fechaActual = new DateTime();
				$fechaActual->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($this->fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinalMasUno == $fechaActualMasUno) {

					$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE vendedor = :perfil AND fechallegada BETWEEN '$this->fechaInicial' AND '$fechaFinalMasUno'");

					$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				} else {


					$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE vendedor = :perfil AND fechallegada BETWEEN '$this->fechaInicial' AND '$this->fechaFinal'");

					$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				}
			}
		} else if ($perfil1 != "") {

			if ($this->fechaInicial == null) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE  $perfil1 = :perfil1");

				$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else if ($this->fechaInicial == $this->fechaFinal) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE $perfil1 = :perfil1 AND fechallegada like '%$this->fechaFinal%'");

				$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else {

				$fechaActual = new DateTime();
				$fechaActual->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($this->fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinalMasUno == $fechaActualMasUno) {

					$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE $perfil1 = :perfil1 AND fechallegada BETWEEN '$this->fechaInicial' AND '$fechaFinalMasUno'");

					$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				} else {


					$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE $perfil1 = :perfil1 AND fechallegada BETWEEN '$this->fechaInicial' AND '$this->fechaFinal'");

					$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				}
			}
		} else {

			//admin
			if ($this->fechaInicial == null) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas ORDER BY id ASC");

				$stmt->execute();

				return $stmt->fetchAll();
			} else if ($this->fechaInicial == $this->fechaFinal) {

				try {

					$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE fechallegada like '%$this->fechaFinal%'");
					$stmt->execute();
					return $stmt->fetchAll();
				} catch (Exception $e) {
					die("Error :" . $e->getMessage());
					echo "Linea del error :" . $e->getLine();
				}
			} else {

				$fechaActual = new DateTime();
				$fechaActual->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($this->fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinalMasUno == $fechaActualMasUno) {

					$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE fechallegada BETWEEN '$this->fechaInicial' AND '$fechaFinalMasUno'");
				} else {


					$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE fechallegada BETWEEN '$this->fechaInicial' AND '$this->fechaFinal'");
				}

				$stmt->execute();

				return $stmt->fetchAll();
			}
		}
	}
}
?> */