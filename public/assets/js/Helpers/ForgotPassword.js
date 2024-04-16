import { getCookieTemp, setCookieTemp } from "./Utils.js";

const parentElement = $('#forgotPasswordParent')
const loader = $('#loading')
const ForgotPassword = async (event) => {
    const email = $('#FormEmailForgot').val();
    loader.css('visibility', 'visible')
    try {
        // parentElement.empty()

        // GenerateElementVerifyOTP(email)

        const response = await $.ajax({
            url: '/api/auth/sendOtp',
            method: 'POST',
            data: {
                email: email
            }
        })
        if (response.httpCode == 200) {
            setCookieTemp('emailTemp', email)
            parentElement.empty()
            GenerateElementVerifyOTP(email)
        }
        loader.css('visibility', 'hidden')
    } catch (error) {
        Swal.fire({
            icon: "error",
            text: error?.responseJSON?.message
        })
        loader.css('visibility', 'hidden')
        console.log(error);
    }
    // console.log(response);
    // parentElement.empty()
    // GenerateElementVerifyOTP()
}

const VerifyOTP = async (event) => {
    const otp = $('#FormOTP').val();
    const email = getCookieTemp('emailTemp')
    loader.css('visibility', 'visible')

    try {
        const response = await $.ajax({
            url: '/api/auth/verifyOtp',
            method: 'POST',
            data: {
                otp: otp,
                email: email
            }
        })
        if (response.httpCode == 200) {
            parentElement.empty()
            GeneratePasswordElements()
            loader.css('visibility', 'hidden')
        }
        console.log(response);
    } catch (error) {
        Swal.fire({
            icon: "error",
            text: error?.responseJSON?.message
        })
        console.log(error);
    }


    // parentElement.empty()
    // GeneratePasswordElements()
}

const SaveNewPassword = async () => {
    const password = $('#FormNewPassword').val();
    const confirmPassword = $('#FormConfirmPassword').val();

    if (password != confirmPassword) {
        Swal.fire({
            icon: "error",
            text: "Password tidak sama"
        })
        return;
    }

    try {
        const response = await $.ajax({
            url: '/api/auth/resetPassword',
            method: "POST",
            data: {
                email: getCookieTemp('emailTemp'),
                password: password
            }
        })
        if (response.httpCode == 200) {
            Swal.fire({
                icon: "success",
                text: response?.message
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/';
                }
            })
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            text: error?.responseJSON?.message
        })
        console.log(error);
    }
    console.log('Save New Password');
}
const GenerateElementVerifyOTP = (email) => {
    console.log('Halo');
    console.log(email);
    // Membuat elemen div dengan class "mb-3"
    var divElement = document.createElement("div");
    divElement.className = "mb-3";

    // Membuat elemen label dengan atribut "for" dan class "form-label"
    var labelElement = document.createElement("label");
    labelElement.setAttribute("for", "exampleFormControlInput1");
    labelElement.className = "form-label";
    labelElement.textContent = "Kode OTP";

    // Membuat elemen input dengan tipe "number", class "form-control", id "FormOTP", dan atribut placeholder
    var inputElement = document.createElement("input");
    inputElement.type = "number";
    inputElement.className = "form-control";
    inputElement.id = "FormOTP";
    inputElement.name = "FormOTP";
    inputElement.placeholder = "Masukkan OTP";
    inputElement.required = true;



    // Menambahkan label dan input ke dalam elemen div
    divElement.appendChild(labelElement);
    divElement.appendChild(inputElement);

    // Membuat elemen div dengan class "d-flex justify-content-end"
    var flexDivElement = document.createElement("div");
    flexDivElement.className = "d-flex justify-content-end";

    // Membuat elemen button dengan tipe "submit", class "btn btn-primary me-3", dan atribut onclick
    var buttonElement = document.createElement("button");
    buttonElement.type = "submit";
    buttonElement.className = "btn btn-primary me-3";
    buttonElement.textContent = "Kirim";
    buttonElement.onclick = function () {
        VerifyOTP(this);
    };

    // Menambahkan button ke dalam elemen div
    flexDivElement.appendChild(buttonElement);

    parentElement.append(divElement)
    parentElement.append(flexDivElement)
}
const GeneratePasswordElements = () => {
    createAndAppendElement("div", "mb-3", [
        { tag: "label", className: "form-label", text: "Masukkan Password Baru Anda", forAttr: "FormNewPassword" },
        { tag: "input", className: "form-control", id: "FormNewPassword", placeholder: "Masukkan Password Baru Anda", required: true }
    ]);

    createAndAppendElement("div", "mb-3", [
        { tag: "label", className: "form-label", text: "Confirm Password Baru Anda", forAttr: "FormConfirmPassword" },
        { tag: "input", className: "form-control", id: "FormConfirmPassword", placeholder: "Konfirmasi Password Baru Anda", required: true }
    ]);

    createAndAppendElement("div", "d-flex justify-content-end", [
        { tag: "button", className: "btn btn-primary me-3", text: "Simpan", onclick: function () { SaveNewPassword(this); } }
    ]);
}

const createAndAppendElement = (parentTag, parentClass, children) => {
    var parentElementTemp = document.createElement(parentTag);
    if (parentClass) parentElementTemp.className = parentClass;

    if (children) {
        children.forEach(function (child) {
            var childElement = document.createElement(child.tag);
            if (child.className) childElement.className = child.className;
            if (child.text) childElement.textContent = child.text;
            if (child.id) childElement.id = child.id;
            if (child.placeholder) childElement.placeholder = child.placeholder;
            if (child.required) childElement.required = child.required;
            if (child.forAttr) childElement.setAttribute("for", child.forAttr);
            if (child.onclick) childElement.onclick = child.onclick;

            parentElementTemp.appendChild(childElement);
        });
    }

    parentElement.append(parentElementTemp)
}


window.ForgotPassword = ForgotPassword;
