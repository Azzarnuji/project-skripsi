const editKelasModal = $('#editKelasModal')
editKelasModal.on('show.bs.modal', (event) => {
    const buttonRelatedTarget = $(event.relatedTarget)

    const idKelas = buttonRelatedTarget.attr('data-bs-idkelas')
    const kelas = buttonRelatedTarget.attr('data-bs-kelas')
    const subKelas = buttonRelatedTarget.attr('data-bs-subkelas')


    $('#editKelas').val(kelas).change()
    $('#editSubKelas').val(subKelas)
    $('#idKelas').val(idKelas)
    console.log({ kelas, subKelas });
})
