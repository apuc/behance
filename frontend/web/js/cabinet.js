

$(document).ready(function () {

    const moneyRegex  = /^\d+(?:\.\d{0,2})$/;
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
    const sumField = $("#sum");
    const sumInput = $("#pay-sum");
    const usdInput = $("#pay-usd");
    const caseInput = $("#pay-case-id");
    const secretInput = $("#pay-sign");
    const orderInput = $("#pay-order-id");
    const submitButton = $("#submit-fc");
    const exchangeSpan = $("#exchange_text");
    const usdSpan = $("#usd_text");
    const infoDiv = $("#info_div");
    const errorDiv = $("#error_div");


    $('.btn-works-grid').on('click',function () {
        hiddenInput.val($(this).attr('data-id'));
    });


    $("#works-form-send").on('click',function () {

        let data = form.serialize();

        $.ajax({
            type:"POST",
            url:"/cabinet/works/assign-balance",
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
                            " лайков и "+ viewsInput.val() +" просмотров популярнее!",
                        content:creafteLink(),
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

    if(casesSelect !== undefined)
    {
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
    }
    if (sumField !== undefined)
    {
        let f = function() {
            let data = $(this).val();
            if (moneyRegex.test(data)) {
                submitButton.removeAttr('disabled');
                infoDiv.css('display', 'block');
                errorDiv.css('display', 'none');
                let rub = parseFloat(sumField.val());
                let exchange = parseFloat(exchangeSpan.text());
                let usd = Math.round((rub/exchange + Number.EPSILON) * exponent) / exponent;
                usdSpan.text(usd);
                let orderId = orderInput.val();
                $.post( "/cabinet/payment/get-form-secret",{"order_id":orderId,"sum":rub}).then(
                    function(res) {
                        sumInput.val(rub);
                        secretInput.val(res);
                        usdInput.val(usd);
                    }
                );
            } else {
                submitButton.attr('disabled', 'disabled');
                infoDiv.css('display', 'none');
                errorDiv.css('display', 'block');
                errorDiv.text('Введённый текст не является корректным значнеим. Примеры корректных значений - 200. , 200.0, 200.1, 200.11')
            }
        };
        sumField.keyup(f);
    }


});//close document ready


function creafteLink()
{
    let link = document.createElement('a');
    link.textContent = "Посмотреть";
    link.setAttribute('href','/cabinet/queue');
    link.style.display = "block";
    link.style.width = '100%';
    link.style.textAlign = 'left';

    return link;
}