<?php
include("../config.php");

$meuID = 0;
if (isset($_GET["id"]) && $_GET["id"]) {
    $meuID = $_GET["id"];
} elseif (isset($_POST["id"]) && $_POST["id"]) {
    $meuID = $_POST["id"];
}

$link = mysqli_connect("localhost", "root", "", "lab"); 
$sql = "SELECT * FROM termo WHERE id = '" . $meuID . "';"; 
$result = mysqli_query($link, $sql);
if (!$result) {
    header("Location: /projeto/admin/termos/index.php"); 
    exit;
}
if (!$row = mysqli_fetch_assoc($result)) {
    header("Location: /projeto/admin/termos/index.php"); 
    exit;
} else {
    $meuID = $row["id"];
    $meuNOME = $row["palavra_ingles"]; 
    $meuTRADUCAO = $row["traducao"];
    $meuDISCIPLINA = $row["disciplina"]; 
    $meuCONTEUDO = $row["contexto_aplicado"]; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["id"] && $_POST["nome"] && $_POST["preco"] && $_POST["disciplina"] && $_POST["contexto"]) {
        $link = mysqli_connect("localhost", "root", "", "lab"); 
        $sql = "UPDATE termo SET palavra_ingles = '" . $_POST["nome"] . "', traducao = '" . $_POST["preco"] . "', disciplina = '" . $_POST["disciplina"] . "', contexto_aplicado = '" . $_POST["contexto"] . "' WHERE id = '" . $_POST["id"] . "';"; 
        $result = mysqli_query($link, $sql);
        header("Location: /projeto/admin/termos/index.php");
        exit;
    }
    $mensagem = "Todos os campos são obrigatórios!";
}

include("../../layout/header.php");
include("../menu.php");
?>
<h1>EDITAR TERMOS</h1> 
<form method="POST">
    <input type="hidden" name="id" value="<?= isset($meuID) ? $meuID : ""; ?>" />
    <table>
        <tr>
            <td align="center" colspan="2">
                <?= isset($mensagem) ? $mensagem : ""; ?>
            </td>
        </tr>
        <tr>
            <td align="right">Palavra em inglês:</td> 
            <td><input type="text" name="nome" value="<?= isset($meuNOME) ? $meuNOME : ""; ?>" /></td>
        </tr>
        <tr>
            <td align="right">Tradução:</td> 
            <td><input type="text" name="preco" value="<?= isset($meuTRADUCAO) ? $meuTRADUCAO : ""; ?>" /></td>
        </tr>
        <tr>
            <td align="right">Disciplina:</td> 
            <td><input type="text" name="disciplina" value="<?= isset($meuDISCIPLINA) ? $meuDISCIPLINA : ""; ?>" /></td>
        </tr>
        <tr>
            <td align="right" valign="top">Contexto Aplicado:</td> 
            <td>
                <textarea name="contexto" style="width: 300px; height: 100px;"><?= isset($meuCONTEUDO) ? $meuCONTEUDO : ""; ?></textarea>
            </td>
        </tr>
        <tr>
            <td align="right" colspan="2"><input type="submit" value="Atualizar" /></td>
        </tr>
    </table>
</form>
<?php include("../../layout/footer.php"); ?>