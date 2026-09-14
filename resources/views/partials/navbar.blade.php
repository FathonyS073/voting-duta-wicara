<nav
    class="
    fixed
    top-0
    left-0
    w-full
    z-50
    bg-white/90
    backdrop-blur-xl
    border-b
    border-gray-100
    ">

    {{-- ========================================================= --}}
    {{-- NAVBAR UTAMA --}}
    {{-- ========================================================= --}}

    <div
        class="
        max-w-7xl
        mx-auto
        px-4
        sm:px-6
        py-3
        sm:py-4
        flex
        items-center
        justify-between
        ">


        {{-- ===================================================== --}}
        {{-- LOGO --}}
        {{-- ===================================================== --}}

        <a href="{{ route('home') }}"
            class="
            flex
            items-center
            gap-3
            shrink-0
            ">

            <div
                class="
                w-10
                h-10
                sm:w-11
                sm:h-11

                rounded-xl

                bg-blue-600

                flex
                items-center
                justify-center

                text-white
                font-bold

                text-xl
                sm:text-2xl

                shadow-lg
                ">
                P
            </div>


            <div class="leading-tight">

                <h1
                    class="
                    font-bold
                    text-lg
                    sm:text-xl
                    ">
                    PICO
                </h1>


                <p
                    class="
                    hidden
                    sm:block

                    text-xs
                    text-gray-500
                    ">
                    Digital Voting Platform
                </p>

            </div>

        </a>



        {{-- ===================================================== --}}
        {{-- MENU DESKTOP --}}
        {{-- ===================================================== --}}

        <div
            class="
            hidden
            lg:flex

            items-center

            gap-7
            xl:gap-10

            text-sm
            font-medium
            text-gray-700
            ">

            <a href="{{ route('home') }}"
                class="
                hover:text-blue-600
                transition
                ">
                Home
            </a>


            <a href="{{ route('events.index') }}"
                class="
                hover:text-blue-600
                transition
                ">
                Event
            </a>


            <a href="{{ route('home') }}#ranking"
                class="
                hover:text-blue-600
                transition
                ">
                Ranking
            </a>


            <a href="{{ route('home') }}#cara-vote"
                class="
                hover:text-blue-600
                transition
                ">
                Cara Vote
            </a>


            <a href="{{ route('about') }}"
                class="
                hover:text-blue-600
                transition
                ">
                Tentang
            </a>

        </div>



        {{-- ===================================================== --}}
        {{-- ACTION DESKTOP --}}
        {{-- ===================================================== --}}

        <div class="
            hidden
            lg:flex
            items-center
            gap-3
            ">

            <a href="#"
                class="
                px-5
                py-2

                rounded-full

                border
                border-gray-300

                text-sm

                hover:bg-gray-50
                transition
                ">
                Masuk
            </a>


            <a href="{{ route('about') }}"
                class="
                bg-blue-600
                hover:bg-blue-700

                text-white

                px-6
                py-2.5

                rounded-full

                text-sm
                font-semibold

                shadow-lg

                transition
                ">
                Buat Event
            </a>

        </div>



        {{-- ===================================================== --}}
        {{-- MOBILE BUTTON --}}
        {{-- ===================================================== --}}

        <button type="button" id="mobileMenuButton" aria-label="Buka menu" aria-expanded="false"
            class="
            lg:hidden

            w-10
            h-10

            sm:w-11
            sm:h-11

            rounded-xl

            border
            border-gray-200

            flex
            items-center
            justify-center

            text-gray-700

            hover:bg-gray-50

            transition
            ">

            {{-- HAMBURGER --}}
            <svg id="mobileMenuOpenIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>


            {{-- CLOSE --}}
            <svg id="mobileMenuCloseIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" class="hidden w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>

        </button>

    </div>



    {{-- ========================================================= --}}
    {{-- MOBILE MENU --}}
    {{-- ========================================================= --}}

    <div id="mobileMenu"
        class="
        hidden
        lg:hidden

        bg-white/98
        backdrop-blur-xl

        border-t
        border-gray-100

        shadow-xl
        ">

        <div
            class="
            max-w-7xl
            mx-auto

            px-4
            sm:px-6

            py-5
            ">


            {{-- MENU LINKS --}}
            <div class="
                flex
                flex-col
                gap-1
                ">

                <a href="{{ route('home') }}"
                    class="
                    mobile-nav-link

                    flex
                    items-center

                    px-4
                    py-3

                    rounded-xl

                    font-medium
                    text-gray-700

                    hover:bg-blue-50
                    hover:text-blue-600

                    transition
                    ">
                    <span class="w-8">
                        🏠
                    </span>

                    Home
                </a>


                <a href="{{ route('events.index') }}"
                    class="
                    mobile-nav-link

                    flex
                    items-center

                    px-4
                    py-3

                    rounded-xl

                    font-medium
                    text-gray-700

                    hover:bg-blue-50
                    hover:text-blue-600

                    transition
                    ">
                    <span class="w-8">
                        📅
                    </span>

                    Event
                </a>


                <a href="{{ route('home') }}#ranking"
                    class="
                    mobile-nav-link

                    flex
                    items-center

                    px-4
                    py-3

                    rounded-xl

                    font-medium
                    text-gray-700

                    hover:bg-blue-50
                    hover:text-blue-600

                    transition
                    ">
                    <span class="w-8">
                        🏆
                    </span>

                    Ranking
                </a>


                <a href="{{ route('home') }}#cara-vote"
                    class="
                    mobile-nav-link

                    flex
                    items-center

                    px-4
                    py-3

                    rounded-xl

                    font-medium
                    text-gray-700

                    hover:bg-blue-50
                    hover:text-blue-600

                    transition
                    ">
                    <span class="w-8">
                        🗳️
                    </span>

                    Cara Vote
                </a>


                <a href="{{ route('about') }}"
                    class="
                    mobile-nav-link

                    flex
                    items-center

                    px-4
                    py-3

                    rounded-xl

                    font-medium
                    text-gray-700

                    hover:bg-blue-50
                    hover:text-blue-600

                    transition
                    ">
                    <span class="w-8">
                        ℹ️
                    </span>

                    Tentang
                </a>

            </div>



            {{-- DIVIDER --}}
            <div
                class="
                border-t
                border-gray-100

                my-5
                ">
            </div>



            {{-- MOBILE ACTION --}}
            <div class="
                grid
                grid-cols-2
                gap-3
                ">

                <a href="#"
                    class="
                    text-center

                    border
                    border-gray-300

                    text-gray-700

                    px-4
                    py-3

                    rounded-xl

                    font-semibold
                    text-sm

                    hover:bg-gray-50

                    transition
                    ">
                    Masuk
                </a>


                <a href="{{ route('home') }}#tentang"
                    class="
                    text-center

                    bg-blue-600
                    hover:bg-blue-700

                    text-white

                    px-4
                    py-3

                    rounded-xl

                    font-semibold
                    text-sm

                    shadow

                    transition
                    ">
                    + Buat Event
                </a>

            </div>



            {{-- MOBILE BRAND INFO --}}
            <div
                class="
                mt-5
                pt-5

                border-t
                border-gray-100

                text-center
                ">

                <p class="
                    text-xs
                    text-gray-400
                    ">
                    PICO — Digital Voting Platform
                </p>

            </div>


        </div>

    </div>

</nav>



{{-- ========================================================= --}}
{{-- NAVBAR JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const menuButton =
            document.getElementById(
                'mobileMenuButton'
            );


        const mobileMenu =
            document.getElementById(
                'mobileMenu'
            );


        const openIcon =
            document.getElementById(
                'mobileMenuOpenIcon'
            );


        const closeIcon =
            document.getElementById(
                'mobileMenuCloseIcon'
            );


        const mobileLinks =
            document.querySelectorAll(
                '.mobile-nav-link'
            );



        /*
        |--------------------------------------------------------------------------
        | TOGGLE MENU
        |--------------------------------------------------------------------------
        */

        function toggleMenu() {

            const isHidden =
                mobileMenu.classList.contains(
                    'hidden'
                );


            if (isHidden) {

                mobileMenu.classList.remove(
                    'hidden'
                );


                openIcon.classList.add(
                    'hidden'
                );


                closeIcon.classList.remove(
                    'hidden'
                );


                menuButton.setAttribute(
                    'aria-expanded',
                    'true'
                );

            } else {

                closeMenu();

            }

        }



        /*
        |--------------------------------------------------------------------------
        | CLOSE MENU
        |--------------------------------------------------------------------------
        */

        function closeMenu() {

            mobileMenu.classList.add(
                'hidden'
            );


            openIcon.classList.remove(
                'hidden'
            );


            closeIcon.classList.add(
                'hidden'
            );


            menuButton.setAttribute(
                'aria-expanded',
                'false'
            );

        }



        /*
        |--------------------------------------------------------------------------
        | BUTTON CLICK
        |--------------------------------------------------------------------------
        */

        menuButton.addEventListener(
            'click',
            toggleMenu
        );



        /*
        |--------------------------------------------------------------------------
        | CLOSE SETELAH PILIH MENU
        |--------------------------------------------------------------------------
        */

        mobileLinks.forEach(function(link) {

            link.addEventListener(
                'click',
                closeMenu
            );

        });



        /*
        |--------------------------------------------------------------------------
        | RESET SAAT KEMBALI KE DESKTOP
        |--------------------------------------------------------------------------
        */

        window.addEventListener(
            'resize',
            function() {

                if (
                    window.innerWidth >= 1024
                ) {

                    closeMenu();

                }

            }
        );

    });
</script>
