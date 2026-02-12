<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?> 
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <div class="header-container">

        <div class="site-branding">
            <a class="site-logo" href="<?php echo home_url(); ?>">
                <img style="border-radius: 50%;" src="<?php echo get_template_directory_uri(); ?>/assets/images/6543598.png" alt="<?php bloginfo('name'); ?> logo" class="logo">
            </a>
            <div class="site-title">
                <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
            </div>
        </div>

        <nav class="main-nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'my_service' ); ?>">
            <?php if ( has_nav_menu( 'primary_menu' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary_menu',
                    'container' => false,
                    'menu_class' => 'nav-menu'
                ) );
            } else { ?>
                <ul class="nav-menu">
                    <li><a href="<?php echo home_url(); ?>">Home</a></li>
                    <li><a href="<?php echo site_url('/about-us'); ?>">About Us</a></li>
                    <li><a href="<?php echo site_url('/contact'); ?>">Contact</a></li>
                </ul>
            <?php } ?>
        </nav>


    </div>
</header>
