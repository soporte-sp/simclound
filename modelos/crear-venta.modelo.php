<?php 
require_once "conexion.php";
require_once "out.model.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../extensiones/phpmailer/src/Exception.php';
require '../extensiones/phpmailer/src/PHPMailer.php';
require '../extensiones/phpmailer/src/SMTP.php';

class CrearVenta {
    private $nuevoVendedor;
    private $nuevoCliente;
    private $nuevoCelular;
    private $nuevoCorreo;
    private $nuevoPasaporte;
    private $fileImgImei;
    private $tipoSimCard;
    private $destinosCargados;
    private $tipoPlan;
    private $textDescription;
    private $price;
    private $fileSimcard;
    private $fechaSalida;
    private $fechaRegreso;
    private $fechaVenta;
    private $observacion;
    private $estado;
    private $codigo;
    private $agrego;
    private $agregoPadre;
    private $horaIngreso;
    private $horaCieere;
    private $coordinador;
    private $numero;
    private $fechaInicial;
    private $fechaFinal;
    private $sessionId;
    private $perfilUser; 
    private $sessionUser;
    private $perfil;
    private $id;
    private $destino;

    public function __construct($objectData){
        $this->nuevoVendedor = isset($objectData->nuevoVendedor) ? $objectData->nuevoVendedor : null;
        $this->nuevoCliente = isset($objectData->nuevoCliente) ? $objectData->nuevoCliente : null;
        $this->nuevoCelular = isset($objectData->nuevoCelular) ? $objectData->nuevoCelular : null;
        $this->nuevoCorreo = isset($objectData->nuevoCorreo) ? $objectData->nuevoCorreo : null;
        $this->nuevoPasaporte = isset($objectData->nuevoPasaporte) ? $objectData->nuevoPasaporte : null;
        $this->fileImgImei = isset($objectData->fileImgImei) ? $objectData->fileImgImei : null;
        $this->tipoSimCard = isset($objectData->tipoSimCard) ? $objectData->tipoSimCard : null;
        $this->destinosCargados = isset($objectData->destinosCargados) ? $objectData->destinosCargados : null;
        $this->tipoPlan = isset($objectData->tipoPlan) ? $objectData->tipoPlan : null;
        $this->textDescription = isset($objectData->textDescription) ? $objectData->textDescription : null;
        $this->price = isset($objectData->price) ? $objectData->price : null;
        $this->fileSimcard = isset($objectData->fileSimcard) ? $objectData->fileSimcard : null;
        $this->fechaSalida = isset($objectData->fechaSalida) ? $objectData->fechaSalida : null;
        $this->fechaRegreso = isset($objectData->fechaRegreso) ? $objectData->fechaRegreso : null;
        $this->fechaVenta = isset($objectData->fechaVenta) ? $objectData->fechaVenta : null;
        $this->observacion = isset($objectData->observacion) ? $objectData->observacion : null;
        $this->estado = isset($objectData->estado) ? $objectData->estado : null;
        $this->codigo = isset($objectData->codigo) ? $objectData->codigo : null;
        $this->agrego = isset($objectData->agrego) ? $objectData->agrego : null;
        $this->agregoPadre = isset($objectData->agregoPadre) ? $objectData->agregoPadre : null;
        $this->horaIngreso = isset($objectData->horaIngreso) ? $objectData->horaIngreso : null;
        $this->horaCieere = isset($objectData->horaCieere) ? $objectData->horaCieere : null;
        $this->coordinador = isset($objectData->coordinador) ? $objectData->coordinador : null;
        $this->numero = isset($objectData->numero) ? $objectData->numero : null;
        $this->fechaInicial = isset($objectData->fechaInicial) ? $objectData->fechaInicial : null;
        $this->fechaFinal = isset($objectData->fechaFinal) ? $objectData->fechaFinal : null;
        $this->sessionId = isset($objectData->sessionId) ? $objectData->sessionId : null;
        $this->perfilUser = isset($objectData->perfilUser) ? $objectData->perfilUser : null;
        $this->sessionUser = isset($objectData->sessionUser) ? $objectData->sessionUser : null;
        $this->perfil = isset($objectData->perfil) ? $objectData->perfil : null;
        $this->id = isset($objectData->id) ? $objectData->id : null;
        $this->destino = isset($objectData->destino) ? $objectData->destino : null;
    }

    public function insertarVenta($files){

            if(!empty($files['SIM'])){ 
                $this->fileSimcard = $this->saveImage($files['SIM'],"sim");
            }else{
                $this->fileSimcard = '';
            }

            if(!empty($files['PASAPORTE'])){ 
                $this->nuevoPasaporte = $this->saveImage($files['PASAPORTE'],"pas");
            }else{
                $this->nuevoPasaporte = '';
            }

            $this->fileImgImei = $this->saveImage($files['IMEI'],"imei");
            $this->codigo = $this->getCodeConsecutive();
        $sql = "
            INSERT INTO ventas 
            (cliente,vendedor,simcard, 
            tipoplan,fechallegada,fecharegreso,
            fechaventa,imei,observacion,valor,
            estado,codigo,agrego,celular,email,
            pasaporte,agregopadre,destino,
            horaingreso,horacierre,coordinador,descripcion,tiposimcard)
            VALUES (:cliente,:vendedor, :simcard, 
            :tipoplan, :fechallegada,:fecharegreso,
            :fechaventa,:imei,:observacion,:valor,
            :estado,:codigo,:agrego,:celular,:email,
            :pasaporte,:agregopadre,:destino,
            :horaingreso,:horacierre,:coordinador, 
            :descripcion, :tiposimcard)";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":cliente", $this->nuevoCliente, PDO::PARAM_STR);
		$stmt->bindParam(":vendedor", $this->nuevoVendedor, PDO::PARAM_STR);
		$stmt->bindParam(":simcard", $this->fileSimcard, PDO::PARAM_STR);
		$stmt->bindParam(":tipoplan", $this->tipoPlan, PDO::PARAM_STR);
		$stmt->bindParam(":fechallegada", $this->fechaSalida, PDO::PARAM_STR);
		$stmt->bindParam(":fecharegreso", $this->fechaRegreso, PDO::PARAM_STR);
		$stmt->bindParam(":fechaventa", $this->fechaVenta, PDO::PARAM_STR);
		$stmt->bindParam(":imei", $this->fileImgImei, PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $this->observacion, PDO::PARAM_STR);
		$stmt->bindParam(":valor", $this->price, PDO::PARAM_STR);
		$stmt->bindParam(":estado", $this->estado, PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $this->codigo, PDO::PARAM_STR);
		$stmt->bindParam(":agrego", $this->agrego, PDO::PARAM_STR);
		$stmt->bindParam(":celular", $this->nuevoCelular, PDO::PARAM_STR);
		$stmt->bindParam(":email", $this->nuevoCorreo, PDO::PARAM_STR);
		$stmt->bindParam(":pasaporte", $this->nuevoPasaporte, PDO::PARAM_STR);
		$stmt->bindParam(":agregopadre", $this->agregoPadre, PDO::PARAM_STR);
		$stmt->bindParam(":destino", $this->destinosCargados, PDO::PARAM_STR);
		$stmt->bindParam(":horaingreso", $this->horaIngreso, PDO::PARAM_STR);
		$stmt->bindParam(":horacierre", $this->horaCieere, PDO::PARAM_STR);
		$stmt->bindParam(":coordinador", $this->coordinador, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $this->textDescription, PDO::PARAM_STR);
		$stmt->bindParam(":tiposimcard", $this->tipoSimCard, PDO::PARAM_STR);

        $data = ["email" => $this->nuevoCorreo,"cliente" => $this->nuevoCliente,
                 "celular" => $this->nuevoCelular,"simcard"=> $this->fileSimcard,
                 "destino" => $this->destino,"fechallegada" => $this->fechaSalida,
                 "valor" => $this->price,"detalle" => $this->textDescription];
        $image_path = "../vistas/img/pagina/Banner-Confirmada.jpg";

        $texto = 'Hola queremos confirmarle que la compra de <span style="color: rgb(255, 208, 0);">Tu</span>Sim Card ha sido exitosa con los siguientes detalles:';

        if($stmt->execute()){
            //TODO habilitar para enviar el correo
                $this->EnviarCorreo($data,"Confirmación de Compra",$image_path,$texto);
			(new out)->return(array("ERROR" => "0000", "MESSAGE" => "registro exitoso", "RESULT" => true));	
		}else{
            (new out)->return(array("ERROR" => $stmt->errorInfo(), "MESSAGE" => "registro no exitoso", "RESULT" => false));	
		}	
		$stmt = null;
    }

    private function getCodeConsecutive(){
        $sql = "SELECT codigo FROM ventas ORDER BY id DESC LIMIT 1";
        $query = Conexion::conectar()->prepare($sql);
        if($query->execute()){
            $result = $query->fetch();
            return intval($result['codigo'])+1;
        }else{
            return 1;
        }
    }

    private function saveImage($file,$option){

        date_default_timezone_set("America/Bogota");

        if($option == "imei"){
            $type = explode('/',$file['type']);
            $name = "imei-". date('h-i-s-m-d-y').".".$type[1];
        }

        if($option == "sim"){
            $type = explode('/',$file['type']);
            $name = "sim-". date('h-i-s-m-d-y').".".$type[1];
        }

        if($option == "pas"){
            $type = explode('/',$file['type']);
            $name = "pasaporte-". date('h-i-s-m-d-y').".".$type[1];
        }

        $urlTemp = $file["tmp_name"];
        $urlInsert = dirname(__DIR__,1)."/files";
        $routeArchive = str_replace('\\','/',$urlInsert). '/'. $name;

        if (!file_exists($urlInsert)) {
            mkdir($urlInsert, 0777, true);
        };
        if(move_uploaded_file($urlTemp, $routeArchive)){
            return 'files/'.$name;
        }
    }

    public function anularVenta()
    {
        $query = Conexion::conectar()->prepare("UPDATE ventas SET estado = :estado WHERE id = :id");
        $query->bindParam(":estado", $this->estado, PDO::PARAM_STR);
        $query->bindParam(":id", $this->id, PDO::PARAM_STR);

        if ($query->execute()) {
            //TODO habilitar para enviar el correo
            $this->EnviarCorreoAnular($this->id);
            (new out)->return(array("ERROR" => "0000", "MESSAGE" => "Estado Modificado", "RESULT" => $this->estado));
        } else {
            (new out)->return(array("ERROR" => $query->errorInfo(), "MESSAGE" => "Estado No Modificado", "RESULT" => false));
        }
        $query = null;
    }

    function EnviarCorreoAnular($id){
        $sql = "SELECT 
                        v.cliente,v.celular,v.simcard,v.email,
                        d.nombre_destino as destino,v.fechallegada,
                        v.valor,v.descripcion as detalle
                        FROM ventas AS v INNER JOIN destinos as d 
                        WHERE v.id = $id AND v.destino = d.id;";

        $query = Conexion::conectar()->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        $image_path = "../vistas/img/pagina/Banner-Anulada.jpg";
        $texto = 'Hola queremos confirmarle que la compra de <span style="color: rgb(255, 208, 0);">Tu</span>Sim Card fue anulada con los siguientes detalles:';
        $this->EnviarCorreo($result,"Compra Anulada",$image_path,$texto);
    }

    private function EnviarCorreo($data,$asunto,$img_header,$texto)
	{
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
                   <tr><td><img class="custom-image" width="700" src="cid:img-header" alt="Header Image"><center>
                   </center></td></tr><tr><td class="container"><table><tr><td class="wrapper"><center>
                   <table><tr><td class="custom-text">'.$texto.'</td></tr></table></center><h1 class="custom-title">DETALLES DE LA VENTA</h1>
                   <center><table class="bordered-table"><tr><td class="center-text">Nombre pasajero</td>
                   <td class="center-text">'.$data["cliente"].'</td></tr><tr><td class="center-text">Celular</td>
                   <td class="center-text">'.$data["celular"].'</td></tr><tr><td class="center-text">Correo</td>
                   <td class="center-text">'.$data["email"].'</td></tr><tr><td class="center-text">Fecha de viaje</td>
                   <td class="center-text">'.$data["fechallegada"].'</td></tr><tr><td class="center-text">Número de simcard</td>
                   <td class="float-center" align="center" valign="top"><center>';if($data['simcard'] != ''){
                   $concat = $cuerpo.'<img class="custom-image-td" src="cid:img-simcard" width="140" alt="Header Image">';
                   }else{$concat = $cuerpo.'Simcard no Agregada';}$cuerpo = $concat.'</center></td></tr><tr>
                   <td class="center-text">Destino</td><td class="center-text">'.$data["destino"].'</td></tr>
                   <tr><td class="center-text">Detalle de plan</td><td class="text-width">'.$data["detalle"].'</td>
                   </tr></table></center></td></tr><tr><td class="container"><center><table class="row"><tr>
                   <td class="text-footer">Muchas gracias por hacernos parte de tu viaje y si tienes cualquier 
                   inquietud no dudes en contactarnos</td></tr></table></center></td></tr></table></td></tr><tr>
                   <td class="container"><center><table><tr><td><img width="700" class="custom-image" src="cid:img-footer"
		   width="700" alt="Footer Image"></td></tr></table></center></td></tr></table></body></html>';

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();    
            $mail->Host = 'mail.caribbeanrepresentaciones.com';//'smtpout.secureserver.net';//'smtp.gmail.com'; //'mail.tusimtravel.com';  
            $mail->SMTPAuth = true;

            /* $mail->Username = 'administrativo@tusimtravel.com'; //TODO correo de Godady 
            $mail->Password = 'umwqshtlwhuunpcb';  //TODO clave del correo Godady  */

		    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //TODO correo de gmail
	        $mail->SMTPSecure = 'ssl'; //TODO correo de Godady
	        $mail->Port = 465;   

            /* $mail->Username = 'APPtusim@tusimtravel.com'; //TODO correo de Tusimtravel 
            $mail->Password = 'ydzx qtim xhrp siho';  //TODO clave del correo Tusimtravel  */

            
            $mail->Username = 'app@caribbeanrepresentaciones.com'; //TODO correo de Godady 
            $mail->Password = 'Sp.2023$';  //TODO clave del correo Godady

            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";

            $mail->setFrom('app@caribbeanrepresentaciones.com', $asunto);
            //$mail->setFrom('administrativo@tusimtravel.com', $asunto); //TODO correo del emisor
	        //$mail->setFrom('APPtusim@tusimtravel.com', $asunto);

            $mail->addAddress($data["email"], $data["cliente"]);
            $mail->addBCC('soporte@tusimtravel.com'); 
            $mail->isHTML(true);     
            $mail->Subject = $asunto;
            $mail->Body = $cuerpo;
            $mail->addEmbeddedImage($img_header,'img-header');
            $mail->addEmbeddedImage('../vistas/img/pagina/Banner-TuSIM.jpg','img-footer');
            $data['simcard'] != '' && $mail->addEmbeddedImage('../'.$data['simcard'],'img-simcard');
            //$mail->SMTPDebug = 3;
            $mail->send();
        } catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
        }
	}    

    public function rangoFechasVentas()
	{ 
        $query = "SELECT v.id AS id, v.agregopadre AS cliente, v.cliente AS vendedor, v.simcard AS simcard, 
                  v.tipoplan AS tipoplan, v.fechallegada AS fechallegada, v.fecharegreso AS fecharegreso,
                  v.fechaventa AS fechaventa, v.imei AS imei, v.observacion AS observacion,
                  v.valor AS valor, v.estado AS estado, v.numero AS numero, v.codigo AS codigo,
                  v.agrego AS agrego, v.celular AS celular, v.email AS email, v.pasaporte AS pasaporte,
                  d.nombre_destino AS destino, v.tiposimcard AS tiposimcard, v.descripcion AS descripcion
                  FROM ventas v, usuario u, destinos d ";

         if ($this->perfil == "Comercial") {
            if ($this->fechaInicial == null) {
                $stmt = Conexion::conectar()->prepare("$query WHERE u.id = v.vendedor AND v.vendedor = $this->sessionId AND v.destino = d.id AND v.estado != 'eliminado' ORDER BY v.id DESC;");
            }else if ($this->fechaInicial == $this->fechaFinal) {
                $stmt = Conexion::conectar()->prepare("$query WHERE u.id = v.vendedor AND v.vendedor = $this->sessionId AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa like '%$this->fechaFinal%'");
            } else {
                $stmt = $this->rangeFecha($this->sessionId,$this->fechaInicial,$this->fechaFinal,$query,null);
            }
         }
         if ($this->perfil == "Agencias") {
			if ($this->fechaInicial == null) {
				$stmt = Conexion::conectar()->prepare("$query WHERE u.id = $this->sessionId AND v.agregopadre = '$this->sessionUser' AND v.destino = d.id AND v.estado != 'eliminado' ORDER BY v.id DESC;");
			}else if ($this->fechaInicial == $this->fechaFinal) {
				$stmt = Conexion::conectar()->prepare("$query WHERE u.id = $this->sessionId AND v.agregopadre = '$this->sessionUser' AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa like '%$this->fechaFinal%'");
			} else {
                $stmt = $this->rangeFecha($this->sessionId,$this->fechaInicial,$this->fechaFinal,$query,null);
			}
		} 
        if($this->perfil == "Administrador") {
			if ($this->fechaInicial == null) {
                $stmt = Conexion::conectar()->prepare("$query WHERE u.id = v.vendedor  AND v.destino = d.id AND v.estado != 'eliminado' ORDER BY v.id DESC;");
			}else if ($this->fechaInicial == $this->fechaFinal) {
				$stmt = Conexion::conectar()->prepare("$query WHERE u.id = v.vendedor  AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa like '%$this->fechaFinal%'");
			} else {
				$stmt = $this->rangeFecha(null,$this->fechaInicial,$this->fechaFinal,$query,null);
			}         
		}

        if($this->perfil == "Coordinador") {
            if ($this->fechaInicial == null) {
                $stmt = Conexion::conectar()->prepare($query." WHERE u.id = v.vendedor AND v.coordinador = ".$this->sessionId." AND v.destino = d.id AND v.estado != 'eliminado' ORDER BY v.id DESC");
			}else if ($this->fechaInicial == $this->fechaFinal) {
                $stmt = Conexion::conectar()->prepare($query." WHERE u.id = v.vendedor AND v.coordinador = ".$this->sessionId." AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa like '%$this->fechaFinal%'");
            } else {
                $stmt = $this->rangeFecha(null,$this->fechaInicial,$this->fechaFinal,$query,$this->sessionId);
			}         
		}
        
        $stmt->execute();
        (new out)->return($stmt->fetchAll());
	} 

    private function rangeFecha($sessionId,$fechaInicial,$fechaFinal,$query,$id_cordinador){
        $fechaActual = new DateTime();
        $fechaActual->add(new DateInterval("P1D"));
        $fechaActualMasUno = $fechaActual->format("Y-m-d");
        $fechaFinal2 = new DateTime($fechaFinal);
        $fechaFinal2->add(new DateInterval("P1D"));
        $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
        if ($fechaFinalMasUno == $fechaActualMasUno) {
            if($sessionId != null){
                //agencia
                $stmt = Conexion::conectar()->prepare("$query WHERE u.id = $this->sessionId AND v.agregopadre = '$this->sessionUser' AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
            }else if($this->perfil == "Administrador"){
                $stmt = Conexion::conectar()->prepare("$query WHERE u.id = v.vendedor AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
            }else{
                //cordinador
                $stmt = Conexion::conectar()->prepare("$query WHERE u.id = v.vendedor AND v.coordinador = $id_cordinador AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
            }
        } else {
            if($sessionId != null){
                //agencia
                $stmt = Conexion::conectar()->prepare("$query WHERE u.id = $this->sessionId AND v.agregopadre = '$this->sessionUser' AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa BETWEEN '$fechaInicial' AND '$fechaFinal'");
            }else if($this->perfil == "Administrador"){
                $stmt = Conexion::conectar()->prepare("$query WHERE u.id = v.vendedor  AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa BETWEEN '$fechaInicial' AND '$fechaFinal'");
            }else{
                //cordinador
                $stmt = Conexion::conectar()->prepare("$query WHERE u.id = v.vendedor AND v.coordinador = $id_cordinador AND v.destino = d.id AND v.estado != 'eliminado' AND v.fechaventa BETWEEN '$fechaInicial' AND '$fechaFinal'");
            }

        }

        return $stmt;

    }

    public function eliminarVenta() {

        $status = "eliminado";
		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET estado = :estado WHERE id = :id");
		$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
		$stmt->bindParam(":estado", $status, PDO::PARAM_STR);

		if($stmt->execute()){
			(new out)->return(array("ERROR" => "0000", "MESSAGE" => "Eliminado exitoso", "RESULT" => true));	
		}else{
            (new out)->return(array("ERROR" => $stmt->errorInfo(), "MESSAGE" => "Eliminado no exitoso", "RESULT" => false));	
		}	
		$stmt = null;
    }
}