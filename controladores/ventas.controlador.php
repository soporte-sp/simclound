<?php


class ControladorVentas
{

	/*============================================= 
	EDITAR VENTAS
	=============================================*/

	/* static public function ctrEditarVentas()
	{



		if (isset($_POST["idVenta"])) {

			$tabla = "ventas";

			// $plan = implode(' - ', $_POST["editarPlan"]);

			$datos = array(
				"id" => $_POST["idVenta"],
				"cliente" => $_POST["editarCliente"],
				"simcard" => $_POST["editarSimcard"],
				"tipoplan" => $_POST["editarPlan"],
				"fechallegada" => $_POST["editarFechaLlegada"],
				"fecharegreso" => $_POST["editarFechaRegreso"],
				"fechaventa" => $_POST["editarFechaVenta"],
				"imei" => $_POST["editarImei"],
				"observacion" => $_POST["editarObservacion"],
				"valor" => $_POST["editarValor"],
				"celular" => $_POST["editarCelular"],
				"email" => $_POST["editarCorreo"],
				"pasaporte" => $_POST["editarPasaporte"],
				"destino" => $_POST["editarDestino"],
				"horaingreso" => $_POST["editarHoraIngreso"],
				"horacierre" => $_POST["editarHoraCierre"]
			);
			var_dump($datos);
			$respuesta = ModeloVentas::mdlEditarVentas($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
		
							swal({
								  type: "success",
								  title: "La venta se ha editado correctamente",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
											if (result.value) {
		
											window.location = "ventas";
		
											}
										})
		
							</script>';
			}
		}
	} */

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor, $item1, $valor3, $perfil)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor, $item1, $valor3, $perfil);

		return $respuesta;
	}

	//CONTAR PLANES

	static public function ctrContarTiposPlanes($perfil, $valor)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlContarTiposPlanes($tabla, $perfil, $valor);

		return $respuesta;
	}

	//CONTAR DESTINOS

	static public function ctrContarDestino($perfil, $valor)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlContarDestino($tabla, $perfil, $valor);

		return $respuesta;
	}


	//SUMAR MAS VENTAS DEL VENDEDOR

	static public function ctrSumarVentasVendedor($perfil, $valor)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumarVentasVendedor($tabla, $perfil, $valor);

		return $respuesta;
	}

	//SUMAR MAS VENTAS DEL CLIENTE

	static public function ctrSumarVentasClientes($perfil, $valor)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumarVentasClientes($tabla, $perfil, $valor);

		return $respuesta;
	}

	//CONTAR NUMERO DE SIMCARDS ACTIVAS

	static public function ctrContarSimcards($perfil, $valor)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlContarSimcards($tabla, $perfil, $valor);

		return $respuesta;
	}

	/*=============================================
	RANGO FECHAS  PARA LA VISTA VENTAS 
	=============================================*/

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1);

		return $respuesta;
	}

	/*=============================================
	RANGO FECHAS  PARA LA VISTA CRONOGRAMA
	=============================================*/

	static public function ctrRangoFechasVentasCronograma($fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentasCronograma($tabla, $fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1);

		return $respuesta;
	}


	/*=============================================
	BORRAR VENTA
	=============================================*/

	static public function ctrBorrarVenta()
	{

		if (isset($_GET["idVentaEliminar"])) {


			$tabla2 = "simcards";

			$item = "simcard";

			$valor = $_GET["simcards"];

			$item2 = "valor";

			$valor2 = 0;

			$respuesta2 = ModeloSimscards::MdlActualizarSimcard($tabla2, $item, $valor, $item2, $valor2);

			$tabla = "ventas";
			$datos = $_GET["idVentaEliminar"];



			$respuesta = ModeloVentas::mdlEliminarVentas($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';
			}
		}
	}

	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public static function ctrSumaTotalVentas($item, $valor, $perfil)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla, $item, $valor, $perfil);

		return $respuesta;
	}


	/*=============================================
	SUMAR PLANES TOTALES
	=============================================*/

	public static function ctrSumaPlanesTotales($perfil, $valor, $perfil1, $valor1)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumarPlanesTodos($tabla, $perfil, $valor, $perfil1, $valor1);

		return $respuesta;
	}

	/*=============================================
	SUMA TOTAL VENTAS DE HOY
	=============================================*/

	static public function ctrSumaTotalVentasHoy($item, $valor, $perfil)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentasHoy($tabla, $item, $valor,$perfil);

		return $respuesta;
	}


	//MOSTRAR VENTAS DE HOY

	static public  function ctrMostrarVentasHoy($item, $valor, $item1, $valor1,$perfil)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentasHoy($tabla, $item, $valor, $item1, $valor1,$perfil);

		return $respuesta;
	}

	/*=============================================
	SUMA TOTAL VENTAS DE MES
	=============================================*/

	static public function ctrSumaTotalVentasMes($item, $valor,$perfil)
	{

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentasMes($tabla, $item, $valor,$perfil);

		return $respuesta;
	}

	/*============================================= 
	CREAR LINEA DEL EXTERIOR 
	=============================================*/

	static public function ctrCrearLineaExterior()
	{
		date_default_timezone_set("America/Bogota");
		$date = date('dmY_his');

		if (isset($_POST["NuevaLineaId"])){
			$tabla = "ventas";
			$item1 = "lineaexterior";
			$valor1 = isset($_POST["nuevoLinea"]) ? $_POST["nuevoLinea"] : "";
			$item2 = "id";
			$valor2 = $_POST["NuevaLineaId"];

			$item3 = "imagelinea";

			if($_FILES["nuevaImg"]["name"] != ""){
				$type = explode('/',$_FILES["nuevaImg"]["type"]);
					if($type[1] == 'pdf' || $type[1] == 'png' ||
					   $type[1] == 'jpeg' || $type[1] == 'jpg'){
						   $valor3 = $_FILES["nuevaImg"];
						   $respuesta = ModeloVentas::mdlActualizarVentasLinea($tabla, $item1, $valor1, $item2, $valor2,$item3,$valor3,$date);
									if ($respuesta == "ok") {
										echo '<script>
										swal({
											type: "success",
											title: "La linea se ha guardado",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"
											}).then(function(result){
														if (result.value) {
														window.location = "cronograma";
														}
													})
					
										</script>';
									}
					}else{
						echo '<script>
							swal({
								  type: "error",
								  title: "Solo Se Aceptan Archivos Con Las Siguientes Extensiones pdf,png,jpg,jpeg ",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
											if (result.value) {
											//window.location = "cronograma";
											}
										})
		
							</script>';
					}
					
				
			}else{
				$valor3 = "";
				$respuesta = ModeloVentas::mdlActualizarVentasLinea($tabla, $item1, $valor1, $item2, $valor2,$item3,$valor3,$date);
					if ($respuesta == "ok") {
						echo '<script>
						swal({
							type: "success",
							title: "La linea se ha guardado",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {
										window.location = "cronograma";
										}
									})

						</script>';
					}
			}
			
			
		}
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte()
	{

		if (isset($_GET["reporte"])) {

			$tabla = "ventas";
			$valor = null;
			$perfil = null;
			$valor1 = null;
			$perfil1 = null;

			if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"], $valor, $perfil, $valor1, $perfil1);
			} else {

				$item = null;
				$valor = null;
				$item1 = null;
				$valor3 = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor, $item1, $valor3,null);
			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"] . '.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate");
			header('Content-Description: File Transfer');
			header('Last-Modified: ' . date('D, d M Y H:i:s'));
			header("Pragma: public");
			header('Content-Disposition:; filename="' . $Name . '"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>SIMCARD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CELULAR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TIPO DE PLAN</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA DE LLEGADA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA DE REGRESO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA DE VENTA</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>IMEI</td>
					<td style='font-weight:bold; border:1px solid #eee;'>OBSERVACION</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>VALOR</td>			
					</tr>");

			foreach ($ventas as $row => $item) {

				// $celular = ControladorClientes::ctrMostrarClientes("id", $item["cliente"],$perfil);
				// $cliente = ControladorUsuarios::ctrMostrarUsuarios("id", $item["cliente"],$perfil);

				echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>" . $item["cliente"] . "</td> 
			 			<td style='border:1px solid #eee;'>" . $item["simcard"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["celular"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["tipoplan"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["fechallegada"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["fecharegreso"] . "</td>	
			 			<td style='border:1px solid #eee;'>" . $item["fechaventa"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["imei"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["observacion"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["valor"] . "</td>
		 					</tr>");
			}


			echo "</table>";
		}
	}
}
