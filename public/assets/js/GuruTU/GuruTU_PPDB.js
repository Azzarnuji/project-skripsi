const parentElementDetail = $('#DetailPPDBData')
function generateDetailData(data) {
    function createInput(type, id, label, placeholder, value, readonly = false) {
        var div = document.createElement("div");
        div.classList.add("input-group", "mb-3");

        var span = document.createElement("span");
        span.classList.add("input-group-text");
        span.textContent = label;

        var input = document.createElement("input");
        input.type = type;
        input.classList.add("form-control");
        input.placeholder = placeholder;
        input.setAttribute("aria-label", label);
        input.setAttribute("aria-describedby", id);
        input.id = id;
        input.name = id;
        input.value = value;
        if (readonly) {
            input.readOnly = true;
        }

        div.appendChild(span);
        div.appendChild(input);

        return div;
    }

    function createFormGroup(className, title) {
        var div = document.createElement("div");
        div.classList.add(className);

        var h3 = document.createElement("h3");
        h3.textContent = title;

        var hr = document.createElement("hr");

        div.appendChild(h3);
        div.appendChild(hr);

        return div;
    }

    // Usage
    var formContainer = document.createElement("div");

    // Data Diri
    formContainer.appendChild(createFormGroup(".data-diri.mt-3", "Data Diri"));
    formContainer.appendChild(createInput("text", "email", "Email", "Email", data.ppdb.detail_user.email, true));
    formContainer.appendChild(createInput("text", "asalSekolah", "Asal Sekolah", "Asal Sekolah", data.ppdb.asal_sekolah, true));
    formContainer.appendChild(createInput("text", "nisn", "NISN", "NISN", data.ppdb.nisn, true));
    formContainer.appendChild(createInput("text", "namaLengkap", "Nama Lengkap", "Nama Lengkap", data.ppdb.detail_user.name, true));
    formContainer.appendChild(createInput("text", "nis", "NIS", "NIS", data.ppdb.nis, true));
    formContainer.appendChild(createInput("text", "tempatTanggalLahir", "Tempat Tanggal Lahir", "Contoh: Bekasi, 19-10-1996", data.ppdb.TTL, true));
    // formContainer.appendChild(createFileInput("formFile", "Foto Diri Anda"));
    var imageDiv = document.createElement("div");
    imageDiv.classList.add("mb-3");
    imageDiv.innerHTML = `
        <h6>Foto Siswa</h6>
        <img src="/assets/foto-siswa/${data.ppdb.image}"
            alt="" srcset="" class="img-fluid img-thumbnail" style="max-width: 20%; cursor: pointer;" onclick="openFullscreen(this)">
    `;
    formContainer.appendChild(imageDiv);

    // Data Ayah
    formContainer.appendChild(createFormGroup(".data-ayah.mt-3", "Data Ayah"));
    formContainer.appendChild(createInput("text", "namaAyah", "Nama Ayah", "Nama Ayah", data.ppdb.nama_ayah, true));
    formContainer.appendChild(createInput("text", "alamatAyah", "Alamat Ayah", "Alamat Ayah", data.ppdb.alamat_ayah, true));
    formContainer.appendChild(createInput("text", "pekerjaanAyah", "Pekerjaan Ayah", "Pekerjaan Ayah", data.ppdb.pekerjaan_ayah, true));
    formContainer.appendChild(createInput("text", "nomorTeleponAyah", "Nomor Telepon Ayah", "Nomor Telepon Ayah", data.ppdb.no_hp_ayah, true));

    // Data Ibu
    formContainer.appendChild(createFormGroup(".data-ibu.mt-3", "Data Ibu"));
    formContainer.appendChild(createInput("text", "namaIbu", "Nama Ibu", "Nama Ibu", data.ppdb.nama_ibu, true));
    formContainer.appendChild(createInput("text", "alamatIbu", "Alamat Ibu", "Alamat Ibu", data.ppdb.alamat_ibu, true));
    formContainer.appendChild(createInput("text", "pekerjaanIbu", "Pekerjaan Ibu", "Pekerjaan Ibu", data.ppdb.pekerjaan_ibu, true));
    formContainer.appendChild(createInput("text", "nomorTeleponIbu", "Nomor Telepon Ibu", "Nomor Telepon Ibu", data.ppdb.no_hp_ibu, true));


    // Update Status Siswa
    formContainer.appendChild(createFormGroup(".update-status-siswa.mt-3", "Update Status Siswa"));
    formContainer.appendChild(generateFormUpdatePPDB(data.kelas, data.ppdb.detail_user.email))
    // Append the generated form container to the body or any other desired element
    parentElementDetail.append(formContainer);
}


function generateFormUpdatePPDB(data, emailCalonSiswa) {
    var formUpdate = document.createElement("form");
    formUpdate.setAttribute("action", "/api/guru_tu/updatStatusPPDBCalonSiswa");
    formUpdate.setAttribute("method", "POST");
    // Create a hidden input for EmailSiswa
    var hiddenInput = document.createElement("input");
    hiddenInput.setAttribute("type", "hidden");
    hiddenInput.setAttribute("name", "EmailSiswa");
    hiddenInput.setAttribute("value", emailCalonSiswa);
    formUpdate.appendChild(hiddenInput);

    // Create a label for the dropdown update ppdb
    var labelElementUpdatePPDB = document.createElement("label");
    labelElementUpdatePPDB.setAttribute("for", "statusDropdown");
    labelElementUpdatePPDB.textContent = "Ubah Status PPDB";
    formUpdate.appendChild(labelElementUpdatePPDB);

    // Create the select dropdown update ppdb
    var selectElementUpdatePPDB = document.createElement("select");
    selectElementUpdatePPDB.classList.add("form-select", "form-select-md", "mb-3");
    selectElementUpdatePPDB.setAttribute("aria-label", ".form-select-lg example");
    selectElementUpdatePPDB.setAttribute("name", "StatusPPDB");
    selectElementUpdatePPDB.setAttribute("required", true)
    // Create options for the select dropdown
    var options = ["Pilih Status", "Diterima", "Ditolak"];
    var values = ["", "Diterima", "Ditolak"];
    for (var i = 0; i < options.length; i++) {
        var optionElement = document.createElement("option");
        optionElement.setAttribute("value", values[i]);
        if (i === 0) {
            optionElement.setAttribute("selected", "selected");
        }
        optionElement.textContent = options[i];
        selectElementUpdatePPDB.appendChild(optionElement);
    }
    formUpdate.appendChild(selectElementUpdatePPDB);



    // Create a label for the dropdown update kelas
    var labelElementUpdateKelas = document.createElement("label");
    labelElementUpdateKelas.setAttribute("for", "KelasSiswa");
    labelElementUpdateKelas.textContent = "Ubah Kelas Siswa";
    formUpdate.appendChild(labelElementUpdateKelas);
    // Create the select dropdown update kelas
    var selectElementUpdateKelas = document.createElement("select");
    selectElementUpdateKelas.classList.add("form-select", "form-select-md", "mb-3");
    selectElementUpdateKelas.setAttribute("aria-label", ".form-select-lg example");
    selectElementUpdateKelas.setAttribute("name", "KelasSiswa");
    selectElementUpdateKelas.setAttribute("required", true)
    // Create options for the select dropdown
    console.log(data.length);

    var defaultOption = document.createElement("option");
    defaultOption.setAttribute("value", "");
    defaultOption.textContent = "Pilih Kelas";
    defaultOption.setAttribute("selected", "selected");
    selectElementUpdateKelas.appendChild(defaultOption);

    for (var i = 0; i < data.length; i++) {
        var optionElement = document.createElement("option");
        optionElement.setAttribute("value", data[i].id_kelas);
        optionElement.textContent = data[i].sub_kelas;
        selectElementUpdateKelas.appendChild(optionElement);
    }
    formUpdate.appendChild(selectElementUpdateKelas);

    // Create button submit data
    var buttonElement = document.createElement("button");
    buttonElement.setAttribute("type", "submit");
    buttonElement.classList.add("btn", "btn-primary");
    buttonElement.textContent = "Submit";
    formUpdate.appendChild(buttonElement);

    return formUpdate;
}
function openFullscreen(element) {
    const elementSrc = $(element).attr('src')
    var fullscreenContainer = document.getElementById("fullscreen-container");
    var fullscreenImage = document.getElementById("fullscreen-image");
    fullscreenImage.src = elementSrc; // Set the source of the fullscreen image
    fullscreenContainer.style.display = "flex";
    document.documentElement.style.overflow = 'hidden'; // Disable scrolling when in fullscreen
}

$('#modalPPDBDetail').on('show.bs.modal', async (event) => {
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var email = button.getAttribute('data-bs-email')
    const response = await $.ajax({
        url: '/api/guru_tu/detailPPDB/' + email,
        method: "GET"
    })
    console.log(response);
    generateDetailData(response.data.items)
})

// Function to exit fullscreen
function exitFullScreen() {
    var fullscreenContainer = document.getElementById("fullscreen-container");
    fullscreenContainer.style.display = "none";
    document.documentElement.style.overflow = 'auto'; // Enable scrolling when exiting fullscreen
}
window.openFullscreen = openFullscreen
window.exitFullScreen = exitFullScreen
