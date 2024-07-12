<?php



class Conexion

{



	static public function conectar()

	{



		$link = new PDO(

			"mysql:host=localhost;dbname=tusimtest",

			"User_Bd_Tusim",

			"Pw_Bd_Tusim_2023#"

		);



		$link->exec("set names utf8");



		return $link;

	}

}

