$(document).ready(function () {
    // handle the button click
    function updateTotalPrice(element) {
        var parent = element.parents("tr");
        var pizzaPrice = parseInt(parent.find(".pizzaPrice").val());
        var pizzaQty = parseInt(parent.find(".qty").val());
        if (isNaN(pizzaQty) || pizzaQty < 0) {
            pizzaQty = 0;
        }
        var totalPrice = pizzaPrice * pizzaQty;
        parent
            .find(".totalAsign")
            .val("$ " + totalPrice)
            .trigger("change");
    }

    //cart summary
    function cartSummary() {
        var total = 0;
        $(".totalAsign").each(function () {
            var value = $(this).val();
            var number = value.replace("$", "");
            total += parseInt(number);
        });

        deliFee = parseInt($("#delifee").html().replace("$", ""));
        if (total == 0) {
            deliFee = 0;
            $("#delifee").html(0);
            $("#checkoutBtn").addClass("disabled");
            $(".cartWarning").slideDown();
        } else {
            deliFee = 5;
            $("#delifee").html("$ 5");
            $("#checkoutBtn").removeClass("disabled");
            $(".cartWarning").slideUp();
        }

        $("#subTotal").html("$ " + total);
        $("#checkoutTotal").html("$ " + parseInt(total + deliFee));
    }

    //order code
    function generateOrderCode() {
        let t = new Date(),
            [e, r, n, o, g, a] = [
                t.getFullYear().toString().slice(-2),
                u(t.getMonth() + 1, 2),
                u(t.getDate(), 2),
                u(t.getHours(), 2),
                u(t.getMinutes(), 2),
                u(t.getSeconds(), 2),
            ];
        function u(t, e) {
            return t.toString().padStart(e, "0");
        }
        return `ATHN-${e}${r}${n}-${o}${g}${a}-`;
    }

    $(".btn-plus").click(function (e) {
        updateTotalPrice($(this));
    });

    $(".btn-minus").click(function (e) {
        updateTotalPrice($(this));
    });

    $(".remove").click(function (e) {
        parent = $(this).parents("tr");
        id = parent.find("#cartId").val();

        $.ajax({
            type: "post",
            url: `/user/ajax/cart/${id}/delete`,
            success: function (response) {
                toast(response.message, "#ffffff", "#FF4136", "#B50000");
                parent.remove();
                cartSummary();
            },
        });
    });

    $(".totalAsign").change(function () {
        cartSummary();
    });

    $(".qty").on("input keydown", function (e) {
        updateTotalPrice($(this));

        if ($(this).val() == "") {
            $(this).val(0);
        }

        if ($(this).val() == 0 && /^[0-9]$/.test(event.key)) {
            $(this).val("");
        }
    });

    $("#checkoutBtn").click(function () {
        orderList = [];
        userId = $("#userId").val();
        rnd = Math.floor(Math.random() * 100000);

        $("tr:not(:first-child)").each(function () {
            orderList.push({
                user_id: userId,
                product_id: $(this).find("#productId").val(),
                qty: $(this).find(".qty").val(),
                total: $(this).find(".totalAsign").val().replace(/\$|\s/g, ""),
                order_code: generateOrderCode() + rnd,
            });
        });

        $.ajax({
            type: "post",
            url: "/user/ajax/order/",
            data: Object.assign({}, orderList),
            success: function (response) {
                toast(response.message, "#ffffff", "#28a745", "#279e3c");
                $("tbody tr").remove();
                cartSummary();
            },
        });
    });

    if ($("#checkoutTotal").html() == "$ 0") {
        $("#checkoutBtn").addClass("disabled");
        $(".cartWarning").slideDown();
    }

    $("#clearCart").click(function () {
        confirm = confirm(
            "Are you sure want to clear cart. This process will delete your cart from database."
        );
        if (confirm) {
            $.ajax({
                type: "post",
                url: "/user/ajax/cart/clear",
                success: function (response) {
                    toast(response.message, "#ffffff", "#FF4136", "#B50000");
                    $("tbody tr").remove();
                    cartSummary();
                },
            });
        }
    });
});
