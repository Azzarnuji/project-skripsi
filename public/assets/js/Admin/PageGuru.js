import { getDataBeforeComma } from "../Helpers/Utils.js";

$('#namaGuru').on('keyup', () => {
    let namaGuru = $('#namaGuru').val();
    namaGuru = getDataBeforeComma(namaGuru)
    let serialize = namaGuru.replace(/[\s,]/g, "_");
    $('#emailGuru').val(`${serialize.toLowerCase()}@annur.id`)
})
