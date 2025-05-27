@extends('layout.main')
@section('customcss')
    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
@section('content')
    <div id="loading-spinner"
        style="
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0; left: 0; width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
">
        <div class="spinner"
            style="
        border: 6px solid #f3f3f3;
        border-top: 6px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    ">
        </div>
    </div>
    <div class="container" role="main" aria-label="Undangan silaturahmi keluarga">
        <h1>Silaturahmi Keluarga</h1>
        <div class="subtitle">Bani Sakirin &amp; Bani Sama'un</div>

        <div class="invitation-message" aria-label="Pesan undangan">
            <p>Assalamu’alaikum Warahmatullahi Wabarakatuh</p>
            <p style="margin-top: -13px">
                Dengan penuh rasa hormat dan kebahagiaan, kami mengundang seluruh
                keluarga besar Bani Sakirin dan Bani Sama'un untuk hadir dalam acara
                silaturahmi keluarga guna mempererat tali persaudaraan dan memperkuat
                ukhuwah. Kehadiran Bapak/Ibu/Saudara(i) sangat kami harapkan.
            </p>

            <button id="input-kehadiran" aria-label="Tampilkan hitung mundur">Input Kehadiran</button>

        </div>

        <div class="section" aria-label="Informasi tanggal dan waktu acara">
            <h2>Tanggal &amp; Waktu</h2>
            <p id="event-date">Minggu, 08 Juni 2025</p>
            <p id="event-time">Pukul 07.00 - Selesai</p>
        </div>

        <div class="section" aria-label="Informasi tanggal dan waktu acara">
            <h2>Rangkaian Acara</h2>
            <div class="list" style="margin: auto;">
                <p style="text-align: left !important">
                    07.30 - 08.00: Pra acara + Daftar Hadir (Live Music)
                </p>
                <p style="text-align: left !important">
                    08.00 - 08.30: Pembukaan + Sambutan
                </p>
                <p style="text-align: left !important">
                    08.30 - 09.00: Tahlil dan Doa
                </p>
                <p style="text-align: left !important">
                    09.00 - 10.30: Sarasehan bersama (acara kebersamaan)
                </p>
                <p style="text-align: left !important">10.30 - 11.00: Foto Bersama</p>
                <p style="text-align: left !important">
                    11.00 - Selesai: Hiburan Live Music & Ramah Tamah
                </p>
            </div>
        </div>

        <div class="section" aria-label="Lokasi acara">
            <h2>Lokasi Acara</h2>
            <p>Rumah H.Mulyono</p>
            <p class="location">
                Jl. Raya Cukurguling, Belakang Kantor Mitra Usaha Desa Cukurguling,
                Kecamatan Lumbang, Kabupaten Pasuruan, Jawa Timur
            </p>

            <div class="maps">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.094888510799!2d112.97607787476585!3d-7.779763192239863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ca8aa33176b9%3A0xbc356f5eb912aae5!2sMitra%20Usaha!5e0!3m2!1sid!2sid!4v1748308984441!5m2!1sid!2sid"
                    width="90%" height="400" style="border: 0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <!-- <button id="countdown" aria-label="Tampilkan hitung mundur"></button> -->
        <p id="countdown-display" aria-live="polite" style="margin-top: 15px; font-weight: 600"></p>

        <footer>
            Kami tunggu kehadiran Anda dan Keluarga. TTD, Segenap Panitia Acara.
        </footer>

        <div id="modal-kehadiran" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <h2>Form Kehadiran</h2>
                <form id="form-kehadiran" action="{{ route('savekehadiran') }}" method="POST"
                    aria-label="Form input kehadiran">
                    @csrf
                    <input type="text" name="nama" placeholder="Nama Lengkap" required />
                    <input type="number" name="keturunan_ke" placeholder="Keturunan ke-" required />
                    <select required name="bani">
                        <option value="">Pilih Bani</option>
                        <option value="Sakirin">Bani Sakirin</option>
                        <option value="Sama'un">Bani Sama'un</option>
                    </select>
                    <input type="text" name="alamat" placeholder="Alamat" required />
                    <input type="number" name="hp" placeholder="No HP" required />
                    <input type="text" name="pekerjaan" placeholder="Pekerjaan / Usaha" required />
                    <div class="form-buttons">
                        <button type="submit">Kirim</button>
                        <button type="button" id="close-modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        const countdownDisplay = document.getElementById("countdown-display");
        const eventDate = new Date("June 08, 2025 07:00:00");

        function updateCountdown() {
            const now = new Date();
            const diff = eventDate - now;

            if (diff <= 0) {
                countdownDisplay.textContent =
                    "Acara sedang berlangsung atau sudah selesai.";
                clearInterval(timerInterval);
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((diff / (1000 * 60)) % 60);
            const seconds = Math.floor((diff / 1000) % 60);

            countdownDisplay.textContent = `${days} hari ${hours} jam ${minutes} menit ${seconds} detik menuju acara`;
        }

        let timerInterval;

        function startCountdown() {
            updateCountdown();
            timerInterval = setInterval(updateCountdown, 1000);
        }
        document.getElementById("input-kehadiran").addEventListener("click", function() {
            document.getElementById("modal-kehadiran").style.display = "flex";
        });

        document.getElementById("close-modal").addEventListener("click", function() {
            document.getElementById("modal-kehadiran").style.display = "none";
        });

        document.addEventListener('DOMContentLoaded', function() {

            const container = document.querySelector(".container");
            setTimeout(() => {
                container.classList.add("fade-in");
            }, 100);
            startCountdown();

            const form = document.getElementById('form-kehadiran');
            const closeBtn = document.getElementById('close-modal');
            const modal = document.getElementById('modal-kehadiran');
            const spinner = document.getElementById('loading-spinner');

            if (modal) {
                const observer = new MutationObserver(() => {
                    if (modal.style.display === 'block' || modal.classList.contains('show')) {
                        // Scroll ke modal
                        modal.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                });

                observer.observe(modal, {
                    attributes: true,
                    attributeFilter: ['style', 'class']
                });
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                const data = {};
                formData.forEach((value, key) => data[key] = value);

                spinner.style.display = 'flex'; // Show loading

                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    })
                    .then(async response => {
                        const contentType = response.headers.get("content-type");
                        spinner.style.display = 'none'; // Hide loading

                        if (!response.ok) {
                            throw new Error('HTTP Error: ' + response.status);
                        }

                        if (contentType && contentType.includes("application/json")) {
                            const res = await response.json();

                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: res.message ||
                                        'Data kehadiran berhasil dikirim !',
                                    confirmButtonText: 'Oke'
                                });

                                form.reset();
                                modal.style.display = 'none';
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops!',
                                    text: res.message || 'Gagal mengirim data',
                                });
                            }
                        } else {
                            throw new Error('Respon bukan JSON 😬');
                        }
                    })
                    .catch(error => {
                        spinner.style.display = 'none'; // Hide loading
                        console.error("Kesalahan saat mengirim:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mengirim data. Coba lagi nanti ya 😢',
                        });
                    });
            });

            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });
        });
    </script>
@endsection
