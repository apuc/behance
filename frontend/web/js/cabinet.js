

$(document).ready(function () {

    //баланс
    var form = $("#works-grid-form");
    var errorSpan = $("#works-form-error");
    var hiddenInput = $("#work-id-input");
    var balanceLikes = $("#balance_likes");
    var balanceViews = $("#balance_views");
    var likesInput = $("#form-likes");
    var viewsInput = $("#form-views");

    //оплата
    var casesSelect = $("#cases-select")[0];
    var sumInput = $("input[name='ik_am']");
    var caseInput = $("input[name='ik_x_caseid']");


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
                    var newLikes = parseInt(balanceLikes.html()) - parseInt(likesInput.val());
                    var newViews = parseInt(balanceViews.html()) - parseInt(viewsInput.val());

                    if(newLikes)
                    balanceLikes.html(newLikes);

                    if(newViews)
                    balanceViews.html(newViews);

                    $("#works-grid-form")[0].reset();

                    $("#exampleModal").modal("hide");
                }
                else
                {
                    errorSpan.html(response);
                }
            }

        });

    })

    casesSelect.addEventListener('change',function () {
        let data = $(this).val().split('|');
        sumInput.val(data[1]);
        caseInput.val(data[0]);
    })

});//close document ready