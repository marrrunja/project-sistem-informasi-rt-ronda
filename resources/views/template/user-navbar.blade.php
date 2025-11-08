<nav class="navbar navbar-expand-md" style="background-color:white;">
  <div class="container">
    <a class="navbar-brand fs-3" href="#">
        <img src="{{ asset('resources/images/logo.png') }}" alt="logo sirata" width="100">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item px-3">
          <a class="nav-link text-dark" href="/user/dashboard">Dashboard</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link text-dark" href="/user/jadwal">Jadwal</a>
        </li>
        <li class="nav-item px-3">
            <a href="/user/laporan" class="nav-link text-dark">Laporan</a>
        </li>
        <li class="nav-item px-3">
            <a href="#" class="nav-link text-dark">Profil</a>
        </li>
      </ul>
    </div>
  </div>
</nav>