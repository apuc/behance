

$(document).ready(function () {

    var form = $("#works-grid-form");
    var errorSpan = $("#works-form-error");
    var hiddenInput = $("#work-id-input");
    var balanceLikes = $("#balance_likes");
    var balanceViews = $("#balance_views");
    var likesInput = $("#form-likes");
    var viewsInput = $("#form-views");


    $('.btn-works-grid').on('click',function () {
        hiddenInput.val($(this).attr('data-id'));
    });


    $("#works-form-send").on('click',function () {

        var data = form.serialize();

        $.ajax({
            type:"POST",
            url:"works/assign-balance",
            data:data,
            success:function (response) {

                if (response == true)
                {
                    //balanceLikes.html(likesInput.val());
                    //balanceViews.html(viewsInput.val());
                    alert(response);
                }
                else
                {
                    errorSpan.html(response);
                }
            }
        });

    })

});//close document ready