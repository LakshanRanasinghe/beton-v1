jQuery(document).ready(function ($) {
    $(document).on('click', '#checkout-billing-shipping-confirm', function(){

        $('.validate-required input, .validate-required select').trigger('validate');

        var hasError = false;
        $('.checkout-shipping-fields .woocommerce-invalid-required-field').each(function () {
            hasError = true; 
        });

        if ($('.dayz-date-mapper-date-picker').val() == '') {
            hasError = true; 
            $('.dayz-date-mapper-date-picker').addClass('invalid'); 
            $('.dayz-date-mapper-date-picker').removeClass('valid');
        } else {
            $('.dayz-date-mapper-date-picker').addClass('valid'); 
            $('.dayz-date-mapper-date-picker').removeClass('invalid');
        }

        if ($('#dayz_date_mapper_timeslots_collection').val() == '') {
            hasError = true;  
        } 

        // if (!$('#billing-to-different-address-checkbox').is(':checked')) {
        //     console.log('Ship to a different address checkbox is not checked');
        //     $('.woocommerce-invalid-required-field').each(function () {
        //         hasError = true; 
        //     });
        // }
        

        if (hasError) {
            $('html, body').animate({
                scrollTop: $('.woocommerce-invalid-required-field:first').offset().top - 50
            }, 500);

            if (!$('.woocommerce-error').length) {
                $('<ul class="woocommerce-error custom-woocommerce-error-msg"><li>Vul alle verplichte velden in.</li></ul>')
                    .prependTo('form.woocommerce-checkout');
            }
        } else {

            $(this).parent('div').addClass('d-none');
            $('.checkout-payment-wrapper').removeClass('d-none');
            $('.checkout-billing-fields-wrapper').removeClass('d-none');
            $('.checkout-billing-content-wrapper').find('.checkout-icons-btn').addClass('d-none');
            $(this).closest('.checkout-box').find('.checkout-icons-btn').removeClass('d-none');
            $('.checkout-payment-wrapper').closest('.checkout-box').removeClass('deactive').addClass('active');
            $('.checkout-billing-content-wrapper').removeClass('deactive').addClass('active');
            $(this).closest('.checkout-box').removeClass('active').addClass('deactive');
            $(this).closest('.checkout-box').addClass('completed');
            $(this).closest('.checkout-box').find('.before-collapse-title').addClass('d-none');
            $(this).closest('.checkout-box').find('.after-collapse-title').removeClass('d-none');

            $('.checkout-payment-title-wrapper').find('.before-collapse-title').removeClass('d-none');
            $('.checkout-payment-title-wrapper').find('.after-collapse-title').addClass('d-none');
            // $('#billing-to-different-address-checkbox').prop('checked', true).trigger('change');
            assignShippingAndBillingFields();
            previewShippingAddressData();
        }
    });

    $(document).on('input', '.dayz-date-mapper-date-picker', function() {
        if ($(this).val() == '') {
           $(this).addClass('invalid'); 
           $(this).removeClass('valid');
        } else {
            $(this).removeClass('invalid'); 
            $(this).addClass('valid');
        }
    });

    $(document).on('click', '#checkout-payment-confirm', function(){
        $('.validate-required input, .validate-required select').trigger('validate');

        var hasError = false;
        $('.checkout-billing-fields .woocommerce-invalid-required-field').each(function () {
            hasError = true; 
        });

        if ( !$('#billing-to-different-address-checkbox').is(':checked') ) {
            $('.woocommerce-invalid-required-field').each(function () {
                hasError = true; 
            });
        }

        if (hasError) {
            $('html, body').animate({
                scrollTop: $('.woocommerce-invalid-required-field:first').offset().top - 50
            }, 500);

            if (!$('.woocommerce-error').length) {
                $('<ul class="woocommerce-error"><li>Vul alle verplichte velden in.</li></ul>')
                    .prependTo('form.woocommerce-checkout');
            }
        } else {
            $(this).parent('div').addClass('d-none');
            $('.checkout-billing-fields-wrapper').addClass('d-none');
            $('.checkout-confirmation-content-wrapper').removeClass('d-none');
            $('.checkout-confirmation-content-wrapper').closest('.checkout-box').find('.checkout-icons-btn').addClass('d-none');
            $('.checkout-billing-content-wrapper').find('.checkout-icons-btn').removeClass('d-none');
            $('.checkout-confirmation-content-wrapper').closest('.checkout-box').removeClass('deactive').addClass('active');
            $(this).closest('.checkout-box').removeClass('active').addClass('deactive');
            $(this).closest('.checkout-box').addClass('completed');
            $('.checkout-billing-content-wrapper').addClass('completed');
            $('.checkout-billing-content-wrapper').removeClass('active').addClass('deactive');
            $('.checkout-payment-title-wrapper').find('.before-collapse-title').addClass('d-none');
            $('.checkout-payment-title-wrapper').find('.after-collapse-title').removeClass('d-none');
    
            let payment_method = $('input[name="payment_method"]:checked');
            let payment_method_label = $('label[for="' + payment_method.attr('id') + '"]').text().trim();
            $('.payment-method-preview').text(payment_method_label);
            previewBillingAddressData();
        }
        
    });

    $(document).on('click', '.checkout-icons-btn', function(){
        
        $('.checkout-box').removeClass('active');
        $('.checkout-box').addClass('deactive');

        let hasBillingContent = $(this).closest('.checkout-box').hasClass('checkout-billing-content-wrapper');
        if( hasBillingContent ) {
            $('#woocommerce-checkout-payment-methods-wrapper').removeClass('deactive').addClass('active');
        }
        $(this).closest('.checkout-box').removeClass('deactive');
        $(this).closest('.checkout-box').addClass('active');
        $(this).closest('.checkout-box').find('.checkout-content-wrapper').removeClass('d-none');
        
        

        $('.checkout-box').each(function(){
            if( $(this).hasClass('deactive')) {
                $(this).find('.checkout-content-wrapper').addClass('d-none');
                $(this).find('.checkout-icons-btn').removeClass('d-none');
            } else {
                $(this).find('.checkout-content-wrapper').removeClass('d-none');
                $(this).find('.checkout-icons-btn').addClass('d-none');
            }

            if( $(this).hasClass('completed')) {
                $(this).closest('.checkout-box').find('.before-collapse-title').addClass('d-none');
                $(this).closest('.checkout-box').find('.after-collapse-title').removeClass('d-none');
            } else {
                $(this).closest('.checkout-box').find('.before-collapse-title').removeClass('d-none');
                $(this).closest('.checkout-box').find('.after-collapse-title').addClass('d-none');
                $(this).find('.checkout-icons-btn').addClass('d-none');
            }
        });

        $(this).closest('.checkout-box').find('.before-collapse-title').removeClass('d-none');
        $(this).closest('.checkout-box').find('.after-collapse-title').addClass('d-none');

    });

    $(document).on('change', 'input[name="custom_order_type"]', function(){
        if ($('#order-type-business').is(':checked') && $(this).val() == '1') {
            $('#custom_company_field').removeClass('d-none');
            $('#custom_eu_vat_number_field').removeClass('d-none');
        } else {
            $('#custom_company_field').addClass('d-none');
            $('#custom_eu_vat_number_field').addClass('d-none');
        }
    });

    $(document).on('input', '#custom_email', function(){
        let email = $(this).val();
        $('#shipping_email').val(email);
    });
    $(document).on('input', '#custom_company', function(){
        let company = $(this).val();
        $('#billing_company').val(company);
        $('#shipping_company').val(company);
    });
    $(document).on('input', '#custom_eu_vat_number', function(){
        let vat_number = $(this).val();
        $('#billing_eu_vat_number').val(vat_number);
    });
    $(document).on('input', '#custom_first_name', function(){
        let first_name = $(this).val();
        $('#shipping_first_name').val(first_name);
        $('.preview-first-name').html(first_name);
    });
    $(document).on('input', '#custom_last_name', function(){
        let last_name = $(this).val();
        $('#shipping_last_name').val(last_name);
        $('.preview-last-name').html(last_name);
    });
    $(document).on('input', '#custom_phone', function() {
        let phone_no = $(this).val();
        $('#billing_phone').val(phone_no);
    }); 
    
    function previewBillingAddressData() {
        let billing_address_array = []; 
        let billing_name = $('#billing_first_name').val() + ' ' + $('#billing_last_name').val();
        let billing_company = $('#billing_company').val();
        let billing_address_1 = $('#billing_address_1').val();
        let billing_address_2 = $('#billing_address_2').val();
        let billing_postcode = $('#billing_postcode').val();
        let billing_city = $('#billing_city').val();
        //let billing_country = $('#billing_country').val(); 
        let billing_country = $('#billing_country option:selected').text();
        
        if (billing_name) billing_address_array.push(billing_name);
        if (billing_company) billing_address_array.push(billing_company);
        if (billing_address_1) billing_address_array.push(billing_address_1);
        if (billing_address_2) billing_address_array.push(billing_address_2);
        if (billing_postcode) billing_address_array.push(billing_postcode);
        if (billing_city) billing_address_array.push(billing_city);
        if (billing_country) billing_address_array.push(billing_country);
    
        $('.preview-billing-address').text(billing_address_array.join(', '));
    }

    function previewShippingAddressData() {
        let shipping_address_array = []; 
        let shipping_name = $('#shipping_first_name').val() + ' ' + $('#shipping_last_name').val();
        let shipping_company = $('#shipping_company').val();
        let shipping_address_1 = $('#shipping_address_1').val();
        let shipping_address_2 = $('#shipping_address_2').val();
        let shipping_postcode = $('#shipping_postcode').val();
        let shipping_city = $('#shipping_city').val();
        //let shipping_country = $('#shipping_country').val(); 
        let shipping_country = $('#shipping_country option:selected').text();
        let time_slot = $('input[name="orddd_time_slotGroup"]:checked').val();
        if (!time_slot) {
            let time_slot_selected = $('#orddd_list_view_select').find('.list-view.selected');
            time_slot = time_slot_selected.find('input[name="orddd_time_slotGroup"]').val();
        }
        let delivery_date = $('#e_deliverydate').val();
        
        if (shipping_name) shipping_address_array.push(shipping_name);
        if (shipping_company) shipping_address_array.push(shipping_company);
        if (shipping_address_1) shipping_address_array.push(shipping_address_1);
        if (shipping_address_2) shipping_address_array.push(shipping_address_2);
        if (shipping_postcode) shipping_address_array.push(shipping_postcode);
        if (shipping_city) shipping_address_array.push(shipping_city);
        if (shipping_country) shipping_address_array.push(shipping_country);
    
        $('.preview-shipping-address').text(shipping_address_array.join(', '));
        $('.preview-time-slot').text(delivery_date + ' | ' + time_slot);
    }
    
    
    $(document).on('click', '#checkout-email-confirm', function(){
        const emailField = $('#custom_email');
        let emailValue = emailField.val().trim(); 
        const emailError = $('#custom_email_error');

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (emailValue === '' || !emailRegex.test(emailValue)) {
            emailError.removeClass('d-none');
            emailField.addClass('is-invalid');
            $(this).removeClass('validated');
            $('.checkout-personal-info-fields').addClass('d-none');
        } else {
            emailError.addClass('d-none');
            emailField.removeClass('is-invalid').addClass('is-valid'); 
            $(this).addClass('validated');
            $('.checkout-personal-info-fields').removeClass('d-none');
        }
    });

    $(document).on('click', '#checkout-email-confirm.validated', function(){
        if(validateCheckoutCustomFields()){
            $(this).parent('div').addClass('d-none');
            $('.checkout-billing-shipping-fields-wrapper').removeClass('d-none');
            $('.checkout-billing-shipping-fields-wrapper').closest('.checkout-box').find('.checkout-icons-btn').addClass('d-none');
            $(this).closest('.checkout-box').find('.checkout-icons-btn').removeClass('d-none');
            $('.checkout-billing-shipping-fields-wrapper').closest('.checkout-box').removeClass('deactive').addClass('active');
            $(this).closest('.checkout-box').removeClass('active');
            $(this).closest('.checkout-box').addClass('deactive');
            $(this).closest('.checkout-box').addClass('completed');
            $(this).closest('.checkout-box').find('.before-collapse-title').addClass('d-none');
            $(this).closest('.checkout-box').find('.after-collapse-title').removeClass('d-none');

            $('.checkout-billing-shipping-fields-wrapper').closest('.checkout-box').find('.before-collapse-title').removeClass('d-none');
            $('.checkout-billing-shipping-fields-wrapper').closest('.checkout-box').find('.after-collapse-title').addClass('d-none');

            $('#ship-to-different-address-checkbox').prop('checked', true).trigger('change');
        }
    });

    function validateCheckoutCustomFields() {
        let isValid = true;

        if ( $('#order-type-business').is(':checked') ) {
            const customCompany = $('#custom_company').val().trim();
            const customVatNumber = $('#custom_eu_vat_number').val().trim();
            if (customCompany === '') {
                $('#custom_company_error').removeClass('d-none');
                $('#custom_company').addClass('is-invalid');
                isValid = false;
            } else {
                $('#custom_company_error').addClass('d-none');
                $('#custom_company').removeClass('is-invalid').addClass('is-valid');
            }

            if (customVatNumber === '') {
//                 $('#custom_eu_vat_number_error').removeClass('d-none');
//                 $('#custom_eu_vat_number').addClass('is-invalid');
//                 isValid = false;
            } else {
                $('#custom_eu_vat_number_error').addClass('d-none');
                $('#custom_eu_vat_number').removeClass('is-invalid').addClass('is-valid');
            }

        }

        const firstName = $('#custom_first_name').val().trim();
        if (firstName === '') {
            $('#custom_first_name_error').removeClass('d-none');
            $('#custom_first_name').addClass('is-invalid');
            isValid = false;
        } else {
            $('#custom_first_name_error').addClass('d-none');
            $('#custom_first_name').removeClass('is-invalid').addClass('is-valid');
        }

        const lastName = $('#custom_last_name').val().trim();
        if (lastName === '') {
            $('#custom_last_name_error').removeClass('d-none');
            $('#custom_last_name').addClass('is-invalid');
            isValid = false;
        } else {
            $('#custom_last_name_error').addClass('d-none');
            $('#custom_last_name').removeClass('is-invalid').addClass('is-valid');
        }

        const emailField = $('#custom_email');
        const emailValue = emailField.val().trim();
        const emailError = $('#custom_email_error');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailValue === '' || !emailRegex.test(emailValue)) {
            emailError.removeClass('d-none');
            emailField.addClass('is-invalid');
            isValid = false;
        } else {
            emailError.addClass('d-none');
            emailField.removeClass('is-invalid').addClass('is-valid');
        }

        const phoneNumber = $('#custom_phone').val().trim();
        const phoneRegex = /^[0-9]{10,15}$/; 
        if (phoneNumber === '' || !phoneRegex.test(phoneNumber)) {
            $('#custom_phone_error').removeClass('d-none');
            $('#custom_phone').addClass('is-invalid');
            isValid = false;
        } else {
            $('#custom_phone_error').addClass('d-none');
            $('#custom_phone').removeClass('is-invalid').addClass('is-valid');
        }

        return isValid;
    }

    $(document).on('change', '#billing-to-different-address-checkbox', function(){
        assignShippingAndBillingFields();

        if (!$('#billing-to-different-address-checkbox').is(':checked')) { 
            const BillingFieldArray = [
                '#billing_first_name',
                '#billing_last_name',
                '#billing_postcode',
                '#billing_house_number',
                '#billing_house_number_suffix',
                '#billing_address_1',
                '#billing_address_2',
                '#billing_street_name',
                '#billing_city',
                '#billing_state',
                '#billing_email'
            ];
    
            $.each(BillingFieldArray, function (index, billingField) {
                $(billingField).val('');
            });
        }
    });

    function assignShippingAndBillingFields() {
        const fieldMap = {
            '#shipping_first_name': '#billing_first_name',
            '#shipping_last_name': '#billing_last_name',
            '#shipping_postcode': '#billing_postcode',
            '#shipping_house_number': '#billing_house_number',
            '#shipping_house_number_suffix': '#billing_house_number_suffix',
            '#shipping_address_1': '#billing_address_1',
            '#shipping_address_2': '#billing_address_2',
            '#shipping_street_name': '#billing_street_name',
            '#shipping_city': '#billing_city',
            '#shipping_state': '#billing_state',
            '#shipping_email': '#billing_email'
        };

        if( $('#billing-to-different-address-checkbox').is(':checked') ){
            $('.checkout-billing-fields').addClass('d-none');
            $.each(fieldMap, function(shippingField, billingField) {
                $(billingField).val($(shippingField).val());
                console.log($(shippingField).val());
            });
        } else {
            $('.checkout-billing-fields').removeClass('d-none');
        } 
        
    }

    //Date picker calendar show hide custom js
    $('#e_deliverydate').on('click',  function(params) {
        if($('#orddd_datepicker').hasClass('custom-hidden')){
            $('#orddd_datepicker').removeClass('custom-hidden');
        } else {
            if($('#orddd_datepicker').hasClass('display-show-calendar')){
                $('#orddd_datepicker').removeClass('display-show-calendar').addClass('display-hide-calendar');
            } else {
                $('#orddd_datepicker').removeClass('display-hide-calendar').addClass('display-show-calendar');
            }
        }
    });

    $(document).on('click', 'input[name="orddd_time_slotGroup"]',  function(params) {
        $('#orddd_datepicker').addClass('custom-hidden');
    });


    function calendarDateClickListener() {
        $('a.ui-state-default').on('click', function(event) {
            $('#orddd_datepicker').addClass('custom-hidden');
        });
    }
    // Rebind after DOM updates (e.g., after an AJAX request or plugin update)
    $(document).ajaxComplete(function() {
        calendarDateClickListener();
    });

    //Popover triggered
    $('.beton-popover').popover();

    //Fields hide when payment selecting - refreshing 
    $(document).on('change', '.checkout-payment-wrapper input[name="payment_method"]', function () {
        setTimeout(function () {
            $('.checkout-payment-wrapper').removeClass('d-none');
            $('.checkout-payment-wrapper').closest('.checkout-box').removeClass('deactive').addClass('active');
        }, 2000);
    });

    $('form.checkout').on('checkout_place_order', function () {
        if ($('#billing-to-different-address-checkbox').is(':checked')) {
            assignShippingAndBillingFields();
        }
        if (!validateCheckoutCustomFields()) {
            setTimeout(function () {
                let firstInvalid = $('.is-invalid:first');
                if (firstInvalid.length) {
                    $('html, body').animate({
                        scrollTop: firstInvalid.offset().top - 100
                    }, 500);
                }
            }, 100);
            return false;
        }
        return true;
    });
    

 });