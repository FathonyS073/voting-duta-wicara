<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $candidate->name }} - Duta Wicara Jawa Timur
    </title>

    @vite(['resources/css/app.css'])

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>


<body class="bg-[#faf8ff] text-[#172033]">


    {{-- NAVBAR BERSAMA --}}
    @include('partials.navbar', [
        'activePage' => 'finalis'
    ])



    <!-- ===================================================== -->
    <!-- BREADCRUMB / BACK -->
    <!-- ===================================================== -->

    <section class="pt-28 sm:pt-32">

        <div class="max-w-7xl mx-auto px-5 sm:px-8">

            <a
                href="{{ route('event.detail', $candidate->event_id) }}"
                class="
                inline-flex
                items-center
                gap-2
                text-sm
                text-gray-500
                hover:text-[#5b0b83]
                transition
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Kembali ke Semua Finalis

            </a>

        </div>

    </section>



    <!-- ===================================================== -->
    <!-- HERO DETAIL FINALIS -->
    <!-- ===================================================== -->

    <section class="pt-7 pb-14 sm:pt-10 sm:pb-20">

        <div class="max-w-7xl mx-auto px-5 sm:px-8">

            <div
                class="
                bg-white
                rounded-[28px]
                sm:rounded-[36px]
                overflow-hidden
                shadow-sm
                border
                border-gray-100
                "
            >

                <div class="grid grid-cols-1 lg:grid-cols-2">


                    <!-- ===================================== -->
                    <!-- FOTO -->
                    <!-- ===================================== -->

                    <div
                        class="
                        relative
                        bg-gradient-to-br
                        from-[#210438]
                        to-[#5b0b83]
                        p-5
                        sm:p-8
                        lg:p-10
                        "
                    >

                        <!-- DEKORASI -->
                        <div
                            class="
                            absolute
                            top-0
                            right-0
                            w-48
                            h-48
                            rounded-full
                            bg-[#e7b24b]/10
                            blur-3xl
                            "
                        ></div>


                        <div
                            class="
                            relative
                            max-w-[420px]
                            mx-auto
                            overflow-hidden
                            rounded-[24px]
                            sm:rounded-[30px]
                            shadow-2xl
                            aspect-[4/5]
                            bg-white/10
                            "
                        >

                            @if($candidate->photo)

                                <img
                                    src="{{ asset('storage/' . $candidate->photo) }}"
                                    alt="{{ $candidate->name }}"
                                    class="
                                    w-full
                                    h-full
                                    object-cover
                                    "
                                >

                            @else

                                <div
                                    class="
                                    w-full
                                    h-full
                                    flex
                                    items-center
                                    justify-center
                                    text-white/60
                                    "
                                >
                                    Foto belum tersedia
                                </div>

                            @endif

                        </div>

                    </div>



                    <!-- ===================================== -->
                    <!-- IDENTITAS -->
                    <!-- ===================================== -->

                    <div
                        class="
                        p-6
                        sm:p-10
                        lg:p-14
                        flex
                        flex-col
                        justify-center
                        "
                    >

                        <p
                            class="
                            text-[#c48621]
                            tracking-[5px]
                            text-xs
                            sm:text-sm
                            font-semibold
                            "
                        >
                            FINALIS
                        </p>


                        <h1
                            class="
                            mt-3
                            text-3xl
                            sm:text-4xl
                            lg:text-5xl
                            font-bold
                            leading-tight
                            text-[#172033]
                            "
                        >
                            {{ $candidate->name }}
                        </h1>



                        <!-- LOKASI -->
                        <div
                            class="
                            mt-4
                            flex
                            items-center
                            gap-2
                            text-gray-500
                            "
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-[#c48621]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>

                            <span>

                                {{ $candidate->city }}

                                @if($candidate->province)
                                    , {{ $candidate->province }}
                                @endif

                            </span>

                        </div>



                        <!-- KATEGORI -->
                        @if($candidate->categories->count())

                            <div
                                class="
                                flex
                                flex-wrap
                                gap-2
                                mt-6
                                "
                            >

                                @foreach($candidate->categories as $category)

                                    <span
                                        class="
                                        bg-[#f6effa]
                                        text-[#5b0b83]
                                        border
                                        border-[#eadcf0]
                                        px-4
                                        py-2
                                        rounded-full
                                        text-xs
                                        sm:text-sm
                                        font-medium
                                        "
                                    >
                                        {{ $category->name }}
                                    </span>

                                @endforeach

                            </div>

                        @endif



                        <!-- TOTAL VOTE -->
                        <div
                            class="
                            mt-8
                            bg-[#faf7fc]
                            border
                            border-[#eee5f2]
                            rounded-2xl
                            p-5
                            sm:p-6
                            "
                        >

                            <p
                                class="
                                text-sm
                                text-gray-500
                                "
                            >
                                Total Dukungan
                            </p>


                            <div
                                class="
                                mt-1
                                flex
                                items-end
                                gap-2
                                "
                            >

                                <span
                                    class="
                                    text-3xl
                                    sm:text-4xl
                                    font-bold
                                    text-[#5b0b83]
                                    "
                                >
                                    {{ number_format(
                                        $candidate->total_votes ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                                <span
                                    class="
                                    text-gray-500
                                    mb-1
                                    "
                                >
                                    vote
                                </span>

                            </div>

                        </div>



                        <!-- BUTTON VOTE -->
                        <a
                            href="{{ route('candidate.vote', $candidate->id) }}"
                            class=" mt-7 w-full sm:w-auto sm:self-start inline-flex items-center justify-center bg-[#5b0b83] hover:bg-[#430563] text-white px-9 py-3.5 rounded-full font-semibold transition "> 
                            Vote Sekarang
                            <span class="ml-2">
                                →
                            </span>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- ===================================================== -->
    <!-- PROFIL FINALIS -->
    <!-- ===================================================== -->

    <section class="pb-16 sm:pb-24">

        <div class="max-w-7xl mx-auto px-5 sm:px-8">

            <div
                class="
                grid
                grid-cols-1
                lg:grid-cols-3
                gap-6
                lg:gap-8
                "
            >


                <!-- ========================================= -->
                <!-- KONTEN UTAMA -->
                <!-- ========================================= -->

                <div class="lg:col-span-2 space-y-6">


                    <!-- TENTANG -->
                    <div
                        class="
                        bg-white
                        rounded-3xl
                        border
                        border-gray-100
                        p-6
                        sm:p-8
                        "
                    >

                        <p
                            class="
                            text-[#c48621]
                            tracking-[4px]
                            text-xs
                            font-semibold
                            "
                        >
                            PROFIL
                        </p>


                        <h2
                            class="
                            text-2xl
                            sm:text-3xl
                            font-bold
                            mt-2
                            "
                        >
                            Tentang Finalis
                        </h2>


                        <div
                            class="
                            mt-5
                            text-gray-600
                            leading-8
                            text-sm
                            sm:text-base
                            "
                        >

                            @if($candidate->bio)

                                {!! nl2br(e($candidate->bio)) !!}

                            @else

                                <span class="text-gray-400">
                                    Profil finalis belum tersedia.
                                </span>

                            @endif

                        </div>

                    </div>



                    <!-- VISI -->
                    <div
                        class="
                        bg-white
                        rounded-3xl
                        border
                        border-gray-100
                        p-6
                        sm:p-8
                        "
                    >

                        <div
                            class="
                            flex
                            items-center
                            gap-4
                            "
                        >

                            <div
                                class="
                                w-11
                                h-11
                                shrink-0
                                rounded-full
                                bg-[#f6effa]
                                text-[#5b0b83]
                                flex
                                items-center
                                justify-center
                                font-bold
                                "
                            >
                                V
                            </div>


                            <h2
                                class="
                                text-xl
                                sm:text-2xl
                                font-bold
                                "
                            >
                                Visi
                            </h2>

                        </div>


                        <div
                            class="
                            mt-5
                            text-gray-600
                            leading-8
                            text-sm
                            sm:text-base
                            "
                        >

                            @if($candidate->vision)

                                {!! nl2br(e($candidate->vision)) !!}

                            @else

                                <span class="text-gray-400">
                                    Visi belum tersedia.
                                </span>

                            @endif

                        </div>

                    </div>
                    <!-- MISI -->
                    <div
                        class="
                        bg-white
                        rounded-3xl
                        border
                        border-gray-100
                        p-6
                        sm:p-8
                        "
                    >
                        <div
                            class="
                            flex
                            items-center
                            gap-4
                            "
                        >
                            <div
                                class="
                                w-11
                                h-11
                                shrink-0
                                rounded-full
                                bg-[#fff8e8]
                                text-[#b47b12]
                                flex
                                items-center
                                justify-center
                                font-bold
                                "
                            >
                                M
                            </div>


                            <h2
                                class="
                                text-xl
                                sm:text-2xl
                                font-bold
                                "
                            >
                                Misi
                            </h2>

                        </div>


                        <div
                            class="
                            mt-5
                            text-gray-600
                            leading-8
                            text-sm
                            sm:text-base
                            "
                        >

                            @if($candidate->mission)

                                {!! nl2br(e($candidate->mission)) !!}

                            @else

                                <span class="text-gray-400">
                                    Misi belum tersedia.
                                </span>

                            @endif

                        </div>

                    </div>

                </div>



                <!-- ========================================= -->
                <!-- SIDEBAR -->
                <!-- ========================================= -->

                <div class="space-y-6">


                    <!-- INFORMASI -->
                    <div
                        class="
                        bg-white
                        rounded-3xl
                        border
                        border-gray-100
                        p-6
                        "
                    >

                        <h3
                            class="
                            text-xl
                            font-bold
                            "
                        >
                            Informasi Finalis
                        </h3>


                        <!-- PENDIDIKAN -->
                        <div
                            class="
                            py-5
                            border-b
                            border-gray-100
                            "
                        >

                            <p
                                class="
                                text-xs
                                uppercase
                                tracking-wider
                                text-gray-400
                                "
                            >
                                Pendidikan
                            </p>


                            <p
                                class="
                                mt-2
                                text-sm
                                font-medium
                                text-[#172033]
                                "
                            >
                                {{ $candidate->education ?: 'Belum tersedia' }}
                            </p>

                        </div>



                        <!-- PRESTASI -->
                        <div class="pt-5">

                            <p
                                class="
                                text-xs
                                uppercase
                                tracking-wider
                                text-gray-400
                                "
                            >
                                Prestasi
                            </p>


                            <div
                                class="
                                mt-2
                                text-sm
                                text-[#172033]
                                leading-6
                                "
                            >

                                @if($candidate->achievement)

                                    {!! nl2br(e($candidate->achievement)) !!}

                                @else

                                    Belum tersedia

                                @endif

                            </div>

                        </div>

                    </div>



                    <!-- MEDIA SOSIAL -->
                    @if($candidate->instagram || $candidate->tiktok)

                        <div
                            class="
                            bg-white
                            rounded-3xl
                            border
                            border-gray-100
                            p-6
                            "
                        >

                            <h3 class="text-xl font-bold">
                                Media Sosial
                            </h3>


                            <div class="mt-5 space-y-3">


                                @if($candidate->instagram)

                                    <a
                                        href="{{ str_starts_with($candidate->instagram, 'http')
                                            ? $candidate->instagram
                                            : 'https://instagram.com/' . ltrim($candidate->instagram, '@') }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-4
                                        border
                                        border-gray-100
                                        rounded-2xl
                                        px-4
                                        py-3
                                        hover:border-[#5b0b83]
                                        hover:text-[#5b0b83]
                                        transition
                                        "
                                    >

                                        <div class="flex items-center gap-3">

                                            <span
                                                class="
                                                w-9
                                                h-9
                                                bg-[#f6effa]
                                                rounded-full
                                                flex
                                                items-center
                                                justify-center
                                                "
                                            >
                                                IG
                                            </span>

                                            <span class="text-sm font-medium">
                                                Instagram
                                            </span>

                                        </div>

                                        <span>→</span>

                                    </a>

                                @endif



                                @if($candidate->tiktok)

                                    <a
                                        href="{{ str_starts_with($candidate->tiktok, 'http')
                                            ? $candidate->tiktok
                                            : 'https://www.tiktok.com/@' . ltrim($candidate->tiktok, '@') }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-4
                                        border
                                        border-gray-100
                                        rounded-2xl
                                        px-4
                                        py-3
                                        hover:border-[#5b0b83]
                                        hover:text-[#5b0b83]
                                        transition
                                        "
                                    >

                                        <div class="flex items-center gap-3">

                                            <span
                                                class="
                                                w-9
                                                h-9
                                                bg-[#f6effa]
                                                rounded-full
                                                flex
                                                items-center
                                                justify-center
                                                "
                                            >
                                                TT
                                            </span>

                                            <span class="text-sm font-medium">
                                                TikTok
                                            </span>

                                        </div>

                                        <span>→</span>

                                    </a>

                                @endif

                            </div>

                        </div>

                    @endif


                </div>

            </div>

        </div>

    </section>



    <!-- ===================================================== -->
    <!-- CTA VOTE -->
    <!-- ===================================================== -->

    <section
        id="vote"
        class="
        bg-[#16052b]
        text-white
        py-14
        sm:py-16
        "
    >

        <div
            class="
            max-w-7xl
            mx-auto
            px-5
            sm:px-8
            "
        >

            <div
                class="
                flex
                flex-col
                md:flex-row
                md:items-center
                md:justify-between
                gap-7
                text-center
                md:text-left
                "
            >

                <div>

                    <p
                        class="
                        text-[#e7b24b]
                        tracking-[4px]
                        text-xs
                        font-semibold
                        "
                    >
                        BERIKAN DUKUNGAN
                    </p>


                    <h2
                        class="
                        mt-2
                        text-2xl
                        sm:text-3xl
                        lg:text-4xl
                        font-bold
                        "
                    >
                        Dukung {{ $candidate->name }}
                    </h2>


                    <p
                        class="
                        mt-3
                        text-gray-300
                        max-w-xl
                        "
                    >
                        Jadilah bagian dari perjalanan
                        {{ $candidate->name }} menuju Duta Wicara
                        Jawa Timur 2026.
                    </p>

                </div>



                <!--
                    SEMENTARA:
                    Tombol ini belum menuju checkout.
                    Pada Tahap 4 nanti kita hubungkan
                    ke halaman pemilihan jumlah vote.
                -->
            <a
                href="{{ route('candidate.vote', $candidate->id) }}"
                class=" bg-[#e7b24b] hover:bg-[#f2c55f] text-black px-9 py-3.5 rounded-full font-semibold whitespace-nowrap transition ">
                Vote Sekarang →
            </a>

            </div>

        </div>

    </section>



    <!-- ===================================================== -->
    <!-- FOOTER -->
    <!-- ===================================================== -->

    <footer class="bg-[#10001d] text-white py-10">

        <div
            class="
            max-w-7xl
            mx-auto
            px-5
            sm:px-8
            flex
            flex-col
            sm:flex-row
            items-center
            justify-between
            gap-6
            "
        >

            <img
                src="{{ asset('Images/logo.webp') }}"
                alt="Duta Wicara Jawa Timur"
                class="h-9 sm:h-10 w-auto"
            >


            <p
                class="
                text-gray-400
                text-xs
                sm:text-sm
                text-center
                sm:text-right
                "
            >
                © 2026 Duta Wicara Jawa Timur.
                All rights reserved.
            </p>

        </div>

    </footer>


</body>

</html>