<?php

require_once "conexion.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ModeloVentas
{


	/*=============================================
	MOSTRAR SIMCARD
	=============================================*/
	static public function mdlMostrarVentas($tabla, $item, $valor, $item1, $valor3, $perfil)
	{
		/* SELECT v.id, v.cliente AS pasajero, v.celular, v.email, 
							v.pasaporte, v.imei, v.tiposimcard, d.nombre_destino AS destino, 
							v.tipoplan, v.descripcion, v.valor, v.simcard, v.fechallegada, 
							v.fecharegreso, v.fechaventa, v.observacion, v.imagelinea, 
							v.codigo, v.estado, v.agrego, v.agregopadre, v.lineaexterior ,
							u.nombre AS vendedor, (SELECT nombre FROM usuario As u1 WHERE u1.id = u.idpadre LIMIT 1) AS agencia FROM ventas AS v, destinos AS d, usuario AS u WHERE v.id = 954 AND v.destino = d.id AND v.vendedor = u.id;*/
			$query = "SELECT v.id, v.cliente, v.celular, v.email, 
							 v.pasaporte, v.imei, v.tiposimcard, 
							 d.nombre_destino AS destino, v.tipoplan, 
							 v.descripcion, v.valor, v.simcard, 
							 v.fechallegada, v.fecharegreso, v.fechaventa, 
							 v.observacion, v.imagelinea, v.codigo,
							 v.estado, v.agrego, v.agregopadre,
							 v.lineaexterior";

		if ($item != null) {
			//aqui entra el editar ventas
			$stmt = Conexion::conectar()->prepare("$query ,u.nombre, (SELECT nombre FROM usuario As u1 WHERE u1.id = u.idpadre LIMIT 1) AS agencia FROM ventas AS v, destinos AS d, usuario AS u WHERE v.id = :$item AND v.destino = d.id AND v.vendedor = u.id AND v.estado <> 'Anulada'");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();
			
			return $stmt->fetch();
		} else if ($item1 != null) {

			if($perfil == "Coordinador"){
				$stmt = Conexion::conectar()->prepare("$query FROM ventas AS v, destinos AS d WHERE v.$item1 = :$item1 AND v.destino = d.id AND v.estado <> 'Anulada'");
				$stmt->bindParam(":" . $item1, $valor3, PDO::PARAM_STR);
			}

			if($perfil == "Agencias"){
				$stmt = Conexion::conectar()->prepare("$query FROM ventas AS v, destinos AS d WHERE v.$item1 = :$item1 AND v.destino = d.id AND v.estado <> 'Anulada'");
				$stmt->bindParam(":" . $item1, $valor3, PDO::PARAM_STR);
			}

			if($perfil == "Comercial"){
				$stmt = Conexion::conectar()->prepare("$query FROM ventas AS v, destinos AS d WHERE v.$item1 = :$item1 AND v.destino = d.id AND v.estado <> 'Anulada'");
				$stmt->bindParam(":" . $item1, $valor3, PDO::PARAM_STR);
			}
		} else {
			$stmt = Conexion::conectar()->prepare("$query, v.vendedor FROM ventas AS v, destinos AS d WHERE v.destino = d.id AND v.estado <> 'Anulada'");
		}
		$stmt->execute();
		return $stmt->fetchAll();
	}


	//Borrar clientes
	static public function mdlEliminarVentas($tabla, $datos)
	{
		$status = "eliminado";
		//$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cliente = :cliente, simcard = :simcard,

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);
		$stmt->bindParam(":estado", $status, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}
	}


	/*=============================================
	ACTUALIZAR VENTAS POR FECHA
	=============================================*/

	static public function mdlActualizarVentasPorFecha($tabla, $item1, $valor1, $item2, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2 OR CURDATE() > fecharegreso");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}
	}


	/*=============================================
	ACTUALIZAR VENTAS
	=============================================*/

	static public function mdlActualizarVentas($tabla, $item1, $valor1, $item2, $valor2)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {
			if($valor1 == 'activado'){
				//TODO habilitar para enviar el correo
				ModeloVentas::EnviarCorreo($valor2);
			}
			return "ok";
		} else {

			return "error";
		}

	}

	static private function EnviarCorreo($id)
	{
		require '../extensiones/phpmailer/src/Exception.php';
		require '../extensiones/phpmailer/src/PHPMailer.php';
		require '../extensiones/phpmailer/src/SMTP.php';

		$query = "SELECT v.cliente, v.lineaexterior, v.imagelinea, 
										 v.fechallegada, v.simcard, v.email, 
										 d.nombre_destino AS destino, v.descripcion 
										 FROM ventas AS v INNER JOIN destinos AS d WHERE v.id = $id AND d.id = v.destino;";

		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		$data = $stmt->fetch();
		$asunto = "Confirmación de activación";
    $concat = '';
		$cuerpo = '<!DOCTYPE html><html><head><meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../vistas/css/foundation-emails.css">
		<style>.custom-image {width: 700px; height: auto;}.custom-background {
		background-color: #5d1d85;}.center-table {margin: 0 auto;}
		.custom-text{font-size: 20px;text-align: center;width: 600px;color: white;
		}.custom-title{text-align: center;color: #ffd000;}.bordered-table {
		border-collapse: collapse;}.center-text {text-align: center;color: white;
		}.bordered-table th,.bordered-table td {border: 1px solid white; padding: 5px; 
		font-size: 20px;}.text-width{width: 300px; text-align: center;color: white;
		}.text-footer{width: 700px;text-align: center;color: white;}.custom-image-td{
		width: 140px;}</style></head><body><table class="body custom-background" bgcolor="#5d1d85">
		<tr><td><center><img class="custom-image" width="700" src="cid:img-header" alt="Header Image">
		</center></td></tr><tr><td class="container"><table><tr><td class="wrapper"><center>
		<table><tr><td class="custom-text">Hola queremos confirmarte que <span style="color: 
		rgb(255, 208, 0);">Tu</span>Sim card ha sido activada exitosamente con los siguientes detalles:
		</td></tr></table></center><h1 class="custom-title">DETALLES DE LA VENTA</h1>
		<center><table class="bordered-table"><tr><td class="center-text">Nombre pasajero</td>
		<td class="center-text">'.$data["cliente"].'</td></tr><tr><td class="center-text">Línea en el exterior</td>
		<td class="center-text">';if($data["imagelinea"] != ''){$concat = $cuerpo.'<img class="custom-image-td" 
		width="140" src="cid:img-linea" alt="img-simcard" />';}else{$concat = $cuerpo.$data["lineaexterior"];}
		$cuerpo = $concat.'</td></tr><tr><td class="center-text">Correo</td><td class="center-text">'.$data["email"].'</td>
		</tr><tr><td class="center-text">Fecha de viaje</td><td class="center-text">'.$data["fechallegada"].'</td>
		</tr><tr><td class="center-text">Número de simcard</td><td class="float-center" align="center" valign="top"><center>';
		if($data['simcard'] != ''){$concat = $cuerpo.'<img class="custom-image-td" src="cid:img-simcard" 
		width="140" alt="Header Image">';}else{$concat = $cuerpo.'Simcard no Agregada';}$cuerpo = $concat.'</center>
		</td></tr><tr><td class="center-text">Destino</td><td class="center-text">'.$data["destino"].'</td>
		</tr><tr><td class="center-text">Detalle de plan</td><td class="text-width">'.$data["descripcion"].'</td>
		</tr></table></center></td></tr><tr><td class="container"><center><table class="row"><tr>
		<td class="text-footer">Muchas gracias por hacernos parte de tu viaje y si tienes cualquier 
		inquietud no dudes en contactarnos</td></tr></table></center></td></tr></table></td></tr><tr>
		<td class="container"><center><table><tr><td><img width="700" class="custom-image" src="cid:img-footer" 
		width="700" alt="Footer Image"></td></tr></table></center></td></tr></table></body></html>
';
        

try {
			$mail = new PHPMailer(true);
            $mail->isSMTP();     
            $mail->Host = 'mail.caribbeanrepresentaciones.com';//'smtp.gmail.com';  
            $mail->SMTPAuth = true;    
            
			$mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_SMTPS;  
            $mail->Port = 465;  

            $mail->Username = 'app@caribbeanrepresentaciones.com';  //TODO correo de Godady 
            $mail->Password = 'Sp.2023$';   //TODO contraseña del correo de Godady
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";
            $mail->setFrom('app@caribbeanrepresentaciones.com', $asunto); //TODO correo del emisor
            $mail->addAddress($data["email"], $data["cliente"]);  
						$mail->addBCC('soporte@tusimtravel.com'); 
            $mail->isHTML(true);     
            $mail->Subject = $asunto;
            $mail->Body = $cuerpo;
            $mail->addEmbeddedImage('../vistas/img/pagina/Banner-Activada.jpg','img-header');
            $mail->addEmbeddedImage('../vistas/img/pagina/Banner-TuSIM.jpg','img-footer');
            $data['simcard'] != '' && $mail->addEmbeddedImage('../'.$data['simcard'],'img-simcard');
            $data['imagelinea'] != '' && $mail->addEmbeddedImage('../'.$data['imagelinea'],'img-linea');
            $mail->send();
        } catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }
	}


	/*=============================================
	CREAR LINEA DEL EXTERIOR 
	=============================================*/

	static public function mdlActualizarVentasLinea($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3,$date)
	{
		if($valor3 != ""){
			$type = explode('/',$valor3["type"]);
			$fileName = $date.".".$type[1]; 
			$url_temp = $valor3["tmp_name"]; 
			$url_insert =  "files";
			$url_target = str_replace('\\', '/', $url_insert) . '/' . $fileName;
			
			if (!file_exists($url_insert)) {
				mkdir($url_insert, 0777, true);
			};
			if (move_uploaded_file($url_temp, $url_target)) {
				$valor3 = $url_insert ."/". $fileName;
			} 
			//var_dump($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item3 = :$item3 WHERE $item2 = :$item2");
			$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
			$stmt->bindParam(":" . $item3, $valor3, PDO::PARAM_STR);
		}else{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
			$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
		}

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}
	}


	/*=============================================
	RANGO FECHAS PARA LA VISTA DE VENTAS
	=============================================*/

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1)
	{

		if ($perfil != null) {

			if ($fechaInicial == null) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $perfil = :perfil AND estado <> 'Anulada'");

				$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else if ($fechaInicial == $fechaFinal) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $perfil = :perfil AND fechaventa like '%$fechaFinal%' AND estado <> 'Anulada'");

				$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else {

				$fechaActual = new DateTime();
				$fechaActual->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinalMasUno == $fechaActualMasUno) {

					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $perfil = :perfil AND fechaventa BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND estado <> 'Anulada'");

					$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				} else {


					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $perfil = :perfil AND fechaventa BETWEEN '$fechaInicial' AND '$fechaFinal' AND estado <> 'Anulada'");

					$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				}
			}
		} else if ($perfil1 != "") {

			if ($fechaInicial == null) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $perfil1 = :perfil1 AND estado <> 'Anulada'");

				$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else if ($fechaInicial == $fechaFinal) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $perfil1 = :perfil1 AND fechaventa like '%$fechaFinal%' AND estado <> 'Anulada'");

				$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else {

				$fechaActual = new DateTime();
				$fechaActual->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinalMasUno == $fechaActualMasUno) {

					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $perfil1 = :perfil1 AND fechaventa BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND estado <> 'Anulada'");

					$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				} else {


					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $perfil1 = :perfil1 AND fechaventa BETWEEN '$fechaInicial' AND '$fechaFinal' AND estado <> 'Anulada'");

					$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				}
			}
		} else {

			if ($fechaInicial == null) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado <> 'Anulada' ORDER BY id ASC");

				$stmt->execute();

				return $stmt->fetchAll();
			} else if ($fechaInicial == $fechaFinal) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaventa like '%$fechaFinal%' AND estado <> 'Anulada'");

				$stmt->execute();

				return $stmt->fetchAll();
			} else {

				$fechaActual = new DateTime();
				$fechaActual->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinalMasUno == $fechaActualMasUno) {

					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaventa BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND estado <> 'Anulada'");
				} else {


					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaventa BETWEEN '$fechaInicial' AND '$fechaFinal' AND estado <> 'Anulada'");
				}

				$stmt->execute();

				return $stmt->fetchAll();
			}
		}
	}


	/*=============================================
	RANGO FECHAS PARA LA VISTA DE CRONOGRAMAS
	=============================================*/

	static public function mdlRangoFechasVentasCronograma($tabla, $fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1)
	{

		if ($perfil != null) {
			//Asesor
			if ($fechaInicial == null) {

				$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND $perfil = :perfil");

				$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else if ($fechaInicial == $fechaFinal) {

				$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND $perfil = :perfil AND fechallegada like '%$fechaFinal%'");

				$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else {

				$fechaActual = new DateTime();
				$fechaActual->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinalMasUno == $fechaActualMasUno) {

					$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND $perfil = :perfil AND fechallegada BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

					$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				} else {

					$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND $perfil = :perfil AND fechallegada BETWEEN '$fechaInicial' AND '$fechaFinal'");

					$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				}
			}
		} else if ($perfil1 != "") {
			//agencia
			if ($fechaInicial == null) {

				$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND  $perfil1 = :perfil1");
				//$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  $perfil1 = :perfil1");

				$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else if ($fechaInicial == $fechaFinal) {

				$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND $perfil1 = :perfil1 AND fechallegada like '%$fechaFinal%'");

				$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetchAll();
			} else {

				$fechaActual = new DateTime();
				$fechaActual->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinalMasUno == $fechaActualMasUno) {

					$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND $perfil1 = :perfil1 AND fechallegada BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

					$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				} else {


					$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND $perfil1 = :perfil1 AND fechallegada BETWEEN '$fechaInicial' AND '$fechaFinal'");

					$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

					$stmt->execute();

					return $stmt->fetchAll();
				}
			}
		} else {
			//administrador
			if ($fechaInicial == null) {

				$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email,v.agregopadre FROM ventas AS v, destinos AS d WHERE d.id = v.destino ORDER BY id ASC;");

				$stmt->execute();

				return $stmt->fetchAll();
			} else if ($fechaInicial == $fechaFinal) {

				try {

					$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email,v.agregopadre FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND fechallegada like '%$fechaFinal%'");
					$stmt->execute();
					return $stmt->fetchAll();
				} catch (Exception $e) {
					die("Error :" . $e->getMessage());
				}
			} else {

				$fechaActual = new DateTime();
				$fechaActual->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($fechaFinal);
				$fechaFinal2->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				if ($fechaFinalMasUno == $fechaActualMasUno) {

					$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email,v.agregopadre FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND fechallegada BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
				} else {
					$stmt = Conexion::conectar()->prepare("SELECT v.codigo,v.id,v.cliente,v.simcard,v.tipoplan,v.lineaexterior,v.imagelinea AS imagelinea,d.nombre_destino,v.agrego,v.fechallegada,v.fecharegreso,v.estado,v.valor,v.email,v.agregopadre FROM ventas AS v, destinos AS d WHERE d.id = v.destino AND fechallegada BETWEEN '$fechaInicial' AND '$fechaFinal'");
				}

				$stmt->execute();

				return $stmt->fetchAll();
			}
		}
	}




	/*=============================================
	CONTAR LOS TIPOS DE PLANES
	=============================================*/

	static public function mdlContarTiposPlanes($tabla, $perfil, $valor)
	{

		if ($perfil != null) {

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(numero) AS cantidad, tipoplan FROM $tabla WHERE numero=0 AND $perfil = :perfil GROUP BY tipoplan");

			$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(numero) AS cantidad, tipoplan  FROM $tabla WHERE numero=0 GROUP BY tipoplan");

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}



	/*=============================================
	SUMAR LOS TIPOS DE PLANES
	=============================================*/

	static public function mdlSumarPlanesTodos($tabla, $perfil, $valor, $perfil1, $valor1)
	{

		if ($perfil != null) {

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS valor,tipoplan,destino FROM $tabla WHERE numero=0 AND $perfil = :perfil GROUP BY tipoplan");

			$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($perfil1 != null) {

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS valor,tipoplan,destino FROM $tabla WHERE numero=0 AND $perfil1 = :perfil1 GROUP BY tipoplan");

			$stmt->bindParam(":perfil1", $valor1, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS valor,tipoplan,destino FROM $tabla WHERE numero=0 GROUP BY tipoplan");

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}



	/*=============================================
	CONTAR DESTINOS
	=============================================*/

	static public function mdlContarDestino($tabla, $perfil, $valor)
	{

		if ($perfil != null) {

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(numero) AS cantidad, d.nombre_destino AS destino FROM $tabla AS v INNER JOIN destinos AS d WHERE numero=0 AND $perfil = :perfil AND v.destino = d.id GROUP BY destino");

			$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(numero) AS cantidad, d.nombre_destino AS destino FROM $tabla AS v INNER JOIN destinos AS d WHERE numero=0 AND v.destino = d.id GROUP BY destino");

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}



	/*=============================================
	SUMAR LAS VENTAS DE CADA VENDEDOR
	=============================================*/

	static public function mdlSumarVentasVendedor($tabla, $perfil, $valor)
	{

		if ($perfil != null) {

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS valor,vendedor FROM $tabla WHERE numero=0 AND $perfil = :perfil GROUP BY vendedor");

			$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS valor,vendedor FROM $tabla WHERE numero=0 GROUP BY vendedor");

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}



	/*=============================================
	SUMAR LAS VENTAS DE CADA CLIENTE
	=============================================*/

	static public function mdlSumarVentasClientes($tabla, $perfil, $valor)
	{

		if ($perfil != null) {

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS valor,cliente FROM $tabla WHERE numero=0 AND $perfil = :perfil GROUP BY cliente");

			$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS valor,cliente FROM $tabla WHERE numero=0 GROUP BY cliente");

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	/*=============================================
	//CONTAR NUMERO DE SIMCARDS ACTIVAS
	=============================================*/

	static public function mdlContarSimcards($tabla, $perfil, $valor)
	{

		if ($perfil != null) {

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(numero) AS cantidad, estado FROM $tabla WHERE numero=0 AND $perfil = :perfil GROUP BY estado");

			$stmt->bindParam(":perfil", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(numero) AS cantidad, estado  FROM $tabla WHERE numero=0 GROUP BY estado");

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla, $item, $valor,$perfil)
	{

		if ($item != null) {
			if($perfil == "Coordinador"){
				$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) as total FROM $tabla WHERE $item = :item AND estado <> 'Anulada'");
				$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			}
			if($perfil == "Agencias"){
				$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) as total FROM $tabla WHERE $item = :item AND estado <> 'Anulada'");
				$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			}
			if($perfil == "Comercial"){
				//TODO falta
				$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) as total FROM $tabla WHERE $item = :item AND estado <> 'Anulada'");
				$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			}

			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) as total FROM $tabla WHERE estado <> 'Anulada'");
			$stmt->execute();
			return $stmt->fetch();
		}

	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS HOY
	=============================================*/

	static public function mdlSumaTotalVentasHoy($tabla, $item, $valor,$perfil)
	{

		if ($item != null) {
			if($perfil == "Coordinador"){
				$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS total FROM $tabla WHERE $item = :item AND fechaventa = CURDATE() AND estado <> 'Anulada'");
				$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			}

			if($perfil == "Agencias"){
				$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS total FROM $tabla WHERE $item = :item AND fechaventa = CURDATE() AND estado <> 'Anulada'");
				$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			}

			if($perfil == "Comercial"){
				$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS total FROM $tabla WHERE $item = :item AND fechaventa = CURDATE() AND estado <> 'Anulada'");
				$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			}


			$stmt->execute();
			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS total FROM $tabla WHERE fechaventa = CURDATE() AND estado <> 'Anulada'");

			$stmt->execute();

			return $stmt->fetch();
		}

	}

	/*=============================================
	//MOSTRAR VENTAS DE HOY
	=============================================*/

	static public function mdlMostrarVentasHoy($tabla, $item, $valor, $item1, $valor1,$perfil)
	{
		date_default_timezone_set('America/Bogota');

		$fecha_actual = date("Y-m-d");
		$fecha_siguiente = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));

		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :item AND fechallegada = CURDATE() OR fechallegada = '$fecha_siguiente' AND estado = 'desactivado' AND estado <> 'Anulada'");
			$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			$stmt->execute();
			
			return $stmt->fetch();
		} else if ($item1 != null) {

			if($perfil == "Coordinador"){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE coordinador = :item1 AND (fechallegada = CURDATE() OR fechallegada = '$fecha_siguiente') AND estado = 'desactivado' AND estado <> 'Anulada'");
				$stmt->bindParam(":item1", $valor1, PDO::PARAM_STR);
			}

			if($perfil == "Agencias"){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :item1 AND fechallegada = CURDATE() OR fechallegada = '$fecha_siguiente' AND estado = 'desactivado' AND coordinador = $valor AND estado <> 'Anulada'");
				$stmt->bindParam(":item1", $valor1, PDO::PARAM_STR);
			}

			if($perfil == "Comercial"){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :item1 OR fechallegada = '$fecha_siguiente' AND fechallegada = CURDATE() AND estado = 'desactivado' AND estado <> 'Anulada'");
				$stmt->bindParam(":item1", $valor1, PDO::PARAM_STR);
			}
			
			$stmt->execute();
			return $stmt->fetchAll();
			
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechallegada = CURDATE() OR fechallegada = '$fecha_siguiente'  AND estado = 'desactivado' AND estado <> 'Anulada'");

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS MES
	=============================================*/

	static public function mdlSumaTotalVentasMes($tabla, $item, $valor,$perfil)
	{

		if ($item != null) {
			if($perfil == "Coordinador"){
				$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS total FROM $tabla WHERE $item = :item AND date_format(fechaventa, '%m') = MONTH (NOW()) AND estado <> 'ANULADA'");
				$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			}

			if($perfil == "Agencias"){
				$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS total FROM $tabla WHERE $item = :item AND date_format(fechaventa, '%m') = MONTH (NOW()) AND estado <> 'ANULADA'");
				$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			}

			if($perfil == "Comercial"){
				$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS total FROM $tabla WHERE $item = :item AND date_format(fechaventa, '%m') = MONTH (NOW()) AND estado <> 'ANULADA'");
				$stmt->bindParam(":item", $valor, PDO::PARAM_STR);
			}

			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT SUM(valor) AS total FROM $tabla WHERE date_format(fechaventa, '%m') = MONTH (NOW()) AND estado <> 'ANULADA'");

			$stmt->execute();

			return $stmt->fetch();
		}
	}
}
