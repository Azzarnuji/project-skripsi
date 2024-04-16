import { HTTP_OK } from '../Data/HttpStatus.js';
import ROLE from '../Data/RoleAccount.js';




const param = new URLSearchParams(window.location.search);


/**
 * Process the login by retrieving the email and password from the form inputs.
 * If the email or password is empty, display an error message.
 * Send a POST request to the '/api/auth/login' endpoint with the email and password.
 * Log the response to the console.
 *
 * @return {void}
 */
const ProcessLogin = async (element = null) => {
    element.setAttribute('disabled', true);
    let email = $('#FormEmail').val();
    let password = $('#FormPassword').val();
    let loading = $('#loading');

    loading.css('visibility', 'visible');
    if ((email.length == 0 || !email.includes('@')) || password.length == 0) {

        Swal.fire({
            icon: "error",
            text: "Email and password are required",
            // focusConfirm: false,
            // confirmButtonText: "OK",
            // allowEnterKey: true,
            didOpen: () => {
                $('#FormEmail').blur()
                $('#FormPassword').blur()
            }
        })
        loading.css('visibility', 'hidden');
        element.removeAttribute('disabled');
        return;
    }

    try {
        var requestBody = {
            email: email,
            password: password
        }
        const response = await $.ajax({
            url: '/api/auth/login',
            method: "POST",
            data: requestBody
        })
        if (response.httpCode == HTTP_OK) {
            loading.css('visibility', 'visible');
            element.setAttribute('disabled', false);
            console.log(response);
            Cookies.set('token', response?.data?.items?.token);
            Cookies.set('profile', JSON.stringify(response?.data?.items?.profile));
            window.top.location.href = `${ROLE[response?.data?.items?.profile?.role].toLowerCase()}/dashboard`;
        } else {
            Swal.fire({
                icon: "error",
                text: response?.message
            })
            loading.css('visibility', 'hidden');
            element.removeAttribute('disabled');
        }

    } catch (error) {

        Swal.fire({
            icon: "error",
            text: error?.responseJSON?.message
        })
        loading.css('visibility', 'hidden');
        element.removeAttribute('disabled');
        console.log(error);
    }
}


const setCookieTemp = (cname, cvalue) => {
    Cookies.set(cname, cvalue);
}
const getCookieTemp = (cname) => {
    return Cookies.get(cname);
}

/**
 * ProcessRegister is an asynchronous function that handles the registration process.
 * It validates the form fields and sends a POST request to the '/api/auth/register' endpoint
 * with the form data.
 *
 * @return {Promise<void>} This function does not return anything.
 */
const ProcessRegister = async () => {
    const fields = [
        'FormName',
        'FormAddress',
        'FormPhone',
        'FormEmail',
        'FormPassword',
        'FormReligion',
        'FormGender'
    ]
    let errors = []
    fields.forEach(field => {
        if ($(`#${field}`).val().length == 0) {
            errors.push({ [field]: "This field is required" })
        }
    });
    if (errors.length > 1) {
        Swal.fire({
            icon: "error",
            text: `Harap Isi Semua Bidang`
        })
        return;
    }
    try {
        console.log(HTTP_OK);
        const requestBody = {
            name: $('#FormName').val(),
            address: $('#FormAddress').val(),
            phone: $('#FormPhone').val(),
            email: $('#FormEmail').val(),
            password: $('#FormPassword').val(),
            religion: $('#FormReligion').val(),
            gender: $('#FormGender').val()
        }
        Swal.fire({
            title: "Processing",
            timerProgressBar: true,
            didOpen: async () => {
                Swal.showLoading()
                const response = await $.ajax({
                    url: '/api/auth/register',
                    method: "POST",
                    data: requestBody
                })
                if (response.httpCode == HTTP_OK) {
                    Swal.fire({
                        icon: "success",
                        text: "Register Success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/login';
                        }
                    })
                }
            }
        })
    } catch (error) {
        console.log(error);
        Swal.fire({
            icon: "error",
            text: error?.responseJSON?.message
        })
    }

}

const getParam = (searchParams) => {
    return param.get(searchParams);
}

const delParam = () => {
    let url = window.location.href;
    let splice = url.split('?');
    window.history.pushState('', '', splice[0].replace(/\/$/, ''));
}


const getPathName = () => {
    const slicePath = window.location.pathname.split('/').filter(path => path.length > 0);
    return [slicePath[0], slicePath[1]]

}

const currency = (num) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(num);
}

const logout = () => {
    Cookies.remove('token');
    Cookies.remove('profile');
    window.location.href = '/';
}

const askBeforeExecution = (message, callback) => {
    return Swal.fire({
        title: "Anda Yakin?",
        text: message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
            // console.log(callback);
        }
    })
}

const postLoader = (callback) => {
    Swal.fire({
        title: "Processing",
        timerProgressBar: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: async () => {
            Swal.showLoading()
            return callback();
        },
        didClose: () => {
            Swal.hideLoading()
        }
    })
}

export const getDataBeforeComma = (inputString) => {
    // Mengecek apakah inputString adalah string
    if (typeof inputString !== 'string') {
        return 'Input bukan sebuah string';
    }

    let commaIndex;
    if (inputString.includes(',')) {
        commaIndex = inputString.indexOf(',');
    } else {
        commaIndex = inputString.indexOf('.');
    }
    // Mencari indeks koma pertama

    // Jika koma tidak ditemukan, mengembalikan string asli
    if (commaIndex === -1) {
        return inputString;
    }

    // Mengambil data sebelum koma
    const dataBeforeComma = inputString.substring(0, commaIndex);

    return dataBeforeComma;
}
const readMore = (target, text) => {
    console.log(target, text);
    const targetElement = $(`#${target}`)
    targetElement.html("")
    targetElement.html(`${text}<a href="#" onclick="less('${target}','${text}')"><small>...Less</small></a>`)
}

const less = (target, text) => {
    console.log(target, text);
    const targetElement = $(`#${target}`)
    targetElement.html("")
    targetElement.html(`${text.substring(0, 50)}<a href="#" onclick="readMore('${target}','${text}')"><small>...Read More</small></a>`)
}



export {
    setCookieTemp,
    getCookieTemp,
    postLoader
}

window.less = less
window.readMore = readMore
window.ProcessRegister = ProcessRegister;
window.ProcessLogin = ProcessLogin;
window.getParam = getParam;
window.delParam = delParam;
window.getPathName = getPathName;
window.currency = currency;
window.logout = logout;
window.askBeforeExecution = askBeforeExecution;
