function setOffer(OFFER_ID, ITEM_ID, PRICE) {
    if ($('#' + ITEM_ID + '_QUANTITY').length) {
        var QUANTITY = $('#' + ITEM_ID + '_QUANTITY').val();
    } else {
        var QUANTITY = 1;
    }
    $('#' + ITEM_ID + '_BY_BUTTON').attr("onclick", 'add2basket(`' + ITEM_ID + '`,`' + OFFER_ID + '`,`' + QUANTITY + '`);return false;');
    $('#' + ITEM_ID + '_BY_BUTTON').html("Купить");
    //количество
    if ($('#' + ITEM_ID + '_QUANTITY').length) {
        $('#' + ITEM_ID + '_QUANTITY').attr("onchange", 'setQuantity(`' + ITEM_ID + '`,`' + OFFER_ID + '`,$(this));return false;');
    }
    $('#' + ITEM_ID + '_PRICE_BLOCK').html(PRICE);
    $(".select-b.open").removeClass('open');
}


function setQuantity(ITEM_ID, OFFER_ID, ELEMENT) {
    var QUANTITY = ELEMENT.val();
    $('#' + ITEM_ID + '_BY_BUTTON').attr("onclick", 'add2basket(`' + ITEM_ID + '`,`' + OFFER_ID + '`,`' + QUANTITY + '`);return false;');
    $('#' + ITEM_ID + '_BY_BUTTON').html("Купить");
}


function add2basket(ELEMENT_ID, OFFER_ID, QUANTITY = false) {
    $.ajax({
        type: 'POST',
        url: '/ajax/add2basket.php',
        data: {ELEMENT_ID:ELEMENT_ID,OFFER_ID:OFFER_ID,QUANTITY:QUANTITY}
    }).done(function (data) {
        $('#' + ELEMENT_ID + '_BY_BUTTON').html("В корзине");
        $('#' + ELEMENT_ID + '_BY_BUTTON').attr("onclick", 'return false;');
        $("#BASKET_COUNTER").html(data);
    }).fail(function () {
        console.log('fail');
    });
    return false;
}


$('#feedbackForm').submit(function(e) {
    var $form = $(this);
    $.ajax({
        type: "POST",
        url: "/ajax/feedback.php",
        data: $form.serialize()
    }).done(function() {
        $form.html("<h2>Спасибо, ваша заявка получена!</h2>");

    }).fail(function() {
        console.log('fail');
    });
    //отмена действия по умолчанию для кнопки submit
    e.preventDefault();
});

const selectCity = document.querySelector('.select-item');
if(selectCity){
		selectCity.addEventListener("change", function(){
            let value = this.value;
			let nextFirst = document.querySelector('.order-next-first');
			let nextTwoMore = document.querySelector('.order-next-two');
			if(value !== ''){
				if(nextFirst.classList.contains('no-active')){
                    nextFirst.classList.remove('no-active');
                }
			}
			else{
				nextFirst.classList.add('no-active');
				nextTwoMore.classList.add('no-active');
				let radioDeliv = document.getElementsByName('DELIVERY_ID');
				if(radioDeliv.length > 0){
					for(let i=0; i<radioDeliv.length; i++){
						radioDeliv[i].checked = false;
					}
				}
			}	
        });
}
/*
let radioDelivery = document.getElementsByName('DELIVERY_ID');
if(radioDelivery.length > 0){
	for(let i=0; i<radioDelivery.length; i++){
		radioDelivery[i].addEventListener("change", function(){
			let nextTwo = document.querySelector('.order-next-two');
			if(nextTwo.classList.contains('no-active')){
				nextTwo.classList.remove('no-active');
			}
		});
	}
}*/

	const header = document.querySelector('.header');
	const footer = document.querySelector('.footer');
	const orderSidebar = document.querySelector('.order__sidebar');

	if(orderSidebar){
		const headerHeight = header.offsetHeight;
		const sidebarHeight = orderSidebar.offsetHeight;
		const windowHeight = document.documentElement.clientHeight;
		const sidebarTop = orderSidebar.getBoundingClientRect().top;
		const footerTop = footer.getBoundingClientRect().top;
		const totalTop = sidebarTop - headerHeight;
		const totalHeight = headerHeight + sidebarHeight;

		if(windowHeight > totalHeight){
			window.addEventListener('scroll', function() {
				if(pageYOffset > totalTop && pageYOffset < footerTop - sidebarHeight - headerHeight - 50){
					orderSidebar.classList.remove('absolute');
					orderSidebar.classList.add('fix');
				}
				else if(pageYOffset > footerTop - sidebarHeight - headerHeight - 50){
					orderSidebar.classList.remove('fix');
					orderSidebar.classList.add('absolute');
				}
				else{
					orderSidebar.classList.remove('fix');
				}
			});
		}
	}