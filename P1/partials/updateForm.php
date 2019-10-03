<main>
	<h1>Gestión de Usuarios </h1>
	<form class="fom_usuario" action="?action=actualizar" method="POST">
        <?php
        include("./gestionBD.php");
        $table = "A_cliente";
        $fila = consultarId($pdo, $table, $_GET["client_id"]);
        $client_id = $fila[0]["client_id"];
        $userName = $fila[0]["nombre"];
        $userSurname = $fila[0]["apellidos"];
        $email = $fila[0]["email"];
        $dni = $fila[0]["dni"];
        $passwd = $fila[0]["clave"];
        $foto = $fila[0]["foto_file"];
        ?>
		<legend>Datos básicos</legend>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $userName ?>"
		 placeholder="Miguel" />
		<br/>
		<label for="apellidos">Apellidos</label>
		<br/>
		<input type="text" name="userSurname" class="item_requerid" size="20" maxlength="25" value="<?php print $userSurname ?>"
		 placeholder="Cervantes" />
		<br/>
		<label for="email">Email</label>
		<br/>
		<input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $email ?>"
		 placeholder="kiko@ic.es" />
		<br/>
		<label for="dni">DNI</label>
		<br/>
		<input type="text" name="dni" class="item_requerid" size="20" maxlength="9" value="<?php print $dni ?>"
		 placeholder="12345678A" />
		<br/>
		<label for="passwd">Clave</label>
		<br/>
		<input type="password" name="passwd" class="item_requerid" size="8" maxlength="25" value="<?php print $passwd ?>"
		/>
		<br/>
		<label for="foto">Foto</label>
		<br/>
		<input type="text" name="foto" class="item_requerid" size="20" maxlength="25" value="<?php print $foto ?>"
		 placeholder="foto.jpg" />
		<br/>
		<input type="hidden" name="client_id" value="<?php print $client_id ?>"/>
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
</main>