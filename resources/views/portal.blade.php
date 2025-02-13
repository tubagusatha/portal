@extends('layout.app')

@section('content')
    <style>
        .carousel {
            width: 100%;
            background-color: #555;
            height: 601px;
            color: #eee;
            margin-top: -50px;
            position: relative;
        }

        .carousel .list {
            width: 100%;
            height: 100%;
            position: relative;
            z-index: 1;
        }


        .carousel .list .item .info {
            max-width: 80%;
            margin: auto;
            padding: 20px;
        }

        .carousel .list .item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .carousel .list .item::before {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: var(--bg-color);
            content: var(--title);
            font-size: 15em;
            font-weight: bold;
            text-transform: uppercase;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #eee4;
            z-index: -1;
        }

        .carousel .list .item .image {
            flex-shrink: 0;
            width: 300px;
            height: 20px;
            --left: -200px;
            background:
                var(--img-src) var(--left) 0,
                url(images/soda.png) no-repeat;
            background-size: 100% auto;
            background-blend-mode: multiply;
            -webkit-mask-image: url(images/soda.png);
            -webkit-mask-size: 100% auto;
            -webkit-mask-repeat: no-repeat;
            mask-image: url(images/soda.png);
            mask-size: 100% auto;
            mask-repeat: no-repeat;
            transition: background 1s ease-in-out;
        }

        .carousel .list .item .content {
            width: 1140px;
            max-width: 90%;
            margin: auto;
            height: 100%;
            padding: 0px 30px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            /* Bikin kolom */
            gap: 20px;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* Biar teks rapi */
        }


        .carousel .list .item .info {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .carousel .list .item .info .title {
            font-size: 6em;
            font-weight: bold;
            border: black;
            text-transform: uppercase;
            line-height: 1em;
        }

        .carousel .list .item .info .category {
            opacity: .7;
        }

        .carousel .list .item .info .des {
            margin: 1em 0;
        }

        .carousel .list .item .info a {
            display: inline-flex;
            gap: 20px;
            text-decoration: none;
            color: #eee;
            font-weight: 500;
        }

        /* set active item */
        .carousel .list .item {
            z-index: 1;
        }

        .carousel .list .item.active {
            z-index: 2;
        }

        .carousel .list .item.active .image {
            --left: 0;
        }

        /* arrows */
        .arrows button {
            position: absolute;
            top: 50%;
            z-index: 2;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-family: monospace;
            background-color: #eee3;
            border: none;
            color: #fff;
            font-weight: bold;
            font-size: large;
            cursor: pointer;
            left: 10%;
            transition: background 0.5s,
                color 0.5s;
        }

        .arrows button#next {
            left: unset;
            right: 10%;
        }

        .arrows button:hover {
            background-color: #eee;
            color: #000;
        }

        .dots li {
            width: 15px;
            height: 15px;
            background-color: #eee5;
            border-radius: 50%;
            cursor: pointer;
        }

        .dots li.active {
            background-color: #eee;
        }

        .dots {
            list-style: none;
            margin: 0;
            padding: 0;
            display: none;

            gap: 20px;
            position: absolute;
            bottom: 30px;
            z-index: 2;
            width: max-content;
            left: 50%;
            transform: translateX(-50%);
            transition: background 0.5s;
        }

        .aaa {
            margin: 10;
            position: absolute;
            bottom: 30px;
            z-index: 2;
            left: 5%;
            width: max-content;
        }


        .carousel {
            overflow: hidden;
        }

        /* responsive */
        @media screen and (max-width: 767px) {
            .carousel {
                height: 111vh;
            }

            .carousel .list .item {
                padding: 20px display: flex;
                flex-direction: column;
                align-items: center;
            }

            .carousel .list .item img {
                max-width: 60%;
                /* Mengecilkan gambar */
                height: auto;
                margin: 5px
            }

            .carousel .list .item .info {
                position: absolute;
                bottom: 5%;
                width: 90%;
                padding: 20px;
                box-sizing: border-box;
                text-align: center;
                /* Tambahkan background transparan */
                border-radius: 10px;
            }

            .carousel .list .item .info .title {
                font-size: 1.5em;
                font-weight: bold;
                color: #fff;
            }

            .carousel .list .item .info .des {
                font-size: 0.8em;
                text-align: center;
                color: #ddd;
                line-height: 1.4;
            }


            .carousel .list .item .content {
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .arrows button {
                bottom: 10px;
            }
        }


        /* effect */
        @keyframes transformAnimation {
            from {
                transform: translateX(var(--transform-from));
            }

            to {
                transform: translateX(var(--transform-to));
            }
        }

        .carousel.effect .item .image {
            animation: transformAnimation 1s ease-in-out 1 forwards;
        }

        .carousel.effect .item .info .title,
        .carousel.effect .item .info .category,
        .carousel.effect .item .info .des,
        .carousel.effect .item .info a {
            animation: transformAnimation 1s ease-in-out 1 forwards;
        }

        .carousel.effect .item .info .category {
            animation-delay: 0.1s;
        }

        .carousel.effect .item .info .des {
            animation-delay: 0.2s;
        }

        .carousel.effect .item .info a {
            animation-delay: 0.3s;
        }

        .carousel.effect .item.active {
            clip-path: polygon(0 0, 0 0, 0 100%, 0% 100%);
            animation: animationClipPath 0.9s ease-in-out 1 forwards;
        }

        @keyframes animationClipPath {
            to {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }
        }

        .carousel.effect {
            --transform: 300px;
        }

        .carousel.effect .item.active {
            --transform-from: calc(var(--transform) * -1);
            --transform-to: 0px;
        }

        .carousel.effect .item {
            --transform-from: 0;
            --transform-to: var(--transform);
        }
    </style>


    <div class="carousel">
        <div class="aaa bg-gray-800 opacity-60 p-3 rounded-sm">
            <a href="{{route('beranda')}}">Kembali</a>
        </div>
        @if ($portals->isEmpty())
            <div class="text-center flex justify-center items-center h-screen text-gray-100 text-lg font-semibold mt-10">
                Oops, belum ada data nih 😞
            </div>
        @else
            <div class="list">
                @foreach ($portals as $index => $p)
                    @php
                        $imagePath = $p->portal_image
                            ? asset('storage/' . $p->portal_image)
                            : asset('images/default.png');
                    @endphp
                    <div class="item {{ $loop->first ? 'active' : '' }}"
                        style="
                        --img-src: url('{{ asset('storage/' . $p->portal_image) }}');
                        --bg-color: {{ $p->bg_color }};
                        --title: '{{ $p->title }}'
                    ">
                        <div class="content">
                            <a href="{{ $p->link }}">
                                <div class="info">
                                    <img src="{{ $imagePath }}" alt="Portal Image" width="150" height="150">
                                    <div class="title">
                                        {{ $p->title }}
                                    </div>
                                    <div class="category">
                                    </div>
                                    <div class="des text-center">
                                        {{ Str::limit($p->deskripsi, 150, '...') }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
           
            <div class="arrows">
                <button id="prev">
                    < </button>
                        <button id="next">></button>
            </div>
            
            <ul class="dots"></ul>
        @endif

    </div>

    <script>
        let list = document.querySelectorAll('.carousel .list .item');
        let carousel = document.querySelector('.carousel');
        let dotsContainer = document.querySelector('.dots');
        let nextBtn = document.getElementById('next');
        let prevBtn = document.getElementById('prev');

        let lastPosition = list.length - 1;
        let active = 0;
        let zIndex = 2;
        let maxDots = 5; // Maksimal 5 dots ditampilkan

        // Buat semua dots sesuai jumlah item di carousel
        let allDots = [];
        dotsContainer.innerHTML = ''; // Hapus dots lama

        list.forEach((item, index) => {
            let dot = document.createElement('li');
            if (index === 0) dot.classList.add('active'); // Dot pertama aktif
            dot.addEventListener('click', () => {
                setItemActive(index, showSlider);
            });
            allDots.push(dot); // Simpan ke array semua dots
        });

        // Tampilkan hanya 5 dots pertama saat load
        updateDotsDisplay();

        // Function untuk update tampilan dots sesuai item aktif
        function updateDotsDisplay() {
            dotsContainer.innerHTML = ''; // Hapus dots lama dari DOM

            let start = Math.max(0, Math.min(active - 2, lastPosition - maxDots + 1));
            let end = Math.min(lastPosition, start + maxDots - 1);

            for (let i = start; i <= end; i++) {
                dotsContainer.appendChild(allDots[i]); // Masukkan dots ke container
            }

            // Update daftar dots yang ada di tampilan
            dots = document.querySelectorAll('.dots li');
        }

        // Next & Prev Button Logic
        nextBtn.onclick = () => {
            let newValue = active + 1 > lastPosition ? 0 : active + 1;
            setItemActive(newValue, showSlider);
        };

        prevBtn.onclick = () => {
            let newValue = active - 1 < 0 ? lastPosition : active - 1;
            setItemActive(newValue, showSlider);
        };

        // Set item aktif dan update tampilan
        const setItemActive = (newValue, callbackFunction) => {
            if (newValue === active) return;
            let type = newValue > active ? 'next' : 'prev';
            active = newValue;
            callbackFunction(type);
        };

        let removeEffect;
        let autoRun = setTimeout(() => {
            nextBtn.click();
        }, 5000);

        const showSlider = (type) => {
            carousel.style.pointerEvents = 'none';

            // Hapus class active dari item lama
            let itemActiveOld = document.querySelector('.carousel .list .item.active');
            if (itemActiveOld) itemActiveOld.classList.remove('active');

            zIndex++;
            list[active].style.zIndex = zIndex;
            list[active].classList.add('active');

            if (type === 'next') {
                carousel.style.setProperty('--transform', '300px');
            } else {
                carousel.style.setProperty('--transform', '-300px');
            }
            carousel.classList.add('effect');

            // Update tampilan dots agar selalu menampilkan 5 dots yang sesuai
            updateDotsDisplay();

            // Update dots active
            let dotActiveOld = document.querySelector('.dots li.active');
            if (dotActiveOld) dotActiveOld.classList.remove('active');
            allDots[active].classList.add('active');

            clearTimeout(removeEffect);
            removeEffect = setTimeout(() => {
                carousel.classList.remove('effect');
                carousel.style.pointerEvents = 'auto';
            }, 1500);

            clearTimeout(autoRun);
            autoRun = setTimeout(() => {
                nextBtn.click();
            }, 5000);
        };
    </script>
@endsection
