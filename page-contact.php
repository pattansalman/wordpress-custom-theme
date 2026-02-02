<?php
/*
Template Name: Contact Page
*/
get_header(); ?>

<main class="contact-page">
    <div class="wrap">

        <h1>Contact Us</h1>

        <div class="contact-grid">
            <div class="contact-card">
                <h3>Email</h3>
                <p><a href="mailto:info@example.com">info@example.com</a></p>

                <h3>Phone</h3>
                <p><a href="tel:+1234567890">+1 (234) 567-890</a></p>

                <h3>Address</h3>
                <p>
                    123 Main Street<br>
                    Sample City, State 12345
                </p>
            </div>

            <div class="contact-form">
                <h3>Send a message</h3>

                <form id="contactForm" novalidate>

                    <label for="contact_name">Name</label>
                    <input
                        type="text"
                        id="contact_name"
                        name="from_user"
                        required
                        minlength="2"
                    >

                    <label for="contact_email">Email</label>
                    <input
                        type="email"
                        id="contact_email"
                        name="email"
                        required
                    >

                    <label for="contact_phone">Phone</label>
                    <input
                        type="text"
                        id="contact_phone"
                        name="phone"
                        pattern="[0-9]{10}"
                        inputmode="numeric"
                        maxlength="10"
                        placeholder="10 digit number"
                    >

                    <label for="contact_message">Message</label>
                    <textarea
                        id="contact_message"
                        name="message"
                        rows="6"
                        required
                        maxlength="1000"
                    ></textarea>

                    <!-- Security nonce -->
                    <input
                        type="hidden"
                        name="nonce"
                        value="<?php echo esc_attr( wp_create_nonce('contact_nonce') ); ?>"
                    >

                    <!-- AJAX action -->
                    <input type="hidden" name="action" value="submit_contact_ajax">

                    <button type="submit">Send Message</button>

                </form>

                <!-- AJAX response -->
                <div id="contactResponse" aria-live="polite" style="margin-top:15px;"></div>

            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
