$('#tableBerita').DataTable()
const quill = new Quill('#editor', {
    theme: 'snow'
})

$('#btnCTASimpan').on('click', () => {
    var htmlBerita = quill.root.innerHTML
    $('#quill-html').val(htmlBerita)
})
