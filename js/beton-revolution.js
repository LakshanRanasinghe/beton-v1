jQuery(document).ready(function ($) {
    console.log('beton-revolution.js loaded');

    // Helper function to handle both comma and period decimals
    function parseInput(value) {
        if (!value) return 0; // Return 0 if the field is empty
        // Replace comma with dot, then convert to a float
        const parsedValue = parseFloat(value.toString().replace(',', '.'));
        // If the result is Not a Number (NaN), return 0 to prevent calculation errors
        return isNaN(parsedValue) ? 0 : parsedValue; 
    }

    // Calculate Cubic Meters
    $('#bpc-kuub-result-calc-btn').on('click', function () {
        // Read the raw values
        const lengthRaw = $('#bpc-kuub-length-input').val();
        const widthRaw = $('#bpc-kuub-width-input').val();
        const heightRaw = $('#bpc-kuub-height-input').val();

        // Sanitize and parse the values
        const length = parseInput(lengthRaw);
        const width = parseInput(widthRaw);
        const height = parseInput(heightRaw);

        // Calculate the result
        const result = length * width * height;

        // Format the result to a maximum of 2 decimal places and display it
        // Note: Using replace('.', ',') to show the output in Dutch format
        const formattedResult = result.toFixed(2).replace('.00', '').replace('.', ',');

        $('#bpc-kuub-result-value').text(formattedResult);
    });

    // Toggle BTW & Price synchronization
    function updateCheckoutButtonPrice() {
        var isInclBtw = $('#bpc-btw-toggle').is(':checked');
        var $activeSource = isInclBtw ? $('#total_formatted') : $('#sub_total_formatted');
        if ($activeSource.length && $('#total_formatted_price').length) {
            $('#total_formatted_price').html($activeSource.html());
        }
    }

    function toggleBTW() {
        if ($('#bpc-btw-toggle').is(':checked')) {
            $('#total_formatted').show();
            $('#sub_total_formatted').hide();
            $('.bpc-btw-label').text('Incl. btw');
        } else {
            $('#total_formatted').hide();
            $('#sub_total_formatted').show();
            $('.bpc-btw-label').text('Excl. btw');
        }
        updateCheckoutButtonPrice();
    }

    // Run on load
    toggleBTW();

    // Run on change
    $('#bpc-btw-toggle').on('change', toggleBTW);

    // Observe price changes to update the checkout button price
    var subTotalEl = document.getElementById('sub_total_formatted');
    var totalEl = document.getElementById('total_formatted');

    if (window.MutationObserver) {
        var priceObserver = new MutationObserver(function() {
            updateCheckoutButtonPrice();
        });

        if (subTotalEl) {
            priceObserver.observe(subTotalEl, { 
                childList: true, 
                characterData: true, 
                subtree: true 
            });
        }
        if (totalEl) {
            priceObserver.observe(totalEl, { 
                childList: true, 
                characterData: true, 
                subtree: true 
            });
        }
    }

    // Initialize Select2 on the timeslot dropdown
    $('#dayz_date_mapper_timeslots').select2({
        placeholder: "Selecteer tijdslot",
        allowClear: true,
        width: '100%'
    });

     // Helper to set cookie
    function setCookie(name, value, days = 7) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + encodeURIComponent(value) + "; path=/" + expires;
    }

    // DATE CHANGE
    $('.dayz-date-mapper-date-picker').on('change', function() {
        let selectedDate = $(this).val();

        // also update hidden field if needed
        $('#dayz_date_mapper_date').val(selectedDate);
        setCookie('ddm_selected_date', selectedDate);
    });

    // TIMESLOT CHANGE (Select2 compatible)
    $('#dayz_date_mapper_timeslots').on('change', function() {
        let selectedSlots = $(this).val(); // array
        let container = $(this).next('.select2-container');

        if ($(this).val() && $(this).val().length > 0) {
            container.find('.select2-selection').addClass('valid');
        } else {
            container.find('.select2-selection').removeClass('valid');
        }

        // convert array to string
        let slotsString = selectedSlots ? selectedSlots.join(',') : '';
        setCookie('ddm_selected_timeslots', slotsString);
    });

    // Restore Date and Timeslots from cookies if available
    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        if (match) return decodeURIComponent(match[2]);
        return null;
    }

    let savedDate = getCookie('ddm_selected_date');
    if (savedDate) {
        $('.dayz-date-mapper-date-picker').val(savedDate);
        $('.dayz-date-mapper-date-picker').each(function() {
            if (this._flatpickr) {
                this._flatpickr.setDate(savedDate, false);
            }
        });
        $('#dayz_date_mapper_date').val(savedDate);
    }

    let savedSlots = getCookie('ddm_selected_timeslots');
    if (savedSlots) {
        let slotsArray = savedSlots.split(',');
        $('#dayz_date_mapper_timeslots').val(slotsArray).trigger('change');
    }


    // Remove error class when user types / changes inputs
    $('.bpc-text-input, .dayz-date-mapper-date-picker, select[name="surface"], select[name="num-rooms"]').on('input change', function () {
        if ($(this).val() && $(this).val().toString().trim() !== '' && $(this).val() != 0) {
            $(this).removeClass('bpc-input-error');
        }
    });

    // Remove error class when user selects timeslots
    $('#dayz_date_mapper_timeslots').on('change', function () {
        $(this).next('.select2-container').find('.select2-selection').removeClass('bpc-input-error');
    });


    /**===========================================
     * Main functions
     *===========================================*/

    // Global variable
    let currentCubicMeters = 0;

    // Check if the user has already selected a postcode and cubic meters
    if ($.cookie("selected_area_code") !== undefined && $.cookie("selected_area_code") !== "") {
        if ($.cookie("selected_city") !== undefined && $.cookie("selected_city") !== "") {
            $("#postcode-input").val($.cookie("selected_city"));
            enableSecondStep();
        }

        if ($.cookie("selected_cubic_meters") !== undefined && $.cookie("selected_cubic_meters") !== "") {
            currentCubicMeters = $.cookie("selected_cubic_meters");
            $("#cubic-meters").val(currentCubicMeters);
            enableSecondStep();
        }
    } else {
        if ($.cookie("selected_city") !== undefined && $.cookie("selected_city") !== "") {
            $("#postcode-input").val($.cookie("selected_city"));
        }
        if ($.cookie("selected_cubic_meters") !== undefined && $.cookie("selected_cubic_meters") !== "") {
            currentCubicMeters = $.cookie("selected_cubic_meters");
            $("#cubic-meters").val(currentCubicMeters);
        }
    }
    
    // Always validate on load to ensure proper disabled state
    enableSecondStep();

    
    // Postcode autocomplete
    $("#postcode-input").on("keyup", function (e) {
        const query = $(this).val();
        $("#postcode-input").removeClass("selected");
        // Clear previous autocomplete suggestions
        $("#autocomplete-list").remove();

        if (query.length >= 2) {
            // Filter results based on the input query
            const filteredResults = betonData.postcodes.filter((item) => {
                // Check if the city name or any zip code matches the query
                return item.city_name.toLowerCase().includes(query.toLowerCase()) || item.zip.split(",").some((zip) => zip.includes(query));
            });
            

            // Create a dropdown list for suggestions
            const dropdown = $('<div id="autocomplete-list" class="dropdown-menu mt-1"></div>');
            filteredResults.forEach((item) => {
                const suggestion = $(
                `<a href="#" class="dropdown-item" data-postcodes="${item.zip}" data-id="${item.id}" data-area-code="${item.area_code}">${item.city_name}</a>`
                );
                dropdown.append(suggestion);
            });

            // Append dropdown to the input field
            $("#postcode-input").after(dropdown);
            dropdown.show();

            // Auto-click if only 1 result or exact match
            if (filteredResults.length === 1) {

                if (e.key === "Backspace") {
                return;
                }

                setTimeout(() => {
                $("#autocomplete-list .dropdown-item").first().trigger("click");
                }, 100);

                $("#postcode-input").addClass("selected");
                console.log('length equals');
            } else {
                // Check for exact match only
                const exactMatch = filteredResults.find(item => 
                item.city_name.toLowerCase() === query.toLowerCase() ||
                item.zip.split(",").includes(query) ||
                item.area_code === query
                );
                
                if (exactMatch) {
                setTimeout(() => {
                    $("#autocomplete-list .dropdown-item").filter(function() {
                            return $(this).text().trim().toLowerCase() === exactMatch.city_name.toLowerCase();
                            }).first().trigger("click");
                }, 100);

                $("#postcode-input").addClass("selected");
                console.log('length not equals');
                }
            }

            
        } else {
            $("#autocomplete-list").remove(); // Clear suggestions for short queries
        }

    });

    $("#postcode-input").on("input change blur", function () {
        $(this).removeClass("bpc-input-error");
        enableSecondStep();
    });

    // Postcode autocomplete click
    $(document).on("click", "#autocomplete-list .dropdown-item", function (e) {
        e.preventDefault();
        $("#postcode-input").addClass("selected");
        const selectedName = $(this).text();
        const selectedId = $(this).data("id");
        const selectedPostcodes = $(this).data("postcodes");
        const selectedAreaCode = $(this).data("area-code");
        // Set input value to selected suggestion
        $("#postcode-input").val(selectedName);

        if (selectedPostcodes == "") {
            return false;
        }
        // Store the selected ID in cookies
        document.cookie = `selected_city=${selectedName}; path=/`;
        document.cookie = `selected_area_code=${selectedAreaCode}; path=/`;

        // Hide dropdown
        $("#autocomplete-list").remove();

        var distance_data = {
            action: "calculate_travel_distance",
            city: selectedName,
        };
        setPriceLoading(true);
        $.post(betonData.ajax_url, distance_data, function (response) {
            if (response && response.success && response.data && typeof response.data.distance !== "undefined") {
                document.cookie = `travelling_distance=${response.data.distance}; path=/`;
            }
            enableSecondStep();
        }).fail(function () {
            enableSecondStep();
        });
    });

    // Hide suggestions if clicked outside
    $(document).on("click", function (e) {
        if (!$(e.target).closest("#postcode-input").length) {
            $("#autocomplete-list").remove();
        }
    });

    // Enable second step
    function enableSecondStep() {
        if ($("#postcode-input").val() == "" || currentCubicMeters == "" || currentCubicMeters <= 0) {
           // Do nothing
        } else {
           if (typeof trigger_calculator === "function") {
               trigger_calculator();
           }
        }
    }

    // Intercept interactions on the rest of the form if location/kuub aren't filled
    $(".bpc-card").on("click change focusin", "input, select, button, label", function (e) {
        // Ignore programmatic/synthetic events (e.g. .trigger('change') during script initialization)
        if (!e.originalEvent || e.originalEvent.isTrusted === false) {
            return;
        }

        let $target = $(e.currentTarget);
        
        let $parentSection = $target.closest(".bpc-section");
        let $checkout = $target.closest(".bpc-checkout");
        
        // Allow interactions if inside the first section or not in a subsequent module
        if (($parentSection.length && $parentSection.is($(".bpc-card .bpc-section").first())) || (!$parentSection.length && !$checkout.length)) {
            return;
        }

        let isLocationFilled = $("#postcode-input").val() && $("#postcode-input").val().trim() !== "";
        let isKuubFilled = currentCubicMeters && currentCubicMeters > 0;

        if (!isKuubFilled || !isLocationFilled) {
            e.preventDefault();
            e.stopPropagation();

            if (e.type === "focusin") {
                $target.blur();
            }

            if (!isLocationFilled && isKuubFilled) {
                $("#postcode-input").focus().addClass("bpc-input-error");
            } else {
                // Focus cubic-meters if both empty, or if only it is empty
                $("#cubic-meters").focus().addClass("bpc-input-error");
            }
        }
    });

    // Cubic meters change function
    function cubicMetersChange(value, step) {
        step || (step = 1.0);

        value = parseFloat(value.toString().replace(',', '.')) || 0;

        var inv = 1.0 / step;
        var rounded = Math.ceil(value * inv) / inv;

        return rounded;
    }

   // Cubic meters change
   $("#cubic-meters").on("change", function () {
        $(this).removeClass("bpc-input-error");

        let rawValue = $(this).val();
        let rounded = cubicMetersChange(rawValue, 0.25);

        currentCubicMeters = rounded;

        if (rawValue.includes(',')) {
            $(this).val(rounded.toString().replace('.', ','));
        } else {
            $(this).val(rounded);
        }

        document.cookie = `selected_cubic_meters=${rounded}; path=/`;
        enableSecondStep();

    });

    $("#cubic-meters").on("keyup input", function () {
        $(this).removeClass("bpc-input-error");
        currentCubicMeters = parseFloat($(this).val().toString().replace(',', '.')) || 0;
        enableSecondStep();
    });


    // Helper to toggle price loading state on the calculator
    function setPriceLoading(isLoading) {
        var isAllIn = $('input[name="performance"]:checked').val() === 'allIn';

        if (isLoading) {
            $('.bpc-price-amount').addClass('loading-price');
            $('#total_formatted_price').addClass('loading-price');
            $('#bpc-price-loader').css('display', 'inline-flex');
            $('#bpc-checkout-price-loader').css('display', 'inline-flex');

            if (isAllIn) {
                $('#allIn_price_wrap').css('display', 'inline-flex');
                $('#bpc-allin-price-loader').css('display', 'inline-flex');
                $('#allIn_formatted').addClass('loading-price');
            }
        } else {
            $('.bpc-price-amount').removeClass('loading-price');
            $('#total_formatted_price').removeClass('loading-price');
            $('#bpc-price-loader').hide();
            $('#bpc-checkout-price-loader').hide();
            $('#bpc-allin-price-loader').hide();
            $('#allIn_formatted').removeClass('loading-price');

            if (!$('#allIn_formatted').text().trim() || !isAllIn) {
                $('#allIn_price_wrap').hide();
            }
        }
    }

    var activeCalculatorXhr = null;
    var calculatorDebounceTimer = null;
    var calculatorRequestId = 0;

    // Debounced trigger_calculator to prevent race conditions and multiple rapid requests
    window.trigger_calculator = function trigger_calculator(immediate) {
        setPriceLoading(true);
        clearTimeout(calculatorDebounceTimer);

        var delay = immediate ? 0 : 200;
        calculatorDebounceTimer = setTimeout(function () {
            executeCalculator();
        }, delay);
    }

    function executeCalculator() {
        if (!currentCubicMeters || parseFloat(currentCubicMeters) <= 0 || !$("#postcode-input").val()) {
            setPriceLoading(false);
            $(".summary-content").removeClass("loading");
            return;
        }

        var requestId = ++calculatorRequestId;

        let compounds = [];
        $('input[name="compound"]:checked').each(function () {
            compounds.push($(this).attr("value"));
        });

        let release_method = "gutter";
        let pump_type = null;
        let pumping_distance = 0;
        $("#release_method_name").text("");
        if ($('input[name="releaseMethod"]:checked').val() == "pump") {
            release_method = "pump";
            console.log("pump");
            $(".release-method-pump-cost-wrapper").removeClass("d-none");
            $(".release-by-pump").removeClass("d-none").addClass("d-block");

            pump_type = $('input[name="pump-type"]:checked').val();

            if (pump_type == "mini") {
                pumping_distance = $('select[name="mini_pumping_distance"]').val();
                $("#release_method_name").text(": Pomp");
                $('#hoog-vloeibaar_input').prop('disabled', true);
                $('#fijn-grind_input').prop('disabled', true);
            } else {
                pumping_distance = $('select[name="boom_pumping_distance"]').val();
                if (pump_type == "boom") {
                    $("#release_method_name").text(": Giekpomp");
                }
                $('#hoog-vloeibaar_input').prop('disabled', false);
                $('#fijn-grind_input').prop('disabled', false);
            }
        } else {
            console.log("no pump");
            $(".release-method-pump-cost-wrapper").addClass("d-none");
            $(".release-by-pump").removeClass("d-block").addClass("d-none");
            $('#hoog-vloeibaar_input').prop('disabled', false);
            $('#fijn-grind_input').prop('disabled', false);
        }

        let performance = $('input[name="performance"]:checked').val();
        let layer_thickness = $("#layer-thickness").val();
        let rooms_count = $("#num-rooms").val();
        let butterfly_floor = $("#butterfly-floor").is(":checked") ? 1 : 0;
        let surface = $('select[name="surface"]').val();
        let selected_floor = $("#mezzanine-floor").is(":checked") ? 1 : 0;

        let dataSet = {
            nonce: (typeof betonData !== 'undefined' && betonData.nonce) ? betonData.nonce : ($("#beton_nonce").val() || ''),
            action: "beton_calculator",
            city: $("#postcode-input").val(),
            cubic_meters: currentCubicMeters,
            area_code: $.cookie("selected_area_code"),
            application: $('input[name="application"]:checked').val(),
            compounds: compounds,
            release_method: release_method,
            pump_type: pump_type,
            pumping_distance: pumping_distance,
            performance: performance,
            layer_thickness: layer_thickness,
            rooms_count: rooms_count,
            butterfly_floor: butterfly_floor,
            surface: surface,
            selected_floor: selected_floor,
        };

        console.log(dataSet);

        if (activeCalculatorXhr && activeCalculatorXhr.readyState !== 4) {
            activeCalculatorXhr.abort();
        }
        
        activeCalculatorXhr = $.ajax({
            type: "post",
            url: betonData.ajax_url,
            data: dataSet,
            beforeSend: function () {
                setPriceLoading(true);
                $(".summary-content").addClass("loading");
            },
            success: function (response) {
                console.log(response);
                // Discard response if a newer calculation was already dispatched
                if (requestId !== calculatorRequestId) {
                    return;
                }
                if (response.data) {
                    $(".dynamic-hide").removeClass("d-flex").addClass("d-none");
                    $(".hide-on-ajax").addClass("d-none");
                    $.each(response.data.dynamic_pricing, function (index, val) {
                        if ($("#" + index).length > 0) {
                            $("#" + index).html(val);

                            if ($("#" + index).hasClass("dynamic-hide")) {
                                $("#" + index)
                                    .removeClass("d-none")
                                    .addClass("d-flex");
                            }
                        }
                    });

                    // All-in price visibility: hide if 0 or not All-in
                    var isAllIn = $('input[name="performance"]:checked').val() === 'allIn';
                    var allInCost = (response.data.dynamic_pricing && response.data.dynamic_pricing.allIn_cost)
                        ? parseFloat(response.data.dynamic_pricing.allIn_cost)
                        : 0;

                    if (isAllIn && allInCost > 0) {
                        $('#allIn_price_wrap').css('display', 'inline-flex');
                    } else {
                        $('#allIn_price_wrap').hide();
                        $('#allIn_formatted').empty();
                    }

                    updateCheckoutButtonPrice();
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                if (textStatus === "abort") {
                    return;
                }
                console.error("Calculator AJAX Error:", textStatus, errorThrown);
            },
            complete: function (jqXHR, textStatus) {
                // Only hide loading indicators if this is the latest request
                if (requestId === calculatorRequestId && textStatus !== "abort") {
                    setPriceLoading(false);
                    $(".summary-content").removeClass("loading");
                }
            }
        });
    }

    // Trigger calculator after page load
    setTimeout(function(){
        trigger_calculator();
    }, 250);

    // Application change
    $('input[name="application"]').on("change", function () {
        trigger_calculator();
    });

    // Compound change
    $('input[name="compound"]').on("change", function () {
        trigger_calculator();
    });

    // Track user compound preferences when not forced by pump
    let userSelectedHoogVloeibaar = $('#hoog-vloeibaar_input').is(':checked') && !$('#hoog-vloeibaar_input').is(':disabled');
    let userSelectedFijnGrind = $('#fijn-grind_input').is(':checked') && !$('#fijn-grind_input').is(':disabled');

    $('#hoog-vloeibaar_input').on('click change', function () {
        if (!$(this).is(':disabled') && $('input[name="releaseMethod"]:checked').val() !== 'pump') {
            userSelectedHoogVloeibaar = $(this).is(':checked');
        }
    });

    $('#fijn-grind_input').on('click change', function () {
        if (!$(this).is(':disabled') && $('input[name="releaseMethod"]:checked').val() !== 'pump') {
            userSelectedFijnGrind = $(this).is(':checked');
        }
    });

    // Release method change
    $('input[name="releaseMethod"]').on("change", function () {
        if ($('input[name="releaseMethod"]:checked').val() === "pump") {
            if (!$('#hoog-vloeibaar_input').is(':disabled')) {
                userSelectedHoogVloeibaar = $('#hoog-vloeibaar_input').is(':checked');
            }
            if (!$('#fijn-grind_input').is(':disabled')) {
                userSelectedFijnGrind = $('#fijn-grind_input').is(':checked');
            }

            $("#kies-pomp-section").show();
            if(!$('#miniPump').is(':checked')){
                $('#miniPump').prop('checked', true).trigger('change');
                $('select[name="mini_pumping_distance"]').addClass('blink-shadow');
            }
        } else {
            $("#kies-pomp-section").hide();
            $('#miniPump').prop('checked', false);

            $('#hoog-vloeibaar_input').prop('disabled', false).prop('checked', userSelectedHoogVloeibaar);
            $('#fijn-grind_input').prop('disabled', false).prop('checked', userSelectedFijnGrind);
        }
        trigger_calculator();
    });

    // Prevent deselecting miniPump if pump is selected
    $("#miniPump").on("click", function(e) {
        if ($('input[name="releaseMethod"]:checked').val() === "pump") {
            e.preventDefault();
        }
    });

    // Prevent label click bubbling from pompafstand select dropdown
    $('.pompafstand-section').on('click mousedown touchstart pointerdown', function (e) {
        e.stopPropagation();
    });

    // Run on load
    if ($('input[name="releaseMethod"]:checked').val() === "pump") {
        $("#kies-pomp-section").show();
        if(!$('#miniPump').is(':checked')){
            $('#miniPump').prop('checked', true);
        }
    } else {
        $("#kies-pomp-section").hide();
    }

    // Pump type change
    $('input[name="pump-type"]').on("change", function () {
        if ($('input[name="releaseMethod"]:checked').val() !== "pump" || !$(this).is(':checked')) {
            return;
        }

        if ($(this).val() == "boom") {
            $("#mini-pump-breakdown").addClass("d-none");
            //$('.pump-horse').addClass('d-none');
            $('#hoog-vloeibaar_input').prop('disabled', false).prop('checked', userSelectedHoogVloeibaar);
            $('#fijn-grind_input').prop('disabled', false).prop('checked', userSelectedFijnGrind);

            $('#extra_hose_length').text($('select[name="boom_pumping_distance"]').val() + 'm');

            $('.mini-pump-breakdown-properties').addClass('d-none');
        } else {
            $("#mini-pump-breakdown").removeClass("d-none");
            $('.mini-pump-breakdown-properties').removeClass('d-none');
            //$('.pump-horse').removeClass('d-none');

            //Mini Pump must have below selections
            $('#hoog-vloeibaar_input').prop('checked', true).prop('disabled', true);
            $('#fijn-grind_input').prop('checked', true).prop('disabled', true);

            $('#extra_hose_length').text($('select[name="mini_pumping_distance"]').val() + 'm');
        }

        $('.custom-select-box').removeClass('blink-shadow');
        $(this).parents('.pump-wrap').find('.custom-select-box').addClass('blink-shadow');

        $('.pump-wrap').removeClass('active');
        $(this).parents('.pump-wrap').addClass('active');
        trigger_calculator();
    });

    $('select[name="mini_pumping_distance"]').on("change", function () {
        $(this).removeClass('blink-shadow');
        trigger_calculator();
        $("#extra_hose_length").text($(this).val() + "m");
    });
    
    $('select[name="boom_pumping_distance"]').on("change", function () {
        $(this).removeClass('blink-shadow');
        trigger_calculator();
        $("#extra_hose_length").text($(this).val() + "m");
    });
    $('select[name="surface"]').on("change", function () {
        if ($(this).val() != 0) {
            $(this).removeClass("blink-shadow");
        } else {
            $(this).addClass("blink-shadow");
        }
        trigger_calculator();
    });

    // Performance change
    $('input[name="performance"]').on("change", function () {
        const $vlinderSection = $('.bpc-vlinder-row').closest('.bpc-section');

        if ($('input[name="performance"]:checked').val() == "allIn") {
            $("#pump").prop("checked", true).trigger("change");
            $(".all-in-cost-wrapper").removeClass("d-none");
            $(".execution-section").addClass("d-block").removeClass('d-none');
            // $("#miniPump").click(); // Removed to prevent conflict with our click interceptor
            $('.release-method-pump-wrapper').find('.section-title').text('Pompafstand');
            if (!$('select[name="mini_pumping_distance"]').val()) {
                var defaultValue = $('select[name="mini_pumping_distance"] option[selected]').val() || '5';
                $('select[name="mini_pumping_distance"]').val(defaultValue).trigger('change');
            } else {
                $('select[name="mini_pumping_distance"]').trigger('change');
            }

            $(".giekpomp-continer").addClass("d-none");
            $(".pump-continer .custom-select-box").addClass("blink-shadow");

            if ($("#surface").val() == 0) {
                $("#surface").addClass("blink-shadow");
            } else {
                $("#surface").removeClass("blink-shadow");
            }

            if ($("#num-rooms").val() == 0) {
                $("#num-rooms").addClass("blink-shadow");
            } else {
                $("#num-rooms").removeClass("blink-shadow");
            }


            $('#butterfly-floor').prop('checked', false);

            $vlinderSection.removeClass('bpc-section-disabled');
            $vlinderSection.find('input, select').prop('disabled', false);
            
            $('.bpc-notice-box').hide();

        } else {
            $('#allIn_price_wrap').hide();
            $('#bpc-allin-price-loader').hide();
            $('#allIn_formatted').empty();

            $("#surface").removeClass("blink-shadow");
            $("#num-rooms").removeClass("blink-shadow");

            $('.bpc-notice-box').show();

            $('#fromGutter').prop("checked", true).trigger("change");
            $('.release-method-section-1').addClass('d-sm-block');
            $('.pump-wrap').removeClass('show-pump-distance');
            $('.release-method-pump-wrapper').find('.section-title').text('KIES POMP');

            trigger_calculator();
            $(".all-in-cost-wrapper").addClass("d-none");
            $(".execution-section").addClass("d-none").removeClass('d-sm-block');
            
            $(".giekpomp-continer").removeClass("d-none");
            if ($(document).width() <= 576) {
                $(".release-method-pump-wrapper").removeClass('d-block').addClass("d-none");
                $(".release-method-section-2-wrapper").removeClass('d-block').addClass("d-none");
            }  

            $(".pompafstand-section").removeClass("all-in-one-selected");

            $('#snelhardend_input, #vlinderbeton_input').each(function () {
                this.disabled = false;

                this.dispatchEvent(
                    new Event('change', { bubbles: true })
                );
            });

            $vlinderSection.addClass('bpc-section-disabled');
            $vlinderSection.find('input, select').prop('disabled', true);
            
            // Optional: Reset the fields when disabled so hidden values aren't submitted
            $vlinderSection.find('input[type="checkbox"]').prop('checked', false);
            $vlinderSection.find('select').val('0'); // Resets selects to their default "0" value
            $('#layer-thickness').val('5-10'); // Resets laagdikte to its default
        }
    
    });

    $('input[name="performance"]:checked').trigger('change');

    // Handle form restore when navigating back from checkout
    $(window).on('pageshow', function() {
        setTimeout(function() {
            if ($('input[name="releaseMethod"]:checked').val() !== "pump") {
                userSelectedHoogVloeibaar = $('#hoog-vloeibaar_input').is(':checked');
                userSelectedFijnGrind = $('#fijn-grind_input').is(':checked');
            }
            $('input[name="releaseMethod"]:checked').trigger('change');
            $('input[name="pump-type"]:checked').trigger('change');
            $('input[name="performance"]:checked').trigger('change');
        }, 150);
    });

    $('select[name="num-rooms"]').on("change", function () {
        if ($(this).val() != 0) {
            $(this).removeClass("blink-shadow");
        } else {
            $(this).addClass("blink-shadow");
        }
        trigger_calculator();
    });
    $('select[name="layer-thickness"]').on("change", function () {
        trigger_calculator();
    });

    $("#mezzanine-floor").on("change", function () {
        trigger_calculator();
    });

    // Submit to checkout button
    $(".submit-btn").on("click", function (e) {
        e.preventDefault();
        if ($(this).val() == "quote") {
            const pdfEmail = $('#email').val().trim();

            e.stopPropagation();
            $('.voer-uw-e-mailadres-wrapper').removeClass('d-none');

            if ($('.voer-uw-e-mailadres-wrapper').hasClass('selected')) {
                if (isValidEmail(pdfEmail)) {

                if ($('input[name="performance"]:checked').val() == "allIn") {
                    if (($("#num-rooms").val() != 0) && ($("#surface").val() != 0)) {
                        $('.submit-btn[value="quote"] span').addClass('dayz-loader');
                        send_to_quotation();
                    } else {
                        showPopupAlert("Gelieve zowel oppervlak als aantal kamers in te vullen.", "Velden ontbreken", function () {
                            $('#surface').focus();
                        });
                    }
                } else {
                    $('.submit-btn[value="quote"] span').addClass('dayz-loader');
                    send_to_quotation();
                }

                var orderTotalExclTax = $('#sub_total_formatted bdi').text().replace('€', '').trim();
                var orderTotalInclTax = $('#total_formatted bdi').text().replace('€', '').trim();

                dataLayer.push({
                    'event': 'gaEvent',
                        'eventAction': 'quoteRequestSend',
                    'orderTotalExclTax': orderTotalExclTax,
                    'orderTotalInclTax': orderTotalInclTax,
                    'timestamp': new Date().toISOString()
                });

                } else {
                    showPopupAlert("Vul alstublieft uw e-mailadres in.", "E-mailadres vereist", function () {
                        $('#email').focus();
                    });
                }
            } else {
                $('.voer-uw-e-mailadres-wrapper').addClass('selected');
                $(this).addClass('selected');
            }

            var orderTotalExclTax = $('#sub_total_formatted bdi').text().replace('€', '').trim();
            var orderTotalInclTax = $('#total_formatted bdi').text().replace('€', '').trim();

            dataLayer.push({
                'event': 'gaEvent',
                'eventAction': 'quoteRequestBtnClick',
                'timestamp': new Date().toISOString()
            });

        } else {
            let $checkoutBtn = $('.bpc-checkout-btn');

            if (!validateFields()) {
                $checkoutBtn.removeClass('is-loading').prop('disabled', false);
                $checkoutBtn.find('.loader-wrapper').removeClass('dayz-loader');
                return false; // HARD STOP
            }

            $checkoutBtn.addClass('is-loading').prop('disabled', true);
            $checkoutBtn.find('.loader-wrapper').addClass('dayz-loader');

            send_to_cart();

            dataLayer.push({
                'event': 'gaEvent',
                'eventAction': 'orderBtnClick',
                'timestamp': new Date().toISOString()
            });
            
        }
        console.log($(this).val());
    });

    // Modal Open & Close Helpers
    function openQuoteModal() {
        $('#bpc-modal-email-error').hide().text('');
        $('#bpc-modal-quote-success').hide().text('');
        $('#bpc-quote-modal').show();
        $('#bpc-quote-modal .custom-modal-overlay').css('display', 'flex').hide().fadeIn(200);
        setTimeout(function () {
            $('#bpc-modal-email').focus();
        }, 200);
    }

    function closeQuoteModal() {
        $('#bpc-quote-modal .custom-modal-overlay').fadeOut(200, function () {
            $('#bpc-quote-modal').hide();
        });
    }

    // ── Custom Popup Alert System ──
    var alertCallback = null;

    function showPopupAlert(message, title, onConfirm) {
        title = title || "Let op";
        alertCallback = typeof onConfirm === "function" ? onConfirm : null;

        // Dynamic fallback if modal markup is not present
        if ($('#bpc-alert-modal').length === 0) {
            $('body').append(`
                <div class="bpc-custom-modal-container bpc-alert-modal-container" id="bpc-alert-modal" style="display: none;">
                    <div class="custom-modal-overlay">
                        <div class="custom-modal bpc-alert-modal">
                            <div class="bpc-alert-modal-content">
                                <div class="bpc-alert-icon-badge">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="10" stroke="#FCA01A" stroke-width="2"/>
                                        <path d="M12 7V13" stroke="#FCA01A" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="12" cy="16.5" r="1" fill="#FCA01A"/>
                                    </svg>
                                </div>
                                <div class="bpc-alert-text">
                                    <h3 class="bpc-alert-title" id="bpc-alert-title"></h3>
                                    <p class="bpc-alert-message" id="bpc-alert-message"></p>
                                </div>
                                <button class="modal-close bpc-alert-close" id="bpc-alert-close-btn" aria-label="Sluiten" type="button">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18.364 5.63604C18.7545 6.02656 18.7545 6.65973 18.364 7.05025L13.4142 12L18.364 16.9497C18.7545 17.3403 18.7545 17.9734 18.364 18.364C17.9734 18.7545 17.3403 18.7545 16.9497 18.364L12 13.4142L7.05025 18.364C6.65973 18.7545 6.02656 18.7545 5.63604 18.364C5.24552 17.9734 5.24552 17.3403 5.63604 16.9497L10.5858 12L5.63604 7.05025C5.24552 6.65973 5.24552 6.02656 5.63604 5.63604C6.02656 5.24552 6.65973 5.24552 7.05025 5.63604L12 10.5858L16.9497 5.63604C17.3403 5.24552 17.9734 5.24552 18.364 5.63604Z"
                                            fill="#111111" />
                                    </svg>
                                </button>
                            </div>
                            <div class="bpc-alert-actions">
                                <button type="button" class="bpc-alert-confirm-btn" id="bpc-alert-ok-btn">Begrepen</button>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        }

        $('#bpc-alert-title').text(title);
        $('#bpc-alert-message').text(message);
        $('#bpc-alert-modal').show();
        $('#bpc-alert-modal .custom-modal-overlay').css('display', 'flex').hide().fadeIn(200);
        $('#bpc-alert-ok-btn').focus();
    }

    function closePopupAlert() {
        $('#bpc-alert-modal .custom-modal-overlay').fadeOut(150, function () {
            $('#bpc-alert-modal').hide();
            if (typeof alertCallback === "function") {
                var cb = alertCallback;
                alertCallback = null;
                cb();
            }
        });
    }

    $(document).on('click', '#bpc-alert-ok-btn, #bpc-alert-close-btn', function (e) {
        e.preventDefault();
        closePopupAlert();
    });

    $(document).on('click', '#bpc-alert-modal .custom-modal-overlay', function (e) {
        if ($(e.target).is('#bpc-alert-modal .custom-modal-overlay')) {
            closePopupAlert();
        }
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && $('#bpc-alert-modal').is(':visible')) {
            closePopupAlert();
        }
    });

    // Expose showPopupAlert globally and override native alert
    window.showPopupAlert = showPopupAlert;
    window.alert = function (message) {
        showPopupAlert(message);
    };

    // Open Quote Modal
    $('#bpc-open-quote-modal-btn').on('click', function (e) {
        e.preventDefault();

        let cubic = ($('#cubic-meters').val() || '').trim();
        let postcode = ($('#postcode-input').val() || '').trim();

        // Clear previous errors
        $('#cubic-meters, #postcode-input, #surface, #num-rooms').removeClass('bpc-input-error');

        let hasError = false;
        let firstInvalid = null;

        if (!cubic || parseFloat(cubic.replace(',', '.')) <= 0) {
            $('#cubic-meters').addClass('bpc-input-error');
            hasError = true;
            firstInvalid = firstInvalid || $('#cubic-meters');
        }

        if (!postcode) {
            $('#postcode-input').addClass('bpc-input-error');
            hasError = true;
            firstInvalid = firstInvalid || $('#postcode-input');
        }

        if ($('input[name="performance"]:checked').val() === "allIn") {
            if (!$("#surface").val() || $("#surface").val() == 0) {
                $('#surface').addClass('bpc-input-error');
                hasError = true;
                firstInvalid = firstInvalid || $('#surface');
            }
            if (!$("#num-rooms").val() || $("#num-rooms").val() == 0) {
                $('#num-rooms').addClass('bpc-input-error');
                hasError = true;
                firstInvalid = firstInvalid || $('#num-rooms');
            }
        }

        if (hasError) {
            showPopupAlert("Gelieve alle verplichte velden in te vullen.", "Velden ontbreken", function () {
                if (firstInvalid) {
                    firstInvalid.focus();
                }
            });
            return;
        }

        let $btn = $(this);
        $btn.addClass('is-loading');
        $btn.find('.loader-wrapper').addClass('dayz-loader');

        setTimeout(function () {
            $btn.removeClass('is-loading');
            $btn.find('.loader-wrapper').removeClass('dayz-loader');
            openQuoteModal();
        }, 200);

        dataLayer.push({
            'event': 'gaEvent',
            'eventAction': 'quoteRequestBtnClick',
            'timestamp': new Date().toISOString()
        });
    });

    // Close Quote Modal
    $('#bpc-quote-modal-close').on('click', function (e) {
        e.preventDefault();
        closeQuoteModal();
    });

    // Close Modal on Overlay Click
    $('#bpc-quote-modal .custom-modal-overlay').on('click', function (e) {
        if ($(e.target).hasClass('custom-modal-overlay')) {
            closeQuoteModal();
        }
    });

    // Close Modal on ESC key
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && $('#bpc-quote-modal').is(':visible')) {
            closeQuoteModal();
        }
    });

    // Submit Quote Request from Modal
    $('#bpc-modal-submit-btn').on('click', function (e) {
        e.preventDefault();
        submitQuoteModal();
    });

    $('#bpc-modal-email').on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            submitQuoteModal();
        }
    });

    function submitQuoteModal() {
        let email = $('#bpc-modal-email').val().trim();
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email || !emailRegex.test(email)) {
            $('#bpc-modal-email-error').text("Vul alstublieft een geldig e-mailadres in.").show();
            $('#bpc-modal-email').focus();
            return;
        }

        $('#bpc-modal-email-error').hide();

        let $btn = $('#bpc-modal-submit-btn');
        $btn.addClass('is-loading').prop('disabled', true);
        $btn.find('.loader-wrapper').addClass('dayz-loader');
        $btn.find('.btn-text').text('Offerte wordt verwerkt...');

        let compositions = [];
        $('input[name="compound"]:checked').each(function () {
            compositions.push($(this).attr("value"));
        });

        let dataSet = {
            action: 'save_quotation',
            nonce: (typeof betonData !== 'undefined' && betonData.nonce) ? betonData.nonce : ($("#beton_nonce").val() || ''),
            bpc_hp: $('#bpc-modal-hp').val() || '',
            user_email: email,
            area_code: $.cookie("selected_area_code"),
            postalcode: $("#postcode-input").val(),
            cubic_meters: currentCubicMeters || parseFloat(($('#cubic-meters').val() || '0').toString().replace(',', '.')) || 0,
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
            success: function (response) {
                $btn.removeClass('is-loading').prop('disabled', false);
                $btn.find('.loader-wrapper').removeClass('dayz-loader');
                $btn.find('.btn-text').text('Offerte verzenden (PDF)');

                var orderTotalExclTax = $('#sub_total_formatted bdi').text().replace('€', '').trim();
                var orderTotalInclTax = $('#total_formatted bdi').text().replace('€', '').trim();
                dataLayer.push({
                    'event': 'gaEvent',
                    'eventAction': 'quoteRequestSend',
                    'orderTotalExclTax': orderTotalExclTax,
                    'orderTotalInclTax': orderTotalInclTax,
                    'timestamp': new Date().toISOString()
                });

                if (response.success && response.data) {
                    if (response.data.redirect) {
                        window.location.href = response.data.redirect;
                    } else {
                        $('#bpc-modal-quote-success').text("Uw offerte is succesvol verzonden naar " + email + "!").show();
                        setTimeout(function () {
                            closeQuoteModal();
                        }, 3000);
                    }
                } else {
                    let err = (response.data && typeof response.data === 'string')
                        ? response.data
                        : "Er is een fout opgetreden bij het genereren van de offerte. Probeer het opnieuw.";
                    $('#bpc-modal-email-error').text(err).show();
                }
            },
            error: function () {
                $btn.removeClass('is-loading').prop('disabled', false);
                $btn.find('.loader-wrapper').removeClass('dayz-loader');
                $btn.find('.btn-text').text('Offerte verzenden (PDF)');
                $('#bpc-modal-email-error').text("Er is een verbindingsfout opgetreden. Probeer het opnieuw.").show();
            }
        });
    }

    // Send to cart
    function send_to_cart() {
        let compositions = [];
        $('input[name="compound"]:checked').each(function () {
            compositions.push($(this).attr("value"));
        });

        let $checkoutBtn = $('.bpc-checkout-btn');

        var dataSet = {
            action: 'concrete_add_to_cart',
            nonce: (typeof betonData !== 'undefined' && betonData.nonce) ? betonData.nonce : ($("#beton_nonce").val() || ''),
            user_email: $("#email").val() || '',
            area_code: $.cookie("selected_area_code"),
            postalcode: $("#postcode-input").val(),
            cubic_meters: currentCubicMeters || parseFloat(($('#cubic-meters').val() || '0').toString().replace(',', '.')) || 0,
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
            success: function (response) {
                console.log(response);
                if (response.success && response.data && response.data.redirect) {
                    window.location.href = response.data.redirect;
                } else {
                    $checkoutBtn.removeClass('is-loading').prop('disabled', false);
                    $checkoutBtn.find('.loader-wrapper').removeClass('dayz-loader');
                    let msg = (response.data && response.data.message) ? response.data.message : "Er is een fout opgetreden bij het toevoegen aan de winkelwagen.";
                    showPopupAlert(msg, "Foutmelding");
                }
            },
            error: function () {
                $checkoutBtn.removeClass('is-loading').prop('disabled', false);
                $checkoutBtn.find('.loader-wrapper').removeClass('dayz-loader');
                showPopupAlert("Er is een verbindingsfout opgetreden. Probeer het opnieuw.", "Verbindingsfout");
            }
        });
    }

    // Validate fields
    function validateFields() {
        let isValid = true;
        let firstInvalid = null;

        // Remove all previous errors
        $('.bpc-input-error').removeClass('bpc-input-error');

        // Fields
        let cubic = $('#cubic-meters');
        let postcode = $('#postcode-input');
        let date = $('#dayz_date_mapper_date'); // hidden input
        let timeslots = $('#dayz_date_mapper_timeslots');

        // --- cubic meters ---
        let cubicVal = cubic.val() ? cubic.val().toString().trim().replace(',', '.') : '';
        if (!cubicVal || parseFloat(cubicVal) <= 0) {
            cubic.addClass('bpc-input-error');
            firstInvalid = firstInvalid || cubic;
            isValid = false;
        }

        // --- postcode ---
        let postcodeVal = (postcode.val() || '').trim();
        if (!postcodeVal) {
            postcode.addClass('bpc-input-error');
            firstInvalid = firstInvalid || postcode;
            isValid = false;
        }

        // --- date (check hidden field or date picker input) ---
        let dateVal = ($('#dayz_date_mapper_date').val() || $('.dayz-date-mapper-date-picker').val() || '').trim();
        if (!dateVal) {
            $('.dayz-date-mapper-date-picker').addClass('bpc-input-error');
            firstInvalid = firstInvalid || $('.dayz-date-mapper-date-picker');
            isValid = false;
        }

        // --- select2 timeslots ---
        if (!timeslots.val() || timeslots.val().length === 0) {
            let select2Box = timeslots.next('.select2-container').find('.select2-selection');
            select2Box.addClass('bpc-input-error');

            firstInvalid = firstInvalid || select2Box;
            isValid = false;
        }

        // --- allIn check: surface and rooms ---
        if ($('input[name="performance"]:checked').val() === "allIn") {
            let surface = $('#surface');
            let rooms = $('#num-rooms');
            if (!surface.val() || surface.val() == 0) {
                surface.addClass('bpc-input-error');
                firstInvalid = firstInvalid || surface;
                isValid = false;
            }
            if (!rooms.val() || rooms.val() == 0) {
                rooms.addClass('bpc-input-error');
                firstInvalid = firstInvalid || rooms;
                isValid = false;
            }
        }

        // --- show alert once ---
        if (!isValid) {
            showPopupAlert("Gelieve alle verplichte velden in te vullen.", "Velden ontbreken", function () {
                if (firstInvalid) {
                    firstInvalid.focus();
                }
            });
        }

        return isValid;
    }
   
});