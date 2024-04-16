if (getParam('message') != null || getParam('message') != undefined) {
    Swal.fire({
        icon: 'info',
        text: getParam('message')
    }).then((result) => {
        if (result.isConfirmed) {
            delParam();
        }
    })
}
