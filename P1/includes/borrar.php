<?php 
include("./gestionBD.php");
function handler($pdo,$table)
{
    $borrado = borrar($pdo,$table,$_GET["client_id"]);
    
    print("Si el cliente con id ". $_GET["client_id"]. " existe, se borrará de la base de datos");

}
$table = "A_cliente";

try{handler($pdo,$table);}
catch (PDOException $e) {
echo "Failed to get DB handle: " . $e->getMessage() . "\n";
exit;
}

    ?>