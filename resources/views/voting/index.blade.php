<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        PICO - Digital Voting Platform
    </title>

    @vite(['resources/css/app.css'])

</head>


<body class="bg-white text-gray-900 overflow-x-hidden">


    @include('partials.navbar')



    {{-- ========================================================= --}}
    {{-- HERO SECTION --}}
    {{-- ========================================================= --}}

    <section class="
        pt-24
        sm:pt-28
        lg:pt-32

        pb-16
        lg:pb-20

        bg-linear-to-br
        from-blue-50
        via-white
        to-blue-100

        overflow-hidden
        ">

        <div class="
            max-w-7xl
            mx-auto

            px-4
            sm:px-6

            grid
            grid-cols-1
            lg:grid-cols-2

            gap-10
            lg:gap-8

            items-center
            ">


            {{-- TEXT --}}
            <div class="
                text-center
                lg:text-left
                ">

                <p class="
                    text-blue-600
                    font-semibold
                    uppercase

                    tracking-[3px]
                    sm:tracking-[4px]

                    text-xs
                    sm:text-sm
                    ">
                    Suara Untuk Perubahan
                </p>



                <h1 class="
                    mt-4
                    sm:mt-5

                    text-4xl
                    sm:text-5xl
                    lg:text-6xl

                    font-bold
                    leading-[1.08]

                    text-[#14285a]
                    ">

                    Platform Voting Digital

                    <br>

                    <span class="text-blue-600">
                        untuk Berbagai Event
                    </span>

                </h1>



                <p class="
                    mt-5
                    sm:mt-6

                    text-gray-600

                    text-base
                    sm:text-lg

                    leading-relaxed

                    max-w-xl

                    mx-auto
                    lg:mx-0
                    ">
                    PICO memudahkan Anda untuk membuat,
                    mengikuti, dan mengelola voting online
                    dengan aman, mudah, dan realtime.
                    Dukung talenta, karya, dan komunitas favorit Anda.
                </p>



                {{-- BUTTON --}}
                <div class="
                    mt-7
                    sm:mt-8

                    flex
                    flex-col
                    sm:flex-row

                    items-stretch
                    sm:items-center

                    justify-center
                    lg:justify-start

                    gap-3
                    sm:gap-4
                    ">

                    <a href="#event" class="
                        bg-blue-600
                        hover:bg-blue-700

                        text-white
                        text-center

                        px-7
                        sm:px-8

                        py-3.5

                        rounded-xl

                        font-semibold

                        shadow-lg
                        transition
                        ">
                        Mulai Voting →
                    </a>


                    <a href="#tentang" class="
                        border
                        border-blue-500

                        text-blue-600
                        text-center

                        px-7
                        sm:px-8

                        py-3.5

                        rounded-xl

                        font-semibold

                        hover:bg-blue-50
                        transition
                        ">
                        + Buat Event
                    </a>

                </div>



                {{-- PEOPLE --}}
                <div class="
                    mt-7
                    sm:mt-8

                    flex
                    flex-col
                    sm:flex-row

                    items-center

                    justify-center
                    lg:justify-start

                    gap-3
                    sm:gap-4
                    ">

                    <div class="flex -space-x-3">

                        <img src="{{ asset('Images/people1.webp') }}" alt="Pengguna PICO" class="
                            w-9
                            h-9
                            sm:w-10
                            sm:h-10

                            rounded-full
                            object-cover

                            border-2
                            border-white
                            ">

                        <img src="{{ asset('Images/people2.webp') }}" alt="Pengguna PICO" class="
                            w-9
                            h-9
                            sm:w-10
                            sm:h-10

                            rounded-full
                            object-cover

                            border-2
                            border-white
                            ">

                        <img src="{{ asset('Images/people3.webp') }}" alt="Pengguna PICO" class="
                            w-9
                            h-9
                            sm:w-10
                            sm:h-10

                            rounded-full
                            object-cover

                            border-2
                            border-white
                            ">

                    </div>


                    <p class="
                        text-xs
                        sm:text-sm

                        text-gray-600

                        text-center
                        sm:text-left
                        ">
                        Bergabung dengan
                        <b>100.000+</b>
                        pengguna di seluruh Indonesia
                    </p>

                </div>

            </div>



            {{-- HERO IMAGE --}}
            <div class="
                relative

                flex
                justify-center
                items-center

                mt-2
                lg:mt-0

                min-h-[260px]
                sm:min-h-[340px]
                lg:min-h-[420px]
                ">

                <div class="
                    absolute

                    w-64
                    h-64

                    sm:w-80
                    sm:h-80

                    lg:w-96
                    lg:h-96

                    bg-blue-300

                    rounded-full

                    blur-3xl
                    opacity-30
                    "></div>


                <img src="{{ asset('Images/hero.webp') }}" alt="Platform Voting Digital PICO" class="
                    relative

                    w-full

                    max-w-sm
                    sm:max-w-lg
                    lg:max-w-xl

                    object-contain
                    ">

            </div>


        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- SEARCH EVENT --}}
    {{-- ========================================================= --}}

    {{-- ========================================================= --}}
    {{-- SEARCH EVENT --}}
    {{-- ========================================================= --}}

    <section class="
    max-w-7xl
    mx-auto
    px-4
    sm:px-6
    -mt-6
    sm:-mt-8
    relative
    z-10
    ">

        <div class="
        bg-white
        rounded-2xl
        sm:rounded-3xl
        shadow-xl
        p-4
        sm:p-5
        border
        border-gray-100
        ">

            <form action="{{ route('home') }}#event" method="GET">

                <div class="
                flex
                items-center
                gap-2
                sm:gap-3
                border
                border-gray-300
                rounded-full
                px-4
                sm:px-5
                py-2.5
                sm:py-3
                ">

                    <span class="shrink-0">
                        🔍
                    </span>


                    <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari event atau voting..."
                        class="
                    w-full
                    min-w-0
                    bg-transparent
                    outline-none
                    text-sm
                    sm:text-base
                    ">


                    @if(!empty($search))

                    <a href="{{ route('home') }}#event" class="
                        shrink-0
                        text-gray-400
                        hover:text-red-500
                        px-2
                        ">
                        ✕
                    </a>

                    @endif


                    <button type="submit" class="
                    shrink-0
                    bg-blue-600
                    hover:bg-blue-700
                    text-white
                    w-10
                    h-10
                    sm:w-auto
                    sm:h-auto
                    sm:px-6
                    sm:py-2.5
                    rounded-full
                    flex
                    items-center
                    justify-center
                    transition
                    ">
                        →
                    </button>

                </div>

            </form>


            {{-- FILTER VISUAL --}}
            <div class="
            flex
            gap-2
            sm:gap-3
            mt-4
            sm:mt-5
            flex-wrap
            ">

                <a href="{{ route('home') }}#event" class="
                bg-blue-600
                text-white
                px-4
                sm:px-5
                py-2
                rounded-full
                text-xs
                sm:text-sm
                ">
                    🔥 Populer
                </a>


                <button type="button" class="
                border
                px-4
                sm:px-5
                py-2
                rounded-full
                text-xs
                sm:text-sm
                ">
                    Terbaru
                </button>


                <button type="button" class="
                border
                px-4
                sm:px-5
                py-2
                rounded-full
                text-xs
                sm:text-sm
                ">
                    ♛ Pageant
                </button>


                <button type="button" class="
                border
                px-4
                sm:px-5
                py-2
                rounded-full
                text-xs
                sm:text-sm
                ">
                    👥 Organisasi
                </button>


                <button type="button" class="
                border
                px-4
                sm:px-5
                py-2
                rounded-full
                text-xs
                sm:text-sm
                ">
                    🏆 Kompetisi
                </button>

            </div>


            @if(!empty($search))

            <div class="
                mt-4
                text-sm
                text-gray-500
                ">

                Hasil pencarian untuk:

                <strong class="text-[#14285a]">
                    "{{ $search }}"
                </strong>

            </div>

            @endif

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- STATISTIC --}}
    {{-- ========================================================= --}}

    <section class="
        max-w-7xl
        mx-auto

        px-4
        sm:px-6

        py-12
        sm:py-16
        ">

        <div class="
            grid

            grid-cols-2
            lg:grid-cols-4

            gap-3
            sm:gap-4
            lg:gap-6
            ">


            <div class="
                bg-blue-50

                rounded-2xl
                sm:rounded-3xl

                p-4
                sm:p-6
                ">

                <h2 class="
                    text-2xl
                    sm:text-3xl

                    font-bold
                    text-blue-600
                    ">
                    500+
                </h2>

                <p class="
                    mt-1

                    text-xs
                    sm:text-base
                    ">
                    Event Telah Dibuat
                </p>

            </div>



            <div class="
                bg-green-50

                rounded-2xl
                sm:rounded-3xl

                p-4
                sm:p-6
                ">

                <h2 class="
                    text-2xl
                    sm:text-3xl

                    font-bold
                    text-green-600
                    ">
                    50.000+
                </h2>

                <p class="
                    mt-1

                    text-xs
                    sm:text-base
                    ">
                    Peserta Terdaftar
                </p>

            </div>



            <div class="
                bg-yellow-50

                rounded-2xl
                sm:rounded-3xl

                p-4
                sm:p-6
                ">

                <h2 class="
                    text-2xl
                    sm:text-3xl

                    font-bold
                    text-yellow-600
                    ">
                    1 Juta+
                </h2>

                <p class="
                    mt-1

                    text-xs
                    sm:text-base
                    ">
                    Vote Terkumpul
                </p>

            </div>



            <div class="
                bg-purple-50

                rounded-2xl
                sm:rounded-3xl

                p-4
                sm:p-6
                ">

                <h2 class="
                    text-2xl
                    sm:text-3xl

                    font-bold
                    text-purple-600
                    ">
                    24/7
                </h2>

                <p class="
                    mt-1

                    text-xs
                    sm:text-base
                    ">
                    Sistem Realtime
                </p>

            </div>


        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- POPULAR EVENT --}}
    {{-- ========================================================= --}}

    <section id="event" class="
    max-w-7xl
    mx-auto
    px-4
    sm:px-6
    pb-14
    sm:pb-20
    ">

        {{-- HEADER --}}
        <div class="
        flex
        items-end
        justify-between
        gap-4
        mb-7
        ">

            <div>

                <h2 class="
                text-2xl
                sm:text-3xl
                font-bold
                text-[#14285a]
                ">
                    @if(!empty($search))
                    Hasil Pencarian
                    @else
                    Vote Terpopuler
                    @endif
                </h2>


                <p class="
                mt-1
                text-sm
                sm:text-base
                text-gray-500
                ">
                    @if(!empty($search))

                    Event yang sesuai dengan pencarian
                    "{{ $search }}"

                    @else

                    Temukan event menarik dan dukung favorit Anda

                    @endif
                </p>

            </div>


            <div class="
            flex
            items-center
            gap-3
            shrink-0
            ">

                <a href="{{ route('events.index') }}" class="
                hidden
                md:inline
                text-blue-600
                font-semibold
                text-sm
                ">
                    Lihat Semua Event →
                </a>


                {{-- TOMBOL SLIDER HANYA JIKA > 4 EVENT --}}
                @if($popularEvents->count() > 4)

                <button type="button" id="eventSliderPrev" class="
                    hidden
                    sm:flex
                    w-10
                    h-10
                    rounded-full
                    border
                    border-gray-200
                    bg-white
                    items-center
                    justify-center
                    hover:border-blue-500
                    hover:text-blue-600
                    transition
                    ">
                    ←
                </button>


                <button type="button" id="eventSliderNext" class="
                    hidden
                    sm:flex
                    w-10
                    h-10
                    rounded-full
                    bg-blue-600
                    text-white
                    items-center
                    justify-center
                    hover:bg-blue-700
                    transition
                    ">
                    →
                </button>

                @endif

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- SLIDER VIEWPORT --}}
        {{-- ========================================================= --}}

        <div class="overflow-hidden">

            <div id="eventSlider" class="
            flex
            gap-4

            overflow-x-auto
            scroll-smooth

            snap-x
            snap-mandatory

            pb-5

            [scrollbar-width:none]
            [&::-webkit-scrollbar]:hidden
            ">

                @forelse($popularEvents as $event)

                <article class="
                    event-slide
                    snap-start
                    shrink-0

                    basis-[88%]
                    sm:basis-[calc((100%_-_1rem)/2)]
                    lg:basis-[calc((100%_-_3rem)/4)]

                    bg-white

                    rounded-2xl

                    border
                    border-gray-100

                    shadow-md

                    overflow-hidden

                    flex
                    flex-col

                    hover:-translate-y-1
                    hover:shadow-xl

                    transition
                    duration-300
                    ">


                    {{-- BANNER --}}
                    <div class="
                        w-full
                        h-40
                        overflow-hidden
                        bg-gray-100
                        ">

                        @if($event->banner)

                        <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->name }}" class="
                                w-full
                                h-full
                                object-cover
                                ">

                        @else

                        <div class="
                                w-full
                                h-full
                                flex
                                items-center
                                justify-center
                                bg-blue-50
                                text-blue-600
                                font-bold
                                ">
                            PICO
                        </div>

                        @endif

                    </div>



                    {{-- CONTENT --}}
                    <div class="
                        p-4
                        flex
                        flex-col
                        flex-1
                        ">

                        {{-- TITLE --}}
                        <h3 class="
                            text-base
                            font-bold
                            leading-6
                            line-clamp-2
                            min-h-[48px]
                            ">
                            {{ $event->name }}
                        </h3>



                        {{-- DESCRIPTION --}}
                        <p class="
                            mt-2
                            text-xs
                            text-gray-500
                            leading-5
                            line-clamp-2
                            min-h-[40px]
                            ">
                            {{ $event->description }}
                        </p>



                        {{-- INFO --}}
                        <div class="
                            mt-4
                            pt-4
                            border-t
                            border-gray-100

                            flex
                            items-center
                            justify-between
                            gap-2

                            text-[11px]
                            text-gray-500
                            ">

                            <span class="truncate">

                                📅

                                @if($event->start_date)
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                @else
                                -
                                @endif

                            </span>


                            <span class="shrink-0">
                                👥
                                {{ $event->candidates_count ?? 0 }}
                                Finalis
                            </span>

                        </div>



                        {{-- TOTAL VOTE --}}
                        <div class="
                            mt-3
                            flex
                            items-center
                            justify-between
                            ">

                            <span class="
                                text-[11px]
                                text-gray-400
                                ">
                                Total dukungan
                            </span>


                            <strong class="
                                text-sm
                                text-blue-600
                                ">
                                {{ number_format(
                                    $event->total_votes ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                                vote
                            </strong>

                        </div>



                        {{-- BUTTON --}}
                        <a href="{{ route('event.detail', $event) }}" class="
                            mt-auto
                            pt-4
                            ">

                            <span class="
                                block
                                w-full
                                text-center

                                bg-blue-600
                                hover:bg-blue-700

                                text-white

                                py-2.5

                                rounded-xl

                                text-sm
                                font-semibold

                                transition
                                ">
                                Lihat Event →
                            </span>

                        </a>

                    </div>

                </article>


                @empty

                <div class="
                    w-full
                    bg-blue-50
                    border
                    border-blue-100
                    rounded-2xl
                    p-10
                    text-center
                    ">

                    <p class="font-bold">
                        Belum ada event tersedia.
                    </p>

                </div>

                @endforelse

            </div>

        </div>



        {{-- MOBILE HINT --}}
        @if($popularEvents->count() > 1)

        <p class="
            sm:hidden
            text-center
            text-xs
            text-gray-400
            mt-1
            ">
            ← Geser untuk melihat event lainnya →
        </p>

        @endif

    </section>



    {{-- ========================================================= --}}
    {{-- CARA VOTE --}}
    {{-- ========================================================= --}}

    <section id="cara-vote" class="
        max-w-7xl
        mx-auto

        px-4
        sm:px-6

        py-2
        sm:py-6
        ">


        {{-- HEADER --}}
        <div class="
            mb-10
            sm:mb-12

            text-center
            lg:text-left
            ">

            <p class="
                text-blue-600

                text-xs
                sm:text-sm

                font-semibold

                uppercase

                tracking-[3px]
                sm:tracking-[4px]
                ">
                Mudah & Cepat
            </p>


            <h2 class="
                mt-3

                text-2xl
                sm:text-3xl

                font-bold

                text-[#14285a]
                ">
                Bagaimana Cara Vote?
            </h2>


            <p class="
                mt-2

                text-sm
                sm:text-base

                text-gray-500

                max-w-2xl

                mx-auto
                lg:mx-0
                ">
                Ikuti beberapa langkah sederhana untuk memberikan
                dukungan kepada kandidat favorit Anda.
            </p>

        </div>



        {{-- STEPS --}}
        <div class="
            grid

            grid-cols-1
            sm:grid-cols-2
            lg:grid-cols-5

            gap-5
            sm:gap-6
            ">


            {{-- STEP 1 --}}
            <div class="
                relative

                text-center

                bg-white

                lg:bg-transparent

                border
                lg:border-0

                border-gray-100

                rounded-2xl

                p-5
                lg:p-0
                ">

                <div class="
                    w-16
                    h-16

                    sm:w-20
                    sm:h-20

                    mx-auto

                    rounded-2xl
                    sm:rounded-3xl

                    bg-blue-50

                    flex
                    items-center
                    justify-center

                    text-2xl
                    sm:text-3xl
                    ">
                    🔍
                </div>


                <div class="
                    w-7
                    h-7

                    -mt-3

                    mx-auto

                    rounded-full

                    bg-blue-600

                    text-white
                    text-xs
                    font-bold

                    flex
                    items-center
                    justify-center
                    ">
                    1
                </div>


                <h3 class="
                    font-bold

                    text-base
                    sm:text-lg

                    mt-4
                    ">
                    Pilih Event
                </h3>


                <p class="
                    text-sm
                    text-gray-500

                    leading-6

                    mt-2
                    ">
                    Temukan event voting yang ingin Anda ikuti.
                </p>

            </div>



            {{-- STEP 2 --}}
            <div class="
                relative
                text-center

                bg-white
                lg:bg-transparent

                border
                lg:border-0

                border-gray-100

                rounded-2xl

                p-5
                lg:p-0
                ">

                <div class="
                    w-16
                    h-16

                    sm:w-20
                    sm:h-20

                    mx-auto

                    rounded-2xl
                    sm:rounded-3xl

                    bg-indigo-50

                    flex
                    items-center
                    justify-center

                    text-2xl
                    sm:text-3xl
                    ">
                    👥
                </div>


                <div class="
                    w-7
                    h-7

                    -mt-3

                    mx-auto

                    rounded-full

                    bg-blue-600

                    text-white
                    text-xs
                    font-bold

                    flex
                    items-center
                    justify-center
                    ">
                    2
                </div>


                <h3 class="font-bold text-base sm:text-lg mt-4">
                    Pilih Finalis
                </h3>


                <p class="text-sm text-gray-500 leading-6 mt-2">
                    Lihat profil finalis dan tentukan kandidat favorit.
                </p>

            </div>



            {{-- STEP 3 --}}
            <div class="
                relative
                text-center

                bg-white
                lg:bg-transparent

                border
                lg:border-0

                border-gray-100

                rounded-2xl

                p-5
                lg:p-0
                ">

                <div class="
                    w-16
                    h-16

                    sm:w-20
                    sm:h-20

                    mx-auto

                    rounded-2xl
                    sm:rounded-3xl

                    bg-sky-50

                    flex
                    items-center
                    justify-center

                    text-2xl
                    sm:text-3xl
                    ">
                    🗳️
                </div>


                <div class="
                    w-7
                    h-7

                    -mt-3

                    mx-auto

                    rounded-full

                    bg-blue-600

                    text-white
                    text-xs
                    font-bold

                    flex
                    items-center
                    justify-center
                    ">
                    3
                </div>


                <h3 class="font-bold text-base sm:text-lg mt-4">
                    Pilih Jumlah Vote
                </h3>


                <p class="text-sm text-gray-500 leading-6 mt-2">
                    Tentukan jumlah vote yang ingin Anda berikan.
                </p>

            </div>



            {{-- STEP 4 --}}
            <div class="
                relative
                text-center

                bg-white
                lg:bg-transparent

                border
                lg:border-0

                border-gray-100

                rounded-2xl

                p-5
                lg:p-0
                ">

                <div class="
                    w-16
                    h-16

                    sm:w-20
                    sm:h-20

                    mx-auto

                    rounded-2xl
                    sm:rounded-3xl

                    bg-violet-50

                    flex
                    items-center
                    justify-center

                    text-2xl
                    sm:text-3xl
                    ">
                    💳
                </div>


                <div class="
                    w-7
                    h-7

                    -mt-3

                    mx-auto

                    rounded-full

                    bg-blue-600

                    text-white
                    text-xs
                    font-bold

                    flex
                    items-center
                    justify-center
                    ">
                    4
                </div>


                <h3 class="font-bold text-base sm:text-lg mt-4">
                    Lakukan Pembayaran
                </h3>


                <p class="text-sm text-gray-500 leading-6 mt-2">
                    Selesaikan pembayaran melalui metode yang tersedia.
                </p>

            </div>



            {{-- STEP 5 --}}
            <div class="
                relative
                text-center

                bg-white
                lg:bg-transparent

                border
                lg:border-0

                border-gray-100

                rounded-2xl

                p-5
                lg:p-0

                sm:col-span-2
                lg:col-span-1
                ">

                <div class="
                    w-16
                    h-16

                    sm:w-20
                    sm:h-20

                    mx-auto

                    rounded-2xl
                    sm:rounded-3xl

                    bg-emerald-50

                    flex
                    items-center
                    justify-center

                    text-2xl
                    sm:text-3xl
                    ">
                    ✅
                </div>


                <div class="
                    w-7
                    h-7

                    -mt-3

                    mx-auto

                    rounded-full

                    bg-green-500

                    text-white
                    text-xs
                    font-bold

                    flex
                    items-center
                    justify-center
                    ">
                    5
                </div>


                <h3 class="font-bold text-base sm:text-lg mt-4">
                    Vote Berhasil
                </h3>


                <p class="text-sm text-gray-500 leading-6 mt-2">
                    Dukungan Anda akan tercatat setelah pembayaran berhasil.
                </p>

            </div>


        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- CTA ORGANIZER --}}
    {{-- ========================================================= --}}

    <section id="tentang" class="
        max-w-7xl
        mx-auto

        px-4
        sm:px-6

        pb-14
        sm:pb-20
        ">

        <div class="
            relative
            overflow-hidden

            rounded-2xl
            sm:rounded-[32px]

            bg-linear-to-r
            from-[#0c2858]
            via-[#0d3975]
            to-[#1265c7]

            text-white

            px-6
            sm:px-8
            lg:px-12

            py-8
            sm:py-10
            lg:py-12

            shadow-xl
            ">


            {{-- DECORATION --}}
            <div class="
                absolute

                -right-24
                -top-28

                w-72
                h-72

                sm:w-96
                sm:h-96

                rounded-full

                bg-blue-300/20
                blur-3xl
                "></div>


            <div class="
                absolute

                right-20
                lg:right-52

                -bottom-44

                w-64
                h-64

                lg:w-80
                lg:h-80

                rounded-full

                bg-white/10
                blur-3xl
                "></div>



            <div class="
                relative

                grid

                grid-cols-1
                lg:grid-cols-[1.3fr_1fr]

                gap-10
                lg:gap-12

                items-center
                ">


                {{-- TEXT --}}
                <div class="
                    text-center
                    lg:text-left
                    ">

                    <p class="
                        text-blue-200

                        text-xs

                        font-semibold

                        uppercase

                        tracking-[3px]
                        sm:tracking-[4px]
                        ">
                        Untuk Organizer
                    </p>


                    <h2 class="
                        mt-3

                        text-3xl
                        sm:text-4xl

                        font-bold

                        leading-tight
                        ">
                        Punya Event?

                        <br>

                        Kelola Voting dengan PICO
                    </h2>


                    <p class="
                        mt-5

                        text-sm
                        sm:text-base

                        text-white/70

                        leading-7

                        max-w-2xl

                        mx-auto
                        lg:mx-0
                        ">
                        Buat dan kelola event voting dengan lebih mudah,
                        aman, dan profesional. Pantau peserta, transaksi,
                        serta perolehan vote melalui satu platform.
                    </p>



                    <a href="#" class="
                        inline-flex
                        items-center
                        justify-center

                        gap-3

                        mt-7

                        bg-[#ffd45c]
                        hover:bg-[#ffcb37]

                        text-[#10204f]

                        px-7
                        py-3.5

                        rounded-xl

                        font-bold

                        shadow-lg

                        transition
                        ">
                        Buat Event Sekarang

                        <span>→</span>
                    </a>

                </div>



                {{-- FEATURES --}}
                <div class="
                    grid

                    grid-cols-1
                    sm:grid-cols-2

                    gap-3
                    sm:gap-4
                    ">


                    <div class="
                        bg-white/10
                        backdrop-blur

                        border
                        border-white/10

                        rounded-2xl

                        p-5
                        ">

                        <div class="text-2xl">
                            📅
                        </div>

                        <p class="font-bold mt-3">
                            Multi Event
                        </p>

                        <p class="text-sm text-white/60 mt-1">
                            Kelola berbagai event voting.
                        </p>

                    </div>



                    <div class="
                        bg-white/10
                        backdrop-blur

                        border
                        border-white/10

                        rounded-2xl

                        p-5
                        ">

                        <div class="text-2xl">
                            📊
                        </div>

                        <p class="font-bold mt-3">
                            Ranking Realtime
                        </p>

                        <p class="text-sm text-white/60 mt-1">
                            Pantau perolehan vote kandidat.
                        </p>

                    </div>



                    <div class="
                        bg-white/10
                        backdrop-blur

                        border
                        border-white/10

                        rounded-2xl

                        p-5
                        ">

                        <div class="text-2xl">
                            📄
                        </div>

                        <p class="font-bold mt-3">
                            Laporan
                        </p>

                        <p class="text-sm text-white/60 mt-1">
                            Data transaksi lebih terstruktur.
                        </p>

                    </div>



                    <div class="
                        bg-white/10
                        backdrop-blur

                        border
                        border-white/10

                        rounded-2xl

                        p-5
                        ">

                        <div class="text-2xl">
                            🔒
                        </div>

                        <p class="font-bold mt-3">
                            Pembayaran Aman
                        </p>

                        <p class="text-sm text-white/60 mt-1">
                            Terintegrasi payment gateway.
                        </p>

                    </div>


                </div>


            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="
        bg-[#0a1b3d]
        text-white
        ">

        <div class="
            max-w-7xl
            mx-auto

            px-4
            sm:px-6

            py-10
            sm:py-14

            grid

            grid-cols-1
            sm:grid-cols-2
            lg:grid-cols-[1.5fr_1fr_1fr_1fr]

            gap-9
            lg:gap-12
            ">


            {{-- BRAND --}}
            <div class="
                sm:col-span-2
                lg:col-span-1
                ">

                <div class="flex items-center gap-3">

                    <div class="
                        w-11
                        h-11
                        sm:w-12
                        sm:h-12

                        rounded-xl

                        bg-blue-600

                        flex
                        items-center
                        justify-center

                        font-bold

                        text-xl
                        sm:text-2xl
                        ">
                        P
                    </div>


                    <div>

                        <p class="
                            font-bold

                            text-2xl
                            sm:text-3xl
                            ">
                            PICO
                        </p>

                        <p class="text-xs text-white/50">
                            Digital Voting Platform
                        </p>

                    </div>

                </div>



                <p class="
                    mt-5

                    text-sm
                    text-white/60

                    leading-6

                    max-w-sm
                    ">
                    Platform voting digital untuk berbagai event di Indonesia.
                    Setiap suara menciptakan peluang yang lebih besar.
                </p>



                <div class="flex gap-3 mt-6">

                    <div class="
                        w-9
                        h-9

                        rounded-lg

                        border
                        border-white/10

                        flex
                        items-center
                        justify-center
                        ">
                        IG
                    </div>


                    <div class="
                        w-9
                        h-9

                        rounded-lg

                        border
                        border-white/10

                        flex
                        items-center
                        justify-center
                        ">
                        YT
                    </div>


                    <div class="
                        w-9
                        h-9

                        rounded-lg

                        border
                        border-white/10

                        flex
                        items-center
                        justify-center
                        ">
                        TT
                    </div>

                </div>

            </div>



            {{-- NAV --}}
            <div>

                <h3 class="font-bold">
                    Navigasi
                </h3>

                <div class="
                    mt-5

                    space-y-3

                    text-sm
                    text-white/60
                    ">

                    <a href="{{ route('home') }}" class="block hover:text-white">
                        Beranda
                    </a>

                    <a href="#event" class="block hover:text-white">
                        Event
                    </a>

                    <a href="#cara-vote" class="block hover:text-white">
                        Cara Vote
                    </a>

                    <a href="#tentang" class="block hover:text-white">
                        Tentang PICO
                    </a>

                </div>

            </div>



            {{-- HELP --}}
            <div>

                <h3 class="font-bold">
                    Bantuan
                </h3>

                <div class="
                    mt-5
                    space-y-3

                    text-sm
                    text-white/60
                    ">

                    <p>Pusat Bantuan</p>
                    <p>Kebijakan Privasi</p>
                    <p>Syarat & Ketentuan</p>
                    <p>Hubungi Kami</p>
                    <p>FAQ</p>

                </div>

            </div>



            {{-- CONTACT --}}
            <div>

                <h3 class="font-bold">
                    Kontak
                </h3>

                <div class="
                    mt-5
                    space-y-4

                    text-sm
                    text-white/60
                    ">

                    <p class="break-all">
                        ✉ hello@pico.id
                    </p>

                    <p>
                        ☎ +62 xxx xxxx xxxx
                    </p>

                    <p>
                        📍 Indonesia
                    </p>

                </div>


                <p class="
                    mt-8

                    text-[#ffd45c]

                    italic

                    leading-6
                    ">
                    “Setiap suara
                    <br>
                    membuat perubahan.”
                </p>

            </div>


        </div>



        {{-- COPYRIGHT --}}
        <div class="border-t border-white/10">

            <div class="
                max-w-7xl
                mx-auto

                px-4
                sm:px-6

                py-5

                flex
                flex-col
                sm:flex-row

                gap-2

                sm:items-center
                sm:justify-between

                text-xs
                text-white/40
                ">

                <p>
                    © {{ date('Y') }} PICO. All rights reserved.
                </p>

                <p>
                    Dibangun untuk Indonesia ♥
                </p>

            </div>

        </div>

    </footer>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const slider =
            document.getElementById('eventSlider');

        const prevButton =
            document.getElementById('eventSliderPrev');

        const nextButton =
            document.getElementById('eventSliderNext');


        if (!slider) {
            return;
        }


        function getSlideDistance() {

            const firstSlide =
                slider.querySelector('.event-slide');

            if (!firstSlide) {
                return 0;
            }


            const slideWidth =
                firstSlide.getBoundingClientRect().width;


            const computedStyle =
                window.getComputedStyle(slider);


            const gap =
                parseFloat(computedStyle.gap) || 16;


            /*
            |--------------------------------------------------------------------------
            | Desktop = 4 card
            | Tablet  = 2 card
            | Mobile  = 1 card
            |--------------------------------------------------------------------------
            */

            if (window.innerWidth >= 1024) {

                return (slideWidth + gap) * 4;

            }


            if (window.innerWidth >= 640) {

                return (slideWidth + gap) * 2;

            }


            return slideWidth + gap;

        }



        if (nextButton) {

            nextButton.addEventListener(
                'click',
                function() {

                    slider.scrollBy({
                        left: getSlideDistance(),
                        behavior: 'smooth'
                    });

                }
            );

        }



        if (prevButton) {

            prevButton.addEventListener(
                'click',
                function() {

                    slider.scrollBy({
                        left: -getSlideDistance(),
                        behavior: 'smooth'
                    });

                }
            );

        }

    });
    </script>


</body>

</html>