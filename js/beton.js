jQuery(document).ready(function ($) {

   
	window.dataLayer = window.dataLayer || [];
	
	$('#quoteButton').on('click', function () {
		window.dataLayer.push({
		   'event': 'gaEvent',
			'eventAction': 'quoteRequested',
		   'timestamp': new Date().toISOString()
	  	});
	});
	
   const googleReviewUrl = 'https://www.google.com/search?sca_esv=3d29f91817f8e566&sxsrf=AHTn8zqICKpJnBpHQXGlqjQsqVVu6qRLRA:1743999989762&si=APYL9bs7Hg2KMLB-4tSoTdxuOx8BdRvHbByC_AuVpNyh0x2KzRam88Sq14J9Tyhv7AFoN6bo3klXzjbOGaYhm854YpZdttAISuqHi71cxNXA0C_2HXYUVmJGidsjZ7QhnHeOV0a4RtgXOGIYXtmqkrzRY5GvKumX6g%3D%3D&q=BetonBestellen.nl+Reviews&sa=X&ved=2ahUKEwjw64KfisWMAxUCR2wGHRVcLjQQ0bkNegQINBAE&biw=1920&bih=844&dpr=1#cobssid=s';

   $(document).on('click', '.ti-review-item.source-Google', function () {
   	window.open(googleReviewUrl, '_blank');
   });


   // Desktop: allow parent links with valid href to navigate on click
   $(".beton-desktop-menu .dropdown-toggle").on("click", function (event) {
      const href = $(this).attr("href");
      if (href && href !== "#" && href !== "javascript:void(0);") {
         location.href = href;
      }
   });

   // Ensure Bootstrap doesn't hijack mobile drawer accordions with floating popper dropdowns
   $(".beton-mobile-drawer .dropdown-toggle").removeAttr("data-bs-toggle");

   // Mobile Offcanvas: toggle accordion submenu when clicking dropdown-toggle or chevron icon
   $(document).on("click", ".beton-mobile-drawer .dropdown-toggle, .beton-mobile-drawer .menu-item-has-children > .beton-arrow-menu-icon", function (event) {
      event.preventDefault();
      event.stopPropagation();

      const $parentLi = $(this).closest(".menu-item-has-children, .dropdown");
      const $toggleLink = $parentLi.children(".dropdown-toggle");
      const $submenu = $parentLi.children("ul.dropdown-menu");
      const $icon = $parentLi.children(".beton-arrow-menu-icon");

      const isOpen = $submenu.hasClass("show");

      // Close other open dropdowns in the mobile drawer (accordion behavior)
      const $otherOpenLis = $parentLi.siblings(".menu-item-has-children.show, .dropdown.show");
      $otherOpenLis.removeClass("show");
      $otherOpenLis.children(".dropdown-toggle").attr("aria-expanded", "false").removeClass("show");
      $otherOpenLis.children("ul.dropdown-menu").removeClass("show").slideUp(200);
      $otherOpenLis.children(".beton-arrow-menu-icon").removeClass("is-open");

      if (isOpen) {
         $parentLi.removeClass("show");
         $toggleLink.attr("aria-expanded", "false").removeClass("show");
         $submenu.removeClass("show").slideUp(200);
         $icon.removeClass("is-open");
      } else {
         $parentLi.addClass("show");
         $toggleLink.attr("aria-expanded", "true").addClass("show");
         $submenu.addClass("show").hide().slideDown(200);
         $icon.addClass("is-open");
      }
   });

   

   //Home page calculator form handle
   $("#home-offerte-aanvragen-form").on("submit", function(e) {
      e.preventDefault(); 
  
      if ( locationQuntityValidation() ) {
         this.submit();
      }

      dataLayer.push({
          'event': 'gaEvent',
			'eventAction': 'homeClickQuoteBtn',
         'timestamp': new Date().toISOString()
      });

   });

   

   function locationQuntityValidation() {
      console.log('Running locationQuntityValidation')
      if ($.cookie("selected_area_code") !== undefined && $.cookie("selected_area_code") !== "") {
         $("#postcode-input").addClass("selected");
      }
      const postcodeInput = $("#postcode-input");
      const cubicMeters = getNormalizedCubicMeters();
      const isPostcodeValid = postcodeInput.hasClass("selected");
      const isCubicMetersValid = cubicMeters > 0;
  
      if (!isPostcodeValid) {
        alert("Selecteer een geldige postcode!");
        postcodeInput.focus();
        return false;
      }
  
      if (!isCubicMetersValid) {
        alert("Kubieke meters moeten groter zijn dan nul!");
        $("#cubic-meters").focus();
        return false;
      }
      return true;
   }

   
   $("#postcode-input").on("change", function (e) {
      dataLayer.push({
         'event': 'gaEvent',
			'eventAction': 'locationQtyEntered',
         'timestamp': new Date().toISOString()
      });
   });

   function getNormalizedCubicMeters() {
      let raw = $("#cubic-meters").val();

      if (!raw) return 0;
      return parseFloat(raw.replace(',', '.')) || 0;
   }

   

   //  Jump to second step on reload
   if ($("#postcode-input").val() !== "" && currentCubicMeters !== "" && currentCubicMeters > 0) {
      $(".location-and-quantity-section").removeClass("active").addClass("inactive");
      $(".type-and-kind-section").addClass("active").removeClass("inactive");
   }

   
   
   
   

   $('.release-method-pump-wrapper .pump-wrap').on("click", function () {
      var pumpCheckbox = $(this).find('input[name="pump-type"]');
      pumpCheckbox.prop('checked', true);
      pumpCheckbox.trigger('change');
   });

   $(document).on("click", '.custom-select-box', function () {
      $('.custom-select-box').removeClass('blink-shadow');
         console.log('fsfsd');
   });
   
   
  
   
   // $("#butterfly-floor").on("change", function () {
   //    trigger_calculator();
   //    // if ($("#mezzanine-floor").is(":checked")) {
   //    //    $(".butterfly_floor_wrapper").removeClass("d-none");
   //    // } else {
   //    //    $(".butterfly_floor_wrapper").addClass("d-none");
   //    // }
   //    $(".butterfly_floor_wrapper").toggleClass("d-none");

   //    if ($('input[name="performance"]:checked').val() == "allIn") {
   //       if ($('#snelhardend_input').is(':checked') && $('#vlinderbeton_input').is(':checked')) {
   //          $('#snelhardend_input').prop('checked', false).trigger('change').prop('disabled', false);
   //          $('#vlinderbeton_input').prop('checked', false).trigger('change').prop('disabled', false);
   //       } else {
   //          $('#snelhardend_input').prop('checked', true).trigger('change').prop('disabled', true);
   //          $('#vlinderbeton_input').prop('checked', true).trigger('change').prop('disabled', true);
   //       }
   //    } 
   // });

   $("#butterfly-floor").on("change", applyButterflyFloorState);

   function applyButterflyFloorState() {
      const isChecked = $('#butterfly-floor').is(':checked');
      const isAllIn = $('input[name="performance"]:checked').val() === "allIn";

      // UI visibility
      $(".butterfly_floor_wrapper").toggleClass("d-none", !isChecked);

      // Default: enable inputs
      $('#snelhardend_input, #vlinderbeton_input').prop('disabled', false);

      // Only force + disable when BOTH conditions true
      if (isChecked && isAllIn) {
         $('#snelhardend_input, #vlinderbeton_input').each(function () {
               this.checked = true;
               this.disabled = true;
         });
      }
	   if(!isChecked){
		   $('#snelhardend_input, #vlinderbeton_input').each(function () {
               this.checked = false;
               this.disabled = false;
         });
	   }

      window.trigger_calculator();
   }

   

   function isValidEmail(pdfEmail) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(pdfEmail);
   }

   //$('#email').on('change', function(){
      // if($(this).val() !== ''){
      //    $('.submit-btn[value="quote"]').prop("disabled", false);
      // }else{
      //    $('.submit-btn[value="quote"]').prop("disabled", true);
      // }
   //})


   $(document).on('click', function(e) {
      if (!$(e.target).closest('.voer-uw-e-mailadres-wrapper, .offerte-in-pdf-btn').length) {
         $('.voer-uw-e-mailadres-wrapper').addClass('d-none');
         $('.voer-uw-e-mailadres-wrapper').removeClass('selected');
         $('.submit-btn[value="quote"]').removeClass('selected');
      }
   })

   function send_to_quotation() {
      let compositions = [];
      $('input[name="compound"]:checked').each(function () {
         compositions.push($(this).attr("value"));
      });

      var dataSet = {
         action: 'save_quotation',
         nonce: (typeof betonData !== 'undefined' && betonData.nonce) ? betonData.nonce : ($("#beton_nonce").val() || ''),
         user_email: $("#email").val(),
         area_code: $.cookie("selected_area_code"),
         postalcode: $("#postcode-input").val(),
         cubic_meters: currentCubicMeters,
         application_product: $('input[name="application"]:checked').val(),
         composition: compositions,
         unloading: $('input[name="releaseMethod"]:checked').val(),
         pump_type: $('input[name="pump-type"]:checked').val(),
         pumping_distance: $('select[name="mini_pumping_distance"]').val(),
         boom_pumping_distance: $('select[name="boom_pumping_distance"]').val(),
         uitvoering: $('input[name="performance"]:checked').val(),
         "surace-sqm": $('select[name="surface"]').val(),
         "layer-thickness": $("#layer-thickness").val(),
         nos_rooms: $("#num-rooms").val(),
         flooring: $("#mezzanine-floor").is(":checked") ? 1 : 0,
         "butterfly-floor": $("#butterfly-floor").is(":checked") ? 1 : 0,
      };

      $.ajax({
         type: "post",
         url: betonData.ajax_url,
         data: dataSet,
         beforeSend: function () {
            $('.summary-content').addClass('loading');
         },
         success: function (response) {
            if(response.data.status == 'mail-sent'){
               window.location.href = response.data.redirect;
               // $(".confirm-and-pay-section").addClass("active");
               // $(".type-and-kind-section").removeClass("pending");
               // $(".type-and-kind-section").removeClass("active");
               // $(".type-and-kind-section").addClass("inactive");
               // $('.type-and-kind-form').addClass('d-none');

               // $('.confirm-and-pay-section').find('.step-title').removeClass('disabled');
               // $('#email').val('').trigger('change');
            }
         }
      });
   }


   

   $('.step-title').not('.disabled').on('click', function(){
      var clicked_section = $(this).parents('.section-wrap');
      let total_steps = 3;
      let clicked_step = $(clicked_section).data('step');

      let current_section = $('.section.active');
      let current_step = $(current_section).data('step');

      $(clicked_section).addClass('active').addClass('pending').removeClass('inactive').removeClass('filled');

      //console.log(clicked_section);

      for (let index = 1; index <= total_steps; index++) {
         if(index == clicked_step){
            $('.section-wrap[data-step='+index+']').find('.form-section').removeClass('d-none');
            continue;
         }else{
            $('.section-wrap[data-step='+index+']').find('.form-section').addClass('d-none');
         }

         if(index == 1){
            if ($("#postcode-input").val() == "" || currentCubicMeters == "" || currentCubicMeters <= 0) {
               $("#location-and-quantity-btn").prop("disabled", true);
               $(".location-and-quantity-section").addClass("pending").removeClass("filled");
            }
         }
         console.log($('.section-wrap[data-step='+index+']'));

         $('.section-wrap[data-step='+index+']').removeClass('active').removeClass('pending').removeClass('inactive')
      }
      
   });

   $("#orddd_datepicker").addClass("display-hide-calendar");

   $(document).on('click', '.orddd-checkout-fields', function() {
      console.log('date-picker opened');
      $("#orddd_datepicker").removeClass("display-hide-calendar");
      $("#orddd_datepicker").addClass("display-show-calendar");
   });

   $('.type-and-kind-section2').on('click', function() {
      window.history.back(); 
   });

   jQuery(document).ready(function ($) {
      $('.location-and-quantity-section2').on('click', function () {
        const targetUrl = '/beton2025/offerte-aanvragen/?step=location';
        window.location.href = targetUrl;
      });
  
      const step = new URL(window.location.href).searchParams.get('step');
  
      if (step === 'location') {
         console.log('location');
         console.log($('.location-and-quantity-section'));
        $('.location-and-quantity-section')
          .addClass('active pending')
          .removeClass('filled inactive');
  
        $('.type-and-kind-section')
          .removeClass('active pending')
          .addClass('inactive');
      }
    });

   //Google Review custom js
   $('.grw-review-inner').each(function(index) {
      const $container = $(this);
      const $svgs = $container.find('svg');
      const $trigger = $svgs.last();
      const $link = $container.find('a.wp-google-name');

      if ($trigger.length && $link.length) {
         $trigger.on('click', function() {
            const href = $link.attr('href');
            if (href) {
               window.open(href, '_blank');
            }
         });
      }
   });

   //Tag event run when quotation page load
   if (window.location.pathname === '/offerte-aanvragen') {
      
      //console.log('The quotation page is loaded.');
      setTimeout(function(){
         var orderTotalExclTax = $('#sub_total_formatted bdi').text().replace('€', '').trim();
         var orderTotalInclTax = $('#total_formatted bdi').text().replace('€', '').trim();

         dataLayer.push({
            'event': 'gaEvent',
            'eventAction': 'quotePageLoaded',
            'orderTotalExclTax': orderTotalExclTax,
            'orderTotalInclTax': orderTotalInclTax,
            'timestamp': new Date().toISOString()
         });
      }, 5000);
      
   } 

   //Tag event run when checkout page load
   // if (window.location.pathname === '/checkout') {
   //    var orderTotalExclTax = $('.beton-checkout-subtotal bdi').text().replace('€', '').trim();
   //    var orderTotalInclTax = $('.beton-checkout-total bdi').text().replace('€', '').trim();
   //    // console.log('The checkout page is loaded.');
   //    // console.log(orderTotalExclTax + ' / ' + orderTotalInclTax);
   //    dataLayer.push({
   //        'event': 'gaEvent',
	// 		'eventAction': 'checkoutPageLoaded',
   //       'orderTotalExclTax': orderTotalExclTax,
   //       'orderTotalInclTax': orderTotalInclTax,
   //       'timestamp': new Date().toISOString()
   //    });
   // } 

   // const isOrderReceived = /(?:^|\/)checkout\/order-received(?:\/|$)/.test(window.location.pathname);

   // if (isOrderReceived) {
   //    console.log('The order received page is loaded.');
   //    dataLayer.push({
   //        'event': 'gaEvent',
   //       'eventAction': 'orderReceivedPageLoaded', 
   //       'timestamp': new Date().toISOString()
   //    });
   // }

});
