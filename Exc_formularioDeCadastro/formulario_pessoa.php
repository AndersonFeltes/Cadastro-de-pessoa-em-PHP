<?php
    if(!isset($pessoa)){
        $pessoa['codigo']="";
        $pessoa['nome']="";
        $pessoa['email']="";
        $pessoa['foto']="";
    }
?>

<div id="form">
    <form name="Form-Pessoa" action="pessoa.php" method="POST" enctype="multipart/form-data">
        
        <div class="input">
            <input type="text" name="codigo" required placeholder="codigo" value="<?php echo $pessoa ['codigo']?>" />
        </div>

        <div class="input">
            <input type="text" name="nome" required placeholder="nome" value="<?php echo $pessoa ['nome']?>" />
        </div>

        <div class="input">
            <input type="e-mail" name="email" required placeholder="email" value="<?php echo $pessoa ['email']?>" />
        </div>
            
        <div class="captura-imagem">
            <div id="arquivo">
                <input type="file" name="foto" required value="<?php echo $pessoa ['foto'] ?>" />
            </div>
        </div>
        <div id="submit">
            <input type="submit" name="Enviar" value="Enviar" >
        </div>
    </form>
</div>
