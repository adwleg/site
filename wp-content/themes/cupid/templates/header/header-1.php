<?php
global $cupid_data;
$header_layout = get_post_meta(get_the_ID(),'header-style',true);
if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
	$header_layout =  $cupid_data['header-layout'];
}
$header_class = array();
$header_class[] = 'header-' . $header_layout;
?>
<header class="<?php g5plus_the_attr_value($header_class) ?>">
	<div class="header">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="header_logo">

                            <a  href="/" title="<?php wp_title(); ?>" rel="home">
							<div>
								<img src="http://www.asilolegnano.com/wp-content/uploads/2016/01/AsiloNidoAmiciWInnieLegnano-1.jpg" width="171" alt="<?php echo wp_title(); ?>" />
                            </div>
                            
						</a>
					</div>
				</div>
				<?php
					$menu_margin_type = 0;

					if ( class_exists( 'WooCommerce' ) && isset($cupid_data['show-mini-cart']) && $cupid_data['show-mini-cart'] ) {
						$menu_margin_type += 1;
					}
					if (isset($cupid_data['show-search-button']) && $cupid_data['show-search-button'] ) {
						$menu_margin_type += 1;
					}
					$menu_margin_right = 'menu-margin-right-' . $menu_margin_type;
				?>
				<?php if ( class_exists( 'WooCommerce' )  && isset($cupid_data['show-mini-cart']) && $cupid_data['show-mini-cart'] ):?>
					<div class="widget_shopping_cart_content">
						<?php get_template_part('woocommerce/cart/mini-cart'); ?>
					</div>
				<?php endif;?>
				<?php if (isset($cupid_data['show-search-button']) && $cupid_data['show-search-button'] ): ?>
					<div class="icon-search-menu">
						<i class="fa fa-search"></i>
					</div>
				<?php endif;?>
				<?php if (has_nav_menu('primary')) : ?>
					<?php
					wp_nav_menu( array(
						'menu_id' => 'main-menu',
						'container' => 'div',
						'container_class' => 'collapse yamm navbar-collapse ' . esc_attr($menu_margin_right),
						'theme_location' => 'primary',
						'menu_class' => 'nav navbar-nav main-menu',
						'walker' => new G5Plus_Mega_Menu_Walker(),
					) );
					?>
				<?php endif; ?>
			</div>
		</nav>
	</div>
</header>
