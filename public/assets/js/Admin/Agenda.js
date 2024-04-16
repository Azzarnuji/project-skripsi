$('#tableAgenda').DataTable();
const isiAgenda = new Quill('#isiAgenda', {
    theme: 'snow'
})
const agendaKeterangan = new Quill('#agendaKeterangan', {
    theme: 'snow'
})


$('#btnCTASimpan').on('click', () => {
    var htmlIsiAgenda = isiAgenda.root.innerHTML
    var htmlAgendaKeterangan = agendaKeterangan.root.innerHTML

    $('#quill-html-isiAgenda').val(htmlIsiAgenda)
    $('#quill-html-agendaKeterangan').val(htmlAgendaKeterangan)
})

