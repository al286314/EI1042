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
?>