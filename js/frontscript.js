$(document).on("load", function () {
    console.log(1);
});

$(document).on("mouseover", ".reference", function () {
    $(this).find(".reference__info-wrapper").show();
});

$(document).on("mouseleave", ".reference", function () {
    $(this).find(".reference__info-wrapper").hide();
});