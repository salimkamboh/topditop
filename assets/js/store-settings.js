$(".panelholder:first").show();

$(document).on("click", ".selector-options a", function (e) {
    e.preventDefault();
    $(".selector-options a").removeClass('active');
    $(this).addClass('active');
    $(".panelholder").hide();
    var panelID = $(this).attr("href");
    $(panelID).show();

    history.pushState({
        panelID: panelID
    }, 'panel', panelID);
});

$(document).on("click", ".save-changes", function () {
    var panelID = $(".selector-options a.active").attr("href");
    localStorage.setItem('hrefer', panelID);
});

$(document).on("click", ".toggle-hidden-next", function (e) {
    $(".hidden-brands").toggleClass("hidden");
});

var elem = document.querySelector('.js-switch');
var switchery = new Switchery(elem, {size: 'small', color: '#0f9a55', secondaryColor: '#0f9a55'});

$('.ui.dropdown').dropdown();

$(document).on("click", ".add_architect_name", function (e) {
    e.preventDefault();

    addToListOfArchitects();
});

function addToListOfArchitects() {
    var newArchitect = $('#architect_name').val();
    if (newArchitect.trim() != '') {
        $('.architect_name_receiver').val($('.architect_name_receiver').val() + newArchitect + ',');
        $('#architect_name').val('');
        $('.arch-list').append('<li>' + newArchitect + '</li>');
    }
}

$(document).on("dblclick", "section#dashboard-settings ul.arch-list li", function (e) {
    e.preventDefault();
    $(this).remove();
    $('.architect_name_receiver').val('');
    $('.arch-list li').each(function (index) {
        var newVal = $(this).html().trim();
        $('.architect_name_receiver').val($('.architect_name_receiver').val() + newVal + ',');
    });
});

hrefExists = false;

if (window.location.hash.indexOf('#') !== -1) {
    var tabActivated = window.location.hash.split('#')[1];

    if (tabActivated != '') {
        var hrefer = "#" + tabActivated;
        $(".selector-options a").removeClass('active');
        $("[href='" + hrefer + "']").addClass('active');
        $(".panelholder").hide();
        $(hrefer).show();
    }
} else {
    if (localStorage.getItem('hrefer') != null) {
        var hrefer = localStorage.getItem('hrefer');
        $(".selector-options a").removeClass('active');

        $("[href='" + hrefer + "']").addClass('active');
        $(".panelholder").hide();
        $(hrefer).show();

        $(".selector-options a").each(function (index) {
            if ($(this).attr('href') == hrefer)
                hrefExists = true;
        });

        if (hrefExists == false) {
            $(".selector-options a:first").trigger('click');
        }
    }
}