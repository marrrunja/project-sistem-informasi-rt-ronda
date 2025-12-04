<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="_baseurl" content="{{ env('BASE_URL') }}">
    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('resources/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('resources/assets/css/styles.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('template.sidebar-admin')

        <div class="body-wrapper">

            <header class="app-header shadow-sm">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>

                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('resources/images/icon.jpeg') }}" alt=""
                                        width="40" height="40" class="rounded-circle p-2 border-primary" style="border:1.4px solid">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>

                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>

                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>

                                        <a href="./authentication-login.html"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="container-fluid">
                @yield('body')


                <!-- <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">

                        <div class="card w-100">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="card-title fw-semibold">Recent Transactions</h5>
                                </div>

                                <ul class="timeline-widget mb-0 position-relative mb-n5">

                                    <li class="timeline-item d-flex position-relative overflow-hidden">
                                        <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
                                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                        </div>
                                        <div class="timeline-desc fs-3 text-dark mt-n1">
                                            Payment received from John Doe of $385.90
                                        </div>
                                    </li>

                                    <li class="timeline-item d-flex position-relative overflow-hidden">
                                        <div class="timeline-time text-dark flex-shrink-0 text-end">10:00 am</div>
                                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                            <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                        </div>

                                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">
                                            New sale recorded
                                            <a href="javascript:void(0)" class="text-primary d-block fw-normal">
                                                #ML-3467
                                            </a>
                                        </div>
                                    </li>

                                </ul>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">

                                <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>

                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th><h6 class="fw-semibold mb-0">Id</h6></th>
                                                <th><h6 class="fw-semibold mb-0">Assigned</h6></th>
                                                <th><h6 class="fw-semibold mb-0">Name</h6></th>
                                                <th><h6 class="fw-semibold mb-0">Priority</h6></th>
                                                <th><h6 class="fw-semibold mb-0">Budget</h6></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td><h6 class="fw-semibold mb-0">1</h6></td>
                                                <td>
                                                    <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                                                    <span class="fw-normal">Web Designer</span>
                                                </td>
                                                <td><p class="mb-0 fw-normal">Elite Admin</p></td>
                                                <td>
                                                    <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                                                </td>
                                                <td><h6 class="fw-semibold mb-0 fs-4">$3.9</h6></td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> -->

                <!-- PRODUCTS S4 -->
                <div class="row">
                    <!-- <div class="col-sm-6 col-xl-3">
                        <div class="card overflow-hidden rounded-2">

                            <div class="position-relative">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('resources/assets/images/products/s4.jpg') }}"
                                        class="card-img-top rounded-0" alt="...">
                                </a>

                                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white 
                                    d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
                                    <i class="ti ti-basket fs-4"></i>
                                </a>
                            </div>

                            <div class="card-body pt-3 p-4">
                                <h6 class="fw-semibold fs-4">Boat Headphone</h6>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="fw-semibold fs-4 mb-0">
                                        $50 <span class="ms-2 fw-normal text-muted fs-3"><del>$65</del></span>
                                    </h6>

                                    <ul class="list-unstyled d-flex align-items-center mb-0">
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                    </ul>
                                </div>

                            </div>

                        </div>
                    </div> -->

                    <!-- PRODUCT S5 -->
                    <!-- <div class="col-sm-6 col-xl-3">
                        <div class="card overflow-hidden rounded-2">

                            <div class="position-relative">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('resources/assets/images/products/s5.jpg') }}"
                                        class="card-img-top rounded-0" alt="...">
                                </a>

                                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white 
                                    d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
                                    <i class="ti ti-basket fs-4"></i>
                                </a>
                            </div>

                            <div class="card-body pt-3 p-4">
                                <h6 class="fw-semibold fs-4">MacBook Air Pro</h6>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="fw-semibold fs-4 mb-0">
                                        $650 <span class="ms-2 fw-normal text-muted fs-3"><del>$900</del></span>
                                    </h6>

                                    <ul class="list-unstyled d-flex align-items-center mb-0">
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                    </ul>

                                </div>

                            </div>

                        </div>
                    </div> -->

                    <!-- PRODUCT S7 -->
                    <!-- <div class="col-sm-6 col-xl-3">
                        <div class="card overflow-hidden rounded-2">

                            <div class="position-relative">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('resources/assets/images/products/s7.jpg') }}"
                                        class="card-img-top rounded-0" alt="...">
                                </a>

                                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white 
                                    d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
                                    <i class="ti ti-basket fs-4"></i>
                                </a>
                            </div>

                            <div class="card-body pt-3 p-4">
                                <h6 class="fw-semibold fs-4">Red Valvet Dress</h6>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="fw-semibold fs-4 mb-0">
                                        $150 <span class="ms-2 fw-normal text-muted fs-3"><del>$200</del></span>
                                    </h6>

                                    <ul class="list-unstyled d-flex align-items-center mb-0">
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                        <li><i class="ti ti-star text-warning"></i></li>
                                    </ul>

                                </div>

                            </div>

                        </div>
                    </div> -->


                </div>

                <!-- <div class="row">
                    <div class="col-12">
                        <footer class="mt-5 py-3 border-top bg-white">
                            <div
                                class="container d-flex flex-column flex-md-row justify-content-between align-items-center">

                                <span class="text-muted small">
                                    © 2025 Sistem Ronda • All rights reserved
                                </span>

                                <div class="mt-2 mt-md-0 d-flex gap-3">
                                    <a href="#" class="text-muted small text-decoration-none">Privacy Policy</a>
                                    <a href="#" class="text-muted small text-decoration-none">Terms</a>
                                    <a href="#" class="text-muted small text-decoration-none">Help</a>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
    <!-- <footer class="footer mt-5 py-4 border-top bg-white">
    <div class="container-fluid">
        <div class="row align-items-center">
            
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <span class="text-muted small">
                    © 2025 Sistem Ronda — All rights reserved
                </span>
            </div>

            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-muted small text-decoration-none me-3">Privacy Policy</a>
                <a href="#" class="text-muted small text-decoration-none me-3">Terms</a>
                <a href="#" class="text-muted small text-decoration-none">Help</a>
            </div>
        </div>
    </div>
</footer> -->




    <!-- JS FILES -->
    <script src="{{ asset('resources/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('resources/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('resources/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('resources/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/dashboard.js') }}"></script>
    <script type="module" src="{{ asset('resources/js/utility/variabel.js') }}"></script>
    <script type="module" src="{{ asset('resources/js/utility/apiData.js') }}"></script>

    @stack('scripts')
</body>

</html>
