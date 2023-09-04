$(document).ready(function () {
    // Asc Desc
    $("#sorting").change(function () {
        sortValue = $("#sorting").val();
        if (sortValue == "desc") {
            $("#product").append($("#product").children().get().reverse());
        } else {
            $("#product").append($("#product").children().get().reverse());
        }
    });

    $("label.btn, label.w-75").click(function () {
        $("label.btn, label.w-75").removeClass("active");
        $(this).addClass("active");
    });

    $("#allCategory").click(function () {
        $("label.w-75 .btn").removeClass("active");
        $(this).addClass("active");
    });

    $(document).on("click", "label.w-75 .btn", function () {
        $("label.w-75 .btn").removeClass("active");
        $(this).addClass("active");
    });

    $(".filter").click(function () {
        categoryId = $(this).data("categoryid");
        $.ajax({
            type: "get",
            url: "/user/ajax/filter/" + categoryId,
            success: function (response) {
                if (response != 0) {
                    list = "";
                    for (i = 0; i < response.length; i++) {
                        list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="product">
                                        <div class="product-item bg-light mb-4">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="object-fit-cover img-fluid w-100" src="/storage/images/products/${response[i].image} " style="height:270px">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href="/user/products/${response[i].id}"><i class="fa-solid fa-circle-info"></i></a>
                                                </div>
                                            </div>
                                            <div class="py-4 text-center">
                                                <a class="h6 text-decoration-none text-truncate" href=""> ${response[i].name} </a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5> ${response[i].price} $</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                    }
                    $("#product").html(list);
                } else {
                    $("#product")
                        .html(`<div class="w-100 h-100 d-flex justify-content-center align-items-center">
							<div class="alert alert-info d-flex align-items-center justify-content-center py-4" role="alert">
								<span class="material-icons mr-4" style="font-size: 3rem;user-select: none;">sentiment_neutral</span>
								<div>
									<h4 class="alert-heading mb-3">No Products Found</h4>
									<p class="mb-0">Sorry, there are no products in this category yet. Please check back later or contact the site <br> administrator for assistance.</p>
								</div>
							</div>
						</div>`);
                }
            },
        });
    });
});
