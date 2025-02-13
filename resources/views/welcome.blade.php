@extends('layout.app')

@section('content')
    <style>
        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
                /* Agar tidak hilang total */
            }
        }

        .animate-blink {
            animation: blink 4.5s infinite;
            /* Durasi lebih lama */
        }
    </style>

    <div class="relative min-h-screen flex flex-col mb-20 items-center justify-center">
        @if ($bg && $bg->image_bg)
            <!-- Background Image for Desktop -->
            <div class="absolute inset-0 bg-center bg-cover bg-no-repeat hidden sm:block"
                style="background-image: url('{{ asset('storage/' . $bg->image_bg) }}'); height: 130vh;">
            </div>

            <!-- Background Image for Mobile -->
            <div class="absolute inset-0 bg-center bg-cover bg-no-repeat sm:hidden"
                style="background-image: url('{{ asset('storage/' . $bg->image_bgres) }}'); height: 130vh;">
            </div>
        @else
            <!-- Jika Tidak Ada Gambar -->
            <div
                class="absolute inset-0 bg-gray-400 text-center flex items-center justify-center p-1 text-white text-xl font-semibold">
                Belum ada gambar yang dipasang saat ini
            </div>
        @endif

        <!-- 🔥 Efek Kelap-Kelip untuk Ucapan 🔥 -->
        @if ($ucapan)
            <div
                class="absolute top-20 px-6 py-4 bg-black bg-opacity-90 text-white text-center font-bold rounded-lg animate-blink
            max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                <h1 class="text-lg sm:text-2xl text-yellow-400 md:text-3xl lg:text-4xl">
                    {{ $ucapan->text }}
                </h1>
            </div>
        @endif

        <!-- Button: Dipindahkan ke bawah -->
        <div class="absolute bottom-10">
            <a href="{{ route('portal') }}"
                class="inline-block px-6 sm:px-12 py-2 text-white font-semibold rounded-3xl border-2 border-transparent transition-all duration-500 ease-in-out
        bg-blue-600 hover:bg-blue-800 hover:bg-opacity-100 shadow-md">
                Layanan <i class="ml-3 fa-solid fa-play"></i>
            </a>
        </div>
    </div>






    <!-- Konten di bawah -->
    <div id="content" class="flex flex-col items-center justify-center min-h-screen bg-white pt-16">


        <style>
            .banner {
                width: 100%;
                height: 100vh;
                text-align: center;
                overflow: hidden;
                position: relative;
            }

            .banner .slider {
                position: absolute;
                width: 180px;
                height: 230px;
                top: 30%;
                left: calc(50% - 100px);
                transform-style: preserve-3d;
                transform: perspective(1000px);
                transform: translateY(-50%);
                animation: autoRun 50s linear infinite;
                /* Dari 20s ke 40s agar lebih lambat */
                z-index: 2;
            }


            @keyframes autoRun {
                from {
                    transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
                }

                to {
                    transform: perspective(1000px) rotateX(0deg) rotateY(360deg);
                }
            }


            .banner .slider .item {
                position: absolute;
                inset: 0 0 0 0;
                transform:
                    rotateY(calc((var(--position) - 1) * (360 / var(--quantity)) * 1deg)) translateZ(400px);
            }

            .banner .slider .item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 10px;
                /* Atur sesuai keinginan */
            }

            .banner .content {
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: min(1400px, 100vw);
                height: max-content;
                padding-bottom: 100px;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
                z-index: 1;
            }

            .banner .content h1 {
                font-family: 'ICA Rubrik';
                font-size: 16em;
                line-height: 1em;
                color: #25283B;
                position: relative;
            }

            .banner .content h1::after {
                position: absolute;
                inset: 0 0 0 0;
                content: attr(data-content);
                z-index: 2;
                -webkit-text-stroke: 2px #d2d2d2;
                color: transparent;
            }

            .banner .content .author {
                font-family: Poppins;
                text-align: right;
                max-width: 200px;
            }

            .banner .content h2 {
                font-size: 3em;
            }

            .banner .content .model {
                background-image: url(images/model.png);
                width: 100%;
                height: 75vh;
                position: absolute;
                bottom: 0;
                left: 0;
                background-size: auto 130%;
                background-repeat: no-repeat;
                background-position: top center;
                z-index: 1;
            }

            @media screen and (max-width: 1023px) {
                .banner .slider {
                    width: 170px;
                    height: 210px;
                    left: calc(50% - 80px);
                }

                .banner .slider .item {
                    transform:
                        rotateY(calc((var(--position) - 1) * (360 / var(--quantity)) * 1deg)) translateZ(300px);
                }

                .banner .content h1 {
                    text-align: center;
                    width: 100%;
                    text-shadow: 0 10px 20px #000;
                    font-size: 7em;
                }

                .banner .content .author {
                    color: #fff;
                    padding: 20px;
                    text-shadow: 0 10px 20px #000;
                    z-index: 2;
                    max-width: unset;
                    width: 100%;
                    text-align: center;
                    padding: 0 30px;
                }
            }

            @media screen and (max-width: 767px) {
                .banner .slider {
                    width: 110px;
                    height: 160px;
                    left: calc(50% - 50px);
                }

                .banner .slider .item {
                    transform:
                        rotateY(calc((var(--position) - 1) * (360 / var(--quantity)) * 1deg)) translateZ(200px);
                }

                .banner .content h1 {
                    font-size: 5em;
                }
            }
        </style>



        <div class="banner p-5 mt-16 relative z-10">
            <h2 class="font-bold text-black text-3xl">DAFTAR INFOGRAPHIS</h2>
            <div class="slider" style="--quantity: 10">
                @foreach ($infographis as $index => $item)
                    @php
                        $videoId = null;
                        $embedUrl = null;

                        if (
                            preg_match(
                                '/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([\w-]+)/',
                                $item->video,
                                $matches,
                            )
                        ) {
                            // YouTube
                            $videoId = $matches[1];
                            $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                        } elseif (preg_match('/(?:tiktok\.com\/(?:.*\/video\/))(\d+)/', $item->video, $matches)) {
                            // TikTok
                            $videoId = $matches[1];
                            $embedUrl = "https://www.tiktok.com/embed/{$videoId}";
                        } elseif (
                            preg_match('/(?:instagram\.com\/(?:reel|p)\/([a-zA-Z0-9_-]+))/', $item->video, $matches)
                        ) {
                            // Instagram Reels atau Post
                            $videoId = $matches[1];
                            $embedUrl = "https://www.instagram.com/reel/{$videoId}/embed/";
                        }

                        $thumbnailUrl = $item->image_thumbnail
                            ? asset('storage/' . $item->image_thumbnail)
                            : asset('default-thumbnail.jpg');
                        $fullImageUrl = $item->image ? asset('storage/' . $item->image) : null;
                        $modalUrl = $embedUrl ?? $fullImageUrl; // Untuk modal, pakai video atau gambar asli
                    @endphp

                    <div class="item cursor-pointer" style="--position: {{ $index + 1 }}"
                        onclick="openModal(`{{ $modalUrl }}`, `{{ addslashes($item->title) }}`, `{{ addslashes($item->deskripsi) }}`, `{{ $fullImageUrl }}`)">

                        @if ($item->image_thumbnail)
                            <div class="w-full h-full bg-cover bg-center rounded-md"
                                style="background-image: url('{{ asset('storage/' . $item->image_thumbnail) }}');"></div>
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center bg-gray-400 text-white font-semibold text-lg rounded-md">
                                Tidak ada data
                            </div>
                        @endif

                    </div>
                @endforeach

            </div>
        </div>






        <div class="container mx-auto bg-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffff" fill-opacity="1"
                    d="M0,32L18.5,58.7C36.9,85,74,139,111,165.3C147.7,192,185,192,222,186.7C258.5,181,295,171,332,170.7C369.2,171,406,181,443,202.7C480,224,517,256,554,272C590.8,288,628,288,665,256C701.5,224,738,160,775,160C812.3,160,849,224,886,208C923.1,192,960,96,997,69.3C1033.8,43,1071,85,1108,128C1144.6,171,1182,213,1218,224C1255.4,235,1292,213,1329,192C1366.2,171,1403,149,1422,138.7L1440,128L1440,0L1421.5,0C1403.1,0,1366,0,1329,0C1292.3,0,1255,0,1218,0C1181.5,0,1145,0,1108,0C1070.8,0,1034,0,997,0C960,0,923,0,886,0C849.2,0,812,0,775,0C738.5,0,702,0,665,0C627.7,0,591,0,554,0C516.9,0,480,0,443,0C406.2,0,369,0,332,0C295.4,0,258,0,222,0C184.6,0,148,0,111,0C73.8,0,37,0,18,0L0,0Z">
                </path>
            </svg>

            <div class="p-4 sm:p-2">
                <h1 class="text-2xl sm:text-3xl font-bold text-center text-white mt-10 sm:mt-16 mb-6 sm:mb-10">
                    Daftar Infografis
                </h1>
            </div>

            <div class="p-6 sm:p-4">
                @if ($infographises->isEmpty())
                    <p class="text-center text-gray-500 text-lg">Tidak ada data tersedia</p>
                @else
                    <!-- Ubah grid agar di HP ada 2 card per baris -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($infographises as $item)
                            @php
                                // Ambil ID video dari berbagai format URL YouTube
                                preg_match(
                                    '/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([\w-]+)/',
                                    $item->video,
                                    $matches,
                                );
                                $videoId = $matches[1] ?? null;

                                // Tentukan URL untuk modal
                                $modalUrl = $videoId
                                    ? "https://www.youtube.com/embed/{$videoId}"
                                    : asset('storage/' . $item->image);
                            @endphp

                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if ($videoId)
                                    <iframe class="w-full h-[200px] sm:h-[300px] md:h-[350px] rounded-md"
                                        src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                @elseif ($item->image_thumbnail)
                                    <!-- Tampilkan thumbnail di card -->
                                    <img src="{{ asset('storage/' . $item->image_thumbnail) }}" alt="{{ $item->title }}"
                                        class="w-full h-[200px] sm:h-[300px] md:h-[350px] object-cover cursor-pointer"
                                        onclick="openModal('{{ $modalUrl }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->deskripsi) }}', '{{ asset('storage/' . $item->image) }}')">
                                @else
                                    <!-- Jika tidak ada data, tetap pakai desain default -->
                                    <div
                                        class="w-full h-[200px] sm:h-[300px] md:h-[350px] flex items-center justify-center bg-gray-400 text-white font-semibold text-lg">
                                        Tidak ada data
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300 ease-out">
        <div id="modalContent"
            class="relative p-4 w-full max-w-2xl max-h-full  overflow-y-auto transform transition-all duration-300 scale-95 opacity-0 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent hover:scrollbar-thumb-gray-500">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-lg dark:bg-gray-700">
                <!-- Modal Header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 id="modalTitle" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        onclick="closeModal()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div id="modalVideoContainer" class="w-full"></div>
                    <img id="modalImage" class="w-full h-auto object-contain rounded-md hidden">
                    <p id="modalDescription" class="text-base leading-relaxed text-gray-500 dark:text-gray-400"></p>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        onclick="closeModal()">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function openModal(mediaUrl, title, description, imageUrl) {
            document.getElementById("modalTitle").innerText = title;
            document.getElementById("modalDescription").innerText = description;

            let modalVideoContainer = document.getElementById("modalVideoContainer");
            let modalImage = document.getElementById("modalImage");

            modalVideoContainer.innerHTML = "";
            modalImage.classList.add("hidden");

            if (mediaUrl.includes("youtube.com") || mediaUrl.includes("youtu.be") || mediaUrl.includes("tiktok.com") ||
                mediaUrl.includes("instagram.com")) {
                modalVideoContainer.innerHTML =
                    `<div class="relative w-full h-0 pb-[56.25%]">
                <iframe class="absolute top-0 left-0 w-full h-full rounded-lg" src="${mediaUrl}" frameborder="0" allowfullscreen></iframe>
            </div>`;
            } else if (imageUrl) {
                modalImage.src = imageUrl;
                modalImage.classList.remove("hidden");
            }

            let modal = document.getElementById("default-modal");
            let modalContent = document.getElementById("modalContent");

            modal.classList.remove("hidden");
            setTimeout(() => {
                modal.classList.add("opacity-100");
                modalContent.classList.remove("scale-95", "opacity-0");
                modalContent.classList.add("scale-100", "opacity-100");
            }, 10);
        }

        function closeModal() {
            let modal = document.getElementById("default-modal");
            let modalContent = document.getElementById("modalContent");

            modal.classList.remove("opacity-100");
            modalContent.classList.remove("scale-100", "opacity-100");
            modalContent.classList.add("scale-95", "opacity-0");

            setTimeout(() => {
                modal.classList.add("hidden");
            }, 200);
        }
    </script>

    <!-- Script Scroll -->
    <script>
        function scrollToContent() {
            document.getElementById('content').scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
@endsection
