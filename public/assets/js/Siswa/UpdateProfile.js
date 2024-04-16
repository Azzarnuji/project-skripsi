import { getCookieTemp } from "../Helpers/Utils.js";

$(document).ready(() => {
    $('#btnModalUpdateProfile').on('click', () => {
        const jsonData = JSON.parse(getCookieTemp('profile'))
        console.log(jsonData);

        const fieldEmail = $('#emailUpdateProfile')
        const fieldNama = $('#namaUpdateProfile')
        const fieldAlamat = $('#alamatUpdateProfile')
        const fieldTelepon = $('#teleponUpdateProfile')

        fieldEmail.val(jsonData.email)
        fieldNama.val(jsonData.detail.name)
        fieldAlamat.val(jsonData.detail.address)
        fieldTelepon.val(jsonData.detail.phone)
    })
})
