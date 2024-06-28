// signin - signup change view function
function changeView() {
    var signUpBox = document.getElementById("signupbox");
    var signInBox = document.getElementById("signinbox");
    var forgetpwbox = document.getElementById("frbod");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
    forgetpwbox.classList.toggle("d-none");
}

// login function
function login() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "Success") {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Successfully Login.",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function () {
                    window.history.back();
                }, 1500);

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "loginprocess.php", true);
    r.send(f);
}

// register function
function signup() {

    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var re = document.getElementById("remail");
    var rpw = document.getElementById("rpassword");
    var mobile = document.getElementById("mobile");
    var terms = document.getElementById("terms");

    var f = new FormData();
    f.append("fname", fn.value);
    f.append("lname", ln.value);
    f.append("remail", re.value);
    f.append("rpassword", rpw.value);
    f.append("mobile", mobile.value);
    f.append("terms", terms.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "Success") {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";

                setTimeout(function () {
                    window.location.reload();
                }, 1000);

            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    }

    r.open("POST", "registerProcess.php", true);
    r.send(f);

}

var bm;
// function forget pw
function forgotPassword() {

    var email = document.getElementById("email");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "Success") {

                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

// function reset pw
function resetPassword() {
    var email = document.getElementById("email");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var f = new FormData();
    f.append("email", email.value);
    f.append("np", np.value);
    f.append("rnp", rnp.value);
    f.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "Success") {

                bm.hide();
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Your password has been updated.",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function () {
                    window.location.reload();
                }, 1500);

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);
}

//function single product load main image
function loadMainImg(id) {
    var sample_img = document.getElementById("productImg" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + sample_img + ")";
}

//function check qty value
function check_value(qty) {

    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        Swal.fire({
            position: "top-center",
            icon: "info",
            title: "Quantity must be 01 or more.",
            showConfirmButton: false,
            timer: 2000
        });
        input.value = 1;
    } else if (input.value > qty) {
        Swal.fire({
            position: "top-center",
            icon: "info",
            title: "Insufficient Quantity.",
            showConfirmButton: false,
            timer: 2000
        });
        input.value = qty;
    }
}

//function qty inc
function qty_inc(qty) {
    var input = document.getElementById("qty_input");

    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue;
    } else {
        Swal.fire({
            position: "top-center",
            icon: "info",
            title: "Maximum quantity has achieved.",
            showConfirmButton: false,
            timer: 2000
        });
        input.value = qty;
    }
}

//function qty dec
function qty_dec() {
    var input = document.getElementById("qty_input");

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue;
    } else {
        Swal.fire({
            position: "top-center",
            icon: "info",
            title: "Minimum quantity has achieved.",
            showConfirmButton: false,
            timer: 2000
        });
        input.value = 1;
    }
}

//function add to cart
function addToCart(id) {

    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "This Product Already Exists In The Cart.") {

                Swal.fire({
                    position: "top-center",
                    icon: "warning",
                    title: "This Product Already Exists In The Cart.",
                    showConfirmButton: false,
                    timer: 2000
                });
                window.location = "cart.php";

            } else if (t == "Success") {

                window.location = "cart.php";

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

//function remove cart
function removeFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
                setTimeout(function () {
                    window.location.reload();
                }, 3000);

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromCartProcess.php?id=" + id, true);
    r.send();

}

function showPassword() {
    var password = document.getElementById("password");
    var pb = document.getElementById("pb");

    if (password.type == "password") {
        password.type = "text";
        pb.innerHTML = '<i class="bi bi-eye"></i>';

    } else {
        password.type = "password";
        pb.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
}

function showPassword1() {
    var rpassword = document.getElementById("rpassword");
    var npb = document.getElementById("npb");

    if (rpassword.type == "password") {
        rpassword.type = "text";
        npb.innerHTML = '<i class="bi bi-eye"></i>';

    } else {
        rpassword.type = "password";
        npb.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
}

function showPassword2() {
    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (np.type == "password") {
        np.type = "text";
        npb.innerHTML = '<i class="bi bi-eye"></i>';

    } else {
        np.type = "password";
        npb.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
}

function showPassword3() {
    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {
        rnp.type = "text";
        rnpb.innerHTML = '<i class="bi bi-eye"></i>';

    } else {
        rnp.type = "password";
        rnpb.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
}

//function cart qty update
function changeQTY(id) {

    var cartId = id;

    var qty = document.getElementById("qty" + id);

    var newQty = parseInt(qty.value);

    var f = new FormData();
    f.append("c", cartId);
    f.append("q", newQty);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "success") {
                qty.value = parseInt(qty.value);
                window.location.reload();
            } else {
                alert(response);
            }
        }
    };
    request.open("POST", "cartQtyUpdateProcess.php", true);
    request.send(f);
}

//function admin verify
var av;
function verifyCode() {

    var email = document.getElementById("email");

    var form = new FormData();
    form.append("email", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var adminVerificationModal = document.getElementById("adminPanelModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(form);

}

//function admin login
function adminLogin() {
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                av.hide();
                window.location = "adminPanel.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "adminLoginProcess.php?v=" + verification.value, true);
    r.send();
}

function shipping() {

    var oaddress = document.getElementById("otherAddress");
    var oShipping = document.getElementById("oShipping");

    oShipping.addEventListener('change', function () {
        if (oShipping.checked) {
            oaddress.classList.remove("d-none");
        } else {
            oaddress.classList.add("d-none");
        }
    });
}

// function user image
function changeProfileImg() {
    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }

}

//function update user details
function updateInformation() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var dob = document.getElementById("dob");
    var gender = document.getElementById("gender");
    var image = document.getElementById("profileImage");

    var f = new FormData();

    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("m", mobile.value);
    f.append("dob", dob.value);
    f.append("g", gender.value);
    f.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (r == "Updated" || r == "Updated") {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            } else if (r == "You have not selected any image.") {
                alert("You have not selected any image.");
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateInformationProcess.php", true);
    r.send(f);
}

//function update address
function updateAddress() {
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");

    var f = new FormData();

    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (r == "Updated" || r == "Saved") {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateAddressProcess.php", true);
    r.send(f);
}

// t function
function logout() {

    var r = new XMLHttpRequest();

    r.ologounreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "Success") {

                window.location = "index.php";

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "signoutProcess.php", "true");
    r.send();

}

// funtion paynow
function payNow(id) {

    var qty = document.getElementById("qty_input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            var obj = JSON.parse(response);

            var mail = obj["umail"];
            var amount = obj["amount"];

            if (response == 1) {
                alert("Please Login.");
                window.location = "register.php";
            } else if (response == 2) {
                alert("Please update your profile.");
                window.location = "userAccountInformation.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    Swal.fire({
                        icon: "success",
                        title: "Payment completed.",
                        footer: "OrderID:" + orderId
                    });
                    setTimeout(function () {
                        saveInvoice(orderId, id, mail, amount, qty);
                    }, 2500);
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/VIVA/singleproductview.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/VIVA/singleProductView.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }

        }
    }

    request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    request.send();
}

// function save invoice
function saveInvoice(orderId, id, mail, amount, qty) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", id);
    form.append("m", mail);
    form.append("a", amount);
    form.append("q", qty);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveInvoiceProcess.php", true);
    request.send(form);

}

function addToWishlist(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "added") {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Successfully Added.",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else if (response == "removed") {
                window.location.reload();
            } else {
                alert(response);
            }

        }
    }

    request.open("GET", "addToWishlistProcess.php?id=" + id, true);
    request.send();


}

// function save feedback
function saveFeedback(id) {

    var type;

    if (document.getElementById("type1").checked) {
        type = 1;
    } else if (document.getElementById("type2").checked) {
        type = 2;
    } else if (document.getElementById("type3").checked) {
        type = 3;
    }

    var feedback = document.getElementById("feed");

    var f = new FormData();
    f.append("pid", id);
    f.append("t", type);
    f.append("f", feedback.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 & r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                Swal.fire({
                    title: "Feedback saved.",
                    icon: "success",
                    showClass: {
                        popup: `
                        animate__animated
                        animate__fadeInUp
                        animate__faster
                      `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                      `
                    }
                });

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);

}

// function add product
function addProduct() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var condition = 0;

    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }

    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("con", condition);
    f.append("qty", qty.value);
    f.append("co", cost.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("de", desc.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 & r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Product Saved Successfully.",
                    showConfirmButton: false,
                    timer: 2000
                });
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);
}

// function update product
function updateProduct() {

    var title = document.getElementById("title");
    var qty = document.getElementById("qty");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("desc");
    var images = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("title", title.value);
    form.append("qty", qty.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("desc", description.value);

    var file_count = images.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("i" + x, images.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Product has been Updated.") {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Product has been Updated.",
                    showConfirmButton: false,
                    timer: 2000
                });
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "updateProductProcess.php", true);
    request.send(form);

}

// function add product image
function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.");
        }
    }

}

function removeFromWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromWishlistProcess.php?id=" + id, true);
    r.send();
}

function sendid(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "Success") {
                window.location = "updateProduct.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "sendIdProcess.php?id=" + id, true);
    request.send();

}

// function printInvoice
function printInvoice() {
    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}

// function search
function basicSearch(x) {

    var txt = document.getElementById("basic_search_txt");
    var select = document.getElementById("basic_search_select");

    var form = new FormData();
    form.append("t", txt.value);
    form.append("s", select.value);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("basicSearchResult").innerHTML = response;
        }
    }

    request.open("POST", "basicSearchProcess.php", true);
    request.send(form);

}

// function advaned search
function advancedSearch(x) {

    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b1");
    var model = document.getElementById("m");
    var condition = document.getElementById("c2");
    var color = document.getElementById("c3");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var form = new FormData();
    form.append("t", txt.value);
    form.append("cat", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("con", condition.value);
    form.append("col", color.value);
    form.append("pf", from.value);
    form.append("pt", to.value);
    form.append("s", sort.value);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("view_area").innerHTML = response;
        }
    }

    request.open("POST", "advancedSearchProcess.php", true);
    request.send(form);

}

// function checkout
function checkout() {

    var f = new FormData();
    f.append("cart", true);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;

            //alert(response);
            var payment = JSON.parse(response);
            doCheckout(payment, "checkoutProcess.php");

        }
    };
    request.open("POST", "paymentProcess.php", true);
    request.send(f);
}
function doCheckout(payment, path) {
    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer

        var f = new FormData();
        f.append("payment", JSON.stringify(payment));

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 & request.status == 200) {
                var response = request.responseText;
                // alert(response);
                var order = JSON.parse(response);

                if (order.resp == "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Payment completed.",
                        footer: "OrderID:" + orderId
                    });
                    setTimeout(function () {
                        window.location = "invoice.php?id=" + orderId;
                    }, 2500);
                } else {
                    alert(response);
                }
            }
        };

        request.open("POST", path, true);
        request.send(f);
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:" + error);
    };

    // Show the payhere.js popup, when "PayHere Pay" is clicked
    //document.getElementById('payhere-payment').onclick = function (e) {
    payhere.startPayment(payment);
    //};
}

// function ad category
function verifyCategory() {

    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var form = new FormData();
    form.append("email", e);
    form.append("name", n);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Success") {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Successfully Category Added.",
                    showConfirmButton: false,
                    timer: 2500
                });
                setTimeout(function () {
                    window.location.reload();
                }, 2500);
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "addNewCategoryProcess.php", true);
    request.send(form);

}