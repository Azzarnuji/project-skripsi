$('#tableFiles').DataTable()
var modalViewFile = document.getElementById('modalViewFile')
modalViewFile.addEventListener('show.bs.modal', (event) => {
    var buttonRelatedTarget = event.relatedTarget
    var filename = buttonRelatedTarget.getAttribute('data-bs-url-file')
    var bodyView = $('#viewFile')

    bodyView.html(`<iframe src="${filename}" frameborder="0" type="application/pdf" style="width: 100%; height: 100%;"></iframe>`)
})
