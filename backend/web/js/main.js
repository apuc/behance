$(document).ready(function () {


    $(".btn-balance-grid").on("click", function () {
        var id = $(this).attr('data-id');
        $('#user-id-input').val(id);
    });

    $(".btn-balance-cash-grid").on("click", function () {
        var id = $(this).attr('data-id');
        $('#user-id-input').val(id);
    });

    $(".btn-balance-withdraw-cash-grid").on("click", function () {
        var id = $(this).attr('data-id');
        console.log(id);
        $('#user-id-withdraw-input').val(id);
    });

    $("#balance-form-send").on("click", function () {

        var data = $("#balance-add-form").serialize();

        $.ajax({
            type: "POST",
            url: "/admin/balance/balance/add-balance",
            data: data,
            success: function (response) {

                if (response == true) {
                    location.reload();
                } else {
                    $("#balance-form-error").html(response);
                }

            }
        });
    });


    $("#balance-cash-form-send").on("click", function () {
        var data = $("#balance-cash-add-form").serialize();

        $.ajax({
            type: "POST",
            url: "/admin/balancecash/balance-cash/add-balance-cash",
            data: data,
            success: function (response) {

                if (response == true) {
                    location.reload();
                } else {
                    $("#balance-cash-form-error").html(response);
                }
            }
        });
    });

    $("#balance-withdraw-cash-form-send").on("click", function () {
        var data = $("#balance-withdraw-cash-add-form").serialize();

        $.ajax({
            type: "POST",
            url: "/admin/balancecash/balance-cash/withdraw-balance-cash",
            data: data,
            success: function (response) {

                if (response == true) {
                    location.reload();
                } else {
                    $("#balance-withdraw-cash-form-error").html(response);
                }
            }
        });
    });


});