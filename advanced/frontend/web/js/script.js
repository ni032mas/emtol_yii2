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

$('.add-to-cart').on('click', function (e) {
    e.preventDefault;
    var reservationInfoId = $("#reservationinfo-id").val();
    var qty = $("#qtyField").val();
    $.ajax({
        url: '/card/add',
        data: {
            reservationInfoId: reservationInfoId,
            qty: qty
        },
        type: 'GET',
        success: function (res) {

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
