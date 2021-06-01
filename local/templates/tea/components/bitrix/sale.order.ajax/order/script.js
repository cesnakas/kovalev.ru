var BXFormPosting = false;


function submitForm(val) {

    if (BXFormPosting === true)
        return true;

    BX.showWait();
    var orderForm = BX('ORDER_FORM');

    $("#errorOrder").text('');

    if (val != 'Y') {
        $('#confirmorder').val('N');
        BX.ajax.submit(orderForm, ajaxResult);
    } else {
        //проверки перед отправкой
        var errorField = false;

        $("#ORDER_FORM input.prop-required").each(function () {
            if ($(this).val() == '') {
                errorField = true;
                $(this).addClass('error-field');

            } else {
                $(this).removeClass('error-field');
            }
        });


        var emailNode = $("[name=ORDER_PROP_3]");
        var email = emailNode.val();
        if (email != '' && typeof email != "undefined") {
            var pattern = /^([a-zA-Z0-9_\.-])+@[a-zA-Z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if (!pattern.test(email)) {
                errorField = true;
                emailNode.addClass('error-field');
            } else {
                emailNode.removeClass('error-field');
            }
        }




        var streetNode = $("input[name='ORDER_PROP_5']");
        var streetstr = streetNode.val();
        if (streetstr != '' && typeof streetstr != "undefined") {
            console.log(streetstr);
            var pattern = /^[а-яА-ЯёЁ'][а-яА-ЯёЁ' ]+[а-яА-ЯёЁ']?$/
            if (!pattern.test(streetstr)) {
                errorField = true;
                streetNode.addClass('error-field');
            } else {
                streetNode.removeClass('error-field');
            }
        }


        if ($('input.prop-required').hasClass('error-field')) {
            $('html, body').animate({
                scrollTop: $(".error-field").offset().top - 120
            }, 500);
        }


        if (!errorField) {
            if (!$("#agreeCheck").prop("checked")) {
                errorField = true;
                $("#errorOrder").text('Вы должны дать согласие на обработку персональных данных');
                $("#agreeCheck").addClass('error-check');
                $('html, body').animate({
                    scrollTop: $("#agreeCheckLabel").offset().top - 90
                }, 500);
            } else {
                $("#errorOrder").text('');
                $("#agreeCheck").removeClass('error-check');
            }
        }

        if (!errorField) {
            var adress = "";
            var street = $("input[name='ORDER_PROP_10']").val();
            var home = $("input[name='ORDER_PROP_11']").val();
            if (street != "" && home != "") {
                adress = `Москва , ${street} дом ${home}`;
            }

            var check19propval;


            console.log("все поля заполнены , место не проверялось");
            $("#but").text("Оформляется...");

            BX.ajax.submit(orderForm, ajaxResult);


        }
    }
    BX.closeWait();


    return true;

}


//карта

var object


function ajaxResult(res) {

    var orderForm = BX('ORDER_FORM');
    try {
        // if json came, it obviously a successfull order submit

        var json = JSON.parse(res);
        BX.closeWait();
        if (json.error) {
            BXFormPosting = false;
            return;
        } else if (json.redirect) {
            window.top.location.href = json.redirect;
        }
    } catch (e) {
        // json parse failed, so it is a simple chunk of html

        BXFormPosting = false;
        BX('order_form_content').innerHTML = res;


    }
    BX.closeWait();
    //changePickup();
    // timePickup();
    BX.onCustomEvent(orderForm, 'onAjaxSuccess');
    // init();
    // all();
    all();
//	setFieldCookie ();
//	$(".phone-mask").mask("+7(999)999-99-99");
}

function ajaxResultFull(res) {
    window.top.location.href = res;
}

$(document).on('click', '#but', function (e) {
    e.preventDefault();
    submitForm("Y");
});

$(document).ready(function () {
    all();
    // setFieldCookie();
});

function all() {
    $(".edit-order-icon-link").click(function () {
        $('#ordering').arcticmodal();
    });
    // changePickup();
    // timePickup();
    $(".change-flatware-amount.increase").click(function () {
        var inp = $(this).siblings(".flatware-amount");
        var lim = parseInt(inp.data('max'));
        var oldVal = parseInt(inp.text());
        if (oldVal < lim) {
            var newVal = ++oldVal;
        }
        inp.text(newVal);
        $("[name=ORDER_PROP_18]").val(newVal);
    });
    $(".change-flatware-amount.decrease").click(function () {
        var inp = $(this).siblings(".flatware-amount");
        var oldVal = parseInt(inp.text());
        if (oldVal > 0) {
            var newVal = --oldVal;
            inp.text(newVal);
            $("[name=ORDER_PROP_18]").val(newVal);
        }
    });
    $(document).on('click', '.applyDiscount', function (e) {
        e.preventDefault();
        var coupon = $(".couponValue").val();
        if (coupon == '') {
            $(".couponValue").addClass('error-field');
        } else {
            $(".couponValue").removeClass('error-field');
            $.ajax({
                type: "POST",
                url: "/ajax/coupon.php",
                data: {coupon: coupon},
                success: function (response) {
                    console.log(response);
                    //$(".delivering-form__coupon-wrap").text('Купон применен');
                    submitForm();
                }
            });
        }
    });

    $("input.prop-required").change(function () {
        if ($(this).val() != "") {
            $(this).removeClass("error-field");
        }

    })

}

//
// function setFiedls(street, home, elem) {
//     if (elem.attr("check") == "N") {
//         console.log(street);
//         $(`input[name="ORDER_PROP_10"]`).removeClass("error-field");
//         $(`input[name="ORDER_PROP_11"]`).removeClass("error-field");
//         $(`input[name="ORDER_PROP_10"]`).val(street).prop("disabled", true);
//         $(`input[name="ORDER_PROP_11"]`).val(home).prop("disabled", true);
//         $(`input[name="ORDER_PROP_12"]`).prop("disabled", true);
//         $(`input[name="ORDER_PROP_13"]`).prop("disabled", true);
//         $(`input[name="ORDER_PROP_14"]`).prop("disabled", true);
//         $(`input[name="ORDER_PROP_15"]`).prop("disabled", true);
//         $(".checkouter").attr("check", "N");
//         elem.attr("check", "Y");
//         $(".checkouter").prop("checked", false);
//         elem.prop("checked", true);
//         $(`input[name="ORDER_PROP_19"]`).prop('checked', false);
//         $(`input[name="ORDER_PROP_19"]`).removeAttr('checked');
//
//     } else {
//         elem.prop("checked", false);
//
//         $(`input[name="ORDER_PROP_10"]`).val("").prop("disabled", false);
//         $(`input[name="ORDER_PROP_11"]`).val("").prop("disabled", false);
//         $(`input[name="ORDER_PROP_13"]`).val("").prop("disabled", false);
//         $(`input[name="ORDER_PROP_12"]`).val("").prop("disabled", false);
//         $(`input[name="ORDER_PROP_14"]`).val("").prop("disabled", false);
//         $(`input[name="ORDER_PROP_15"]`).val("").prop("disabled", false);
//         // $(".checkouter").prop("checked",false);
//         // $(`input[name="ORDER_PROP_19"]`).prop('checked', false);
//         // $(`input[name="ORDER_PROP_19"]`).removeAttr('checked');
//         elem.attr("check", "N");
//     }
// }

// function setFiedls2(street, home, elem) {
//     $(".checker").attr("check", "N");
//     elem.attr("check", "Y");
//     $(".checker").each(function () {
//         setCookie($(this).data('name'), "N");
//     });
//     setCookie(elem.data('name'), "Y");
//     console.log(document.cookie);
// }

//
// function setFieldCookie() {
//     $("#ORDER_FORM input, #ORDER_FORM textarea").keyup(function () {
//         console.log($(this).val());
//         let $this = $(this);
//         let name = $this.attr('name');
//         let value = $this.val();
//         setCookie(name, value);
//         console.log(document.cookie);
//     });
// }


// $("#basketToOrder").click(function (e) {
//     e.preventDefault(e);
//     //window.location.href = "/order/";
//     submitForm('',init)
// });
// function changePickup() {
//     $("#quickPickup").change(function () {
//         if ($(this).prop("checked")) {
//             $("[name=ORDER_PROP_17]").val('как можно быстрее');
//             $("#datetimepicker").attr('disabled', 'disabled');
//         } else {
//             $("[name=ORDER_PROP_17]").val('');
//             $("#datetimepicker").removeAttr('disabled');
//         }
//     });
// }

// function timePickup() {
//     var d = new Date();
//     d.setMinutes(d.getMinutes() + 15);
// }

