<?php
	require_once 'usuarios.php';
	$u = new usuario
?>


//antes de fechar a tag body
<?php
// verificar se clicou no botao
if(isset($_POST['nome']))
{
	$nome = addslashes($_POST['nome']); //addslashes bloqueia para que pessoas possam entrar e mandar forms maliciosos
	$login = addslashes($_POST['login']); // escrever do mesmo jeito que estiver no imput name
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confirmaSenha = addslashes($_POST['confirmaSenha']);

	//verificar se está preenchido

	if(!empty($nome)&& !empty(login) && !empty(email) && !empty(senha) && !empty(confirmaSenha))
	{
		$u - > conectar("roll6","localhost","root","jesus");
		if($u - >msgErro == "") // se estiver tudo ok
		{
			if($senha == $confirmaSenha)
			{
				if($u- >cadastrar($nome,$login,$email,$senha))
				{
					echo "Cadastrado com sucesso!"
				}
				else{
					echo "E-mail já cadastrado!"
				}
			}
			else{
				echo "Senhas não conferem!";
			}
		}
		else
		{
			echo "Erro:  ".$u - >msgErro;
		}

	}else
	{
		echo "Preencha todos os campos!!";
	}
}

?>