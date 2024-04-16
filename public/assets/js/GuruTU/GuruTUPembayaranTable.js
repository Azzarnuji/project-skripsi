function generateTable(data, FilterBy) {
    // Create the table element
    var table = document.createElement("table");
    table.classList.add("table", "p-2");
    table.id = "PPDBTable";

    // Create the table header
    var thead = document.createElement("thead");
    var headerRow = document.createElement("tr");
    headerRow.classList.add(FilterBy == "pending" ? "bg-warning" : (FilterBy == "tolak" ? "bg-danger" : 'bg-success'));

    var headers = ["No", "Nama", "Email", "Nama Pembayaran", "No Telepon", "Jumlah Bayar", "Action"];
    headers.forEach(function (headerText) {
        var th = document.createElement("th");
        th.scope = "col";
        th.appendChild(document.createTextNode(headerText));
        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    // Create the table body
    var tbody = document.createElement("tbody");

    for (var i = 0; i < data.items.length; i++) {
        var rowData = data.items[i];
        var tr = document.createElement("tr");

        // Add No column
        var thNo = document.createElement("th");
        thNo.scope = "row";
        thNo.appendChild(document.createTextNode(i + 1));
        tr.appendChild(thNo);

        // Add other columns
        var columns = ["users_table.detail.name", "users_table.detail.email", "pembayaran_table.nama_pembayaran", "users_table.detail.phone", "pembayaran_table.nominal"];
        columns.forEach(function (column) {
            var td = document.createElement("td");
            var columnData = column == "pembayaran_table.nominal" ? window.currency(getDataByPath(rowData, column)) : getDataByPath(rowData, column);
            td.appendChild(document.createTextNode(columnData));
            tr.appendChild(td);
        });

        // Add Action column
        var tdAction = document.createElement("td");
        var button = document.createElement("button");
        button.type = "button";
        button.classList.add("btn", "btn-primary", "btn-sm");
        button.setAttribute("data-bs-iduser", rowData.users_table.email);
        button.setAttribute("data-bs-idPembayaran", rowData.pembayaran_id_foreign);
        button.onclick = function () {
            BtnDetailPayment(this, FilterBy);
        };
        button.appendChild(document.createTextNode("Detail"));
        tdAction.appendChild(button);
        tr.appendChild(tdAction);

        tbody.appendChild(tr);
    }

    table.appendChild(tbody);

    $('#parentPPDBTable').html("");
    PPDBTable.destroy();
    // Append the table to the body or any other container element
    document.getElementById("parentPPDBTable").appendChild(table);
    $('#PPDBTable').DataTable();
}

// Helper function to get data from nested objects using a path
function getDataByPath(obj, path) {
    console.log(path);
    return path.split('.').reduce(function (acc, key) {
        return acc[key];
    }, obj);
}

// Example usage:
$('#filterBy').on('change', async () => {
    $('#loaderFilter').removeClass('visually-hidden')
    const FilterBy = $('#filterBy').val()
    const response = await $.ajax({
        url: '/api/guru_tu/getDataByFilter/' + FilterBy,
        method: "GET",
    })
    $('#statusPembayaran').html(FilterBy)
    generateTable(response.data, FilterBy);
    $('#loaderFilter').addClass('visually-hidden')
})

