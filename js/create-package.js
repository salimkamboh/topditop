function invokeDragabble() {
    $(".fieldgroup-list, .panel-list").sortable({
        connectWith: ".connectedSortable"
    }).disableSelection();
}
invokeDragabble();
$(document).on("click", ".add-panel", function (e) {
    e.preventDefault();

    var num = $(".panel-list").length;
    if (num != undefined)
        var dataOrder = parseInt(num + 1);
    else
        dataOrder = 1;

    var $html = $('<div data-order="' + dataOrder + '" class="panel-list connectedSortable">' +
        '<input type="text" class="panel_name"><br>' +
        '</div>');

    $(".panel-list-holder").append($html.attr("data-order", dataOrder));
    invokeDragabble();
});

var connector = {
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

$(".save-package").on("click", function () {

    var panels = [];

    $(".panel-list").each(function (index) {
        var fieldGroups = [];
        $(this).find("h4").each(function (index) {
            fieldGroups.push($(this).data("id"));
        });
        var panel_db_id = null;
        if ($(this).data("db-id") != undefined) {
            panel_db_id = $(this).data("db-id")
        }
        panels.push({
            panel_id: index,
            panel_db_id: panel_db_id,
            panel_name: $(this).find(".panel_name").val(),
            fieldGroups: fieldGroups
        })
    });

    var dataToSend = {
        package_name: $("#package_name").val(),
        panels: panels,
        _token: $("[name='_token']").val()
    };

    console.log(dataToSend);

    function callBackFunction(context, response) {
        if (response == 200) {

        }
    }

    connector.getData("POST", $("form#insert-package").attr("action"), "json", dataToSend, callBackFunction, "");
});