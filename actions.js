$(document).ready(function() {
    $("#filter").click(function() {
        var max = $("#price-max").val();
        var min = $("#price-min").val();

        $.ajax({
            url: "get_products.php",
            method: "POST",
            data: { min: min, max: max },
            success: function(data) {
                $("#get_product").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        });
    });

    $(".input-select").change(function() {
        var value = $(this).val();
        $.ajax({
            url: "get_products.php",
            method: "POST",
            data: { orderby: value },
            success: function(data) {
                $("#get_product").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        });
    });

    $("body").delegate(".selectBrand", "click", function(event) {
        // event.preventDefault();
        $("#get_product").html("<h3>Loading...</h3>");
        var bid = $(this).attr('bid');
        $.ajax({
            url: "get_products.php",
            method: "POST",
            data: { selectBrand: 1, brand_id: bid },
            success: function(data) {
                $("#get_product").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        });
    });

    $('#btn-login').click(function() {
        // var email = $('#email').val();
        // var password = $('#password').val();

        // $.ajax({
        //     url: "index.php",
        //     method: "POST",
        //     data: { email: email, password: password }
        // });
    });

    $("#login").on("submit", function(event) {
        // event.preventDefault();
        $(".overlay").show();
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            url: "login.php",
            method: "POST",
            data: { email: email, password: password },
            success: function(data) {
                // if (data == "login_success") {
                //     window.location.href = "index.php";
                // } else if (data == "cart_login") {
                //     window.location.href = "cart.php";
                // } else {
                //     $("#e_msg").html(data);
                //     $(".overlay").hide();
                // }
                if (email == "admin@gmail.com" && password == "admin") {

                    window.location.href = "admin/index.php";
                } else {
                    window.location.href = "index.php";
                }
            }
        })
    })

    $(".add-to-cart-btn").click(function() {
        var pid = $(this).attr("pid");
        var sl = 1;
        $.ajax({
            url: "index.php",
            method: "GET",
            data: { pid: pid, sl: sl },
            success: function(data) {}
        });
    });

    $(".remove").click(function() {
        var id = $(this).attr("remove_id");
        $.ajax({
            url: 'cart.php?action=remove',
            type: 'get',
            data: { removeId: id },
            success: function() {
                //whatever you wanna do after the form is successfully submitted
            }
        });
        $(this).parent().parent().remove();
    });

    $(".dropdown").click(function() {
        $("#cart_product").load('./cart_product.php');
    });

    $("#product").click(function() {

        var count = $("#cart-count").text();
        var re_count = parseFloat(count) + 1;
        $("#cart-count").text(re_count);
    });

    $('#add-to-cart-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'cart.php?action=add',
            type: 'post',
            data: $('#add-to-cart-form').serialize(),
            success: function() {
                //whatever you wanna do after the form is successfully submitted

                var text = "<div class='alert alert-success'>" +
                    "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>" +
                    "<b>Thêm thành công!</b>" +
                    "</div>";
                $("#product-detail").prepend(text);
            }
        });
    });

    $('#rv-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'action.php?action=send_review',
            type: 'post',
            data: $('#rv-form').serialize(),
            success: function() {}
        });
        window.location.reload();
    });

    $('#profile').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'action.php?action=save_profile',
            type: 'post',
            data: $('#profile').serialize(),
            success: function() {}
        });
        var text = "<div class='alert alert-success'>" +
            "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>" +
            "<b>Lưu thành công!</b>" +
            "</div>";
        $("#profile").prepend(text);
        window.location.reload();
    });

    // $('#change_password').submit(function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url: 'action.php?action=change_password',
    //         type: 'post',
    //         data: $('#change_password').serialize(),
    //         success: function() {}
    //     });
    //     var text = "<div class='alert alert-success'>" +
    //         "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>" +
    //         "<b>Đổi mật khẩu thành công!</b>" +
    //         "</div>";
    //     $("#change_password").prepend(text);
    //     window.location.reload();
    // });

    $('input[type=radio][name=payment]').change(function() {
        if (this.value == 'momo') {
            $("#qr-code").html("<img width='350px' src='img/MoMo.png' alt='momo'>");
        } else if (this.value == 'qrpay') {
            $("#qr-code").html("<img width='280px' src='img/QRPay.png' alt='qrpay'>");
        } else {
            $("#qr-code").html("");
        }
    });
});