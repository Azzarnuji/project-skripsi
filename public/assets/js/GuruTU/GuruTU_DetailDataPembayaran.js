const parentElementDetail = $('#DetailPayment')
const btnLoader = $('#btnLoader')
async function BtnDetailPayment(element, filterBy = null) {
    const iduser = element.getAttribute('data-bs-iduser')
    const idPembayaran = element.getAttribute('data-bs-idPembayaran')
    btnLoader.removeClass('visually-hidden');
    await $.ajax({
        url: `/api/guru_tu/detailSiswa/${iduser}/${idPembayaran}`,
        method: "GET",
        dataType: "json",
        success: function ({ data }) {

            generateCard(data.items, filterBy)
        }
    })
    btnLoader.addClass('visually-hidden');

}
function openFullscreen(element) {
    const elementSrc = $(element).attr('src')
    var fullscreenContainer = document.getElementById("fullscreen-container");
    var fullscreenImage = document.getElementById("fullscreen-image");
    fullscreenImage.src = elementSrc; // Set the source of the fullscreen image
    fullscreenContainer.style.display = "flex";
    document.documentElement.style.overflow = 'hidden'; // Disable scrolling when in fullscreen
}

// Function to exit fullscreen
function exitFullScreen() {
    var fullscreenContainer = document.getElementById("fullscreen-container");
    fullscreenContainer.style.display = "none";
    document.documentElement.style.overflow = 'auto'; // Enable scrolling when exiting fullscreen
}
function generateCard(data, filterBy = null) {
    if (parentElementDetail.children().length > 0) {
        parentElementDetail.empty()
    }
    // Create a new card container
    var cardDiv = document.createElement("div");
    cardDiv.classList.add("card");

    // Create card header
    var cardHeaderDiv = document.createElement("div");
    cardHeaderDiv.classList.add("card-header");
    cardHeaderDiv.innerHTML = `<span>Detail Pembayaran - ${data.upcoming_payment.payment_id}</span>`;
    cardDiv.appendChild(cardHeaderDiv);

    // Create card body
    var cardBodyDiv = document.createElement("div");
    cardBodyDiv.classList.add("card-body");

    // Generate form elements
    var formElements = [
        { label: "Nama Pembayaran", type: "text", placeholder: "Nama Pembayarn", name: "NamaPembayaran", value: data.upcoming_payment.pembayaran_table.nama_pembayaran, disabled: true, readonly: true },
        { label: "Kelas", type: "text", placeholder: "Kelas", name: "Kelas", value: data.upcoming_payment.pembayaran_table.untuk_kelas.toUpperCase(), disabled: true, readonly: true },
        { label: "Nama Calon Siswa", type: "text", placeholder: "Nama Calon Siswa", name: "NamaCalonSiswa", value: data.detail.name, disabled: true, readonly: true },
        { label: "Email Calon Siswa", type: "text", placeholder: "Email Calon Siswa", name: "EmailCalonSiswa", value: data.detail.email, disabled: true, readonly: true },
        { label: "Nomor Telepon Calon Siswa", type: "number", placeholder: "Nomor Telepon Calon Siswa", name: "NomorTeleponCalonSiswa", value: data.detail.phone, disabled: true, readonly: true },
        { label: "Rekening Asal", type: "number", placeholder: "Rekening Asal", name: "RekeningAsal", value: data.upcoming_payment.rekening_asal, disabled: true, readonly: true },
        { label: "Nama Pemilik Rekening", type: "text", placeholder: "Nama Pemilik Rekening", name: "NamaPemilikRekeningAsal", value: data.upcoming_payment.nama_pemilik_rekening, disabled: true, readonly: true }
    ];

    formElements.forEach(function (element) {
        var inputDiv = document.createElement("div");
        inputDiv.classList.add("mb-3");

        var labelElement = document.createElement("label");
        labelElement.setAttribute("for", element.name);
        labelElement.classList.add("form-label");
        labelElement.textContent = element.label;

        var inputElement = document.createElement("input");
        inputElement.setAttribute("value", element.value);
        inputElement.setAttribute("type", element.type);
        inputElement.setAttribute("class", "form-control");
        inputElement.setAttribute("id", element.name);
        inputElement.setAttribute("placeholder", element.placeholder);
        inputElement.setAttribute("name", element.name);
        inputElement.setAttribute("disabled", element.disabled);
        inputElement.setAttribute("readonly", element.readonly);

        inputDiv.appendChild(labelElement);
        inputDiv.appendChild(inputElement);

        cardBodyDiv.appendChild(inputDiv);
    });

    // Add image element
    var imageDiv = document.createElement("div");
    imageDiv.classList.add("mb-3");
    imageDiv.innerHTML = `
        <h6>Bukti Pembayaran</h6>
        <img src="/assets/bukti-pembayaran/${data.upcoming_payment.bukti_pembayaran}"
            alt="" srcset="" class="img-fluid img-thumbnail" style="max-width: 20%; cursor: pointer;" onclick="openFullscreen(this)">
    `;
    cardBodyDiv.appendChild(imageDiv);

    console.log(filterBy);
    if (filterBy == null || filterBy == "pending") {
        cardBodyDiv.appendChild(generateForm(data.detail.email))
    } else if (filterBy == "tolak") {
        cardBodyDiv.appendChild(generateStatusPembayaran(filterBy))
        cardBodyDiv.appendChild(generateForm(data.detail.email))
    } else {
        cardBodyDiv.appendChild(generateStatusPembayaran(filterBy))

    }

    cardDiv.appendChild(cardBodyDiv);

    // Append the dynamically created card to the container
    parentElementDetail.append(cardDiv);


}

function generateStatusPembayaran(status) {
    const divAlert = document.createElement('div')
    divAlert.classList.add('alert', 'alert-primary')
    divAlert.setAttribute('role', 'alert')
    divAlert.textContent = `Status: ${status.toUpperCase()}`
    return divAlert
}

function generateForm(emailCalonSiswa) {

    var formElementDiv = document.createElement("div");
    formElementDiv.classList.add("mb-3");

    // Create a new form element
    var formElement = document.createElement("form");
    formElement.setAttribute("action", "/api/guru_tu/updateStatusPembayaranDaftarBaru");
    formElement.setAttribute("method", "POST");
    formElement.setAttribute("id", "dynamicForm");

    // Create a hidden input for EmailSiswa
    var hiddenInput = document.createElement("input");
    hiddenInput.setAttribute("type", "hidden");
    hiddenInput.setAttribute("name", "EmailSiswa");
    hiddenInput.setAttribute("value", emailCalonSiswa);
    formElement.appendChild(hiddenInput);

    // Create a label for the dropdown
    var labelElement = document.createElement("label");
    labelElement.setAttribute("for", "statusDropdown");
    labelElement.textContent = "Ubah Status Pembayaran";
    formElement.appendChild(labelElement);

    // Create the select dropdown
    var selectElement = document.createElement("select");
    selectElement.classList.add("form-select", "form-select-md", "mb-3");
    selectElement.setAttribute("aria-label", ".form-select-lg example");
    selectElement.setAttribute("name", "StatusPembayaran");
    selectElement.setAttribute("required", true)
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
        selectElement.appendChild(optionElement);
    }

    var buttonElement = document.createElement("button");
    buttonElement.setAttribute("type", "submit");
    buttonElement.classList.add("btn", "btn-primary");
    buttonElement.textContent = "Submit";


    formElement.appendChild(selectElement);

    formElement.appendChild(buttonElement);

    formElementDiv.appendChild(formElement);
    // Append the dynamically created form to the container
    return formElementDiv
}

$(document).ready(() => {
    const table = $('#PPDBTable').DataTable()
    window.PPDBTable = table
})
window.BtnDetailPayment = BtnDetailPayment
window.openFullscreen = openFullscreen
window.exitFullScreen = exitFullScreen
