<?php
/* Page Template: About Us */
get_header();
?>

<main class="about-page">

    <!-- HERO -->
    <section class="about-hero">
        <div class="wrap">
            <h1><?php the_field('about_title'); ?></h1>
            <p class="subtitle">
                 <?php the_field('about_content'); ?>
            </p>
        </div>
    </section>

    <!-- INTRO -->
    <section class="about-intro">
        <div class="wrap about-grid">
            <div class="about-image">
                <?php $about_img = get_field('about_image'); ?>
                <?php if ($about_img): ?>
                    <img src="<?php echo esc_url($about_img['url']); ?>" alt="<?php echo esc_attr($about_img['alt']); ?>">
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- VALUES -->
    <section class="about-values">
        <div class="wrap">
            <h2>Our Values</h2>

            <div class="values-grid">
                <div class="value-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/quality.jpg" alt="Quality">
                    <h3>Quality</h3>
                    <p>We deliver high-quality solutions that meet real business needs.</p>
                </div>

                <div class="value-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/trust.jpg" alt="Trust">
                    <h3>Trust</h3>
                    <p>Transparency and honesty are at the heart of everything we do.</p>
                </div>

                <div class="value-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/support.jpg" alt="Support">
                    <h3>Support</h3>
                    <p>We build long-term relationships with continuous support.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
