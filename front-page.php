<?php get_header(); ?>

<section class="hero">
    <div class="wrap">
        <h1>Welcome to <?php bloginfo('name'); ?></h1>
        <p class="lead">We help businesses grow with professional, reliable, and affordable services. Let us take your project from idea to success.</p>
        <p><a class="button" href="<?php echo esc_url( home_url('/contact') ); ?>">Get in Touch</a></p>
    </div>
</section>

<section class="services">
    <div class="wrap">
        <h2>Our Services</h2>
        <div class="grid">
            <div class="card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/meeting.jpg" alt="Consulting">
                <h3>Consulting</h3>
                <p>Strategic planning, process improvements and expert business advice to accelerate growth.</p>
            </div>
            <div class="card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/development.jpg" alt="Development">
                <h3>Development</h3>
                <p>Modern web and mobile solutions built for performance, accessibility, and scale.</p>
            </div>
            <div class="card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/designer.jpg" alt="Design">
                <h3>Design</h3>
                <p>Human-centered design and branding to make your product intuitive and memorable.</p>
            </div>
        </div>
    </div>
</section>

<section class="latest-articles">
    <div class="wrap">
        <h2>Latest Articles</h2>
        <div class="articles">
            <?php
            $q = new WP_Query( array( 'posts_per_page' => 3 ) );
            if ( $q->have_posts() ) :
                while ( $q->have_posts() ) : $q->the_post(); ?>
                    <article class="article-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/article1.svg" alt="<?php the_title_attribute(); ?>"></a>
                        <?php endif; ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else :
                // Fallback sample articles
                for ( $i = 1; $i <= 3; $i++ ) : ?>
                    <article class="article-card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/article1.svg" alt="Sample article">
                        <h3>Sample Article <?php echo $i; ?></h3>
                        <p class="excerpt">A short sample description about how our services helped a client achieve outstanding results.</p>
                    </article>
                <?php endfor;
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
