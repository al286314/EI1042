<?php
  add_filter("the_content", "mfp_Fix_Text_Spacing");
  // Automatically correct double spaces from any post
  function mfp_Fix_Text_Spacing($the_Post)
  {
  $the_New_Post = str_replace("chokolandia", "CHOKOLANDIA", $the_Post);
  return $the_New_Post;
  }

  /*
Plugin Name: my_Plugin_Widget1
Description: Este plugin añade un widget que pone un título y una descripción.
Author: dllido
Author Email: dllido@uji.es
Version: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
// Registramos el widget
function load_my_widget() {
	register_widget( 'my_widget1' );
}
add_action( 'widgets_init', 'load_my_widget' );
// Creamos el widget 
class my_widget1 extends WP_Widget {
public function __construct() {
		$widget_ops = array( 
			'classname' => 'my_widget',
			'description' => 'My Widget is awesome',
		);
		parent::__construct( 'my_widget1', 'My Widget1', $widget_ops );
	}	
// Creamos la parte pública del widget
public function widget( $args, $instance ) {
$shop = apply_filters( 'widget_title', $instance['shop'] );
$address = apply_filters( 'widget_title', $instance['address'] );
// los argumentos del antes y después del widget vienen definidos por el tema
echo $args['before_widget'];
if ( ! empty( $shop ) )
echo $args['before_title'] . $shop . $args['after_title'];
// Aquí es donde debemos introducir el código que queremos que se ejecute
echo $address;
echo $args['after_widget'];
}
		
// Backend  del widget
public function form( $instance ) {
if ( isset( $instance[ 'shop' ] ) ) {
$shop = $instance[ 'shop' ];
$address = $instance[ 'address' ];
}
else {
$shop = __( 'Nombre de la tienda', 'my_widget_domain' );
$address = __( 'Dirección', 'my_widget_domain' );
}
// Formulario del backend
?>
<p>
<label for="<?php echo $this->get_field_id( 'shop' ); ?>"><?php _e( 'Nombre de la tienda' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'shop' ); ?>" name="<?php echo $this->get_field_name( 'shop' ); ?>" type="text" value="<?php echo esc_attr( $shop ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Dirección' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" />
</p>
<?php	
}
// Actualizamos el widget reemplazando las viejas instancias con las nuevas
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['shop'] = ( ! empty( $new_instance['shop'] ) ) ? strip_tags( $new_instance['shop'] ) : '';
$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
return $instance;
}
} // La clase wp_widget termina aquí

?>
