var $ = jQuery;

function aos_init() {
    AOS.init({ 
        startEvent: 'load',
        anchorPlacement: 'top-center'
    });
}

// aos init
AOS.init();

//smooth scroll
$("a.page-scroll").bind("click", function (event) {
    event.preventDefault();
    var $anchor = $(this);

    $("html, body")
        .stop()
        .animate({
                scrollTop: $($anchor.attr("href")).offset().top,
            },
            1000
        );

});

// rellax init
if ($('.rellax').length) {
    var rellax = new Rellax('.rellax', {
        speed: -1.5
    });
    if ($(window).width() > 991) {
        rellax.refresh();
    } else {
        rellax.destroy();
    }
    $(window).resize(function () {
        if ($(window).width() > 991) {
            rellax.refresh();
        } else {
            rellax.destroy();
        }
    })
}

// nice select init
if ($('select.nice-select').length) {
    $('select.nice-select').niceSelect();
}

function formFocus() {
    $('.form-group input,.form-group select').focusin(function () {
        $(this).parents('.form-group').addClass('focus-in')
    }).focusout(function () {
        $(this).parents('.form-group').removeClass('focus-in')
    })

}

formFocus();



function formStepAndValidate() {
    var form = $('.custom-form-step');
    if (form.length == 0) {
        return;
    }
    var totalNum, progressPercent;
    form.validate({
        email: {
            required: true,
            email: true
        },
        errorPlacement: function errorPlacement(error, element) {
            if (element.parent('.form-group').length) {
                element.parent('.form-group').append(error);
                console.log(element)
            } else if (element.parents('.radio-wrap').length) {
                element.parents('.radio-wrap').append(error);
            } else {
                element.after(error);
            }
        }
    });

    form.steps({
        headerTag: 'h4',
        bodyTag: '.form-step',
        transitionEffect: 'fade',
        autoFocus: true,
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            previous: "Back",
            finish: "Submit"
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onInit: function (event, currentIndex) {
            var parentSection = $(this).parents('.section'),
                customFormWrap = $(this).parents('.custom-form-step-wrap');
            $(this).find('.actions a[href="#previous"]').addClass('btn btn-main btn-transp');
            $(this).find('.actions a[href="#next"]').addClass('btn btn-main btn-hasarrow');
            $(this).find('.actions a[href="#finish"]').addClass('btn btn-main btn-hasarrow');
            $(this).parents('.section').prepend('<span class="form-step-progress"></span>');
            $(this).before('<p class="form-step-count">Question <span class="num-current">1</span> of <span class="num-total">10</span></p>');

            totalNum = $(this).find('.content .form-step').length - 1;
            progressPercent = ((currentIndex + 1) * 100) / totalNum;
            $('.form-step-progress').css({
                width: progressPercent + '%'
            });
            parentSection.find('.form-step-count .num-current').html((currentIndex + 1));
            parentSection.find('.form-step-count .num-total').html(totalNum);

            setTimeout(
                function () {
                    customFormWrap.find('.loader').fadeOut()
                }, 1000);
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            var parentSection = $(this).parents('.section'),
                customFormWrap = $(this).parents('.custom-form-step-wrap');
            progressPercent = ((currentIndex + 1) * 100) / totalNum;

            $(this).find('.actions a[href="#next"]').html('Next');

            parentSection.find('.form-step-count .num-current').html((currentIndex + 1));
            parentSection.find('.form-step-count .num-total').html(totalNum);
            $('.form-step-progress').css({
                width: progressPercent + '%'
            });

            if (currentIndex === totalNum) {
                parentSection.find('.form-step-count').hide()
                $(this).find('.actions a[href="#previous"]').parent().hide();
                parentSection.find('.form-step-progress').hide()
                customFormWrap.find('.shapes').fadeIn()
            }
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
        }
    })
}

$('.custom-form-step').validate({
    rules: {
        email: {
            required: true,
            email: true
        }
    },
    errorPlacement: function errorPlacement(error, element) {
        if (element.parent('.form-group').length) {
            element.parent('.form-group').append(error);
            console.log(element)
        } else if (element.parents('.radio-wrap').length) {
            element.parents('.radio-wrap').append(error);
        } else {
            element.after(error);
        }
    },
    
});


$('#takesurveyToggleForm').click(function (e) {
    e.preventDefault();
    $(this).parents('.takesurvey').hide();
    $(this).parents('.section').find('.custom-form-step-wrap').show();
    formStepAndValidate();
})

function getStartedForm_validate() {
    $('.getstarted-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
    });
}

function getStartedForm_submit() {
    $(".getstarted-form .btn-submit").click(function(event){
        event.preventDefault();
        if( $(".getstarted-form").valid() ){
            $( ".getstarted-form .btn-submit").attr("disabled", true);
            var form_data = $(".getstarted-form").serialize();
            var form_url = $(".getstarted-form").attr('action');
            $('body').css('cursor','wait');
            $.ajax({
                type:"POST",
                url: form_url,
                data: form_data,
                dataType:"json",
                success: function(response){
                    // console.log(response);
                    $( ".getstarted-form .btn-submit").attr("disabled", false);
                    $('body').css('cursor','auto');
                    if(response.status === "success") {
                        if(response.message === "demo") {
                            window.location.href="thankyou.php?enquiry_type=demo#sectionGetstarted";
                        }
                        else if(response.message === "contact") {
                            window.location.href="thankyou.php?enquiry_type=contact#sectionGetstarted";
                        }
                        else if(response.message === "contact") {
                           $('#msg').html('There might be some problem sending message. Please contact site admin');
                            $('#msg').css('visibility',"visible");
                        }
                    }
                    else{
                        $('#msg').html('There might be some problem sending message. Please contact site admin');
                        $('#msg').css('visibility',"visible");
                    }

                },
                error: function(err) {
                    console.log(err);
                    $('#msg').html('There might be some problem sending message. Please contact site admin');
                    $('#msg').css('visibility',"visible");
                },
            });
        }
    });

}

getStartedForm_validate();
getStartedForm_submit();

function customStepForm_submit() {
    $('.custom-form-step').submit(function (e) {
        // Stop the form submitting
        e.preventDefault();
        if ($(".custom-form-step").valid()) {
            $(".custom-form-step .survey-submit").attr("disabled", true);
            var form_data = $(".custom-form-step").serialize();
            var form_url = $(".custom-form-step").attr('action');
            $('body').css('cursor', 'wait');
            $.ajax({
                type: "POST",
                url: form_url,
                data: form_data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    $(".custom-form-step .survey-submit").attr("disabled", false);
                    $('body').css('cursor', 'auto');
                    if (response.status === "success") {
                        $('.custom-form-step').hide();
                        $('.custom-form-step-wrap .thank-you-msg-wrap').html('<div class="thank-you-msg"> <h2>Thank you.</h2> <p>One of our cybersecurity consultants will get back to you shortly with your free license for “Zone Alarm Mobile security”.</p></div>');
                        $("html, body").stop().animate({
                            scrollTop: $('.custom-form-step-wrap').parents('.section').offset().top,
                        }, 1000);
                    } else if (response.status === "failed") {
                        $('.custom-form-step-wrap .thank-you-msg-wrap').html('There is some problem submitting the entry. Please try again');
                        $('.custom-form-step-wrap .thank-you-msg-wrap').css('visibility', "visible");
                    }
                },
                error: function (err) {
                    console.log(err);
                    $('.custom-form-step-msg').html('There might be some problem sending message. Please contact site admin');
                    $('.custom-form-step-msg').css('visibility', "visible");
                },
            });
        }
    });

}


customStepForm_submit();

function animStart() {
    var objTarget = $('.footer .circ-orange-red svg'),
        offsetFromTop = objTarget.offset().top;

    $(window).scroll(function () {
        var windowScroll = $(window).scrollTop(),
            windowHeight = $(window).height();
        // console.log('Offset Top', offsetFromTop);
        // console.log('Window Height', $(window).height());
        // console.log('Window Scroll', $(window).scrollTop());
        if (offsetFromTop < (windowScroll + windowHeight)) {
            // console.log('YEAH!!!!!!!!!!!!!!');
            objTarget.addClass('anim-start')
        }
    })
}

animStart();