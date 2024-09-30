<?php
include("../../layout/header.php");
include("../menu.php");
include("../config.php");
?>
<h1>TERMOS</h1>

<form method="GET" action="">
    <input type="text" name="search" placeholder="Buscar por disciplina ou termo em inglês" required>
    <button type="submit">Buscar</button>
</form>

<a href="/projeto/admin/termos" style="color: black;">Retornar</a><br><br>

<a style="color: black;" href="/projeto/admin/termos/adicionar.php">+ adicionar</a><br><br>

<table border="1px">
    <tr>
        <th style="padding: 10px;">Palavra em Inglês</th>
        <th style="padding: 10px;">Tradução</th>
        <th style="padding: 10px;">Disciplina</th>
        <th style="padding: 10px;">Definição</th>
        <th style="padding: 10px;">Editar</th>
        <th style="padding: 10px;">Apagar</th>
    </tr>
    <?php
 
    $link = mysqli_connect("localhost", "root", "", "lab");

   
    $sql = "SELECT * FROM termo";
    

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = mysqli_real_escape_string($link, $_GET['search']);
        $sql .= " WHERE disciplina LIKE '%$search%' OR palavra_ingles LIKE '%$search%'";
    }

    $sql .= " ORDER BY disciplina;";
    $result = mysqli_query($link, $sql);

    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
            echo "<td style=\"padding: 10px;\">" . htmlspecialchars($row["disciplina"]) . "</td>";
            echo "<td style=\"padding: 10px;\">" . htmlspecialchars($row["palavra_ingles"]) . "</td>";
            echo "<td style=\"padding: 10px;\">" . htmlspecialchars($row["traducao"]) . "</td>";    
            echo "<td style=\"padding: 10px;\">" . htmlspecialchars($row["contexto_aplicado"]) . "</td>";
           
            ?><td style="padding: 10px;"><a style="color: black;" href="/projeto/admin/termos/editar.php?id=<?=$row["id"];?>">editar</a></td><?php
            ?><td style="padding: 10px;"><a style="color: black;" href="/projeto/admin/termos/apagar.php?id=<?=$row["id"];?>">apagar</a></td><?php
        echo "</tr>";
    }
    ?>
</table>
<br>

<?php include("../../layout/footer.php"); ?>