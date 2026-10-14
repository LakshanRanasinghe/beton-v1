<?php 
/* Template Name: Thank you page */ 

get_header(); 
?>
<div class="container thank-you-section">
    <div class="my-5 mx-auto py-sm-5 max-w-696">
        <!-- Success Icon -->
        <div class="success-icon mb-4 max-w-162 mx-auto">
            <img src="<?php echo get_template_directory_uri() ?>/images/thank-you-icon.png" alt="" class="">
        </div>

        <!-- Thank You Message -->
        <h3 class="thank-you-header text-center oswald-600 text-sm-32 text-dark-blue mb-4">BEDANKT VOOR HET AANVRAGEN VAN DE OFFERTE!</h3>
        <p class="mb-4 text-center poppins-400 text-sm-18 text-dark-gray mb-5">U ontvangt binnen enkele minuten een e-mail met uw offerte. Heeft u vragen? Neem gerust contact met ons op.</p>

        <!-- Action Buttons -->
        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-stretch align-items-sm-center gap-3">
            <a href="<?php echo esc_url( home_url( '/#calculator' ) ); ?>" class="btn thankyou-page-btn1">
                BEREKEN EEN ANDERE PRIJS
            </a>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn thankyou-page-btn2">
                GA NAAR DE HOMEPAGINA
            </a>
        </div>
    </div>
</div>
  
<?php
get_footer();
?>