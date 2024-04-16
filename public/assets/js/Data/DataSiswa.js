
const generateSelectElement = (data) => {
    var selectElement = document.createElement("select");
    selectElement.className = "form-select";
    selectElement.setAttribute("aria-label", "Default select example");
    selectElement.id = "pilihSubKelas";
    var defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.textContent = "Pilih Sub Kelas";
    selectElement.appendChild(defaultOption);
    data.forEach(function (option) {
        var optionElement = document.createElement("option");
        optionElement.value = option.id_kelas;
        optionElement.textContent = option.sub_kelas;
        selectElement.appendChild(optionElement);
    });
    $('#containerSubKelas').empty();
    $('#containerSubKelas').append(selectElement);
}

const generateListSiswa = (data) => {
    const tableListSiswaParent = $('#tableListSiswaParent');
    const containerListSiswa = $('#containerListSiswa');
    console.log(containerListSiswa.children().length);
    if ($.fn.dataTable.isDataTable('#tableListSiswaParent')) {
        tableListSiswaParent.DataTable().destroy();
    }
    if (data == null || data.length == 0) {
        containerListSiswa.empty()
        tableListSiswaParent.DataTable().destroy();
        $('#containerListSiswa').html('<tr><td colspan="6">No data available</td></tr>');
        return
    }
    containerListSiswa.empty()
    for (var i = 0; i < data.length; i++) {
        const row = $('<tr>')
        row.append($('<th scope="row">').text(i + 1))
        row.append($('<td>').text(data[i]?.detail_siswa[0]?.name))
        row.append($('<td>').text(data[i]?.detail_siswa[0]?.nis))
        row.append($('<td>').text(data[i]?.detail_siswa[0]?.nisn))
        row.append($('<td>').addClass('text-uppercase').text(data[i]?.detail_kelas.kelas))
        row.append($('<td>').text(data[i]?.detail_kelas.sub_kelas))
        row.append($('<td>').addClass('text-uppercase').text(data[i]?.detail_kelas.wali_kelas))

        $('#containerListSiswa').append(row);
    }
    tableListSiswaParent.DataTable();

}

$(document).on('change', '#pilihSubKelas', async () => {
    const valueSubKelas = $('#pilihSubKelas').val()
    $('#IDKelas').val(valueSubKelas)
    console.log(valueSubKelas);
    $('#detailNameKelas').text(`Kelas : ${$('#pilihSubKelas').find(':selected').text().toUpperCase()}`)
    if ($('#pilihSubKelas').val() == "") {
        generateListSiswa([])
    } else {

        try {
            $('#pilihKelasLoader').removeClass('visually-hidden');

            const response = await $.ajax({
                url: `/api/admin/getSiswaByKelas/${valueSubKelas}`,
                method: "GET",
            })
            $('#pilihKelasLoader').addClass('visually-hidden');

            generateListSiswa(response.data.items)

        } catch (error) {
            generateListSiswa(error.responseJSON.data.items)
            $('#pilihKelasLoader').addClass('visually-hidden');

        }
    }
})
$('#pilihKelas').on('change', async () => {
    $('#pilihKelasLoader').removeClass('visually-hidden');
    const valuePilihKelas = $('#pilihKelas').val()
    try {
        const response = await $.ajax({
            url: `/api/admin/getSubKelas/${valuePilihKelas}`,
            method: "GET",
        })

        generateSelectElement(response.data.items)
        $('#pilihKelasLoader').addClass('visually-hidden');

    } catch (error) {
        $('#containerSubKelas').empty();
        $('#pilihKelasLoader').addClass('visually-hidden');

    }
})


