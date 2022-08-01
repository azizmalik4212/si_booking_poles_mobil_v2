@extends('frontend.layouts.app')
@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <!-- About SM -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('assets_frontend/img/bgslider.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-10 col-lg-7 text-center text-lg-start">
                                <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Auto Detailing //</h6>
                                <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">SM Detailing </h1>
                                <a href="#layananKami" class="btn btn-primary py-3 px-5 animated slideInDown">Layanan Kami<i class="fa fa-arrow-down ms-3"></i></a>
                            </div>
                            {{-- <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                <img class="img-fluid" src="{{ asset('assets_frontend/img/background_prime_1.jpg') }}" alt="">
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Booking  Flow-->
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('assets_frontend/img/slider1.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            {{-- <div class="col-10 col-lg-7 text-center text-lg-start">
                                <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Car Servicing //</h6>
                                <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Qualified Car Wash Service Center</h1>
                                <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Learn More<i class="fa fa-arrow-right ms-3"></i></a>
                            </div> --}}
                            {{-- <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                <img class="img-fluid" src="{{ asset('assets_frontend/img/background_prime_1.jpg') }}" alt="">
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Service List -->
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('assets_frontend/img/slider2.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            {{-- <div class="col-10 col-lg-7 text-center text-lg-start">
                                <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Car Servicing //</h6>
                                <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Qualified Car Wash Service Center</h1>
                                <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Learn More<i class="fa fa-arrow-right ms-3"></i></a>
                            </div> --}}
                            {{-- <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                <img class="img-fluid" src="{{ asset('assets_frontend/img/carousel-bg-2.png') }}" alt="">
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="d-flex py-5 px-4">
                    <i class="fa fa-certificate fa-3x text-primary flex-shrink-0"></i>
                    <div class="ps-4">
                        <h5 class="mb-3">Kualitas Layanan</h5>
                        <p>Memiliki pengalaman lebih dari satu tahun dalam bidang auto detailing</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="d-flex bg-light py-5 px-4">
                    <i class="fa fa-users-cog fa-3x text-primary flex-shrink-0"></i>
                    <div class="ps-4">
                        <h5 class="mb-3">Pekerja Profesional</h5>
                        <p>Memiliki pegawai yang bekerja secara tekun dan profesional</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="d-flex py-5 px-4">
                    <i class="fa fa-tools fa-3x text-primary flex-shrink-0"></i>
                    <div class="ps-4">
                        <h5 class="mb-3">Peralatan Berkualitas</h5>
                        <p  id="Aboutus" > Alat dan Bahan terbaik dan ramah lingkungan dalam bidang auto detailing</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 pt-4" style="min-height: 400px;">
                <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                    <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets_frontend/img/bgaboutus.jpg') }}" style="object-fit: cover;" alt="">
                    <div class="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5" style="background: rgba(0, 0, 0, .08);">
                        <h1 class="display-4 text-white mb-0">4 <span class="fs-4">Years</span></h1>
                        <h4 class="text-white">Experience</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h6 class="text-primary text-uppercase">// Tentang Kami //</h6>
                <h1 class="mb-4"><span class="text-primary">SM Detailing</span> Tempat Terbaik Untuk Perawatan Kendaraan Anda</h1>
                <p class="mb-4">Pelayanan Jasa Auto Detailing Mobil yang melayani anda dengan profesional.<br>SM Detailing menggunakan pelayanan jasa Home Service ke rumah anda</p>
                <div class="row g-4 mb-3 pb-3">
                    <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                        <div class="d-flex">
                            <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-secondary">01</span>
                            </div>
                            <div class="ps-3">
                                <h6>Kualitas Layanan</h6>
                                <span>Memiliki pengalaman lebih dalam bidang auto detailing</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                        <div class="d-flex">
                            <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-secondary">02</span>
                            </div>
                            <div class="ps-3">
                                <h6>Pekerja Profesional</h6>
                                <span>Memiliki pegawai yang bekerja secara tekun dan profesional</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                        <div class="d-flex">
                            <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-secondary">03</span>
                            </div>
                            <div class="ps-3">
                                <h6>Peralatan Berkualitas</h6>
                                <span>Alat dan Bahan terbaik dalam bidang auto detailing</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Fact Start -->
<div class="container-fluid fact bg-dark my-5 py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                <i class="fa fa-check fa-2x text-white mb-3"></i>
                <h2 class="text-white mb-2" data-toggle="counter-up">1</h2>
                <p class="text-white mb-0">Fokus Pengerjaan Harian</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                <i class="fa fa-users-cog fa-2x text-white mb-3"></i>
                <h2 class="text-white mb-2" data-toggle="counter-up">2</h2>
                <p class="text-white mb-0">Pekerja Berpengalaman</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                <i class="fa fa-users fa-2x text-white mb-3"></i>
                <h2 class="text-white mb-2" data-toggle="counter-up">50</h2>
                <p class="text-white mb-0">Klien yang Puas</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                <i class="fa fa-car fa-2x text-white mb-3"></i>
                <h2 class="text-white mb-2" data-toggle="counter-up">50</h2>
                <p  id="Service" class="text-white mb-0">Projek Selesai</p>
            </div>
        </div>
    </div>
</div>
<!-- Fact End -->


<!-- Service Start -->
<div class="container-xxl service py-5" id="layananKami">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">// Layanan //</h6>
            <h1 class="mb-5">Layanan Yang Kami Miliki</h1>
        </div>
        <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-lg-4">
                <div class="nav w-100 nav-pills me-6">
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                        <i class="fa fa-car-side fa-2x me-3"></i>
                        <h4 class="m-0">Perawatan Kaca</h4>
                    </button>
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                        <i class="fa fa-car fa-2x me-3"></i>
                        <h4 class="m-0">Perawatan Interior</h4>
                    </button>
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                        <i class="fa fa-cog fa-2x me-3"></i>
                        <h4 class="m-0">Perawatan Exterior</h4>
                    </button>
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                        <i class="fa fa-oil-can fa-2x me-3"></i>
                        <h4 class="m-0">Pembersihan Mesin</h4>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="tab-content w-100">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <div class="row g-4">
                            <div class="col-md-6" style="min-height: 350px;">
                                <div class="position-relative h-100">
                                    <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets_frontend/img/service-1.jpg') }}"
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-3">Perawatan Kaca Mobil</h3>
                                <p class="mb-4">Kaca mobil merupakan komponen yang memerlukan perawatan. Untuk perawatan pada kaca berbeda dengan bodi. Karena kebersihan kaca mempengaruhi tampilan mobil dan penglihatan pengemudi.</p>
                                <p><i class="fa fa-check text-success me-3"></i>Jamur</p>
                                <p><i class="fa fa-check text-success me-3"></i>Flek</p>
                                <p><i class="fa fa-check text-success me-3"></i>Baret</p>
                                <a href="" class="btn btn-primary py-3 px-5 mt-3">Booking Layanan<i class="fa fa-arrow-right ms-3"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <div class="row g-4">
                            <div class="col-md-6" style="min-height: 350px;">
                                <div class="position-relative h-100">
                                    <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets_frontend/img/service-2.jpg') }}"
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-3">Perawatan Interior Mobil</h3>
                                <p class="mb-4">Anda bisa berkendara dengan nyaman bukan hanya dari segi mesin mobil yang prima tetapi juga kabin selalu bersih. Membersihkan interior mobil bukan hanya membawa kenyamanan tetapi Anda yang menggunakannya juga terjaga kesehatannya.</p>
                                <p><i class="fa fa-check text-success me-3"></i>Plafon</p>
                                <p><i class="fa fa-check text-success me-3"></i>Jok Mobil</p>
                                <p><i class="fa fa-check text-success me-3"></i>Dashboard</p>
                                <a href="" class="btn btn-primary py-3 px-5 mt-3">Booking Layanan<i class="fa fa-arrow-right ms-3"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row g-4">
                            <div class="col-md-6" style="min-height: 350px;">
                                <div class="position-relative h-100">
                                    <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets_frontend/img/service-3.jpg') }}"
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-3">Perawatan Exterior Mobil</h3>
                                <p class="mb-4">Cat mobil memerlukan perawatan agar tetap mengkilap dan tahan lama. Jika tidak dilakukan perawatan yang benar, cat akan menjadi kusam. Jika hal itu terjadi, maka penampilan dari mobil Anda akan menjadi kurang menarik. Oleh karena itu, diperlukan perawatan agar cat tetap mengkilap dan tahan lama.</p>
                                <p><i class="fa fa-check text-success me-3"></i>Bodi Mobil</p>
                                <p><i class="fa fa-check text-success me-3"></i>Velg</p>
                                <p><i class="fa fa-check text-success me-3"></i>Lampu Mobil</p>
                                <a href="" class="btn btn-primary py-3 px-5 mt-3">Booking Layanan<i class="fa fa-arrow-right ms-3"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-4">
                        <div class="row g-4">
                            <div class="col-md-6" style="min-height: 350px;">
                                <div class="position-relative h-100">
                                    <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets_frontend/img/service-4.jpg') }}"
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-3">Pembersihan Mesin Mobil</h3>
                                <p class="mb-4">Meski selalu tertutup, ternyata ruang mesin pada mobil juga bisa terpapar oleh debu dan kotoran. Oleh sebab itu, anda pelu membersihkan mesin mobil yang tepat agar ruang dapur pacu tetap terjaga performanya.</p>
                                <p><i class="fa fa-check text-success me-3"></i>Debu & Kotoran</p>
                                <p><i class="fa fa-check text-success me-3"></i>Mesin</p>
                                <p><i class="fa fa-check text-success me-3"></i>Radiator</p>
                                <a href="" class="btn btn-primary py-3 px-5 mt-3">Booking Layanan<i class="fa fa-arrow-right ms-3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->
@endsection
