<style>
    .footer-link {
        color: #fff !important;
        text-decoration: none;
    }
</style>
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Alamat</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jln. Merta Agung, Gg. Sawahku Agung no.25B, Kerobokan Kelod</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+6289 54136 99890</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>smdetailing@gmail.com</p>
                <div class="d-flex pt-2">
                    <a class="footer-link btn btn-outline-light btn-social" target="_blank" href=""><i class="fab fa-instagram"></i></a>
                    <a class="footer-link btn btn-outline-light btn-social" target="_blank" href="https://web.facebook.com/awan.anker.16"><i class="fab fa-facebook-f"></i></a>
                    <a class="footer-link btn btn-outline-light btn-social" target="_blank" href=""><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Jam Operasional</h4>
                <h6 class="text-light">Senin - Jumat</h6>
                <p class="mb-4">09.00 AM - 06.00 PM</p>
                <h6 class="text-light">Saturday - Sunday:</h6>
                <p class="mb-0">10.00 AM - 03.00 PM</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Layanan</h4>
                <a class="footer-link btn btn-link" href="#">Cuci Kendaraan</a>
                <a class="footer-link btn btn-link" href="#">Perawatan Kaca</a>
                <a class="footer-link btn btn-link" href="#">Perawatan Interior</a>
                <a class="footer-link btn btn-link" href="#">Perawatan Exterior </a>
                <a class="footer-link btn btn-link" href="#">Pembersihan Mesin</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Pendaftaran</h4>
                <p>Daftarkan diri anda sebagai salah satu pelanggan SM Detailing</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    {{-- <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email"> --}}
                    <a href="{{ route('registerMenu') }}"> <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2 w-100">DAFTAR</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">SM Detailing</a>, All Right Reserved.
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a class="border-bottom" href="">Leo Partha</a>
                    {{-- <br>Distributed By: <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a> --}}
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a class="footer-link" href="#">Home</a>
                        <a class="footer-link" href="#Aboutus">Tentang</a>
                        <a class="footer-link" href="#Service">Layanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
