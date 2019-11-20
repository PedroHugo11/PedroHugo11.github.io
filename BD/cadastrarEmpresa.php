<?php

include "connBD.php";

session_start();
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$nome = $_POST['nome'];
		$categoria = $_POST['categoria'];
		$descricao = $_POST['descricao'];
		$ano = $_POST['ano'];
		$site = $_POST['site'];
		$id = $_POST['id'];
        
        ini_set('post_max_size', '50M');
        ini_set('upload_max_filesize', '50M');
        ini_set('max_execution_time', 0);
        ini_set('max_input_time', 0);

        $name = $_FILES['logo']['name'];
        $tmp_name = $_FILES['logo']['tmp_name'];
        $type= $_FILES['logo']['type'];
        $size = $_FILES['logo']['size'];
        $error = $_FILES['logo']['error'];

        $extensao = pathinfo ( $name, PATHINFO_EXTENSION );
        $extensao = strtolower ( $extensao );

		$novo_nome = md5( time () ) . '.' . $extensao; //define o nome do arquivo
        $diretorio = "uploads/"; //define o diretorio para onde enviaremos o arquivo
        
        move_uploaded_file($tmp_name, $diretorio.$novo_nome);//efetua o upload
     

		$sql = "insert into empresa (id, nome, categoria, descricao, logo, ano, site) 
		values ('$id', '$nome', '$categoria', '$descricao', '$novo_nome', '$ano', '$site');";
			
			if(mysqli_query($conn, $sql)){
				$_SESSION['msg'] = "Cadastrado com sucesso!";
			}else{
				$_SESSION['msg'] =  mysqli_error($conn);
			}
			header('location: ../areaAdm.php');
	}
?>
