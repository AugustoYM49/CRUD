<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if ($_POST["palavra_ingles"] && $_POST["traducao"] && $_POST["disciplina"] && $_POST["contexto_aplicado"]) {
   
        $link = mysqli_connect("localhost", "root", "", "lab"); 

        
        $sql = "INSERT INTO termo (palavra_ingles, traducao, disciplina, contexto_aplicado) VALUES ('" . $_POST["palavra_ingles"] . "', '" . $_POST["traducao"] . "', '" . $_POST["disciplina"] . "', '" . $_POST["contexto_aplicado"] . "');";
        $result = mysqli_query($link, $sql);

       
        header("Location: /projeto/admin/termos/index.php");
        exit;
    }
    $mensagem = "Todos os campos são obrigatórios!";
}

include("../../layout/header.php");
include("../menu.php");
?>
<h1>Adicionar termo</h1>
<form method="POST">
    <table>
        <tr>
            <td align="center" colspan="2">
                <?= isset($mensagem) ? $mensagem : ""; ?>
            </td>
        </tr>
        <tr>
            <td align="right">Palavra em inglês:</td>
            <td><input type="text" name="palavra_ingles" value="<?= isset($_POST["palavra_ingles"]) ? $_POST["palavra_ingles"] : ""; ?>" /></td>
        </tr>
        <tr>
            <td align="right">Tradução:</td>
            <td><input type="text" name="traducao" value="<?= isset($_POST["traducao"]) ? $_POST["traducao"] : ""; ?>" /></td>
        </tr>
        <tr>
            <td align="right">Disciplina:</td>
            <td><input type="text" name="disciplina" value="<?= isset($_POST["disciplina"]) ? $_POST["disciplina"] : ""; ?>" /></td>
        </tr>
        <tr>
            <td align="right" valign="top">Definição:</td>
            <td>
                <textarea name="contexto_aplicado" style="width: 300px; height: 100px;"><?= isset($_POST["contexto_aplicado"]) ? $_POST["contexto_aplicado"] : ""; ?></textarea>
            </td>
        </tr>
        <tr>
            <td align="right" colspan="2"><input type="submit" value="Adicionar" /></td>
        </tr>
    </table>
</form>
<?php include("../../layout/footer.php"); ?>