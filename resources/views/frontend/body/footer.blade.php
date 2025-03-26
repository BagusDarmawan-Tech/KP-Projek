<!-- Footer -->
<footer id="footer" class="footer bg-white text-dark py-4 shadow-lg">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <!-- Logo Section -->
            <div class="col-lg-3 col-md-6 col-12 text-center">
                <div class="d-flex justify-content-center flex-wrap">
                    <div class="p-2"><img class="img-fluid" src="{{ asset('kla-log.png') }}" alt="Logo 1" width="100"></div>
                    <div class="p-2"><img class="img-fluid" src="{{ asset('logo-sby.png') }}" alt="Logo 2" width="100"></div>
                </div>
            </div>

            <!-- About Section -->
            <div class="col-lg-5 col-md-6 col-12 text-center text-md-start">
                <div class="d-flex justify-content-center justify-content-md-start">
                <img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="180">
                </div>
                <p class="mt-3">{{ $configApps['footer'] ?? 'Kota Layak Anak adalah Kota yang mempunyai sistem pembangunan berbasis hak anak melalui pengintegrasian komitmen dan sumber daya pemerintah.' }}</p>
                <p><strong>Lokasi:</strong> {{ $configApps['head_office'] ?? 'Jl. Jimerto No. 25-27, Ketabang, Kec. Genteng, Kota SBY, Jawa Timur 60272' }}</p>
                <p><strong>Phone:</strong> {{ $configApps['phone'] ?? '(031) 5475600' }}</p>
            </div>

            <!-- Map Section -->
            <div class="col-lg-4 col-md-12 col-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.8507938365497!2d112.74516277357107!3d-7.257816571300096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9650a8a8883%3A0xb7bdb9b29f06f4bf!2sDinas%20Komunikasi%20dan%20Informatika%20Surabaya!5e0!3m2!1sen!2sid!4v1738832731622!5m2!1sen!2sid" 
                    class="w-100 rounded-3 shadow" height="250" style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <!-- Social Media Section -->
    <div class="container text-center mt-4">
    <h4>Follow Us</h4>
    <div class="d-flex justify-content-center gap-3">
        <a href="https://x.com/i/flow/login?redirect_after_login=%2Ffa_surabaya" class="social-link"><i class="bi bi-twitter"></i></a>
        <a href="https://www.tiktok.com/@fa_surabaya" class="social-link"><i class="bi bi-tiktok"></i></a>
        <a href="https://www.instagram.com/fasuroboyo/?igshid=MzRlODBiNWFlZA%3D%3D" class="social-link"><i class="bi bi-instagram"></i></a>
        <a href="https://www.youtube.com/@forumanaksurabaya3094" class="social-link"><i class="bi bi-youtube"></i></a>
    </div>
</div>

</footer>

