
function uuidv4() {
    return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}

function generateElementInput(parentElement, type, name, value) {
    var input = document.createElement("input");
    input.setAttribute("type", type);
    input.setAttribute("name", name);
    input.setAttribute("value", value);
    parentElement.appendChild(input);
}

function generateDynamicElements(index) {

    var nomorSoal = document.createElement("p");
    nomorSoal.innerHTML = `No : ${index}`;

    // Create a new row container
    var rowDiv = document.createElement("div");
    generateElementInput(rowDiv, "hidden", "UjianId", uuidv4());
    generateElementInput(rowDiv, "hidden", "NamaUjian", $('#namaUjian').val());
    generateElementInput(rowDiv, "hidden", "UjianUntuk", $('#ujianUntuk').val());
    generateElementInput(rowDiv, "hidden", "JumlahSoal", $('#jumlahSoal').val());
    generateElementInput(rowDiv, "hidden", "BobotNilai", $('#bobotNilai').val());
    generateElementInput(rowDiv, "hidden", "NilaiMinimal", $('#nilaiMinimal').val());

    rowDiv.appendChild(nomorSoal);

    rowDiv.classList.add("row");

    // Create the Soal input group
    var soalInputGroup = document.createElement("div");
    soalInputGroup.classList.add("input-group", "mb-3");
    soalInputGroup.innerHTML = `
        <span class="input-group-text">Soal</span>
        <textarea class="form-control" aria-label="With textarea" name="Soal[${index}]"></textarea>
    `;
    rowDiv.appendChild(soalInputGroup);

    // Create the left column
    var colLeftDiv = document.createElement("div");
    colLeftDiv.classList.add("col-6");

    // Create input groups for options A and B
    colLeftDiv.innerHTML += createInputGroup(index, "A");
    colLeftDiv.innerHTML += createInputGroup(index, "B");

    rowDiv.appendChild(colLeftDiv);

    // Create the right column
    var colRightDiv = document.createElement("div");
    colRightDiv.classList.add("col-6");

    // Create input groups for options C and D
    colRightDiv.innerHTML += createInputGroup(index, "C");
    colRightDiv.innerHTML += createInputGroup(index, "D");

    // Create the select element for the correct answer
    var selectElement = document.createElement("select");
    selectElement.classList.add("form-select", "mb-3");
    selectElement.setAttribute("aria-label", "Default select example");
    selectElement.setAttribute("name", `Jawaban[${index}][Jawaban_Benar]`);
    selectElement.innerHTML = `
        <option selected>Jawaban Benar</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    `;
    colRightDiv.appendChild(selectElement);

    rowDiv.appendChild(colRightDiv);


    // Append the dynamically created row to the container
    document.getElementById("formSoal").appendChild(rowDiv);

}

function createInputGroup(index, label) {
    return `
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">${label}</span>
            <input type="text" class="form-control" placeholder="Jawaban ${label}"
                aria-label="Username" aria-describedby="basic-addon1"
                name="Jawaban[${index}][${label}]">
        </div>
    `;
}

function GenerateSoal(jumlah) {
    for (let i = 1; i <= parseInt(jumlah); i++) {
        generateDynamicElements(i)
    }
    var button = document.createElement("button");
    button.classList.add("btn", "btn-primary");
    button.setAttribute("type", "submit");
    button.innerHTML = "Submit";
    document.getElementById("formSoal").appendChild(button);
}

$('#btnGenerateSoal').on('click', () => {
    var namaUjian = $('#namaUjian').val()
    var jumlahSoal = $('#jumlahSoal').val()
    GenerateSoal(jumlahSoal)
    $('#labelModal').html(namaUjian)

    var modalSoal = new bootstrap.Modal(document.getElementById('tambahSoal'), {})
    modalSoal.show()

    $('#tambahSoal').on('hidden.bs.modal', () => {
        $('#formSoal').html('')
    })
})

$('#bobotNilai').on('keyup', (event) => {
    const jumlahSoal = $('#jumlahSoal').val()
    const bobotNilai = event.target.value

    $('#totalNilai').val(jumlahSoal * bobotNilai)
})
