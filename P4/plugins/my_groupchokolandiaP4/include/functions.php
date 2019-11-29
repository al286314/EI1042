<?php
/**
 * * Descripción: Controlador principal
 * *
 * * Descripción extensa: Iremos añadiendo cosas complejas en PHP.
 * *
 * * @author  Lola <dllido@uji.es> 
 * * @copyright 2018 Lola
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 * */


//Estas 2 instrucciones me aseguran que el usuario accede a través del WP. Y no directamente
if ( ! defined( 'WPINC' ) ) exit;

if ( ! defined( 'ABSPATH' ) ) exit;




//Funcion instalación plugin. Crea tabla
function MP_CrearTchokolandia($tabla){
    
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    $query="CREATE TABLE IF NOT EXISTS $tabla (person_id INT(11) NOT NULL AUTO_INCREMENT, nombre VARCHAR(100),  email VARCHAR(100),  foto_file VARCHAR(25), clienteMail VARCHAR(100),  PRIMARY KEY(person_id))";
    $consult = $MP_pdo->prepare($query);
    $consult->execute (array());
}


function MP_Register_Formchokolandia($MP_user , $user_email)
{//formulario registro amigos de $user_email
    ?>
    <h1>Gestión de Usuarios </h1>
    <form class="fom_usuario" action="?action=my_datos&proceso=registrar" method="POST" enctype="multipart/form-data">
        <label for="clienteMail">Tu correo</label>
        <br/>
        <input type="text" name="clienteMail"  size="20" maxlength="25" value="<?php print $user_email?>"
        readonly />
        <br/>
        <legend>Datos básicos</legend>
        <label for="nombre">Nombre</label>
        <br/>
        <input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["userName"] ?>"
        placeholder="Miguel Cervantes" />
        <br/>
        <label for="email">Email</label>
        <br/>
        <input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["email"] ?>"
        placeholder="kiko@ic.es" />
        <br/>
<label for="foto_file">Foto</label>
<br/>
<input type="file" id="foto" name="foto" class="item_requerid" value="<?php print $foto ?>" required />
<br/>
<br>
<p> <img id="img_foto" src="" width="200" height="200"></p>
<script type="text/javascript" defer charset="utf-8">

      function mostrarFoto(file, imagen) {
	  //carga la imagen de file en el elemento src imagen
         var reader = new FileReader();
         reader.addEventListener("load", function () {
            imagen.src = reader.result;
         });
         reader.readAsDataURL(file);
      }

      function ready() {
         var fichero = document.querySelector("#foto");
         var imagen  = document.querySelector("#img_foto");
	  //escuchamos evento selección nuevo fichero.
         fichero.addEventListener("change", function (event) {
            mostrarFoto(this.files[0], imagen);
         });
      }

      ready();

   </script>

        <input type="submit" value="Enviar">
        <input type="reset" value="Deshacer">
    </form>
<?php
}

function MP_Update_Formchokolandia($MP_user , $user_email, $foto)
{//formulario update amigos de $user_email
    ?>
    <h1>Gestión de Usuarios </h1>
    <form class="fom_usuario" action="?action=my_datos&proceso=update" method="POST" enctype="multipart/form-data">
        <label for="clienteMail">Tu correo</label>
        <br/>
        <input type="text" name="clienteMail"  size="20" maxlength="25" value="<?php print $user_email?>"
        readonly />
        <br/>
        <legend>Datos básicos</legend>
        <label for="nombre">Nombre</label>
        <br/>
        <input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["userName"] ?>"/>
        <br/>
        <label for="email">Email</label>
        <br/>
        <input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["email"] ?>"/>
        <br/>
        <input type="hidden" name="person_id" value="<?php print $MP_user['person_id'] ?>">
        <label for="foto_file">Foto</label>
        <br/>
        <input type="file" id="foto" name="foto" class="item_requerid" value="<?php print $foto ?>" required />
        <br/>
        <br>
        <p> <img id="img_foto" src="<?php print $foto ?>" width="200" height="200"></p>
        <script type="text/javascript" defer charset="utf-8">

      function mostrarFoto(file, imagen) {
	  //carga la imagen de file en el elemento src imagen
         var reader = new FileReader();
         reader.addEventListener("load", function () {
            imagen.src = reader.result;
         });
         reader.readAsDataURL(file);
      }

      function ready() {
         var fichero = document.querySelector("#foto");
         var imagen  = document.querySelector("#img_foto");
	  //escuchamos evento selección nuevo fichero.
         fichero.addEventListener("change", function (event) {
            mostrarFoto(this.files[0], imagen);
         });
      }

      ready();

        </script>

        <input type="submit" value="Enviar">
        <input type="reset" value="Deshacer">
    </form>
<?php
}

//CONTROLADOR
//Esta función realizará distintas acciones en función del valor del parámetro
//$_REQUEST['proceso'], o sea se activara al llamar a url semejantes a 
//https://host/wp-admin/admin-post.php?action=my_datos&proceso=r 

function MP_my_datoschokolandia()
{ 
    global $user_ID , $user_email,$table;
    
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    wp_get_current_user();
    if ('' == $user_ID) {
                //no user logged in
                exit;
    }
    
    
    
    if (!(isset($_REQUEST['action'])) or !(isset($_REQUEST['proceso']))) { print("Opciones no correctas $user_email"); exit;}

    get_header();
    echo '<div class="wrap">';

    switch ($_REQUEST['proceso']) {
        case "registro":
            $MP_user=null; //variable a rellenar cuando usamos modificar con este formulario
            MP_Register_Formchokolandia($MP_user,$user_email);
            break;
        case "registrar":
            if (count($_REQUEST) < 3) {
                print ("No has rellenado el formulario correctamente");
                return;
            }
            
            
            $fotoURL="";
			$fotoURL2="";
			$IMAGENES_USUARIOS = '/storage/ssd1/126/11109126/public_html/Lab/P1/fotos/';
			$Base = '/Lab/P1/fotos/';
			if(array_key_exists('foto', $_FILES) && $_POST['email']) {
				$fotoURL = $IMAGENES_USUARIOS.$_POST['userName']."_".$_FILES['foto']['name'];
				$fotoURL2 = $Base.$_POST['userName']."_".$_FILES['foto']['name'];
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $fotoURL)){ 
					echo "foto subida con éxito";
				}
			}
			
	
            
            $query = "INSERT INTO $table (nombre, email,foto_file,clienteMail) VALUES (?,?,?,?)";         
            $a=array($_REQUEST['userName'], $_REQUEST['email'],$fotoURL2,$_REQUEST['clienteMail'] );
            //$pdo1 = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            if (1>$a) {echo "InCorrecto $query";}
            else wp_redirect(admin_url( 'admin-post.php?action=my_datos&proceso=listar'));
            break;
        case "listar":
            ?>
            <style>
table.tablaAmigos {
  font-family: "Proxima Nova", Consola, serif;
  border: 1px solid #AAAAAA;
  background-color: yellow;
  width: 100%;
  text-align: center;
  border-collapse: collapse;
}
table.tablaAmigos td, table.tablaAmigos th {
  border: 1px solid green;
  padding: 4px 2px;
}
table.tablaAmigos tbody td {
  font-size: 15px;
}
table.tablaAmigos tr:nth-child(even) {
  background: PINK;
}
table.tablaAmigos th {
  background: ORANGE;
  background: -moz-linear-gradient(top, #dde6c0 0%, #d6e1b3 66%, #D2DEAB 100%);
  background: -webkit-linear-gradient(top, #dde6c0 0%, #d6e1b3 66%, #D2DEAB 100%);
  background: linear-gradient(to bottom, #dde6c0 0%, #d6e1b3 66%, #D2DEAB 100%);
  border-bottom: 1px solid #FFFFFF;
}
table.tablaAmigos th {
  font-size: 17px;
  font-weight: bold;
  color: #FF00FF;
  text-align: center;
  border-left: 0px solid #FFFFFF;
}

table.tablaAmigos tfoot .links a{
  display: inline-block;
  background: GREY;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 7px;
}
</style>
<?php
            //Listado amigos o de todos si se es administrador.
            $a=array();
            if (current_user_can('administrator')) {$query = "SELECT     * FROM       $table ";}
            else {$campo="clienteMail";
                $query = "SELECT     * FROM  $table      WHERE $campo =?";
                $a=array( $user_email);
 
            } 

            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            $rows=$consult->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($rows)) {/* Creamos un listado como una tabla HTML*/
                print '<div><table class="tablaAmigos"><tr>';
                foreach ( array_keys($rows[0])as $key) {
                    echo "<th>", $key,"</th>";
                }
                print "</tr>";
                 foreach ($rows as $row) {
                    print "<tr>";
                    foreach ($row as $key => $val) {
                        if ($key=="person_id"){
                            $person_id=$val;
                        }
                        if ($key=="foto_file"){
							echo "<td>", "<img src='$val' width='100' height='100'>", "</td>";
						} else {
							echo "<td>", $val, "</td>";}

                    }
                    print "<td><a href='admin-post.php?action=my_datos&proceso=borrar&person_id=$person_id'>Borrar</a></td>";
                    print "<td><a href='admin-post.php?action=my_datos&proceso=modificar&person_id=$person_id'>Modificar</a></td>";
                    print "</tr>";
                }
                print "</table></div>";

            }
            else{echo "No existen valores";}
            break;
        case 'borrar':
            print $_GET["person_id"];
            wp_redirect(admin_url( 'admin-post.php?action=my_datos&proceso=listar'));
            break;
        case 'modificar':
            //consultar la base de datos y asignar variables
            $person_id=$_GET['person_id'];
            $query = "SELECT * FROM $table WHERE person_id=$person_id";
            
            $consult = $MP_pdo->query($query);
            $row = $consult->fetch(PDO::FETCH_ASSOC);
            
            $MP_user = null;
            $MP_user['userName'] = $row['nombre'];
            $MP_user['email'] = $row['email'];
            $MP_user['person_id'] = $person_id;
            $foto = $row['foto_file'];

            MP_Update_Formchokolandia($MP_user,$user_email,$foto);
            break;
        case 'update':
            if (count($_REQUEST) < 3) {
                print ("No has rellenado el formulario correctamente");
                return;
            }
            
            
            $fotoURL="";
			$fotoURL2="";
			$IMAGENES_USUARIOS = '/storage/ssd1/126/11109126/public_html/Lab/P1/fotos/';
			$Base = '/Lab/P1/fotos/';
			if(array_key_exists('foto', $_FILES) && $_POST['email']) {
				$fotoURL = $IMAGENES_USUARIOS.$_POST['userName']."_".$_FILES['foto']['name'];
				$fotoURL2 = $Base.$_POST['userName']."_".$_FILES['foto']['name'];
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $fotoURL)){ 
					echo "foto subida con éxito";
				}
			}
			
	    
            
            $query = "UPDATE $table SET nombre=?, email=?,foto_file=?,clienteMail=? WHERE person_id=?";         
            $a=array($_REQUEST['userName'], $_REQUEST['email'],$fotoURL2,$_REQUEST['clienteMail'],$_REQUEST['person_id'] );
            //$pdo1 = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            if (1>$a) {echo "InCorrecto $query";}
            else wp_redirect(admin_url( 'admin-post.php?action=my_datos&proceso=listar'));
            break;            
        default:
            print "Opción no correcta";
        
    }
    echo "</div>";
    // get_footer ademas del pie de página carga el toolbar de administración de wordpres si es un 
    //usuario autentificado, por ello voy a borrar la acción cuando no es un administrador para que no aparezca.
    if (!current_user_can('administrator')) {

        // for the admin page
        remove_action('admin_footer', 'wp_admin_bar_render', 1000);
        // for the front-end
        remove_action('wp_footer', 'wp_admin_bar_render', 1000);
    }

    get_footer();
    }
//add_action('admin_post_nopriv_my_datos', 'my_datos');
//add_action('admin_post_my_datos', 'my_datos'); //no autentificados
?>
