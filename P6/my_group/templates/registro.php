<?php
$MP_user=null;
MP_Register_Form($MP_user , $user_email);
function MP_Register_Form($MP_user , $user_email)
{//formulario registro amigos de $user_email
    ?>
    <h1>Gestión de Usuarios </h1>
    <form class="fom_usuario" action="?action=my_datos&proceso=registrar" method="POST">
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
            if (!(/\.(jpg)$/i).test(file.name)) {
                alert('El archivo a adjuntar no es una imagen jpg');
                imagen.src = "";
	            document.querySelector("#foto").value="";
            }
            else {
                if (imagen.width.toFixed(0) <= 600 && imagen.height.toFixed(0) <= 600) {
                    alert('Las medidas deben ser menor: 600 * 600');
            } else if (file.size > 20000)
                {
                    alert('El peso de la imagen no puede exceder los 200kb')
                    imagen.src = "";
		            document.querySelector("#foto").value="";
                }
                else {
                    imagen.src = reader.result;
                }
            }
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
?>