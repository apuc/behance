// ajax to get service data for selected social
//global for price of selected service
var price = 0;
var is_answer = false;

function ajaxChangeData($)
{
    let url = window.location.origin + '/cabinet/social-queue/create-get-services';
    let csrf = $('meta[name=csrf-token]').attr("content");
    let id_soc = $('#socialqueueform-social').val();
    $('#socialqueueform-type_id').empty();
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id_soc: id_soc,
            _csrf : csrf
        },
        success: function (data) {
            if (data.code == 200) {
                $.each(data['data'],
                    function (item, index) {
                        let newOption = new Option(index, item, false, false);
                        $('#socialqueueform-type_id').append(newOption);
                    }
                );
                $("#socialqueueform-type_id")[0].selectedIndex = 0;
                $("#socialqueueform-type_id").trigger('change.select2');
                if (data['data'].length == 0) {
                    $('#div_age').css('display', 'none');
                    $('#div_answer').css('display', 'none');
                    $('#div_friends').css('display', 'none');
                    $('#div_link').css('display', 'none');
                    $('#socialqueueform-link').val(null);
                    $('#div_msg').css('display', 'none');
                    $('#socialqueueform-msg').val(null);
                    $('#div_gender').css('display', 'none');
                    $('#success_button').attr('disabled', 'disabled');
                    $('#div_balance').css('display', 'none');
                    $('#div_price').css('display', 'none');
                }
            }
        }
    });
}

// enable\disable fields depending on what fields are needed. mb test
function enableDisableFields($)
{
    let url = window.location.origin + '/cabinet/social-queue/create-get-fields';
    let csrf = $('meta[name=csrf-token]').attr("content");
    let type_id = $('#socialqueueform-type_id').val();
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            type_id: type_id,
            _csrf : csrf
        },
        success: function (data) {
            if (data.code == 200) {
                let inputs = data.inputs;
                price = data.price;
                $('#div_age').css('display', 'none');
                $('#div_answer').css('display', 'none');
                $('#div_friends').css('display', 'none');
                $('#div_link').css('display', 'none');
                $('#socialqueueform-link').val(null);
                $('#div_msg').css('display', 'none');
                $('#socialqueueform-msg').val(null);
                $('#div_gender').css('display', 'none');
                $.each(inputs,
                    function (item, index) {
                        $('#div_' + index).css('display', 'block');
                    });
                $('#div_balance').css('display', 'block');
                $('#div_answer').css('display', 'none');
                is_answer = inputs.includes('answer');
                $('#div_price').css('display', 'block');
                calculatePrice($);
            }
        }
    });
}

function calculatePrice($)
{
    let index = $('#socialqueueform-friends_id')[0].selectedIndex - 1;
    let count = $('#socialqueueform-balance').val();
    let current_price = Math.round((price * friend_prices[index] * count + Number.EPSILON) * exponent) / exponent;
    $('#price_text').text('Стоимость услуги - ' + current_price + '$');
    $('#socialqueueform-price').val(current_price * exponent);
    if (balance_cash >= Math.round(current_price * exponent)) {
        $('#success_button').removeAttr('disabled');
        $('#errors').css('display', 'none');
    } else {
        $('#success_button').attr('disabled', 'disabled');
        $('#errors').text("Недостаточно средств на балансе для создания задачи");
        $('#errors').css('display', 'block');
    }
}

$('#socialqueueform-link').blur(function () {
    if (is_answer) {
        $('#div_answer').css('display', 'none');
        $('#socialqueueform-answer_id').empty();
        let url = window.location.origin + '/cabinet/social-queue/create-get-answers';
        let link = $('#socialqueueform-link').val();
        let csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                link: link,
                _csrf : csrf
            },
            success: function (data) {
                if (data.code == 200) {
                    $.each(data.answers,
                        function (item, index) {
                            let newOption = new Option(index, item, false, false);
                            $('#socialqueueform-answer_id').append(newOption);
                        });
                    $('#poll_text').text('Вопрос - ' + data.title);
                    $('#div_answer').css('display', 'block');
                    $("#socialqueueform-answer_id")[0].selectedIndex = 0;
                    $("#socialqueueform-answer_id").trigger('change');
                }
            }
        });
    }
});

$('#socialqueueform-balance').blur(function () {
    calculatePrice($);
});

$('#socialqueueform-balance').change(function () {
    calculatePrice($);
});