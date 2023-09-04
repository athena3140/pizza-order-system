$(document).ready(function () {
    const params = new URLSearchParams(window.location.search);
    const key = params.get("key");
    if (key) {
        const inputEl = document.getElementById(key);
        if (inputEl) {
            inputEl.focus();
            inputEl.setSelectionRange(
                inputEl.value.length,
                inputEl.value.length
            );
        }
    }
    try {
        var deleteBtns = document.querySelectorAll(".delete-product");
        deleteBtns.forEach(function (deleteBtn) {
            deleteBtn.addEventListener("click", function (event) {
                event.preventDefault();
                if (confirm("Are you sure you want to delete this product?")) {
                    window.location.href = deleteBtn.href;
                }
            });
        });
    } catch (error) {
        console.log(error);
    }

    tooltip = document.querySelectorAll(".item");
    tooltip.forEach((item) => {
        tippy(item, {
            content: item.getAttribute("data-tooltip"),
            animation: "shift-toward",
            arrowType: "round",
        });
    });

    try {
        tippy("#profileImg", {
            content: document
                .getElementById("profileImg")
                .getAttribute("data-tooltip"),
            animation: "shift-toward",
            arrowType: "round",
        });
        var input = document.getElementById("cc-pament");
        input.selectionStart = input.selectionEnd = input.value.length;
    } catch (err) {
        null;
    }
    tippy(".copy", {
        content: $(".copy").attr("data-tooltip"),
        animation: "shift-toward",
        arrowType: "round",
    });

    $(".fa-plus, .expection").click(function () {
        $(this).parents("li").find(".ps-3").slideToggle();
        $(this).parents("li").find(".fa-plus").toggleClass("fa-plusActive");
        $(this)
            .parents("li")
            .find(".fa-solid.fa-gear")
            .toggleClass("fa-gearActive");
    });
});
var currentUrl = window.location.href;
$("li a").each(function () {
    var href = $(this).attr("href");
    if (href && currentUrl.indexOf(href) > -1) {
        $(this).addClass("text-danger text-decoration-underline");
        $(this).parents("li").find(".ps-3").slideToggle();
        $(this).parents("li").find(".fa-plus").toggleClass("fa-plusActive");
    }
});
