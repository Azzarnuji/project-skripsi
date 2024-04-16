const bayarModal = $('#bayarModal')

bayarModal.on('show.bs.modal', (event) => {
    const buttonRelatedTarget = $(event.relatedTarget)
    const email = buttonRelatedTarget.attr('data-bs-email')
    const idpembayaran = buttonRelatedTarget.attr('data-bs-idpembayaran')
    const nominal = buttonRelatedTarget.attr('data-bs-nominal')

    $('#email').val(email)
    $('#idPembayaran').val(idpembayaran)
    $('#nominalText').html(currency(nominal))
    console.log(email);

})
