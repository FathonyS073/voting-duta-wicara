<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $candidate->name }} - {{ $event->name }} - PICO
    </title>

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#f8faff] text-[#10204f] overflow-x-hidden">


    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    @include('partials.navbar')



    @php

        $totalVotes = (int) ($candidate->total_votes ?? 0);

    @endphp



    {{-- ========================================================= --}}
    {{-- BREADCRUMB --}}
    {{-- ========================================================= --}}

    <section class="pt-20 sm:pt-24">

        <div
            class="
        max-w-7xl
        mx-auto
        px-4
        sm:px-6
        pt-5
        sm:pt-7
        ">

            <div
                class="
            flex
            items-center
            gap-2

            text-xs
            sm:text-sm

            text-gray-500

            overflow-hidden
            ">

                <a href="{{ route('home') }}"
                    class="
                shrink-0
                hover:text-blue-600
                transition
                ">
                    Beranda
                </a>


                <span class="shrink-0">
                    ›
                </span>


                <a href="{{ route('event.detail', $event) }}"
                    class="
                truncate
                max-w-[130px]
                sm:max-w-xs

                hover:text-blue-600
                transition
                ">
                    {{ $event->name }}
                </a>


                <span class="shrink-0">
                    ›
                </span>


                <span
                    class="
                text-[#10204f]
                font-medium
                truncate
                ">
                    {{ $candidate->name }}
                </span>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- CANDIDATE HERO --}}
    {{-- ========================================================= --}}

    <section class="py-5 sm:py-8">

        <div class="
        max-w-7xl
        mx-auto
        px-4
        sm:px-6
        ">

            <div
                class="
            grid
            grid-cols-1
            lg:grid-cols-[420px_1fr]

            bg-white

            rounded-2xl
            sm:rounded-[30px]

            overflow-hidden

            border
            border-blue-100

            shadow-sm
            ">


                {{-- ================================================= --}}
                {{-- FOTO --}}
                {{-- ================================================= --}}

                <div
                    class="
                relative

                bg-linear-to-br
                from-[#eaf3ff]
                via-[#edf4ff]
                to-[#d8e8ff]

                p-5
                sm:p-7
                lg:p-8

                flex
                items-center
                justify-center

                overflow-hidden
                ">


                    {{-- DECORATION --}}
                    <div
                        class="
                    absolute
                    -top-16
                    -left-16

                    w-52
                    h-52
                    sm:w-64
                    sm:h-64

                    rounded-full

                    bg-blue-300/30
                    blur-3xl
                    ">
                    </div>


                    <div
                        class="
                    absolute
                    -bottom-20
                    -right-12

                    w-56
                    h-56
                    sm:w-72
                    sm:h-72

                    rounded-full

                    bg-indigo-300/20
                    blur-3xl
                    ">
                    </div>



                    <div
                        class="
                    relative

                    w-full

                    max-w-[250px]
                    sm:max-w-[300px]
                    lg:max-w-[330px]

                    aspect-[4/5]

                    rounded-2xl
                    sm:rounded-[28px]

                    overflow-hidden

                    bg-white

                    shadow-xl

                    border
                    border-white
                    ">

                        @if ($candidate->photo)
                            <img src="{{ asset('storage/' . $candidate->photo) }}" alt="{{ $candidate->name }}"
                                class="
                            w-full
                            h-full
                            object-cover
                            ">
                        @else
                            <div
                                class="
                            w-full
                            h-full

                            flex
                            items-center
                            justify-center

                            bg-blue-50
                            text-blue-600

                            text-6xl
                            sm:text-7xl

                            font-bold
                            ">
                                {{ mb_substr($candidate->name, 0, 1) }}
                            </div>
                        @endif

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- INFORMASI UTAMA --}}
                {{-- ================================================= --}}

                <div
                    class="
                p-5
                sm:p-8
                lg:p-12

                flex
                flex-col
                justify-center
                ">

                    <p
                        class="
                    text-blue-600

                    tracking-[3px]
                    sm:tracking-[4px]

                    uppercase

                    text-xs
                    font-bold
                    ">
                        Kandidat PICO
                    </p>



                    <h1
                        class="
                    mt-3
                    sm:mt-4

                    text-3xl
                    sm:text-4xl
                    lg:text-5xl

                    leading-tight

                    font-extrabold
                    tracking-tight

                    text-[#10204f]

                    break-words
                    ">
                        {{ $candidate->name }}
                    </h1>



                    {{-- EVENT --}}
                    <div
                        class="
                    mt-5

                    flex
                    items-center

                    gap-3
                    ">

                        <div
                            class="
                        w-9
                        h-9

                        rounded-xl

                        bg-blue-600

                        text-white

                        flex
                        items-center
                        justify-center

                        text-sm
                        font-bold

                        shrink-0
                        ">
                            P
                        </div>


                        <div class="min-w-0">

                            <p class="text-xs text-gray-400">
                                Finalis Event
                            </p>


                            <a href="{{ route('event.detail', $event) }}"
                                class="
                            block

                            font-semibold

                            text-sm
                            sm:text-base

                            truncate

                            hover:text-blue-600
                            transition
                            ">
                                {{ $event->name }}
                            </a>

                        </div>

                    </div>



                    {{-- LOCATION --}}
                    <div
                        class="
                    mt-5
                    sm:mt-6

                    flex
                    items-start

                    gap-2

                    text-sm
                    sm:text-base

                    text-gray-500
                    ">

                        <span class="shrink-0">
                            📍
                        </span>


                        <span>
                            {{ $candidate->city ?: '-' }}

                            @if ($candidate->province)
                                , {{ $candidate->province }}
                            @endif
                        </span>

                    </div>



                    {{-- CATEGORIES --}}
                    @if ($candidate->categories->count())

                        <div
                            class="
                        mt-5
                        sm:mt-6

                        flex
                        flex-wrap

                        gap-2
                        ">

                            @foreach ($candidate->categories as $category)
                                <span
                                    class="
                                bg-blue-50

                                border
                                border-blue-100

                                text-blue-700

                                px-3
                                sm:px-4

                                py-2

                                rounded-full

                                text-xs
                                sm:text-sm

                                font-medium
                                ">
                                    {{ $category->name }}
                                </span>
                            @endforeach

                        </div>

                    @endif



                    {{-- TOTAL VOTE --}}
                    <div
                        class="
                    mt-7
                    sm:mt-8

                    w-full
                    sm:max-w-md

                    rounded-2xl
                    sm:rounded-3xl

                    bg-linear-to-r
                    from-[#f6f8ff]
                    to-[#eef4ff]

                    border
                    border-blue-100

                    px-5
                    sm:px-6

                    py-4
                    sm:py-5
                    ">

                        <p class="text-sm text-gray-500">
                            Total Dukungan
                        </p>


                        <div
                            class="
                        flex
                        items-end

                        gap-2

                        mt-1
                        ">

                            <span
                                class="
                            text-3xl
                            sm:text-4xl

                            font-extrabold

                            text-blue-600
                            ">
                                {{ number_format($totalVotes, 0, ',', '.') }}
                            </span>


                            <span
                                class="
                            text-gray-500
                            mb-1
                            ">
                                vote
                            </span>

                        </div>

                    </div>



                    {{-- BUTTON --}}
                    <div
                        class="
                    mt-7
                    sm:mt-8

                    grid
                    grid-cols-1
                    sm:flex

                    gap-3
                    ">

                        <a href="{{ route('candidate.vote', $candidate) }}"
                            class="
                        inline-flex
                        items-center
                        justify-center

                        gap-2

                        bg-blue-600
                        hover:bg-blue-700

                        text-white

                        px-7
                        sm:px-8

                        py-3.5

                        rounded-xl

                        font-semibold

                        shadow-lg

                        transition
                        ">
                            Vote Sekarang
                            <span>→</span>
                        </a>


                        <a href="{{ route('event.detail', $event) }}?tab=finalis"
                            class="
                        inline-flex
                        items-center
                        justify-center

                        border
                        border-gray-200

                        hover:border-blue-300
                        hover:text-blue-600

                        px-6
                        py-3.5

                        rounded-xl

                        font-semibold

                        transition
                        ">
                            ← Semua Finalis
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- DETAIL CONTENT --}}
    {{-- ========================================================= --}}

    <section class="pb-10 sm:pb-12">

        <div
            class="
        max-w-7xl
        mx-auto

        px-4
        sm:px-6

        grid
        grid-cols-1
        lg:grid-cols-[1fr_340px]

        gap-5
        sm:gap-6
        lg:gap-7

        items-start
        ">


            {{-- ================================================= --}}
            {{-- LEFT --}}
            {{-- ================================================= --}}

            <div class="space-y-5 sm:space-y-6">


                {{-- ABOUT --}}
                <div
                    class="
                bg-white

                rounded-2xl
                sm:rounded-[26px]

                border
                border-gray-100

                shadow-sm

                p-5
                sm:p-8
                ">

                    <p
                        class="
                    text-blue-600
                    text-xs
                    uppercase
                    tracking-[3px]
                    sm:tracking-[4px]
                    font-semibold
                    ">
                        Profil
                    </p>


                    <h2
                        class="
                    text-2xl
                    sm:text-3xl

                    font-extrabold

                    mt-3
                    ">
                        Tentang Kandidat
                    </h2>


                    <div
                        class="
                    mt-5
                    sm:mt-6

                    text-sm
                    sm:text-base

                    text-gray-600

                    leading-7
                    sm:leading-8

                    whitespace-pre-line

                    break-words
                    ">
                        {{ $candidate->bio ?: 'Profil kandidat belum tersedia.' }}
                    </div>

                </div>



                {{-- VISI --}}
                <div
                    class="
                bg-white

                rounded-2xl
                sm:rounded-[26px]

                border
                border-gray-100

                shadow-sm

                p-5
                sm:p-8
                ">

                    <div
                        class="
                    flex
                    items-center
                    gap-3
                    sm:gap-4
                    ">

                        <div
                            class="
                        w-11
                        h-11
                        sm:w-12
                        sm:h-12

                        rounded-2xl

                        bg-violet-50
                        text-violet-600

                        flex
                        items-center
                        justify-center

                        font-extrabold

                        shrink-0
                        ">
                            V
                        </div>


                        <h2
                            class="
                        text-xl
                        sm:text-2xl

                        font-extrabold
                        ">
                            Visi
                        </h2>

                    </div>


                    <div
                        class="
                    mt-5
                    sm:mt-6

                    text-sm
                    sm:text-base

                    text-gray-600

                    leading-7
                    sm:leading-8

                    whitespace-pre-line
                    break-words
                    ">
                        {{ $candidate->vision ?: 'Visi kandidat belum tersedia.' }}
                    </div>

                </div>



                {{-- MISI --}}
                <div
                    class="
                bg-white

                rounded-2xl
                sm:rounded-[26px]

                border
                border-gray-100

                shadow-sm

                p-5
                sm:p-8
                ">

                    <div
                        class="
                    flex
                    items-center
                    gap-3
                    sm:gap-4
                    ">

                        <div
                            class="
                        w-11
                        h-11
                        sm:w-12
                        sm:h-12

                        rounded-2xl

                        bg-amber-50
                        text-amber-600

                        flex
                        items-center
                        justify-center

                        font-extrabold

                        shrink-0
                        ">
                            M
                        </div>


                        <h2
                            class="
                        text-xl
                        sm:text-2xl

                        font-extrabold
                        ">
                            Misi
                        </h2>

                    </div>


                    <div
                        class="
                    mt-5
                    sm:mt-6

                    text-sm
                    sm:text-base

                    text-gray-600

                    leading-7
                    sm:leading-8

                    whitespace-pre-line
                    break-words
                    ">
                        {{ $candidate->mission ?: 'Misi kandidat belum tersedia.' }}
                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- RIGHT --}}
            {{-- ================================================= --}}

            <aside class="
            space-y-5
            sm:space-y-6

            w-full
            ">


                {{-- INFORMATION --}}
                <div
                    class="
                bg-white

                rounded-2xl
                sm:rounded-[26px]

                border
                border-gray-100

                shadow-sm

                p-5
                sm:p-6
                ">

                    <h2
                        class="
                    text-lg
                    sm:text-xl

                    font-extrabold
                    ">
                        Informasi Kandidat
                    </h2>



                    {{-- EDUCATION --}}
                    <div
                        class="
                    mt-5
                    sm:mt-6

                    pb-5

                    border-b
                    border-gray-100
                    ">

                        <p
                            class="
                        text-xs
                        uppercase
                        tracking-[2px]
                        text-gray-400
                        ">
                            Pendidikan
                        </p>


                        <p
                            class="
                        font-semibold
                        mt-2
                        break-words
                        ">
                            {{ $candidate->education ?: '-' }}
                        </p>

                    </div>



                    {{-- ACHIEVEMENT --}}
                    <div class="pt-5">

                        <p
                            class="
                        text-xs
                        uppercase
                        tracking-[2px]
                        text-gray-400
                        ">
                            Prestasi
                        </p>


                        <div
                            class="
                        mt-2

                        text-sm
                        sm:text-base

                        text-gray-600

                        leading-6

                        whitespace-pre-line
                        break-words
                        ">
                            {{ $candidate->achievement ?: '-' }}
                        </div>

                    </div>

                </div>



                {{-- SOCIAL MEDIA --}}
                <div
                    class="
                bg-white

                rounded-2xl
                sm:rounded-[26px]

                border
                border-gray-100

                shadow-sm

                p-5
                sm:p-6
                ">

                    <h2
                        class="
                    text-lg
                    sm:text-xl

                    font-extrabold
                    ">
                        Media Sosial
                    </h2>


                    <div class="mt-5 space-y-3">


                        @if ($candidate->instagram)
                            <a href="{{ $candidate->instagram }}" target="_blank" rel="noopener noreferrer"
                                class="
                            flex
                            items-center
                            justify-between

                            gap-3

                            border
                            border-gray-100

                            hover:border-blue-200

                            rounded-2xl

                            px-4
                            py-4

                            transition
                            ">

                                <div
                                    class="
                                flex
                                items-center

                                gap-3

                                min-w-0
                                ">

                                    <div
                                        class="
                                    w-10
                                    h-10

                                    rounded-xl

                                    bg-pink-50

                                    flex
                                    items-center
                                    justify-center

                                    font-bold

                                    shrink-0
                                    ">
                                        IG
                                    </div>


                                    <span class="font-medium truncate">
                                        Instagram
                                    </span>

                                </div>

                                <span class="shrink-0">→</span>

                            </a>
                        @else
                            <div
                                class="
                            flex
                            items-center
                            justify-between

                            border
                            border-gray-100

                            rounded-2xl

                            px-4
                            py-4

                            opacity-50
                            ">
                                <span>Instagram</span>
                                <span>-</span>
                            </div>
                        @endif



                        @if ($candidate->tiktok)
                            <a href="{{ $candidate->tiktok }}" target="_blank" rel="noopener noreferrer"
                                class="
                            flex
                            items-center
                            justify-between

                            gap-3

                            border
                            border-gray-100

                            hover:border-blue-200

                            rounded-2xl

                            px-4
                            py-4

                            transition
                            ">

                                <div
                                    class="
                                flex
                                items-center
                                gap-3
                                min-w-0
                                ">

                                    <div
                                        class="
                                    w-10
                                    h-10

                                    rounded-xl

                                    bg-gray-50

                                    flex
                                    items-center
                                    justify-center

                                    font-bold

                                    shrink-0
                                    ">
                                        TT
                                    </div>


                                    <span class="font-medium truncate">
                                        TikTok
                                    </span>

                                </div>

                                <span class="shrink-0">→</span>

                            </a>
                        @else
                            <div
                                class="
                            flex
                            items-center
                            justify-between

                            border
                            border-gray-100

                            rounded-2xl

                            px-4
                            py-4

                            opacity-50
                            ">
                                <span>TikTok</span>
                                <span>-</span>
                            </div>
                        @endif

                    </div>

                </div>



                {{-- EVENT --}}
                <div
                    class="
                bg-linear-to-br
                from-blue-50
                to-indigo-50

                rounded-2xl
                sm:rounded-[26px]

                border
                border-blue-100

                p-5
                sm:p-6
                ">

                    <p
                        class="
                    text-xs
                    uppercase
                    tracking-[2px]

                    text-blue-600
                    font-semibold
                    ">
                        Event
                    </p>


                    <h3
                        class="
                    font-extrabold
                    text-base
                    sm:text-lg

                    mt-2

                    break-words
                    ">
                        {{ $event->name }}
                    </h3>


                    <a href="{{ route('event.detail', $event) }}"
                        class="
                    inline-flex
                    items-center
                    gap-2

                    text-blue-600

                    font-semibold

                    mt-5
                    ">
                        Lihat Event
                        <span>→</span>
                    </a>

                </div>

            </aside>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- BOTTOM CTA --}}
    {{-- ========================================================= --}}

    <section class="
    max-w-7xl
    mx-auto

    px-4
    sm:px-6

    pb-10
    ">

        <div
            class="
        relative
        overflow-hidden

        rounded-2xl
        sm:rounded-[30px]

        bg-linear-to-r
        from-[#e6f0ff]
        via-[#f9fbff]
        to-[#dfeaff]

        border
        border-blue-100

        px-5
        sm:px-8
        lg:px-10

        py-6
        sm:py-9

        flex
        flex-col
        lg:flex-row

        lg:items-center
        lg:justify-between

        gap-6
        ">

            <div>

                <p
                    class="
                text-blue-600

                text-xs

                tracking-[3px]

                font-semibold
                uppercase
                ">
                    Berikan Dukungan
                </p>


                <h2
                    class="
                mt-2

                text-2xl
                sm:text-3xl

                font-extrabold

                wrap-break-words
                ">
                    Dukung {{ $candidate->name }}
                </h2>


                <p
                    class="
                text-sm
                sm:text-base

                text-gray-500

                mt-2
                ">
                    Setiap vote adalah bentuk dukungan untuk perjalanan kandidat favorit Anda.
                </p>

            </div>



            <a href="{{ route('candidate.vote', $candidate) }}"
                class="
            w-full
            sm:w-auto

            text-center

            bg-blue-600
            hover:bg-blue-700

            text-white

            px-8
            sm:px-9

            py-4

            rounded-xl

            font-semibold

            shadow-lg

            transition

            shrink-0
            ">
                Vote Sekarang →
            </a>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @include('partials.footer')


</body>

</html>
