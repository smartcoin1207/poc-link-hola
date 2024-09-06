$(function(){
    $("#form-register").validate({
        rules: {
            password : {
                required : true,
            },
            confirm_password: {
                equalTo: "#password"
            }
        },
        messages: {
            username: {
                required: "Please provide an username"
            },
            email: {
                required: "Please provide an email"
            },
            password: {
                required: "Please provide a password"
            },
            confirm_password: {
                required: "Please provide a password",
                equalTo: "Please enter the same password"
            }
        }
    });
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        // enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : '<i class="step-back">戻る</i>',
            next : '<i class="zmdi zmdi-arrow-right"></i>',
            finish : '<i class="zmdi zmdi-arrow-right"></i>',
            current : ''
        },
        onStepChanging: function (event, currentIndex, newIndex) { 
            var project_name = $('#project_name').val();
            var company_name = $('#company_name').val();
            var user_name = $('#user_name').val();
            var contact = $('#contact').val();
            var bike_kind = $('#bike_kind').val();
            var bike_count = $('#bike_count').val();
            var distance_year = $('#distance_year').val();
            var base_line_bike_kind = $('#base_line_bike_kind').val();
            var fuel_efficiency = $('#fuel_efficiency').val();
            var emission_factor = $('#emission_factor').val();
            var ele_consum_efficiency = $('#ele_consum_efficiency').val();
            var co2_count = $('#co2_count').val();


            $('#project_name-val').text(project_name);
            $('#company_name-val').text(company_name);
            $('#user_name-val').text(user_name);
            $('#contact-val').text(contact);
            $('#bike_kind-val').text(bike_kind);
            $('#bike_count-val').text(bike_count);
            $('#distance_year-val').text(distance_year);
            $('#base_line_bike_kind-val').text(base_line_bike_kind);
            $('#fuel_efficiency-val').text(fuel_efficiency);
            $('#emission_factor-val').text(emission_factor);
            $('#ele_consum_efficiency-val').text(ele_consum_efficiency);
            $('#co2_count-val').text(co2_count);

            $("#form-register").validate().settings.ignore = ":disabled,:hidden";
            return $("#form-register").valid();
        },
        onFinishing: function (event, currentIndex) {
            // Perform any validation or operations needed before submitting the form
            return true; // Return true to proceed to onFinished
        },
        onFinished: function (event, currentIndex) {
            // Trigger form submission
            var fullUrl = window.location.href;
            console.log("Full URL: " + fullUrl);

            // Get the path of the URL
            var path = window.location.pathname;
            console.log("Path: " + path);

            // Check if the path includes 'bike-check'
            if (path.includes('bike-check')) {
                location.href = "./bike-calculate";
            } else {
                $("#form-register").submit();
            }
        }
    });
});
