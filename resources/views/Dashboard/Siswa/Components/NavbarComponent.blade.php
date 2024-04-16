<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">SMA I ANNUR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            @if ($active != 'siswa-lama')
                <ul class="navbar-nav mb-lg-0 mb-2 me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'dashboard' ? 'active' : null }}" aria-current="page"
                            href="dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'pembayaran' ? 'active' : null }}" aria-current="page"
                            href="pembayaran">Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#updateProfile" id="btnModalUpdateProfile">Update
                            Profile</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle hoverlink" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="19.5"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                            </svg>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="updateProfileLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateProfileLabel">Update Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/api/auth/updateProfile" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="namaUpdateProfile"
                                            placeholder="Nama Anda" readonly>
                                        <input type="text" class="form-control" id="emailUpdateProfile"
                                            placeholder="Nama Anda" readonly hidden name="emailUpdateProfile">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamatUpdateProfile" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamatUpdateProfile" rows="3" name="alamat"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="teleponUpdateProfile" class="form-label">Telepon</label>
                                        <input type="number" class="form-control" id="teleponUpdateProfile"
                                            placeholder="Telepon Anda" name="telepon">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fileUpdateProfile" class="form-label">Foto Profile</label>
                                        <input class="form-control" type="file" id="fileUpdateProfile"
                                            name="fotoProfile">
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</nav>
