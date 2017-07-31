connector = {
    getData: function (methodType, route, dataType, dataBlock, callbackFunction, context) {
        return $.ajax({
            async: true,
            type: methodType,
            dataType: dataType,
            url: route,
            data: dataBlock
        }).then(function (data) {
            if (callbackFunction != null && context != null) {
                callbackFunction(context, data);
            }
            return data;
        });
    }
};

$('button.navbar-toggle').on("click", function () {
    $('.collapse.navbar-collapse').toggleClass('active-block')
});

$('.dropdown').on("click", function () {
    $(this).toggleClass('open')
});

$('.dropdown').on("mouseleave", function () {
    $(this).removeClass('open')
});

$('.close-reg-form').on('click', function () {

    $('.registration-form.service-page').removeClass('registration-popup');
    $('body').css({
        'position': '',
        'width': '100%'
    })
});

$('.product-opet').on('click', function () {

    $('.registration-form.product-view').addClass('registration-popup');
    $('body').css({
        'width': '100%'
    })
});

$('.close-reg-form').on('click', function () {

    $('.registration-form.product-view').removeClass('registration-popup');
    $('body').css({
        'position': '',
        'width': '100%'
    })
});

$('.ui.modal.modal-register').modal({
    observeChanges: true,
    refresh: true
});

$(document).on('click', '.registration-button', function (e) {
    e.preventDefault();
    $('.ui.modal-register').modal('show').modal('refresh');
});

$(document).on('click', '.open-newsletter-modal', function (e) {
    e.preventDefault();
    $('.ui.modal-newsletter').modal('show').modal('refresh');
});

window.fbAsyncInit = function () {
    FB.init({
        appId: '468781016625797',
        xfbml: true,
        version: 'v2.8'
    });
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(document).on('click', '.shareBtn', function (e) {
    e.preventDefault();
    FB.ui({
        method: 'feed',
        link: $(this).attr('href'),
        caption: 'An example caption'
    }, function (response) {
    });
});

$(document).on('click', '.show-home-newest', function () {
    $(".references-home-newest").removeClass('hidden-block');
    $(".references-home-most").addClass('hidden-block');
    $('.show-home-most').removeClass('active');
    $(this).addClass('active');
});

$(document).on('click', '.show-home-most', function () {
    $(".references-home-newest").addClass('hidden-block');
    $(".references-home-most").removeClass('hidden-block');
    $('.show-home-newest').removeClass('active');
    $(this).addClass('active');
});

$(document).on('click', '.show-home-newest-prod', function () {
    $(".products-home-newest").removeClass('hidden-block');
    $(".products-home-most").addClass('hidden-block');
    $('.show-home-most-prod').removeClass('active');
    $(this).addClass('active');
});

$(document).on('click', '.show-home-most-prod', function () {
    $(".products-home-newest").addClass('hidden-block');
    $(".products-home-most").removeClass('hidden-block');
    $('.show-home-newest-prod').removeClass('active');
    $(this).addClass('active');
});

$(document).on('click', '.login-modal-open', function (e) {
    e.preventDefault();
    $('.ui.modal-login').modal('show').modal('refresh');
});

$(document).on('mouseover', '.modal-register button.click-button', function () {
    $('.modal-register input[type="text"]').each(function () {
        localStorage.setItem('_pref_' + $(this).attr('name'), $(this).val());
    });
});

$('.modal-register input[type="text"]').each(function () {
    if (localStorage.getItem('_pref_' + $(this).attr('name'))) {
        $(this).val(localStorage.getItem('_pref_' + $(this).attr('name')));
    }
});