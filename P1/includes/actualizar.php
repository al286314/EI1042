<?php
include("./gestionBD.php");

function handler($pdo,$table)
{
    $datos = $_REQUEST;
    if (count($_REQUEST) < 7) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }
    $query = "UPDATE $table SET nombre=?, apellidos=?, email=?, dni=?, clave=?, foto_file=?
                        WHERE client_id=?";
                       
    echo $query;
    try { 
        $a=array($_REQUEST['userName'], $_REQUEST['userSurname'],   $_REQUEST['email'], $_REQUEST['dni'],
            $_REQUEST['passwd'], $_REQUEST['foto'], $_REQUEST['client_id'] );
        print_r ($a);
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($_REQUEST['userName'], $_REQUEST['userSurname'],   $_REQUEST['email'], $_REQUEST['dni'],
            $_REQUEST['passwd'], $_REQUEST['foto'], $_REQUEST['client_id']  ));
        if (1>$a)echo "InCorrecto";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

$table = "A_cliente";
var_dump($_POST);
handler( $pdo,$table);
?>