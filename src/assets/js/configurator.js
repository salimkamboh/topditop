$.noConflict();
(function ($) {

    _globalLang = $('.current_lang').val();

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

    var fieldGroupsExistingData = null;
    var activePanelId = $(".holder_panel_id").val();

    /**
     *
     * @param url
     * @private
     */
    function _setOptionValues(url) {

        function callBackFunction(context, response) {
            fieldGroupsExistingData = response;

            console.log(fieldGroupsExistingData);
            $.each(fieldGroupsExistingData, function (index, item) {

                var currentItemId = item.id;
                var formRow = "<div class='singlerow' style='margin: 10px 0;'>";
                formRow += "<select class='fieldgroups'>";
                formRow += "<option value='" + item.id + "'>" + item.name + "</option>";

                $.each(fieldGroupsData, function (index, itemExisting) {
                    if (itemExisting.id !== currentItemId)
                        formRow += "<option value='" + itemExisting.id + "'>" + itemExisting.name + "</option>";
                });
                formRow += "<option value='" + item.id + "'>" + item.name + "</option>";
                formRow += "</select>";
                formRow += "</div>";

                $("#general2 .form-list").after(formRow);
            });
        }

        connector.getData("GET", url, "json", null, callBackFunction, "");
    }

    var fieldGroupsData = null;
    var optionsHtml = null;

    /**
     *
     * @param url
     * @private
     */
    function _collectOptionValues(url) {

        function callBackFunction(context, response) {
            fieldGroupsData = response;
            $.each(fieldGroupsData, function (index, item) {
                optionsHtml += "<option value='" + item.id + "'>" + item.name + "</option>";
            });
            if (activePanelId !== "") {
                _setOptionValues(_globalRoute + "/en/api/panels/fieldgroups/" + activePanelId);
            }
        }

        connector.getData("GET", url, "json", null, callBackFunction, "");
    }

    _collectOptionValues(_globalRoute + "/en/api/fieldgroups/all");

    $(".addmore").on("click", function () {
        var formRow = "<div class='singlerow' style='margin: 10px 0;'>";
        formRow += "<select class='fieldgroups'>" + optionsHtml + "</select>";
        formRow += "</div>";
        $("#general2 .form-list").after(formRow);
    });

    $(document).on("click", ".saveit", function () {

        var url = _globalRoute + "/api/panels";

        var fieldroupIds = [];
        $(".fieldgroups").each(function (index) {
            fieldroupIds.push($(this).val())
        });

        var dataToSend = {
            name: $("#name").val(),
            key: $("#key").val(),
            fieldGroups: fieldroupIds
        };

        function callBackFunction(context, response) {

        }

        connector.getData("POST", url, "json", dataToSend, callBackFunction, "");
    });

    $(document).on("mouseup", ".clickable-save", function (e) {

        var url = _globalRoute + "/" + _globalLang + "/api/panels/" + activePanelId;

        var fieldroupIds = [];
        $(".fieldgroups").each(function (index) {
            fieldroupIds.push($(this).val())
        });

        var dataToSend = {
            name: $("#name").val(),
            key: $("#key").val(),
            fieldGroups: fieldroupIds
        };

        function callBackFunction(context, response) {
            window.location.reload();
        }

        connector.getData("POST", url, "json", dataToSend, callBackFunction, "");
    });

    $(document).on("click", ".editit", function () {

        var url = _globalRoute + "/api/panels/" + activePanelId;

        var fieldroupIds = [];
        $(".fieldgroups").each(function (index) {
            fieldroupIds.push($(this).val())
        });

        var dataToSend = {
            name: $("#name").val(),
            key: $("#key").val(),
            fieldGroups: fieldroupIds
        };

        function callBackFunction(context, response) {

        }

        connector.getData("POST", url, "json", dataToSend, callBackFunction, "");
    });

    $(window).on("load", function (e) {
        $(".save.scalable").attr('disabled', 'disabled').addClass('clickable-save');
    });
})(jQuery);