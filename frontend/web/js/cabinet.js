

$(document).ready(function () {

    //баланс
    const form = $("#works-grid-form");
    const errorSpan = $("#works-form-error");
    const hiddenInput = $("#work-id-input");
    const balanceLikes = $("#balance_likes");
    const balanceViews = $("#balance_views");
    const likesInput = $("#form-likes");
    const viewsInput = $("#form-views");

    //оплата
    const casesSelect = $("#cases-select")[0];
    const sumInput = $("#pay-sum");
    const caseInput = $("#pay-case-id");
    const secretInput = $("#pay-sign");
    const orderInput = $("#pay-order-id");


    $('.btn-works-grid').on('click',function () {
        hiddenInput.val($(this).attr('data-id'));
    });


    $("#works-form-send").on('click',function () {

        let data = form.serialize();

        $.ajax({
            type:"POST",
            url:"works/assign-balance",
            data:data,
            success:function (response) {

                if (response == true)
                {
                    let newLikes = parseInt(balanceLikes.html()) - parseInt(likesInput.val());
                    let newViews = parseInt(balanceViews.html()) - parseInt(viewsInput.val());

                    if(newLikes)
                    balanceLikes.html(newLikes);

                    if(newViews)
                    balanceViews.html(newViews);

                    $("#exampleModal").modal("hide");

                    swal({
                        text: "Работа добавленна в лайкер! Теперь вы станете на " +likesInput.val()+
                            " лйков и "+ viewsInput.val() +" просмотров популярнее!",
                        buttons: {
                            confirm: {
                                text: 'OK',
                                value: true,
                                visible: true,
                                className: "btn btn-pink",
                                closeModal: true
                            }
                        }
                    });

                    $("#works-grid-form")[0].reset();
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
        let orderId = orderInput.val();

        $.post( "/cabinet/payment/get-form-secret",{"order_id":orderId,"sum":data[1]}).then(
            function(res) {
                sumInput.val(data[1]);
                caseInput.val(data[0]);
                secretInput.val(res);
            }
        );

    })

});//close document ready


