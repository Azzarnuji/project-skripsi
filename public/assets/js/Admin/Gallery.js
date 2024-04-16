import { postLoader } from "../Helpers/Utils.js"
const tbodyAlbum = $('#tbodyAlbum');
const tableAlbum = $('#tableAlbum');


const updateTableData = async () => {
    try {
        const response = await $.ajax({
            url: '/api/admin/getAllAlbum',
            method: 'GET',
        })
        if (response.httpCode == 200 && response.data !== null) {

            window.location.reload()
        }
        console.log(response);
    } catch (error) {
        console.log(error);
    }

}

$('#btnCTABuatAlbum').on('click', () => {
    const albumName = $('#namaAlbum')
    const emailAuthor = $('#emailAuthor')
    const nameAuthor = $('#nameAuthor')
    const albumCover = $('#albumCover')
    postLoader(async () => {
        try {
            if (albumName.length == 0) {
                Swal.fire({
                    icon: "error",
                    text: "Nama Album Harus Diisi"
                })
                return
            }
            const formDataCover = new FormData();
            formDataCover.append('albumCover', albumCover[0].files[0])
            formDataCover.append('namaAlbum', albumName.val())
            formDataCover.append('emailAuthor', emailAuthor.val())
            formDataCover.append('nameAuthor', nameAuthor.val())
            const response = await $.ajax({
                url: '/api/admin/buatAlbum',
                method: 'POST',
                processData: false,
                cache: false,
                contentType: false,

                data: formDataCover
            })

            if (response.httpCode == 200) {

                if ($.fn.dataTable.isDataTable('#tableAlbum')) {
                    tbodyAlbum.empty();
                    tableAlbum.DataTable().destroy();
                }
                tbodyAlbum.empty();

                albumCover.val('')
                albumName.val('')
                emailAuthor.val('')
                nameAuthor.val('')

                Swal.close()
                Swal.fire({
                    icon: 'info',
                    text: response?.message
                })
                updateTableData()


            }
        } catch (error) {
            console.log(error);
            Swal.close()
            if (error?.responseJSON?.message) {
                Swal.fire({
                    icon: "error",
                    text: error?.responseJSON?.message
                })
            }
        }
    })
})




$(document).ready(() => {
    tableAlbum.DataTable();
    var modalAlbum = document.getElementById('modalAlbum');
    modalAlbum.addEventListener('show.bs.modal', async (event) => {
        var buttonRelatedTarget = event.relatedTarget
        var albumId = buttonRelatedTarget.getAttribute('data-bs-albumid')
        const response = await $.ajax({
            url: `/api/admin/getAlbumGalleryById/${albumId}`,
            method: "GET"
        })
        const images = response?.data?.items
        $('#modalAlbumLabel').text(response?.data?.items[0]?.album_nama)
        const dataImg = [];
        images.forEach((item, index) => {
            dataImg.push({
                src: item.galeri_gambar,
                srct: item.galeri_gambar,
                title: item.galeri_judul,
            })
        })

        $('#gallery').nanogallery2({
            thumbnailHeight: 250,
            thumbnailWidth: "auto",
            itemsBaseURL: `${window.location.origin}/assets/web-sekolah/assets/images/`,
            items: dataImg,
            thumbnailDisplayTransition: 'slideUp2',
            thumbnailDisplayTransitionDuration: 500,
            thumbnailDisplayInterval: 30,
            galleryDisplayTransition: 'rotateX',
            galleryDisplayTransitionDuration: 500
        })
        console.log(dataImg);
    })
})

