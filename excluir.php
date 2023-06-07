<?php
session_start();

class Database {
    private $host = 'localhost';
    private $dbname = 'chat_app_db';
    private $usuario = 'root';
    private $senha = '';
    private $conexao;

    public function __construct() {
        try {
            $this->conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->usuario, $this->senha);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $erro) {
            echo "<h1>ERRO DE CONEXÃO COM O BANCO DE DADOS!</h1><br>" . $erro->getMessage();
            exit();
        }
    }

    public function deletarDepoimentos($usuario_id) {
        try {
            $deletar = $this->conexao->prepare("DELETE depoimento FROM depoimento 
                                                JOIN cadastro ON depoimento.usuario_id = cadastro.usuario_id 
                                                WHERE cadastro.usuario_id = :usuario_id");
            $deletar->bindParam(':usuario_id', $usuario_id);
            $deletar->execute();
        } catch (PDOException $erro) {
            echo "<h1>NÃO FOI POSSÍVEL CONCLUIR!</h1><br>" . $erro->getMessage() . "<br><br><a href='listar-alunos.php'>Voltar para listagem</a>";
            exit();
        }
    }
}

if (!isset($_SESSION['NomeUsuario']) || empty($_SESSION['NomeUsuario'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];

    $database = new Database();
    $database->deletarDepoimentos($usuario_id);

    header('Location: minhahistoria.php');
    exit();
}
?>
