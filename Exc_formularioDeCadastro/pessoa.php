<?php
//conectando arquivo de conexão
include "conexao_formulario.php";
//conectando arquivo do formulario
include "formulario_pessoa.php";

//testando se ouve a tentativa de envio do formulario
if(isset($_POST['Enviar'])){
    //armazenando as informações dos campos
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    
    //testando se foi selecionado algum arquivo
    if(isset($_FILES['foto'])){
        //colocando imagem em uma variavel
        $foto = $_FILES['foto'];

        //testando se ouver algum erro
        if($foto['error']){
            die("Falha ao enviar a foto!!");
        }

        //testando o tamanho do arquivo(size retorna o tamnho)
        if($foto['size'] > 2097152){
            die("Arquivo muito grande!! Máximo: 2MB");
            //1024 bytes == 1kb
            //1024 kb == 1MB
        }    
        //selecionando pasta para salvar imagem em lacalhost
        $pasta = "imagens/";
        //capturando o nome do arquivo
        $nomeDaFoto = $foto['name'];
        //definindo um novo nome para o arquivo( uniqid gera uma id nova e unica para o arquivo)
        $novoNome = uniqid();
        /*capturando a extenção do arquivo(strtolower converte todos os caracteres em minusculo, pathinfo retorna a extencao do arquivo
        que esta armazenada na variavel $nomeDaFoto(no campo 'name') )*/
        $extencao = strtolower(pathinfo($nomeDaFoto, PATHINFO_EXTENSION));
            
        //verificando a extenção do arquivo(testando para aceitar apenas jpg e png)
        if($extencao != "jpg" && $extencao_imagem != "png"){
            die("Tipo de arquivo nao aceito. Apenas PNG ou JPG!");
        }

        //criando um path com caminho para a imagem pasta/novoId/extenção
        $path = $pasta.$novoNome.".".$extencao;
        //enviando arquivo da foto
        $funcionou = move_uploaded_file($foto["tmp_name"], $path);
        //testando se funcionou o envio do arquivo
        if($funcionou){
            $conn->query("INSERT INTO imagens (nome, path) VALUES ('', '')");
            echo("Arquivo enviado!!");
        }
        else{
            echo("Falha ao enviar o arquivo");    
        }
        //enviando os dados para o banco de dados
        $sql = "INSERT INTO pessoa (codigo, nome, email, foto) 
        VALUES ($codigo, '$nome', '$email', '$novoNome')";
        if(mysqli_query($conn, $sql)){
            echo "Usuario cadastrado!!";
        }
    }
}

echo "<table border='1' cellpandding='10'>
<thread><tr><th>Codigo</th><th>Nome</th><th>Email</th><th>Foto</th></tr><thread>
<tbody>";
$sql_query = $conn->query("SELECT * FROM pessoa") or die($conn->error);
while($pessoa = $sql_query->fetch_array()){
    echo "<tr>
            <td>".$pessoa['codigo']."</td>
            <td>".$pessoa['nome']."</td>
            <td>".$pessoa['email']."</td>
            <td> <img height='60' alt='' src='".$pessoa['path']."'/></td>
          </tr>";
        }

mysqli_close($conn);