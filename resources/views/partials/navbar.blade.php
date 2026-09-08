@php

    /*
    |--------------------------------------------------------------------------
    | Menentukan Event untuk URL Finalis
    |--------------------------------------------------------------------------
    |
    | - Halaman event       -> menggunakan $event
    | - Halaman kandidat    -> menggunakan event_id kandidat
    | - Landing page        -> menggunakan event aktif pertama dari $events
    |
    */

    $navEventId = null;

    if (isset($event)) {
        $navEventId = $event->id;
    } elseif (isset($candidate)) {
        $navEventId = $candidate->event_id;
    } elseif (isset($events) && $events->count() > 0) {
        $navEventId = $events->first()->id;
    }


    /*
    |--------------------------------------------------------------------------
    | URL Halaman Finalis
    |--------------------------------------------------------------------------
    */

    $finalisUrl = $navEventId
        ? route('event.detail', $navEventId)
        : route('home') . '#finalis';


    /*
    |--------------------------------------------------------------------------
    | Halaman Aktif
    |--------------------------------------------------------------------------
    */

    $activePage = $activePage ?? '';

@endphp



<!-- NAVBAR -->
<nav class="fixed top-0 left-0 w-full z-50 bg-[#16052b]/95 backdrop-blur-md">

    <div
        class="
        max-w-7xl
        mx-auto
        px-5
        sm:px-8
        py-4
        flex
        items-center
        justify-between
        "
    >

        <!-- LOGO -->
        <a href="{{ route('home') }}">

            <img
                src="{{ asset('Images/logo.webp') }}"
                alt="Duta Wicara Jawa Timur"
                class="h-9 sm:h-10 w-auto"
            >

        </a>



        <!-- MENU DESKTOP -->
        <div class="hidden lg:flex items-center gap-7 text-white text-sm">

            <!-- BERANDA -->
            <a
                href="{{ route('home') }}"
                class="
                transition
                hover:text-[#e7b24b]

                {{ $activePage === 'home'
                    ? 'text-[#e7b24b]'
                    : 'text-white'
                }}
                "
            >
                Beranda
            </a>


            <!-- TENTANG -->
            <a
                href="{{ route('home') }}#tentang"
                class="hover:text-[#e7b24b] transition"
            >
                Tentang
            </a>


            <!-- FINALIS -->
            <a
                href="{{ $finalisUrl }}"
                class="
                transition
                hover:text-[#e7b24b]

                {{ $activePage === 'finalis'
                    ? 'text-[#e7b24b]'
                    : 'text-white'
                }}
                "
            >
                Finalis
            </a>


            <!-- PERINGKAT -->
            <a
                href="#"
                class="
                transition
                hover:text-[#e7b24b]

                {{ $activePage === 'ranking'
                    ? 'text-[#e7b24b]'
                    : 'text-white'
                }}
                "
            >
                Peringkat
            </a>


            <!-- CARA VOTE -->
            <a
                href="{{ route('home') }}#cara-vote"
                class="hover:text-[#e7b24b] transition"
            >
                Cara Vote
            </a>


            <!-- BERITA -->
            <a
                href="#"
                class="hover:text-[#e7b24b] transition"
            >
                Berita
            </a>


            <!-- KONTAK -->
            <a
                href="#"
                class="hover:text-[#e7b24b] transition"
            >
                Kontak
            </a>

        </div>



        <!-- BUTTON VOTE DESKTOP -->
        <a
            href="{{ $finalisUrl }}"
            class="
            hidden
            lg:inline-flex
            items-center
            justify-center
            bg-[#e7b24b]
            hover:bg-[#f2c55f]
            text-black
            px-7
            py-2.5
            rounded-full
            font-semibold
            transition
            "
        >
            Vote Sekarang
        </a>



        <!-- HAMBURGER MOBILE -->
        <button
            id="mobileMenuButton"
            type="button"
            class="
            lg:hidden
            text-white
            p-2
            rounded-lg
            hover:bg-white/10
            transition
            "
            aria-label="Buka Menu"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-7 h-7"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />

            </svg>

        </button>

    </div>



    <!-- MOBILE MENU -->
    <div
        id="mobileMenu"
        class="
        hidden
        lg:hidden
        bg-[#16052b]
        border-t
        border-white/10
        "
    >

        <div class="px-6 py-6 flex flex-col gap-5 text-white">

            <a
                href="{{ route('home') }}"
                class="{{ $activePage === 'home' ? 'text-[#e7b24b]' : '' }}"
            >
                Beranda
            </a>


            <a href="{{ route('home') }}#tentang">
                Tentang
            </a>


            <a
                href="{{ $finalisUrl }}"
                class="{{ $activePage === 'finalis' ? 'text-[#e7b24b]' : '' }}"
            >
                Finalis
            </a>


            <a href="#">
                Peringkat
            </a>


            <a href="{{ route('home') }}#cara-vote">
                Cara Vote
            </a>


            <a href="#">
                Berita
            </a>


            <a href="#">
                Kontak
            </a>


            <a
                href="{{ $finalisUrl }}"
                class="
                mt-2
                text-center
                bg-[#e7b24b]
                text-black
                px-6
                py-3
                rounded-full
                font-semibold
                "
            >
                Vote Sekarang
            </a>

        </div>

    </div>

</nav>



<!-- SCRIPT MOBILE NAVBAR -->
<script>

    document.addEventListener('DOMContentLoaded', function () {

        const mobileMenuButton =
            document.getElementById('mobileMenuButton');

        const mobileMenu =
            document.getElementById('mobileMenu');


        if (mobileMenuButton && mobileMenu) {

            mobileMenuButton.addEventListener('click', function () {

                mobileMenu.classList.toggle('hidden');

            });


            mobileMenu
                .querySelectorAll('a')
                .forEach(function (link) {

                    link.addEventListener('click', function () {

                        mobileMenu.classList.add('hidden');

                    });

                });

        }

    });

</script>