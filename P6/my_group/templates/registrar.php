<?php
if (count($_REQUEST) < 3) {
                print ("No has rellenado el formulario correctamente");
                return;
            }
            $query = "INSERT INTO $table (nombre, email,clienteMail) VALUES (?,?,?)";         
            $a=array($_REQUEST['userName'], $_REQUEST['email'],$_REQUEST['clienteMail'] );
            //$pdo1 = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            if (1>$a) {echo "InCorrecto $query";}
            else wp_redirect(admin_url( 'admin-post.php?action=my_datos&proceso=listar'));
?>