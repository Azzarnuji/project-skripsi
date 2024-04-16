<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">SMA I ANNUR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-lg-0 mb-2 me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ $active == 'dashboard' ? 'active' : null }}"
                        aria-current="page" href="/calon_siswa/dashboard">Dashboard</a>
                </li>
                @if ($statusKelulusan == \App\Data\StatusKelulusan::LULUS_UJIAN)
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'ppdb' ? 'active' : null }}"
                            aria-current="page" href="/calon_siswa/ppdb">PPDB</a>
                    </li>
                @endif

            </ul>

            <div class="d-flex">
                <div class="dropdown">
                    <a class="btn dropdown-toggle hoverlink" href="#" role="button"
                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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
        </div>
    </div>
</nav>
