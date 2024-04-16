async function getDataById(id) {
    const response = await fetch(`/api/ujian/getById/${id}`, {
        method: 'GET',

    })
    return await response.json()
}


function uuidv4() {
    return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}

function generateDynamicElements(index, data) {
    console.log(data[index - 1]);
    var nomorSoal = document.createElement("p");
    nomorSoal.innerHTML = `No : ${index}`;

    // Create a new row container
    var rowDiv = document.createElement("div");
    rowDiv.appendChild(nomorSoal);

    rowDiv.classList.add("row");

    // Create the Soal input group
    var soalInputGroup = document.createElement("div");
    soalInputGroup.classList.add("input-group", "mb-3");
    soalInputGroup.innerHTML = `
        <span class="input-group-text">Soal</span>
        <textarea class="form-control" aria-label="With textarea" name="Soal[${index}]" disable readonly>${data[index - 1].soal}</textarea>
    `;
    rowDiv.appendChild(soalInputGroup);

    // Create the left column
    var colLeftDiv = document.createElement("div");
    colLeftDiv.classList.add("col-lg-6");

    // Create input groups for options A and B
    colLeftDiv.innerHTML += createInputGroup(index, "A", data[index - 1].jawaban_a);
    colLeftDiv.innerHTML += createInputGroup(index, "B", data[index - 1].jawaban_b);

    rowDiv.appendChild(colLeftDiv);

    // Create the right column
    var colRightDiv = document.createElement("div");
    colRightDiv.classList.add("col-lg-6");

    // Create input groups for options C and D
    colRightDiv.innerHTML += createInputGroup(index, "C", data[index - 1].jawaban_c);
    colRightDiv.innerHTML += createInputGroup(index, "D", data[index - 1].jawaban_d);

    // Create the select element for the correct answer
    var selectElement = document.createElement("select");
    selectElement.classList.add("form-select", "mb-3");
    selectElement.setAttribute("aria-label", "Default select example");
    selectElement.setAttribute("name", `Jawaban[${index}][Jawaban_Benar]`);
    selectElement.setAttribute("disabled", "true");
    selectElement.innerHTML = `
        <option value="${data[index - 1].jawaban_benar}">${data[index - 1].jawaban_benar}</option>
    `;
    colRightDiv.appendChild(selectElement);

    rowDiv.appendChild(colRightDiv);


    // Append the dynamically created row to the container
    document.getElementById("bodyModalDetail").appendChild(rowDiv);

}

function createInputGroup(index, label, value) {
    return `
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">${label}</span>
            <input type="text" class="form-control" placeholder="Jawaban ${label}"
                aria-label="Username" aria-describedby="basic-addon1"
                name="Jawaban[${index}][${label}]" value="${value}" disable readonly>
        </div>
    `;
}

function showSoalDetail(jumlah, data) {
    for (let i = 1; i <= parseInt(jumlah); i++) {
        generateDynamicElements(i, data)
    }
}

var detailSoal = $('#detailSoal');
detailSoal.on('show.bs.modal', async function (event) {
    var button = event.relatedTarget
    var ujianID = $(button).attr('data-bs-ujianid')
    var data = await getDataById(ujianID)
    $('#labelModalDetail').html(data.data.items[0].nama_ujian)
    showSoalDetail(parseInt(data.data.items[0].ujian.length), data.data.items[0].ujian)
    console.log(data.data.items[0].ujian.length);
})
detailSoal.on('hidden.bs.modal', function (event) {
    $('#bodyModalDetail').html("")
})
