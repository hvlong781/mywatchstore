$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore()
{
    const page = $('#page').val();
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        data : { page },
        url : 'services/load-product',
        success : function (result) {
            if (result.html !== '') {
                $('#loadProduct').append(result.html);
                $('#page').val(page+1);
            } else {
                alert('Đã load tất cả sản phẩm!')
                $('#btn-loadMore').css('display', 'none');
            }
        }
    })
}

$(document).ready(function () {
    var trigger = $('.hamburger'),
        overlay = $('.overlay'),
        isClosed = false;

    trigger.click(function () {
        hamburger_cross();
    });

    function hamburger_cross() {

        if (isClosed == true) {
            overlay.hide();
            trigger.removeClass('is-open');
            trigger.addClass('is-closed');
            isClosed = false;
        } else {
            overlay.show();
            trigger.removeClass('is-closed');
            trigger.addClass('is-open');
            isClosed = true;
        }
    }

    $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
    });
});
