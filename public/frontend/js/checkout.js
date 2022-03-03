// // Example starter JavaScript for disabling form submissions if there are invalid fields
// (function () {
//     "use strict";

//     // Fetch all the forms we want to apply custom Bootstrap validation styles to
//     var forms = document.querySelectorAll(".needs-validation");

//     // Loop over them and prevent submission
//     Array.prototype.slice.call(forms).forEach(function (form) {
//         form.addEventListener(
//             "submit",
//             function (event) {
//                 if (!form.checkValidity()) {
//                     event.preventDefault();
//                     event.stopPropagation();
//                 }

//                 form.classList.add("was-validated");
//             },
//             false
//         );
//     });
// })();
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".razorpay-btn").click(function (e) {
        e.preventDefault();
        var firstname = $(".firstname").val();
        var lastname = $(".lastname").val();
        var email = $(".email").val();
        var phone = $(".phone").val();
        var address1 = $(".address1").val();
        var address2 = $(".address2").val();
        var city = $(".city").val();
        var state = $(".state").val();
        var country = $(".country").val();
        var pincode = $(".pincode").val();

        var data = {
            firstname: firstname,
            lastname: lastname,
            email: email,
            phone: phone,
            address1: address1,
            address2: address2,
            city: city,
            state: state,
            country: country,
            pincode: pincode,
        };

        if (
            firstname &&
            lastname &&
            phone &&
            email &&
            city &&
            address1 &&
            address2 &&
            state &&
            country &&
            pincode
        ) {
            $.ajax({
                method: "POST",
                url: "/proceed-to-pay",
                data: data,
                success: function (response) {
                    // swal(response.total_price.toString());
                    var options = {
                        key: "rzp_test_K7NTR5yAZI4ZNO", // Enter the Key ID generated from the Dashboard
                        amount: response.total_price * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        currency: "INR",
                        name: response.firstname + " " + response.lastname,
                        description: "Thank you for choosing Us",
                        image: "https://example.com/your_logo",
                        // order_id: "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        handler: function (responsea) {
                            // alert(responsea.razorpay_payment_id);

                            $.ajax({
                                method: "POST",
                                url: "/place-order",
                                data: {
                                    fname: response.firstname,
                                    lname: response.lastname,
                                    email: response.email,
                                    phone: response.phone,
                                    address1: response.address1,
                                    address2: response.address2,
                                    city: response.city,
                                    state: response.state,
                                    country: response.country,
                                    pincode: response.pincode,
                                    payment_mode: "Paid by Razorpay",
                                    payment_id: responsea.razorpay_payment_id,
                                },
                                dataType: "dataType",
                                success: function (responseb) {
                                    swal(responseb.status).then(() => {
                                        window.location.href = "/my-orders";
                                    });
                                },
                            });
                        },
                        prefill: {
                            name: response.firstname + " " + response.lastname,
                            email: response.email,
                            contact: response.phone,
                        },

                        theme: {
                            color: "#3399cc",
                        },
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on("payment.failed", function (response) {});
                    rzp1.open();
                },
            });
        } else {
            swal("please fill your info");
            return false;
        }
    });
});
