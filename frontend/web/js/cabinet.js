

$(document).ready(function () {

    const moneyRegex  = /^\d{3,}$/;
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
    const successDiv = $("#success_div");


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
                        content:createLink(),
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

    if (submitButton !== undefined)
    {
        submitButton.click(function (e) {
            let url = window.location.origin + '/cabinet/payment-cash/put-order';
            let csrf = $('meta[name=csrf-token]').attr("content");
            let order_id = orderInput.val();
            let rub = parseFloat(sumField.val());
            let usd = parseFloat(usdInput.val());
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    amount:  rub,
                    order_id: order_id,
                    usd: usd,
                    _csrf : csrf
                },
                success: function (data) {
                    if (data.code == 200) {
                        submitButton.attr('disabled', 'disabled');
                        errorDiv.css('display', 'none');
                        gtag('event', 'payment', { 'event_category': 'form', 'event_action': 'payment', });
                        yaCounter51223025.reachGoal('payment');
                        return true;

                    } else {
                        e.preventDefault();
                        errorDiv.css('display', 'block');
                        errorDiv.text('Произошла ошибка при формировании платежа. Введите сумму заново или перезагрузите страницу, а затем попробуйте снова.');
                        submitButton.attr('disabled', 'disabled');
                    }
                },
                async: false
            });
        });
    }
    if (sumField !== undefined)
    {
        let f = function() {
            submitButton.attr('disabled', 'disabled');
            successDiv.css('display', 'none');
            let data = $(this).val();
            if (moneyRegex.test(data) && data >= 150) {
                infoDiv.css('display', 'block');
                successDiv.css('display', 'block');
                successDiv.text('Пожалуйста, подождите...');
                errorDiv.css('display', 'none');
                let rub = parseFloat(sumField.val());
                let url = window.location.origin + '/cabinet/payment-cash/get-form-secret';
                let csrf = $('meta[name=csrf-token]').attr("content");
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        sum:  rub + ".00",
                        _csrf : csrf
                    },
                    success: function (data) {
                        if (data.code == 200) {
                            successDiv.css('display', 'none');
                            sumInput.val(rub+".00");
                            let exchange = parseFloat(exchangeSpan.text());
                            let usd = Math.round((rub/exchange + Number.EPSILON) * exponent) / exponent;
                            orderInput.val(data.order_id);
                            secretInput.val(data.sign);
                            usdInput.val(usd);
                            usdSpan.text(usd);
                            submitButton.removeAttr('disabled');
                        }
                    }
                });
            } else {
                successDiv.css('display', 'none');
                submitButton.attr('disabled', 'disabled');
                infoDiv.css('display', 'none');
                errorDiv.css('display', 'block');
                errorDiv.text('Сумма не должна быть меньше 150 руб. и без копеек');
            }
        };
        sumField.keydown(function () {
            successDiv.css('display', 'block');
            successDiv.text('Нажмите Enter для проверки введённой суммы');
            submitButton.attr('disabled', 'disabled');
        });
        sumField.change(f);
    }


});//close document ready


function createLink()
{
    let link = document.createElement('a');
    link.textContent = "Посмотреть";
    link.setAttribute('href','/cabinet/queue');
    link.style.display = "block";
    link.style.width = '100%';
    link.style.textAlign = 'left';

    return link;
}