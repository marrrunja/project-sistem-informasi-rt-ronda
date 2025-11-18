<nav class="navbar navbar-expand-md" style="background-color:white;">
  <div class="container">
    <a class="navbar-brand fs-3" href="#">
      <img src="{{ asset('resources/images/logo.png') }}" alt="logo sirata" width="100">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item px-3">
          <a class="nav-link text-dark {{ request()->is('user/dashboard') ? 'active':'' }}" href="/user/dashboard">Dashboard</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link text-dark {{ request()->is('user/jadwal') ? 'active':'' }}" href="/user/jadwal">Jadwal</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link text-dark {{ request()->is('user/laporan') || request()->is('user/laporan/all') ? 'active':'' }}" href="/user/laporan">Laporan</a>
        </li>
      </ul>

      {{-- Dropdown Profil --}}
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
          Profil
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li class="dropdown-item-text fw-semibold">
              {{ Session::get('nama_lengkap') ?? 'User' }}
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('auth.logout') }}" method="POST" id="formLogout">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
