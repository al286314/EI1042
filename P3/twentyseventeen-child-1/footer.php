<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
			<div>
			    <h3><b> Autores </b></h3>
			    <p><b> David Mayo Azorín </b></p>
			    <p><b> Carlos Tena Marín </b></p>
			    <p><b> Laura Marín Serrano </b></p>
			</div>
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) :
					?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
								)
							);
						?>
					</nav><!-- .social-navigation -->
					<?php
				endif;
				get_template_part( 'template-parts/footer/site', 'info' );
				?>
			</div><!-- .wrap -->
			<div align="center">
	            <p> © 2019, Chokolandia, Inc. Todos los derechos reservados. Chokolandia, el logotipo de Chokolandia son marcas comerciales o marcas registradas de Chokolandia, Inc. tanto en España como en el resto del mundo. Otras marcas o nombres de productos son marcas comerciales de sus respectivos propietarios. Las transacciones fuera de España se realizan a través de Chokolandia International, S.à r.l.
	            </p> 
	        </div>
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
