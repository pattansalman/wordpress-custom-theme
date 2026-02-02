<?php
/* Page Template: About Us */
get_header();
?>

<main class="about-page">

    <!-- HERO -->
    <section class="about-hero">
        <div class="wrap">
            <h1><?php the_title(); ?></h1>
            <p class="subtitle">
                Building trust, delivering quality, and helping businesses grow.
            </p>
        </div>
    </section>

    <!-- INTRO -->
    <section class="about-intro">
        <div class="wrap about-grid">
            <div class="about-text <?php echo trim( get_the_content() ) === '' ? 'is-empty' : ''; ?>">
                <?php
                while ( have_posts() ) :
                    the_post();
                    the_content();   // Content from Admin
                endwhile;
                ?>
            </div>

            <div class="about-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-us.jpg" alt="About our company">
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
