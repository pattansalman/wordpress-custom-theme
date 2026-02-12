<?php get_header(); ?>

<section class="single-article">

    <div class="wrap">

        <h1><?php echo esc_html( get_the_title() ); ?></h1>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-img">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>

        <?php 
        $subtitle = get_field('article_subtitle');
        if ($subtitle) : ?>
            <h3 class="subtitle"><?php echo esc_html($subtitle); ?></h3>
        <?php endif; ?>

        <?php 
        $banner = get_field('article_banner');
        if ($banner) : ?>
            <div class="banner">
                <img src="<?php echo esc_url($banner['url']); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
            </div>
        <?php endif; ?>

        <div class="content">
            <?php the_content(); ?>
        </div>

        <?php 
        $btn_text = get_field('button_text');
        $btn_link = get_field('button_link');

        if ($btn_text && $btn_link) : ?>
            <a class="button" href="<?php echo esc_url($btn_link); ?>">
                <?php echo esc_html($btn_text); ?>
            </a>
        <?php endif; ?>

    </div>

</section>

<?php get_footer(); ?>