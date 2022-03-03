$(document).ready(function () {
    loadCart();
    loadWishlist();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    function loadCart() {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function (response) {
                $(".cart-count").html("");
                $(".cart-count").html(response.count);
            },
        });
    }
    function loadWishlist() {
        $.ajax({
            method: "GET",
            url: "/load-wishlist-data",
            success: function (response) {
                $(".wishlist-count").html("");
                $(".wishlist-count").html(response.count);
            },
        });
    }

    $(".addToCartBtn").click(function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product_data")
            .find(".prod_id")
            .val();
        var product_qty = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                product_id: product_id,
                product_qty: product_qty,
            },
            success: function (response) {
                swal(response.status);
                loadCart();
                console.log(response.status + ",");
            },
        });
    });

    $(".addToWishlist").click(function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product_data")
            .find(".prod_id")
            .val();
        $.ajax({
            method: "POST",
            url: "/add-to-wishlist",
            data: {
                product_id: product_id,
            },
            success: function (response) {
                swal(response.status);
                console.log(response.status + ",");
                loadWishlist();
            },
        });
    });

    $(document).on("click", ".increament-btn", function (e) {
        e.preventDefault();
        var inc_value = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });
    $(document).on("click", ".decrement-btn", function (e) {
        e.preventDefault();
        var dec_value = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 0) {
            value--;
            $(this).closest(".product_data").find(".qty-input").val(value);
        }
    });
    $(document).on("click", ".delete-cart-item", function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product_data")
            .find(".prod_id")
            .val();
        $.ajax({
            method: "POST",
            url: "delete-cart-item",
            data: {
                product_id: product_id,
            },
            success: function (response) {
                // window.location.reload();
                $(".cartitems").load(location.href + " .cartitems");
                loadCart();
                swal("", response.status, "success");
            },
        });
    });

    $(document).on("click", ".delete-wishlist-item", function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product_data")
            .find(".prod_id")
            .val();
        $.ajax({
            method: "POST",
            url: "delete-wishlist-item",
            data: {
                product_id: product_id,
            },
            success: function (response) {
                // window.location.reload();
                $(".wishlistitems").load(location.href + " .wishlistitems");
                loadWishlist();
                swal("", response.status, "success");
            },
        });
    });
    $(document).on("click", ".changeQuantity", function (e) {
        e.preventDefault();
        var product_id = $(this)
            .closest(".product_data")
            .find(".prod_id")
            .val();
        var product_qty = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();
        data = {
            product_id: product_id,
            product_qty: product_qty,
        };
        $.ajax({
            method: "POST",
            url: "update-cart",
            data: data,
            success: function (response) {
                // window.location.reload();
                $(".cartitems").load(location.href + " .cartitems");
                loadCart();
                swal(response.status);
            },
        });
    });
});
