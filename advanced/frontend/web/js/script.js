$(document).ready(function () {
    $('.item-background-carousel').css('height', $(window).height() - 50);
});
$(window).resize(function () {
    $('.item-background-carousel').css('height', $(window).height() - 50);
});

$(document).ready(function () {
    /* Example 2 */
    $("#ex2").slider({});
    // var slider = new Slider('#ex2', {});

    $("#qtyPlus").click(function () {
        var n = $(this).closest('.product').find('#qtyField');
        n.val(Number(n.val()) + 1);
    });
    $("#qtyMinus").click(function () {
        var n = $(this).closest('.product').find('#qtyField');
        n.val(Number(n.val()) - 1);
        if (n.val() < 0) {
            n.val(0);
        }
    });
});

//Корзина
function showCart(cart) {
    var qty = $(cart).find('#qty-modal').text();
    if (qty > 0) {
        $('#navbar-cart').text('Корзина(' + qty + ')');
    } else {
        $('#navbar-cart').text('Корзина');
    }

    $('#cart-modal').find('.modal-body').html(cart);
    $('#cart-modal').modal();

}

function getCart() {
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function (res) {
            if (!res) alert("Ошибка!");
            showCart(res);
        },
        error: function () {
            alert("Error!");
        }
    });
    return false;
}

function clearCart() {
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res) {
            if (!res) alert("Ошибка!");
            showCart(res);
        },
        error: function () {
            alert("Error!");
        }
    });
}

$('#cart-modal .modal-body').on('click', '.del-item-cart', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/del-item',
        data: {
            id: id
        },
        type: 'GET',
        success: function (res) {
            if (!res) alert("Ошибка!");
            showCart(res);
        },
        error: function () {
            alert("Error!");
        }
    });

});

$('.add-to-cart').on('click', function (e) {
    e.preventDefault;
    var reservationInfoId = $("#reservationinfo-id").val(),
        qty = $("#qtyField").val();
    $.ajax({
        url: '/cart/add',
        data: {
            reservationInfoId: reservationInfoId,
            qty: qty
        },
        type: 'GET',
        success: function (res) {
            if (!res) alert("Ошибка!");
            showCart(res);
        },
        error: function () {
            alert("Error!");
        }
    });
});
$('.form-buy').submit(false);
// jQuery(function($) {
//     $("#qtyField").focus(function() { // удаление текста в input при фокусе
//         if ( $(this).val() == $(this).attr("data-placeholder") ) {
//             $(this).val("");
//             $(this).css("color","#040404");
//         }
//     }).blur(function() {
//         if ( !$(this).val() ) {
//             $(this).val( $(this).attr("data-placeholder") );
//             $(this).css("color","#858585");
//         }
//     }).focus().blur();
//     $('#searchFormButton').click(function(){$('form').submit()})
//     $('form').submit(submitSearchForm)
//     function submitSearchForm() {
//         //if($('#searchError').length){ $('#searchError').remove();}
//         if( !$.trim( $('#qtyField').val() ) || $('#qtyField').val() == $('#qtyField').attr("data-placeholder") ) {
//             $('.er').animate({width:'show'}, 500); // показать div с ошибкой
//             return false;
//         }
//         var str = $('#qtyField').val();
// //  проверка инпут - запрет ввода любых букв (только цифры) как правильно сделать?
//         if  (/\D/.test(str)) {
//             $('.er').animate({width:'show'}, 500); // показать div с ошибкой
//             return false;
//         }
// //  ????????????????????????
//         return true
//     }
//     $("#qtyField").click(function(){ // спрятать div с ошибкой при клике в поле input
//         $(".er").animate({width:'hide'}, 300);
//     });
// });
