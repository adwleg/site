<?php
/**
 * Template Name: LandingPage
 *
 * @package cupid
 */

$home_pages = array(
    array(
        'name' => 'Demo 01',
        'image' => get_template_directory_uri() .  '/assets/landing-page/images/homepage-1.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-1' )->ID )
    ),
    array(
        'name' => 'Demo 02',
        'image' => get_template_directory_uri() .  '/assets/landing-page/images/homepage-2.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-2' )->ID )
    ),
    array(
        'name' => 'Demo 03',
        'image' => get_template_directory_uri() .  '/assets/landing-page/images/homepage-3.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-3' )->ID )
    ),
    array(
        'name' => 'Demo 04',
        'image' => get_template_directory_uri() .  '/assets/landing-page/images/homepage-4.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-4' )->ID )
    ),
    array(
        'name' => 'Demo 05',
        'image' => get_template_directory_uri() .  '/assets/landing-page/images/homepage-5.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-5' )->ID )
    ),
    array(
        'name' => 'Demo 06',
        'image' => get_template_directory_uri() .  '/assets/landing-page/images/homepage-6.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-6' )->ID )
    )
);

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>">
    <meta property="og:url" content="<?php echo esc_url(get_the_permalink())?>" />
    <meta name="robots" content="noindex, follow" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php global $cupid_data; ?>

    <?php $favicon = '';
    if (isset($cupid_data['favicon']) && !empty($cupid_data['favicon']) ) {
        $favicon = $cupid_data['favicon'];
    } else {
        $favicon = get_template_directory_uri() . "/assets/images/favicon.ico";
    }

    ?>

    <link rel="shortcut icon" href="<?php echo esc_url($favicon);?>" type="image/x-icon">
    <link rel="icon" href="<?php echo esc_url($favicon);?>" type="image/x-icon">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() . '/assets/css/proximaNova-fonts.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() . '/assets/landing-page/css/template.css' ?>">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
    <header>
        <div class="header-top">
            <div class="container">
                <div class="header-top-left col-sm-5">
                    <div class="header-top-left-inner">
                        <img class="logo img-responsive" src="<?php echo  get_template_directory_uri() . '/assets/landing-page/images/logo.png' ?>">
                        <div class="site-description">
                            <p>Adorable Kindergarten</p>
                            <p>WordPress Theme</p>
                        </div>
                    </div>
                </div>
                <div class="header-top-right col-sm-7">
                    <img class="img-responsive" width="738" height="442" src="<?php echo  get_template_directory_uri() . '/assets/landing-page/images/child.png' ?>">
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="choose-demo">
                    <h4>Choose your favourite demo below</h4>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <?php foreach ( $home_pages as $home_page ): ?>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="screen">
                            <div class="screen-image-wrapper">
                                <a href="<?php echo esc_url($home_page['url'])?>" title="<?php echo esc_attr($home_page['name']);?>">
                                    <div class="screen-image" style="background-image: url(<?php echo esc_url($home_page['image'])?>)"></div>
                                </a>
                            </div>
                            <a class="button" href="<?php echo esc_url($home_page['url'])?>" title="<?php echo esc_attr($home_page['name']);?>"><?php echo esc_html($home_page['name']); ?></a>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-top-wrapper">
            <div class="container">
                <div class="footer-top">
                    <div class="footer-top-inner">
                        <h4>In love with our theme?</h4>
                        <a href="http://themeforest.net/item/cupid-adorable-kindergarten-wordpress-theme/10762082?license=regular&open_purchase_for_item_id=10474922&purchasable=source&ref=g5theme" class="button button-2">Purchase Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer-copyright">
                <div class="footer-copyright-inner">
                    <div class="copyright-text">
                        Copyright © 2015 G5Theme. All rights reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>