

$(document).ready(function () {


    $(".btn-balance-grid").on("click",function () {
        var id = $(this).attr('data-id');
        $('#user-id-input').val(id);
    });

    $("#balance-form-send").on("click",function () {

        var data = $("#balance-add-form").serialize();

        $.ajax({
            type:"POST",
            url:"balance/add-balance",
            data:data,
            success:function (response) {

                if(response == true)
                {
                    location.reload();
                }
                else
                {
                    $("#balance-form-error").html(response);
                }

            }
        });
    })



});