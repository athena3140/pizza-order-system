$(document).ready(function () {
    $("#addToCart").click(function () {
        source = {
            qty: $("#pizzaCount").val(),
            product_id: $("#pizzaId").val(),
            user_id: $("#userId").val(),
        };

        $.ajax({
            type: "post",
            url: "/user/ajax/cart",
            data: source,
            dataType: "json",
            success: function (response) {
                toast(response.message, "#ffffff", "#28a745", "#279e3c");
            },
        });
    });

    $.ajax({
        type: "put",
        url: "/user/ajax/viewcount",
        data: { id: $("#pizzaId").val() },
    });
});
