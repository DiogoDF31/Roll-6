<?php

class Usuario
{
	private $pdo;
	public $msgErro = "ei";//sem erro

	public function conectar($nome, $host, $usuario,$senha)
	{
		global $pdo;
		Try
		{
			$pdo =  new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
		} catch (PDOexception $e){
			$msgERRO = $e - >getMessage();
		}
	}

	public function cadastrar($nome,$login,$email,$senha);
	{
		global $pdo;
		//verificar se já existe o e-mail cadastrador
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE login = :e");

		$sql- >bindValue(":e", $login);
		$sql- >execute();
		if($sql->rowCount() > 0 )
		{
			return false; // ja esta cadastrada
		}
		else
		{
			//caso nao, cadastrar
			$sql = $pdo->prepare("INSERT INTO usuarios(nome,login,email,senha)VALUES (:n, :l, :e, :s)");
			$sql- >bindValue(":n", $nome);
			$sql- >bindValue(":l", $login);
			$sql- >bindValue(":e", $email);
			$sql- >bindValue(":s", md5($senha));
			$sql- >execute();
			return true;
		}

	}

	public function logar($login,$senha)
	{
		global $pdo;
		//verificar se o email e senha estao cadastrado, se sim
		$sql = $pdo - >prepare("SELECT id_usuario FROM usuarios WHERE login = :e AND senha = :s");
		$sql - >bindValue(":l", $login);
		$sql- >bindValue(":s", md5($senha));
		$sql - >execute();
		if($sql- >rowCount() > 0)
			{
				//entrar no sistema (sessao)
				$dado = $sql - >fetch(); //tranforma um array com os dados da coluna
				session_start();
				$_SESSION['id_usuario'] = $dado['id_usuario'];
				return true; //logado com sucesso
			}
			else
			{
				return false;//nao foi possivel logar
		}
	}

}

?>