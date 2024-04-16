const containerPendaftaranSiswaLama = $('#pendaftaranSiswaLama')
const formPendafataranSiswaLama = $('#formPendaftaranSiswaLama')
const ProcessSiswaLama = async () => {
    const valueNIS = $('#FormNIS').val()

    const response = await $.ajax({
        url: `/api/siswa/getSiswaByNIS/${valueNIS}`,
        method: "GET",
    })
    console.log(response);
    containerPendaftaranSiswaLama.empty()
    generateForm(response?.data?.items)
    formPendafataranSiswaLama.attr('action', `/api/siswa/daftarSiswaLama`)
    formPendafataranSiswaLama.attr('method', 'POST')
    formPendafataranSiswaLama.removeAttr('onsubmit')
}


function generateForm(data) {
    // Define the form fields
    const formFields = [
        { label: 'NIS', type: 'number', id: 'FormNIS', placeholder: 'NIS Anda', name: 'FormNIS', value: data.nis, readonly: true },
        { label: 'Nama Anda', type: 'text', id: 'FormNama', placeholder: 'Nama Anda', name: 'FormNamaAnda', value: data.name, readonly: true },
        { label: 'Nama Ayah', type: 'text', id: 'FormNamaAyah', placeholder: 'Nama Ayah Anda', name: 'FormNamaAyah', value: data.nama_ayah, readonly: true },
        { label: 'Buat Email', type: 'email', id: 'FormEmail', placeholder: 'Buat Email', name: 'FormEmail', value: "" },
        { label: 'Buat Password', type: 'password', id: 'FormPassword', placeholder: 'Buat Password', name: 'FormPassword', value: "" },
        { label: 'Confirm Password', type: 'password', id: 'FormConfirmPassword', placeholder: 'Buat Password', name: 'FormConfirmPassword', value: "" },
    ];

    // Get the container element
    const formContainer = document.getElementById('pendaftaranSiswaLama');

    // Loop through formFields and create form elements
    formFields.forEach(field => {
        // Create the form group div
        const formGroup = document.createElement('div');
        formGroup.className = 'mb-3';

        // Create the label element
        const label = document.createElement('label');
        label.className = 'form-label';
        label.textContent = field.label;

        // Create the input element
        const input = document.createElement('input');
        input.type = field.type;
        input.value = field.value;
        input.className = 'form-control';
        input.id = field.id;
        input.placeholder = field.placeholder;
        input.name = field.name;
        input.required = true;
        if (field.readonly) {
            input.readOnly = true
        }

        // Append label and input to form group
        formGroup.appendChild(label);
        formGroup.appendChild(input);

        // Append form group to form container
        formContainer.appendChild(formGroup);
    });
    const button = document.createElement('button');
    button.className = 'btn btn-primary';
    button.textContent = 'Daftar';
    button.type = 'submit';
    formContainer.appendChild(button);
}

$(document).on('keyup', '#FormConfirmPassword', () => {
    const originalPassword = $('#FormPassword').val()
    const confirmPassword = $('#FormConfirmPassword').val()
    $('#alertPasswordConfirm').remove()
    const alertPasswordConfirm = $('<p>').attr('id', 'alertPasswordConfirm')
    if (originalPassword != confirmPassword) {
        alertPasswordConfirm.text('Password Tidak Sama')
        alertPasswordConfirm.addClass('text-danger')
    }
    containerPendaftaranSiswaLama.append(alertPasswordConfirm)
    console.log(confirmPassword);

})
window.ProcessSiswaLama = ProcessSiswaLama
