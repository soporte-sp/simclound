<?php
header('Content-Type: text/html; charset=utf-8');
require_once "conexion.php";
require_once "out.model.php";

class Usuario
{

    private $perfil;
    private $id;
    private $estado;
    private $nombre;
    private $usuario2;
    private $correo;
    private $password;
    private $mostrar;
    private $nit;
    private $comercial;
    private $idpadre;
    private $coordinador;
    private $idcoordinadordeadmin;
    private $passwordActual;
    private $idCordinadorActual;

    public function __construct($objectData)
    {
        $this->perfil = isset($objectData->perfil) ? $objectData->perfil : null;
        $this->id = isset($objectData->id) ? $objectData->id : null;
        $this->estado = isset($objectData->estado) ? $objectData->estado : null;
        $this->nombre = isset($objectData->nombre) ? $objectData->nombre : null;
        $this->usuario2 = isset($objectData->usuario2) ? $objectData->usuario2 : null;
        $this->correo = isset($objectData->correo) ? $objectData->correo : null;
        $this->password = isset($objectData->password) ? $objectData->password : null;
        $this->mostrar = isset($objectData->mostrar) ? $objectData->mostrar : null;
        $this->nit = isset($objectData->nit) ? $objectData->nit : null;
        $this->comercial = isset($objectData->comercial) ? $objectData->comercial : null;
        $this->idpadre = isset($objectData->idpadre) ? $objectData->idpadre : null;
        $this->coordinador = isset($objectData->coordinador) ? $objectData->coordinador : null;
        $this->passwordActual = isset($objectData->passwordActual) ? $objectData->passwordActual : null;
        $this->idcoordinadordeadmin = isset($objectData->idcoordinadordeadmin) ? $objectData->idcoordinadordeadmin : null;
        $this->idCordinadorActual = isset($objectData->idCordinadorActual) ? $objectData->idCordinadorActual : null;
    }

    public function showTableUser()
    {
        if ($this->perfil == 'Administrador') {
            //SELECT u1.id, u1.nombre,u1.usuario2,u1.nit,u1.perfil,u1.estado,u1.ultimo_login,u1.idpadre, (SELECT u2.nombre from usuario AS u2 WHERE u2.id = u1.idpadre) as agencia FROM usuario as u1 ORDER BY u1.`perfil` ASC;
            $sql = "SELECT id,nombre,usuario2,nit,perfil,estado,ultimo_login,idpadre FROM usuario ORDER BY id DESC";
            $query = Conexion::conectar()->prepare($sql);
        }
        if($this->perfil == 'Agencias'){
            $sql = "SELECT id,nombre,usuario2,correo,nit,perfil,estado,ultimo_login FROM usuario WHERE id = $this->id OR comercial = '$this->comercial' ORDER BY id DESC";
            $query = Conexion::conectar()->prepare($sql);
        }
        if($this->perfil == 'Coordinador'){
            $sql = "SELECT id,nombre,usuario2,correo,nit,perfil,estado,ultimo_login FROM usuario WHERE id = $this->id OR idcoordinadordeadmin = '$this->id' ORDER BY id DESC";
            $query = Conexion::conectar()->prepare($sql);
        }
        $query->execute();
        $result = $query->fetchAll();
        (new out)->return($result);
    }

    public function setStatusChanges()
    {
        $query = Conexion::conectar()->prepare("UPDATE usuario SET estado = :estado WHERE id = :id");

        $query->bindParam(":estado", $this->estado, PDO::PARAM_STR);
        $query->bindParam(":id", $this->id, PDO::PARAM_STR);

        if ($query->execute()) {
            (new out)->return(array("ERROR" => "0000", "MESSAGE" => "Estado Modificado", "RESULT" => $this->estado));
        } else {
            (new out)->return(array("ERROR" => $query->errorInfo(), "MESSAGE" => "Estado No Modificado", "RESULT" => false));
        }
        $query = null;
    }

    public function getPerfil()
    {
        if ($this->perfil == "Coordinador") {
            $query = Conexion::conectar()->prepare("SELECT id,nombre FROM usuario WHERE perfil = :perfil");
            $query->bindParam(":perfil", $this->perfil, PDO::PARAM_STR);
        }
        if ($this->perfil == "Agencias") {
            $query = Conexion::conectar()->prepare("SELECT nombre,usuario2 FROM usuario WHERE perfil = :perfil OR comercial = 5");
            $query->bindParam(":perfil", $this->perfil, PDO::PARAM_STR);
        }
        $query->execute();
        $result = $query->fetchAll();
        (new out)->return(array("RESULT" => $result, "PERFIL" => $this->perfil));
    }

    public function getIdAgencia()
    {
        $query = Conexion::conectar()->prepare("SELECT id FROM usuario WHERE usuario2 = :usuario2");
        $query->bindParam(":usuario2", $this->usuario2, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();
        (new out)->return($result);
    }

    public function insertarUser()
    {

        $sql = "
        INSERT INTO usuario (nombre,usuario2,correo,password,perfil,mostrar,nit,
        comercial,idpadre,coordinador,idcoordinadordeadmin)
        VALUES (:nombre,:usuario2,:correo, :password, 
        :perfil, :mostrar,:nit,
        :comercial,:idpadre,:coordinador,:idcoordinadordeadmin)";
        $password = crypt($this->password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $this->perfil == "Administrador" ? $mostrar = 0 : $mostrar = 1;
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(":usuario2", $this->usuario2, PDO::PARAM_STR);
        $stmt->bindParam(":correo", $this->correo, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $this->perfil, PDO::PARAM_STR);
        $stmt->bindParam(":mostrar", $mostrar, PDO::PARAM_STR);
        $stmt->bindParam(":nit", $this->nit, PDO::PARAM_STR);
        $stmt->bindParam(":comercial", $this->comercial, PDO::PARAM_STR);
        $stmt->bindParam(":idpadre", $this->idpadre, PDO::PARAM_STR);
        $stmt->bindParam(":coordinador", $this->coordinador, PDO::PARAM_STR);
        $stmt->bindParam(":idcoordinadordeadmin", $this->idcoordinadordeadmin, PDO::PARAM_STR);
        if ($stmt->execute()) {
            (new out)->return(array("ERROR" => "0000", "MESSAGE" => "registro exitoso", "RESULT" => true));
        } else {
            (new out)->return(array("ERROR" => $stmt->errorInfo(), "MESSAGE" => "registro no exitoso", "RESULT" => false));
        }

        $stmt = null;
    }

    public function showEditarUser()
    {
        $sql = "SELECT id,nombre,usuario2,correo,password,perfil,mostrar,nit,
                comercial,idpadre,idcoordinadordeadmin FROM usuario WHERE id = :id";

        $query = Conexion::conectar()->prepare($sql);
        $query->bindParam(":id", $this->id, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();
        (new out)->return($result);
    }

    public function editarUser()
    {
        $sql = "UPDATE usuario SET 
                usuario2 = :usuario2,
                correo = :correo,
                nombre = :nombre, 
                password = :password, 
                perfil = :perfil, 
                mostrar = :mostrar, 
                nit = :nit,
                idcoordinadordeadmin = :idcoordinadordeadmin
                WHERE id = :id";

        if ($this->password != "") {
            $encriptar = crypt($this->password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        } else {
            $encriptar = $this->passwordActual;
        }
        $this->perfil == "Administrador" ? $mostrar = 0 : $mostrar = 1;

        if($this->idcoordinadordeadmin != $this->idCordinadorActual){
            $sql1 = "UPDATE ventas SET 
            coordinador = $this->idcoordinadordeadmin
            WHERE coordinador = $this->idCordinadorActual";
            $query1 = Conexion::conectar()->prepare($sql1);
            $query1->execute();
        }
        $query = Conexion::conectar()->prepare($sql);

        $query->bindParam(":id", $this->id, PDO::PARAM_STR);
        $query->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
        $query->bindParam(":usuario2", $this->usuario2, PDO::PARAM_STR);
        $query->bindParam(":correo", $this->correo, PDO::PARAM_STR);
        $query->bindParam(":password", $encriptar, PDO::PARAM_STR);
        $query->bindParam(":perfil", $this->perfil, PDO::PARAM_STR);
        $query->bindParam(":mostrar", $mostrar, PDO::PARAM_STR);
        $query->bindParam(":nit", $this->nit, PDO::PARAM_STR);
        $query->bindParam(":idcoordinadordeadmin", $this->idcoordinadordeadmin, PDO::PARAM_STR);

        if ($query->execute()) {
            (new out)->return(array("ERROR" => "0000", "MESSAGE" => "registro modificado", "RESULT" => true));
        } else {
            (new out)->return(array("ERROR" => $query->errorInfo(), "MESSAGE" => "registro no modificado", "RESULT" => false));
        }
    }

    public function eliminarUser()
    {
        $query = Conexion::conectar()->prepare("UPDATE usuario SET estado = :estado WHERE id = :id");

        $query->bindParam(":estado", $this->estado, PDO::PARAM_STR);
        $query->bindParam(":id", $this->id, PDO::PARAM_STR);

        if ($query->execute()) {
            (new out)->return(array("ERROR" => "0000", "MESSAGE" => "Usuaurio Eliminado", "RESULT" => $this->estado));
        } else {
            (new out)->return(array("ERROR" => $query->errorInfo(), "MESSAGE" => "Usuario No Eliminado", "RESULT" => false));
        }
        $query = null;
    }

}