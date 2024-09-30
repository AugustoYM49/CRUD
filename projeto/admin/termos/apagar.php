<?php
include("../config.php");

$link = mysqli_connect("localhost", "root", "", "lab"); 
$sql = "SELECT * FROM termo WHERE id = '" . $_GET["id"] . "';"; 
$result = mysqli_query($link, $sql);
if (!$result) {
    header("Location: /projeto/admin/termos/index.php"); 
    exit;
}
if (!$row = mysqli_fetch_assoc($result)) {
    header("Location: /projeto/admin/termos/index.php"); 
    exit;
}
if (isset($_GET["apagar"]) && $_GET["apagar"] == "sim") {
    $sql = "DELETE FROM termo WHERE id = '" . $row["id"] . "';"; 
    $result = mysqli_query($link, $sql);
    header("Location: /projeto/admin/termos/index.php"); 
    exit;
}

include("../../layout/header.php");
include("../menu.php");
?>

<h1>APAGAR TERMOS</h1>

<table>
    <tr>
        <td align="right">Palavra em inglês:</td>
        <td><?= $row["palavra_ingles"]; ?></td> 
    </tr>
    <tr>
        <td align="right">Tradução:</td>
        <td><?= $row["traducao"]; ?></td> 
    </tr>
    <tr>
        <td align="right"><a href="/projeto/admin/termos/apagar.php?id=<?= $row["id"]; ?>&apagar=sim"><input type="button" value="Sim"></a></td>
        <td><a href="/projeto/admin/termos/index.php"><input type="button" value="Não"></a></td> 
    </tr>
</table>
<br>

<?php include("../../layout/footer.php"); ?>