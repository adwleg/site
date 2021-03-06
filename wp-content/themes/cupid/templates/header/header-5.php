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
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".menu-dropdown-wrapper">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="header_logo">
						<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
							<div>
								<img src="<?php echo esc_url($cupid_data['site-logo']); ?>" width="171" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
							</div>
						</a>
					</div>
				</div>
				<div class="icon-search-menu">
					<i class="fa fa-search"></i>
				</div>
				<div class="menu-dropdown-wrapper collapse">
					<?php if (has_nav_menu('left-menu')) : ?>
						<?php
						wp_nav_menu( array(
							'menu_id' => 'main-menu-left',
							'container' => 'div',
							'container_class' => 'yamm navbar-collapse navbar-collapse-left',
							'theme_location' => 'left-menu',
							'menu_class' => 'nav navbar-nav main-menu',
							'walker' => new G5Plus_Mega_Menu_Walker(),
						) );
						?>
					<?php endif; ?>
					<?php if (has_nav_menu('right-menu')) : ?>
						<?php
						wp_nav_menu( array(
							'menu_id' => 'main-menu-right',
							'container' => 'div',
							'container_class' => 'yamm navbar-collapse navbar-collapse-right',
							'theme_location' => 'right-menu',
							'menu_class' => 'nav navbar-nav main-menu',
							'walker' => new G5Plus_Mega_Menu_Walker(),
						) );
						?>
					<?php endif; ?>
				</div>
			</div>
		</nav>
	</div>
</header>