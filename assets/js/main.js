document.addEventListener('DOMContentLoaded', function(){
    // Mobile menu toggle
    var btn = document.querySelector('.menu-toggle');
    var nav = document.querySelector('.main-nav');
    if ( btn && nav ) {
        btn.addEventListener('click', function(){
            nav.classList.toggle('open');
            btn.setAttribute('aria-expanded', nav.classList.contains('open'));
        });
    }

    // Basic client-side validation for the contact page form (non-ajax)
    var contactForm = document.querySelector('form[action*="admin-post.php"][name=""]') || document.querySelector('form[action*="admin-post.php"]');
    if ( contactForm ) {
        contactForm.addEventListener('submit', function(e){
            var name = contactForm.querySelector('#contact_name');
            var email = contactForm.querySelector('#contact_email');
            var message = contactForm.querySelector('#contact_message');
            if ( !name || !email || !message ) return; // let server handle

            if ( name.value.trim().length < 2 ) {
                alert('Name must be at least 2 characters'); e.preventDefault(); return false;
            }
            if ( !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test( email.value.trim() ) ) {
                alert('Please enter a valid email'); e.preventDefault(); return false;
            }
        });
    }
});

