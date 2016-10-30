var itemCardBtn = $('.item-card-btn');
var dateBeginPicker = $('#dateBeginPicker');
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


});

//Корзина
function refreshButtonCart(cart) {
    var qty = $(cart).find('#qty-modal').text();
    if (qty > 0) {
        $('#navbar-cart').text('Корзина(' + qty + ')');
    } else {
        $('#navbar-cart').text('Корзина');
    }
}

function showOrdersItem(ordersItem) {
    $('#orders-item-modal').find('.modal-body').html(ordersItem);
    $('#orders-item-modal').modal();
}

function showCart(cart) {
    refreshButtonCart(cart);
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

$('.open-order-item').on('click', function (e) {
    e.preventDefault;
    var ordersId = $(this).data('id');
    $.ajax({
        url: '/orders-item/view',
        data: {
            ordersId: ordersId
        },
        type: 'GET',
        success: function (res) {
            if (!res) {
                alert("Ошибка!")
            }
            showOrdersItem(res);
        }
    })
});

$('.cancel-order').on('click', function (e) {
    var ordersId = $(this).data('id');
    $('.btn-cancel-order').attr('href', '/orders/cancel?ordersId=' + ordersId);
    $('#orders-cancel-modal').find('.modal-body').html('<span>Вы уверены что хотите отменить заказ №' + ordersId + '?</span>');
    $('#orders-cancel-modal').modal();
});

$('.add-to-cart').on('click', function (e) {
    e.preventDefault;
    // var reservationInfoId = $("#reservationinfo-id").val(),
    //     qty = $("#qtyField").val();
    var reservationInfoId = $("#dateBeginPicker").attr('reservationinfoid'),
        qty = $("#qtyField").val();
    addToCart(reservationInfoId, qty);
});

$('.add-to-cart-item').on('click', function (e) {
    e.preventDefault;
    var reservationInfoId = $(this).data('id'),
        qty = $("#qtyField").val();
    addToCart(reservationInfoId, qty);
});

function addToCart(reservationInfoId, qty) {
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
}


// todo Уменьшение/увеличение количества товара в корзине
function setQty(id) {
    var qty = $('#qtyField' + id).val();
    $.ajax({
        url: '/cart/add-qty',
        data: {
            id: id,
            qty: qty
        },
        type: 'GET',
        success: function (res) {
            if (!res) alert("Ошибка!");
            refreshButtonCart(res);
        },
        error: function () {
            alert("Error!");
        }
    });
}
$('.qtyFieldClassCartView').on("change keyup input click", function () {
    var id = $(this).data('id');
    setQty(id);
});

// $('.qtyPlusCartView').on("mouseup", function (e) {
//     e.preventDefault;
//     var id = $('.qtyPlusCartView').data('id');
//     setQty(id);
// });
//
// $('.qtyMinusCartView').on("mouseup", function (e) {
//     e.preventDefault;
//     var id = $('.qtyPlusCartView').data('id');
//     setQty(id);
// });

function qtyPlus(id) {
    var n = $('#qtyField' + id);
    n.val(Number(n.val()) + 1);
    if (id) {
        setQty(id);
    }
}

function qtyMinus(id) {
    var n = $('#qtyField' + id);
    n.val(Number(n.val()) - 1);
    if (n.val() < 1) {
        n.val(1);
    }
    if (id) {
        setQty(id);
    }
}

$("#qtyPlus").click(function () {
    qtyPlus('');
});

$("#qtyMinus").click(function () {
    qtyMinus('');
});

$('.qtyField').bind("change keyup input click", function () {
    if (this.value.match(/[^0-9]/g)) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }
    if (this.value == '' || this.value == 0) {
        this.value = 1;
    }
    //TODO максимальное значение
    // maxValue = $('#qtyField').data('value')
    // if (this.value > maxValue) {
    //     this.value = maxValue;
    // }
});

function getReservationinfoId(objreservationId, dt) {

    // var dateBeginPicker = $('#dateBeginPicker');
    // var arr = JSON.parse(dateBeginPicker.attr('allowdatetimes'));
    // // alert(dt);
    // // alert(arr['31']);
    // for(var p in arr) {
    //     // alert(arr[p]);
    //     console.log(arr[p]);
    //     console.log(dt);
    //     console.log(p);
    //     if (arr[p] == dt) {
    //         dateBeginPicker.attr('reservationinfoid', p);
    //         // dateBeginPicker.data('reservationinfoid').value = p;
    //     }
    // }
}

function setTime(ct, i) {
    $('.time-event').removeClass("active");
    itemCardBtn.removeClass('active');
    var fd = formatDate(i);
    $('div[data-date="' + fd + '"]').addClass("active");
    console.log('div[data-date="' + fd + '"]');

    // $(".xdsoft_time_variant").empty();
    // var dateBeginPicker = $('#dateBeginPicker');
    // var arr = JSON.parse(dateBeginPicker.attr('timedate'));
    // var fd = formatDate(i);
    // var dateBeginPicker = $('#dateBeginPicker');
    // var dt;
    // var h;
    // var m;
    // var arrTimes = [];
    // for(var p in arr) {
    //     if (formatDate(p) == fd) {
    //         arrTimes.push(arr[p]);
    //         // dt = new Date(fd + ' ' + arr[p]);
    //         // console.log(dt.getHours());
    //         // h = dt.getHours() < 10 ? '0'  + dt.getHours() : dt.getHours();
    //         // m = dt.getMinutes() < 10 ? '0'  + dt.getMinutes() : dt.getMinutes();
    //         // $("xdsoft_time_variant").append('<div class="xdsoft_time " data-hour="' + dt.getHours() + '" data-minute="' + dt.getMinutes() +  '">' + h + ':' + m + '</div>');
    //     }
    // }
    // // dateBeginPicker.attr('allowtimes', '{"44":"10:10","46":"22:00","47":"09:00"}');
    // $(".xdsoft_time_variant").empty();
}

function formatDate(i) {

    var dateBegin = new Date(i);
    var dd = dateBegin.getDate();

    if (dd < 10) dd = '0' + dd;

    var mm = dateBegin.getMonth() + 1;
    if (mm < 10) mm = '0' + mm;

    var yy = dateBegin.getFullYear();

    return yy + '-' + mm + '-' + dd;
}

itemCardBtn.on('click', function (e) {
    itemCardBtn.removeClass('active');
    $(this).addClass('active');
    dateBeginPicker.attr('reservationinfoid', $(this).data('id'));
});

$('#test-btn').on('click', function (e) {
    $(".xdsoft_time_variant").empty();
    $('#dateBeginPicker').attr('allowtimes', '{"44":"10:10","46":"22:00","47":"09:00"}');
});

//test
$('#testbutton').on('click', function (e) {
    e.preventDefault;
    var dt = $('#testdatetimepicker').val();
    $.ajax({
        url: '/test/testtime',
        data: {
            dt: dt
        },
        type: 'GET',
        success: function (res) {
            if (!res) alert("Ошибка!");
            $('#testid').text(res);
        },
        error: function () {
            alert("Error!");
        }
    });
});







