<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $event->name }} - Vooters
    </title>
    <link rel="icon" type="image/webp" href="{{ asset('Images/logo.webp') }}">

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#fffaf5] text-[#5A1520] overflow-x-hidden">


    {{-- ========================================================= --}}
    {{-- NAVBAR Vooters --}}
    {{-- ========================================================= --}}

    @include('partials.navbar')



    @php

        /*
    |--------------------------------------------------------------------------
    | DATA DASAR HALAMAN EVENT
    |--------------------------------------------------------------------------
    */

        $rankedCandidates = $candidates->values();

        $topThree = $rankedCandidates->take(3)->values();

        $totalEventVotes = $rankedCandidates->sum(function ($candidate) {
            return (int) ($candidate->total_votes ?? 0);
        });

        $eventStatus =
            [
                'draft' => 'Draft',
                'active' => 'Event Voting',
                'closed' => 'Voting Ditutup',
                'finished' => 'Selesai',
            ][$event->status] ?? ucfirst($event->status);

        $startDate = $event->start_date ? \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') : '-';

        $endDate = $event->end_date ? \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y') : '-';

    @endphp



    {{-- ========================================================= --}}
    {{-- HERO EVENT --}}
    {{-- ========================================================= --}}

    <section class="relative pt-24 overflow-hidden">


        {{-- BACKGROUND EVENT --}}

        <div class="absolute inset-0">

            @if ($event->banner)
                <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->name }}"
                    class="w-full h-full object-cover opacity-[0.12]">
            @endif


            <div
                class="
            absolute
            inset-0
            bg-gradient-to-r
            from-[#eef5ff]
            via-[#f7faff]/95
            to-[#e5efff]/90
            ">
            </div>

        </div>



        <div
            class="
        relative
        max-w-7xl
        mx-auto
        px-4
        sm:px-6
        py-6
        sm:py-8
        lg:py-10
        ">

            {{-- BREADCRUMB --}}

            <div
                class="
    flex
    items-center
    gap-2
    text-xs
    sm:text-sm
    text-gray-500
    mb-5
    sm:mb-6
    overflow-hidden
    ">

                <a href="{{ route('home') }}" class="hover:text-[#7A1F2B] transition">
                    Event
                </a>

                <span>›</span>

                <span class="text-[#10204f]">
                    {{ $event->name }}
                </span>

            </div>



            <div
                class="
    grid
    grid-cols-1
    lg:grid-cols-[260px_1fr]
    gap-6
    lg:gap-8
    items-stretch
    ">


                {{-- POSTER / BANNER EVENT --}}

                <div
                    class="bg-white rounded-2xl sm:rounded-[26px] overflow-hidden shadow-lg border border-[#F1E3C0] w-full max-w-[280px] sm:max-w-[320px] lg:max-w-non mx-auto lg:mx- aspect-[4/5] ">

                    @if ($event->banner)
                        <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->name }}"
                            class="w-full h-full object-cover">
                    @elseif($event->logo)
                        <div
                            class="
                        w-full
                        h-full
                        flex
                        items-center
                        justify-center
                        p-8
                        ">

                            <img src="{{ asset('storage/' . $event->logo) }}" alt="{{ $event->name }}"
                                class="max-w-full max-h-full object-contain">

                        </div>
                    @else
                        <div
                            class="
                        w-full
                        h-full
                        flex
                        items-center
                        justify-center
                        bg-gradient-to-br
                        from-[#5A1520]
                        to-indigo-900
                        text-white
                        text-center
                        p-6
                        ">

                            <div>

                                <div
                                    class="
                                w-14
                                h-14
                                rounded-2xl
                                bg-white/15
                                mx-auto
                                flex
                                items-center
                                justify-center
                                font-bold
                                text-2xl
                                ">
                                    P
                                </div>

                                <p class="mt-5 font-bold text-xl">
                                    {{ $event->name }}
                                </p>

                            </div>

                        </div>
                    @endif

                </div>



                {{-- INFORMASI EVENT --}}

                <div
                    class="
    relative
    bg-white/60
    backdrop-blur-sm

    rounded-2xl
    sm:rounded-[28px]

    border
    border-[#F5E6C8]

    p-5
    sm:p-6
    lg:p-8

    overflow-hidden
    ">


                    {{-- DECORATION --}}

                    <div
                        class="
                    absolute
                    -right-10
                    -top-16
                    w-64
                    h-64
                    rounded-full
                    bg-[#D4AF37]/20
                    blur-3xl
                    ">
                    </div>


                    <div class="relative">


                        {{-- STATUS --}}

                        <span
                            class="
                        inline-flex
                        items-center
                        gap-2
                        bg-[#F5E6C8]
                        text-[#5A1520]
                        px-4
                        py-2
                        rounded-full
                        text-xs
                        font-semibold
                        ">

                            <span
                                class="
                            w-2
                            h-2
                            rounded-full
                            bg-[#7A1F2B]
                            "></span>

                            {{ $eventStatus }}

                        </span>



                        {{-- TITLE --}}

                        <h1
                            class="
    mt-4

    text-2xl
    sm:text-3xl
    lg:text-4xl
    xl:text-5xl

    leading-tight
    font-extrabold
    tracking-tight
    text-[#10204f]
    break-words
    ">
                            {{ $event->name }}
                        </h1>



                        {{-- ORGANIZER --}}

                        <div class="
    mt-4
    flex
    flex-wrap
    items-center
    gap-2
    sm:gap-3
    ">

                            <span class="text-sm sm:text-base text-gray-500">
                                Diselenggarakan melalui
                            </span>


                            <div
                                class="
                            w-8
                            h-8
                            rounded-lg
                            bg-[#7A1F2B]
                            text-white
                            flex
                            items-center
                            justify-center
                            font-bold
                            ">
                                P
                            </div>


                            <strong>
                                Vooters
                            </strong>

                        </div>



                        {{-- PERIODE --}}

                        <div class="mt-7">

                            <p
                                class="
                            text-xs
                            uppercase
                            tracking-[2px]
                            text-gray-400
                            font-semibold
                            ">
                                Periode Voting
                            </p>


                            <div
                                class="
    mt-2
    flex
    items-start
    sm:items-center
    gap-3

    font-semibold
    text-sm
    sm:text-base

    text-[#10204f]
    ">

                                <div
                                    class="
                                w-9
                                h-9
                                rounded-xl
                                bg-[#F5E6C8]
                                text-[#7A1F2B]
                                flex
                                items-center
                                justify-center
                                ">
                                    📅
                                </div>

                                {{ $startDate }} — {{ $endDate }}

                            </div>

                        </div>



                        {{-- DESCRIPTION --}}

                        <p
                            class="
                        mt-6
                        text-gray-600
                        leading-7
                        max-w-3xl
                        ">

                            {{ \Illuminate\Support\Str::limit(
                                $event->description ?: 'Ikuti event ini dan berikan dukungan kepada kandidat favorit Anda melalui Vooters.',
                                260,
                            ) }}

                        </p>



                        {{-- ACTION BUTTON --}}

                        <div class="
    mt-7
x    grid
    grid-cols-1
    sm:flex
    gap-3
    ">

                            <a href="{{ route('home') }}#cara-vote"
                                class="
                            inline-flex
                            items-center
                            gap-2
                            bg-white
                            border
                            border-[#E6C86A]
                            text-[#5A1520]
                            px-5
                            py-3
                            rounded-xl
                            font-semibold
                            shadow-sm
                            hover:bg-[#fff7ed]
                            transition
                            justify-center
                            ">
                                <span>?</span>
                                Panduan Vote
                            </a>


                            <button type="button"
                                class="
                            inline-flex
                            items-center
                            gap-2
                            bg-white
                            border
                            border-[#E6C86A]
                            text-[#5A1520]
                            px-5
                            py-3
                            rounded-xl
                            font-semibold
                            shadow-sm
                            hover:bg-[#fff7ed]
                            transition
                            ">
                                ✓ S&K Voting
                            </button>


                            <button type="button"
                                class="
                            inline-flex
                            items-center
                            gap-2
                            bg-white
                            border
                            border-[#E6C86A]
                            text-[#5A1520]
                            px-5
                            py-3
                            rounded-xl
                            font-semibold
                            shadow-sm
                            hover:bg-[#fff7ed]
                            transition
                            ">
                                FAQ
                            </button>

                        </div>


                    </div>

                </div>


            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- EVENT TAB NAVIGATION --}}
    {{-- ========================================================= --}}

    <section
        class="
    sticky
    top-[65px]
    sm:top-[77px]
    z-30
    bg-white
    border-y
    border-gray-100
    shadow-sm
    ">

        <div class="
    max-w-7xl
    mx-auto
    px-0
    sm:px-6
    flex
    items-center
    justify-between
    ">
            <div
                class="
    flex
    items-center

    overflow-x-auto
    whitespace-nowrap

    w-full
    xl:w-auto

    [scrollbar-width:none]
    [&::-webkit-scrollbar]:hidden
    ">


                <button type="button" data-event-tab="ranking"
                    class="
                event-tab
                px-6
                py-5
                border-b-[3px]
                font-semibold
                transition
                ">
                    🏆 Papan Peringkat
                </button>


                <button type="button" data-event-tab="finalis"
                    class="
                event-tab
                px-6
                py-5
                border-b-[3px]
                font-semibold
                transition
                ">
                    👥 Finalis
                </button>


                <button type="button" data-event-tab="dukungan"
                    class="
                event-tab
                px-6
                py-5
                border-b-[3px]
                font-semibold
                transition
                ">
                    💬 Dukungan
                </button>


                <button type="button" data-event-tab="deskripsi"
                    class="
                event-tab
                px-6
                py-5
                border-b-[3px]
                font-semibold
                transition
                ">
                    📄 Deskripsi
                </button>

            </div>



            <div
                class="
            hidden
            xl:flex
            items-center
            gap-2
            bg-[#fff7ed]
            text-[#5A1520]
            px-5
            py-3
            rounded-xl
            text-sm
            ">
                📣
                Dukung finalis favoritmu. Setiap suara punya arti.
            </div>


        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- MAIN EVENT CONTENT --}}
    {{-- ========================================================= --}}

    <main class="
    max-w-7xl
    mx-auto
    px-4
    sm:px-6

    py-5
    sm:py-8
    ">


        <div class="
        grid
        xl:grid-cols-[1fr_320px]
        gap-7
        items-start
        ">


            {{-- ================================================= --}}
            {{-- LEFT CONTENT --}}
            {{-- ================================================= --}}

            <div>


                {{-- ================================================= --}}
                {{-- TAB RANKING --}}
                {{-- ================================================= --}}

                <section id="tab-ranking" data-tab-panel="ranking" class="event-tab-panel">


                    <div
                        class="
    bg-white

    rounded-2xl
    sm:rounded-[26px]

    border
    border-gray-100
    shadow-sm
    p-4
    sm:p-6
    ">


                        {{-- HEADER --}}

                        <div
                            class="
    flex
    flex-col
    sm:flex-row

    sm:items-start
    sm:justify-between

    gap-4
    sm:gap-5

    mb-7
    ">

                            <div>

                                <div
                                    class="
                                flex
                                items-center
                                gap-3
                                ">

                                    <div
                                        class="
                                    w-12
                                    h-12
                                    bg-amber-50
                                    rounded-2xl
                                    flex
                                    items-center
                                    justify-center
                                    text-2xl
                                    ">
                                        👑
                                    </div>


                                    <div>

                                        <h2
                                            class="
    text-xl
    sm:text-2xl
    lg:text-3xl

    font-extrabold
    text-[#10204f]
    ">
                                            Papan Peringkat
                                        </h2>

                                        <p class="text-gray-500 mt-1">
                                            Lihat perolehan suara sementara dan dukung favoritmu sekarang.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div
                                class="
                            text-xs
                            text-gray-400
                            whitespace-nowrap
                            mt-2
                            ">
                                Total {{ number_format($totalEventVotes, 0, ',', '.') }} vote
                            </div>

                        </div>



                        {{-- TOP THREE --}}

                        @if ($rankedCandidates->count() > 0)

                            <div
                                class="
    grid
    grid-cols-1
    md:grid-cols-3
    gap-4
    items-stretch
    md:items-end
    mb-6
    ">


                                {{-- JUARA 2 --}}

                                @if (isset($topThree[1]))

                                    @php
                                        $candidate = $topThree[1];
                                        $voteCount = (int) ($candidate->total_votes ?? 0);
                                        $percentage = $totalEventVotes > 0 ? ($voteCount / $totalEventVotes) * 100 : 0;
                                    @endphp

                                    <div
                                        class="
                                    rounded-3xl
                                    border
                                    border-[#E6C86A]
                                    bg-gradient-to-b
                                    from-[#fff7ed]
                                    to-white
                                    p-5
                                    text-center
                                    ">

                                        <div class="text-4xl mb-2">
                                            🥈
                                        </div>


                                        <div
                                            class="
                                        w-24
                                        h-24
                                        mx-auto
                                        rounded-full
                                        overflow-hidden
                                        border-4
                                        border-[#E6C86A]
                                        bg-[#F5E6C8]
                                        ">

                                            @if ($candidate->photo)
                                                <img src="{{ asset('storage/' . $candidate->photo) }}"
                                                    alt="{{ $candidate->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="
                                                w-full
                                                h-full
                                                flex
                                                items-center
                                                justify-center
                                                text-3xl
                                                font-bold
                                                text-[#fff7ed]
                                                ">
                                                    {{ mb_substr($candidate->name, 0, 1) }}
                                                </div>
                                            @endif

                                        </div>


                                        <h3 class="font-bold mt-4">
                                            {{ $candidate->name }}
                                        </h3>


                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $candidate->city ?: 'Finalis Vooters' }}
                                        </p>


                                        <p
                                            class="
                                        text-xl
                                        font-extrabold
                                        text-[#10204f]
                                        mt-3
                                        ">
                                            {{ number_format($percentage, 2, ',', '.') }}%
                                        </p>


                                        <a href="{{ route('candidate.vote', $candidate) }}"
                                            class="
                                        block
                                        mt-4
                                        bg-[#7A1F2B]
                                        hover:bg-[#5A1520]
                                        text-white
                                        py-3
                                        rounded-xl
                                        font-semibold
                                        transition
                                        justify-center
                                        ">
                                            Vote
                                        </a>

                                    </div>

                                @endif



                                {{-- JUARA 1 --}}

                                @if (isset($topThree[0]))

                                    @php
                                        $candidate = $topThree[0];
                                        $voteCount = (int) ($candidate->total_votes ?? 0);
                                        $percentage = $totalEventVotes > 0 ? ($voteCount / $totalEventVotes) * 100 : 0;
                                    @endphp

                                    <div
                                        class="
                                    relative
                                    rounded-3xl
                                    border-2
                                    border-amber-300
                                    bg-gradient-to-b
                                    from-[#fff8e8]
                                    to-white
                                    p-6
                                    text-center
                                    shadow-md
                                    ">

                                        <div
                                            class="
                                        absolute
                                        -top-8
                                        left-1/2
                                        -translate-x-1/2
                                        text-5xl
                                        ">
                                            👑
                                        </div>


                                        <div
                                            class="
                                        w-28
                                        h-28
                                        mx-auto
                                        rounded-full
                                        overflow-hidden
                                        border-4
                                        border-amber-300
                                        bg-amber-100
                                        ">

                                            @if ($candidate->photo)
                                                <img src="{{ asset('storage/' . $candidate->photo) }}"
                                                    alt="{{ $candidate->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="
                                                w-full
                                                h-full
                                                flex
                                                items-center
                                                justify-center
                                                text-4xl
                                                font-bold
                                                text-amber-500
                                                ">
                                                    {{ mb_substr($candidate->name, 0, 1) }}
                                                </div>
                                            @endif

                                        </div>


                                        <h3 class="font-bold text-lg mt-4">
                                            {{ $candidate->name }}
                                        </h3>


                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $candidate->city ?: 'Finalis Vooters' }}
                                        </p>


                                        <p
                                            class="
                                        text-2xl
                                        font-extrabold
                                        text-[#10204f]
                                        mt-3
                                        ">
                                            {{ number_format($percentage, 2, ',', '.') }}%
                                        </p>


                                        <a href="{{ route('candidate.vote', $candidate) }}"
                                            class="
                                        block
                                        mt-4
                                        bg-[#7A1F2B]
                                        hover:bg-[#5A1520]
                                        text-white
                                        py-3
                                        rounded-xl
                                        font-semibold
                                        shadow
                                        transition
                                        ">
                                            Vote
                                        </a>

                                    </div>

                                @endif



                                {{-- JUARA 3 --}}

                                @if (isset($topThree[2]))

                                    @php
                                        $candidate = $topThree[2];
                                        $voteCount = (int) ($candidate->total_votes ?? 0);
                                        $percentage = $totalEventVotes > 0 ? ($voteCount / $totalEventVotes) * 100 : 0;
                                    @endphp

                                    <div
                                        class="
                                    rounded-3xl
                                    border
                                    border-rose-200
                                    bg-gradient-to-b
                                    from-rose-50
                                    to-white
                                    p-5
                                    text-center
                                    ">

                                        <div class="text-4xl mb-2">
                                            🥉
                                        </div>


                                        <div
                                            class="
                                        w-24
                                        h-24
                                        mx-auto
                                        rounded-full
                                        overflow-hidden
                                        border-4
                                        border-rose-200
                                        bg-rose-100
                                        ">

                                            @if ($candidate->photo)
                                                <img src="{{ asset('storage/' . $candidate->photo) }}"
                                                    alt="{{ $candidate->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="
                                                w-full
                                                h-full
                                                flex
                                                items-center
                                                justify-center
                                                text-3xl
                                                font-bold
                                                text-rose-500
                                                ">
                                                    {{ mb_substr($candidate->name, 0, 1) }}
                                                </div>
                                            @endif

                                        </div>


                                        <h3 class="font-bold mt-4">
                                            {{ $candidate->name }}
                                        </h3>


                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $candidate->city ?: 'Finalis Vooters' }}
                                        </p>


                                        <p
                                            class="
                                        text-xl
                                        font-extrabold
                                        text-[#10204f]
                                        mt-3
                                        ">
                                            {{ number_format($percentage, 2, ',', '.') }}%
                                        </p>


                                        <a href="{{ route('candidate.vote', $candidate) }}"
                                            class="
                                        block
                                        mt-4
                                        bg-[#7A1F2B]
                                        hover:bg-[#5A1520]
                                        text-white
                                        py-3
                                        rounded-xl
                                        font-semibold
                                        transition
                                        ">
                                            Vote
                                        </a>

                                    </div>

                                @endif


                            </div>



                            {{-- RANK 4+ --}}

                            <div class="space-y-3">

                                @foreach ($rankedCandidates->slice(3)->take(7) as $candidate)
                                    @php
                                        $voteCount = (int) ($candidate->total_votes ?? 0);

                                        $percentage = $totalEventVotes > 0 ? ($voteCount / $totalEventVotes) * 100 : 0;

                                        $rank = $loop->iteration + 3;
                                    @endphp


                                    <div
                                        class="
    grid
    grid-cols-[44px_1fr]
    sm:grid-cols-[52px_1fr_90px_80px]
    lg:grid-cols-[52px_1fr_100px_90px]
    gap-3
    sm:gap-4
    items-center
    bg-[#fbfcff]
    border
    border-gray-100
    rounded-2xl
    px-3
    sm:px-4
    py-3
    ">

                                        <div
                                            class="
                                        w-11
                                        h-11
                                        rounded-xl
                                        bg-[#fff7ed]
                                        flex
                                        items-center
                                        justify-center
                                        font-extrabold
                                        text-[#10204f]
                                        ">
                                            {{ $rank }}
                                        </div>


                                        <div
                                            class="
                                        flex
                                        items-center
                                        gap-4
                                        ">

                                            <div
                                                class="
                                            w-12
                                            h-12
                                            rounded-xl
                                            overflow-hidden
                                            bg-gray-100
                                            shrink-0
                                            ">

                                                @if ($candidate->photo)
                                                    <img src="{{ asset('storage/' . $candidate->photo) }}"
                                                        alt="{{ $candidate->name }}"
                                                        class="w-full h-full object-cover">
                                                @endif

                                            </div>


                                            <div>

                                                <p class="font-bold">
                                                    {{ $candidate->name }}
                                                </p>

                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $candidate->education ?: ($candidate->city ?: 'Finalis Vooters') }}
                                                </p>

                                            </div>

                                        </div>


                                        <p
                                            class="
    font-extrabold
    text-right

    col-start-2
    sm:col-start-auto
    ">
                                            {{ number_format($percentage, 2, ',', '.') }}%
                                        </p>


                                        <a href="{{ route('candidate.vote', $candidate) }}"
                                            class="
    col-span-2
    sm:col-span-1

    text-center

    border
    border-[#D4AF37]

    text-[#7A1F2B]

    hover:bg-[#7A1F2B]
    hover:text-white

    py-2

    rounded-xl
    font-semibold
    transition
    ">
                                            Vote
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                        @else
                            <div
                                class="
                            bg-[#fff7ed]
                            rounded-3xl
                            p-12
                            text-center
                            ">

                                <div class="text-5xl">
                                    🏆
                                </div>

                                <h3 class="font-bold text-xl mt-4">
                                    Belum Ada Ranking
                                </h3>

                                <p class="text-gray-500 mt-2">
                                    Ranking akan muncul setelah finalis menerima vote.
                                </p>

                            </div>

                        @endif


                    </div>

                </section>



                {{-- ================================================= --}}
                {{-- TAB FINALIS --}}
                {{-- ================================================= --}}

                <section id="tab-finalis" data-tab-panel="finalis" class="event-tab-panel hidden">

                    <div
                        class="
                    bg-white
                    rounded-[26px]
                    border
                    border-gray-100
                    shadow-sm
                    p-6
                    ">


                        <div
                            class="
    flex
    flex-col
    lg:flex-row
    lg:items-start
    lg:justify-between
    gap-5
    lg:gap-6
    mb-7
    ">

                            <div>

                                <h2
                                    class="
                                text-3xl
                                font-extrabold
                                ">
                                    Finalis
                                </h2>

                                <p class="text-gray-500 mt-1">
                                    Pilih dan dukung finalis favorit Anda.
                                </p>

                            </div>



                            {{-- SEARCH --}}

                            <form method="GET" action="{{ route('event.detail', $event) }}"
                                class=" grid grid-cols-1 sm:grid-cols-[1fr_180px_auto] gap- w-full lg:w-auto ">

                                <input type="hidden" name="tab" value="finalis">


                                <input type="text" name="q" value="{{ $search }}"
                                    placeholder="Cari finalis..."
                                    class="
                                border
                                border-gray-200
                                rounded-xl
                                px-4
                                py-2.5
                                outline-none
                                focus:border-[#fff7ed] w-full
                                ">


                                <select name="city"
                                    class="
                                border
                                border-gray-200
                                rounded-xl
                                px-3
                                outline-none
                                ">

                                    <option value="">
                                        Semua Kota
                                    </option>

                                    @foreach ($cities as $city)
                                        <option value="{{ $city }}" @selected($selectedCity === $city)>
                                            {{ $city }}
                                        </option>
                                    @endforeach

                                </select>


                                <button type="submit"
                                    class="
    bg-[#7A1F2B]
    text-white
    px-5
    py-3
    rounded-xl
    font-semibold
    ">
                                    Cari
                                </button>

                            </form>

                        </div>



                        <div class=" grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 ">

                            @forelse($candidates as $candidate)
                                <div
                                    class=" bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm flex flex-col h-full ">

                                    {{-- FOTO --}}
                                    <div
                                        class="
            aspect-[4/5]
            bg-gray-100
            overflow-hidden
            shrink-0
            ">

                                        @if ($candidate->photo)
                                            <img src="{{ asset('storage/' . $candidate->photo) }}"
                                                alt="{{ $candidate->name }}"
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
                    bg-[#fff7ed]
                    text-[#7A1F2B]
                    text-5xl
                    font-bold
                    ">
                                                {{ mb_substr($candidate->name, 0, 1) }}
                                            </div>
                                        @endif

                                    </div>



                                    {{-- CONTENT --}}
                                    <div
                                        class="
            p-5
            flex
            flex-col
            flex-1
            ">

                                        {{-- NAMA --}}
                                        <h3 class="
                font-bold
                text-lg
                leading-7
                min-h-[56px]
                line-clamp-2
                "
                                            title="{{ $candidate->name }}">
                                            {{ $candidate->name }}
                                        </h3>



                                        {{-- KOTA --}}
                                        <p
                                            class="
                text-gray-500
                text-sm
                mt-1
                min-h-[24px]
                ">
                                            {{ $candidate->city ?: '-' }}
                                        </p>



                                        {{-- TOTAL VOTE --}}
                                        <div
                                            class="
                flex
                items-center
                justify-between
                mt-5
                text-sm
                ">

                                            <span class="text-gray-500">
                                                Total Vote
                                            </span>


                                            <strong
                                                class="
                    text-[#7A1F2B]
                    text-base
                    ">
                                                {{ number_format($candidate->total_votes ?? 0, 0, ',', '.') }}
                                            </strong>

                                        </div>



                                        {{-- BUTTON --}}
                                        <div class="mt-auto pt-5">

                                            <a href="{{ route('candidate.detail', $candidate) }}"
                                                class="
                    block
                    w-full
                    text-center
                    border
                    border-[#E6C86A]
                    text-[#7A1F2B]
                    hover:bg-[#fff7ed]
                    py-3
                    rounded-xl
                    font-semibold
                    transition
                    ">
                                                Lihat Detail
                                            </a>


                                            <a href="{{ route('candidate.vote', $candidate) }}"
                                                class="
                    block
                    w-full
                    mt-2
                    text-center
                    bg-[#7A1F2B]
                    hover:bg-[#5A1520]
                    text-white
                    py-3
                    rounded-xl
                    font-semibold
                    transition
                    ">
                                                Vote
                                            </a>

                                        </div>


                                    </div>

                                </div>

                            @empty

                                <div
                                    class="
        col-span-3
        text-center
        py-16
        bg-[#fff7ed]
        rounded-3xl
        ">

                                    <p class="font-bold">
                                        Finalis tidak ditemukan.
                                    </p>

                                </div>
                            @endforelse
                        </div>


                    </div>

                </section>



                {{-- ================================================= --}}
                {{-- TAB DUKUNGAN --}}
                {{-- ================================================= --}}

                <section id="tab-dukungan" data-tab-panel="dukungan" class="event-tab-panel hidden">

                    <div
                        class="
                    bg-white
                    rounded-[26px]
                    border
                    border-gray-100
                    shadow-sm
                    p-8
                    ">

                        <h2
                            class="
                        text-3xl
                        font-extrabold
                        ">
                            Dukungan
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Pesan dukungan untuk para finalis event ini.
                        </p>


                        <div
                            class="
                        mt-8
                        bg-[#fff7ed]
                        rounded-3xl
                        px-8
                        py-14
                        text-center
                        ">

                            <div class="text-5xl">
                                💙
                            </div>

                            <h3 class="font-bold text-xl mt-4">
                                Belum Ada Pesan Dukungan
                            </h3>

                            <p
                                class="
                            text-gray-500
                            mt-2
                            max-w-lg
                            mx-auto
                            ">
                                Fitur pesan dukungan dapat ditambahkan pada tahap berikutnya.
                                Untuk sekarang, dukung finalis favorit Anda melalui voting.
                            </p>

                        </div>

                    </div>

                </section>



                {{-- ================================================= --}}
                {{-- TAB DESKRIPSI --}}
                {{-- ================================================= --}}

                <section id="tab-deskripsi" data-tab-panel="deskripsi" class="event-tab-panel hidden">

                    <div
                        class="
                    bg-white
                    rounded-[26px]
                    border
                    border-gray-100
                    shadow-sm
                    p-8
                    ">

                        <h2
                            class="
                        text-3xl
                        font-extrabold
                        ">
                            Tentang Event
                        </h2>


                        <div
                            class="
                        mt-6
                        text-gray-600
                        leading-8
                        whitespace-pre-line
                        ">
                            {{ $event->description ?: 'Deskripsi event belum tersedia.' }}
                        </div>



                        @if ($event->categories->count())

                            <div class="mt-9">

                                <h3 class="font-bold">
                                    Kategori Voting
                                </h3>


                                <div
                                    class="
                                mt-4
                                flex
                                flex-wrap
                                gap-3
                                ">

                                    @foreach ($event->categories as $category)
                                        <span
                                            class="
                                        bg-[#fff7ed]
                                        text-[#5A1520]
                                        border
                                        border-[#F5E6C8]
                                        px-4
                                        py-2
                                        rounded-full
                                        text-sm
                                        ">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach

                                </div>

                            </div>

                        @endif

                    </div>

                </section>


            </div>



            {{-- ================================================= --}}
            {{-- SIDEBAR --}}
            {{-- ================================================= --}}

            <aside class=" space-y-5 w-full ">


                {{-- DETAIL EVENT --}}

                <div
                    class="
                bg-white
                border
                border-gray-100
                rounded-[24px]
                shadow-sm
                p-5
                ">

                    <div
                        class="
                    flex
                    items-center
                    justify-between
                    ">

                        <h3 class="font-bold text-lg">
                            Detail Event
                        </h3>

                        <span class="text-[#7A1F2B] text-sm">
                            Vooters
                        </span>

                    </div>



                    <div
                        class="
                    mt-5
                    flex
                    gap-4
                    ">

                        <div
                            class="
                        w-16
                        h-20
                        rounded-xl
                        overflow-hidden
                        bg-gray-100
                        shrink-0
                        ">

                            @if ($event->banner)
                                <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->name }}"
                                    class="w-full h-full object-cover">
                            @endif

                        </div>


                        <div>

                            <p class="font-bold leading-snug">
                                {{ $event->name }}
                            </p>

                            <p class="text-xs text-gray-500 mt-2">
                                📅 {{ $startDate }} — {{ $endDate }}
                            </p>

                            <p class="text-xs text-gray-500 mt-2">
                                👥 {{ $candidates->count() }} finalis
                            </p>

                        </div>

                    </div>


                    <div
                        class="
                    mt-5
                    pt-5
                    border-t
                    border-gray-100
                    flex
                    justify-between
                    ">

                        <span class="text-sm text-gray-500">
                            Total Vote
                        </span>

                        <strong class="text-[#7A1F2B]">
                            {{ number_format($totalEventVotes, 0, ',', '.') }}
                        </strong>

                    </div>

                </div>



                {{-- VOTE KAMU --}}

                <div
                    class="
                bg-white
                border
                border-gray-100
                rounded-[24px]
                shadow-sm
                p-5
                ">

                    <div
                        class="
                    flex
                    items-center
                    gap-3
                    ">

                        <div
                            class="
                        w-10
                        h-10
                        rounded-xl
                        bg-violet-100
                        flex
                        items-center
                        justify-center
                        ">
                            🗳️
                        </div>

                        <h3 class="font-bold text-lg">
                            Vote Kamu
                        </h3>

                    </div>



                    <label for="sidebarCandidateSelect"
                        class="
                    block
                    text-sm
                    text-gray-500
                    mt-6
                    mb-2
                    ">
                        Pilih Finalis
                    </label>


                    <select id="sidebarCandidateSelect"
                        class="
                    w-full
                    border
                    border-gray-200
                    rounded-xl
                    px-4
                    py-3
                    outline-none
                    focus:border-[#fff7ed]
                    ">

                        <option value="">
                            Pilih finalis terlebih dahulu
                        </option>

                        @foreach ($rankedCandidates as $candidate)
                            <option value="{{ route('candidate.vote', $candidate) }}">
                                {{ $candidate->name }}
                            </option>
                        @endforeach

                    </select>



                    <div
                        class="
                    mt-6
                    border-t
                    border-gray-100
                    pt-5
                    flex
                    items-center
                    justify-between
                    ">

                        <span class="font-semibold">
                            Total Pembayaran
                        </span>

                        <span
                            class="
                        text-xl
                        font-extrabold
                        ">
                            Rp0
                        </span>

                    </div>


                    <p class="text-xs text-gray-400 mt-2">
                        Jumlah vote dan total pembayaran dipilih pada langkah berikutnya.
                    </p>


                    <button type="button" id="sidebarVoteButton" disabled
                        class="
                    mt-5
                    w-full
                    bg-[#7A1F2B]
                    text-white
                    py-3
                    rounded-xl
                    font-semibold
                    transition
                    disabled:bg-gray-200
                    disabled:text-gray-400
                    disabled:cursor-not-allowed
                    ">
                        Lanjut Voting →
                    </button>

                </div>



                {{-- SUPPORT CARD --}}

                <div
                    class="
                bg-gradient-to-br
                from-[#eef4ff]
                to-[#f7f5ff]
                rounded-[24px]
                border
                border-[#F5E6C8]
                p-5
                ">

                    <div class="text-3xl">
                        🎁
                    </div>

                    <h3 class="font-bold mt-3">
                        Dukung Finalis Favoritmu!
                    </h3>

                    <p
                        class="
                    text-sm
                    text-gray-500
                    mt-2
                    leading-6
                    ">
                        Setiap vote adalah dukungan nyata untuk perjalanan finalis favorit Anda.
                    </p>

                </div>



                {{-- SHARE --}}

                <div
                    class="
                bg-white
                rounded-[24px]
                border
                border-gray-100
                p-5
                ">

                    <h3 class="font-bold">
                        Bagikan Event Ini
                    </h3>

                    <p class="text-sm text-gray-500 mt-2">
                        Ajak teman, keluarga, dan komunitas untuk ikut vote.
                    </p>


                    <div class="flex gap-2 mt-5">

                        <button type="button" id="copyEventLink"
                            class="
                        w-10
                        h-10
                        rounded-xl
                        border
                        flex
                        items-center
                        justify-center
                        hover:bg-gray-50
                        ">
                            🔗
                        </button>


                        <a href="https://wa.me/?text={{ urlencode($event->name . ' - ' . url()->current()) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="
                        w-10
                        h-10
                        rounded-xl
                        bg-green-50
                        flex
                        items-center
                        justify-center
                        ">
                            WA
                        </a>

                    </div>

                </div>


            </aside>


        </div>

    </main>



    {{-- ========================================================= --}}
    {{-- CTA --}}
    {{-- ========================================================= --}}

    <section class=" max-w-7xl mx-auto px-4 sm:px-6 pb-8 ">

        <div
            class=" relative overflow-hidden rounded-2xl sm:rounded-[28px] bg-gradient-to-r from-[#e7f1ff] via-white to-[#dfeaff] border border-[#F5E6C8] px-5 sm:px-8 lg:px-10 py-6 sm:py-8 flex flex-col lg:flex-row lg:items-center lg:justify-between. gap-6 ">

            <div>

                <p class="text-sm text-[#7A1F2B] font-semibold">
                    BERSAMA Vooters
                </p>

                <h2
                    class="
                text-2xl
                font-extrabold
                mt-1
                ">
                    Dukung Finalis Favoritmu Hari Ini
                </h2>

                <p class="text-gray-500 mt-2">
                    Pilih finalis, tentukan jumlah vote, dan jadilah bagian dari perjalanan mereka.
                </p>

            </div>


            <button type="button" id="ctaVoteButton"
                class="
            bg-[#7A1F2B]
            hover:bg-[#5A1520]
            text-white
            px-8
            py-3
            rounded-xl
            font-semibold
            shadow-lg
            transition
            ">
                Vote Sekarang →
            </button>

        </div>

    </section>
    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @include('partials.footer')




    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {


            /*
            |--------------------------------------------------------------------------
            | TAB EVENT
            |--------------------------------------------------------------------------
            */

            const tabs =
                document.querySelectorAll('.event-tab');

            const panels =
                document.querySelectorAll('.event-tab-panel');


            function activateTab(tabName) {

                tabs.forEach(function(tab) {

                    const active =
                        tab.dataset.eventTab === tabName;

                    tab.classList.toggle(
                        'border-[#7A1F2B]',
                        active
                    );

                    tab.classList.toggle(
                        'text-[#7A1F2B]',
                        active
                    );

                    tab.classList.toggle(
                        'border-transparent',
                        !active
                    );

                    tab.classList.toggle(
                        'text-gray-500',
                        !active
                    );

                });


                panels.forEach(function(panel) {

                    const active =
                        panel.dataset.tabPanel === tabName;

                    panel.classList.toggle(
                        'hidden',
                        !active
                    );

                });

            }



            tabs.forEach(function(tab) {

                tab.addEventListener('click', function() {

                    activateTab(
                        tab.dataset.eventTab
                    );

                    const url =
                        new URL(window.location.href);

                    url.searchParams.set(
                        'tab',
                        tab.dataset.eventTab
                    );

                    window.history.replaceState({},
                        '',
                        url
                    );

                });

            });



            /*
            |--------------------------------------------------------------------------
            | OPEN TAB DARI URL
            |--------------------------------------------------------------------------
            */

            const params =
                new URLSearchParams(
                    window.location.search
                );

            const requestedTab =
                params.get('tab');

            const availableTabs = [
                'ranking',
                'finalis',
                'dukungan',
                'deskripsi'
            ];


            activateTab(
                availableTabs.includes(requestedTab) ?
                requestedTab :
                'ranking'
            );



            /*
            |--------------------------------------------------------------------------
            | SIDEBAR VOTE
            |--------------------------------------------------------------------------
            */

            const candidateSelect =
                document.getElementById(
                    'sidebarCandidateSelect'
                );

            const voteButton =
                document.getElementById(
                    'sidebarVoteButton'
                );


            candidateSelect.addEventListener(
                'change',
                function() {

                    voteButton.disabled = !candidateSelect.value;

                }
            );


            voteButton.addEventListener(
                'click',
                function() {

                    if (!candidateSelect.value) {
                        return;
                    }

                    window.location.href =
                        candidateSelect.value;

                }
            );



            /*
            |--------------------------------------------------------------------------
            | CTA VOTE
            |--------------------------------------------------------------------------
            */

            const ctaVoteButton =
                document.getElementById(
                    'ctaVoteButton'
                );


            ctaVoteButton.addEventListener(
                'click',
                function() {

                    activateTab('finalis');

                    document
                        .getElementById('tab-finalis')
                        .scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                }
            );



            /*
            |--------------------------------------------------------------------------
            | COPY EVENT LINK
            |--------------------------------------------------------------------------
            */

            const copyButton =
                document.getElementById(
                    'copyEventLink'
                );


            copyButton.addEventListener(
                'click',
                async function() {

                    try {

                        await navigator.clipboard.writeText(
                            window.location.href
                        );

                        const oldText =
                            copyButton.textContent;

                        copyButton.textContent =
                            '✓';

                        setTimeout(function() {

                            copyButton.textContent =
                                oldText;

                        }, 1500);

                    } catch (error) {

                        console.error(
                            'Gagal menyalin URL',
                            error
                        );

                    }

                }
            );


        });
    </script>


</body>

</html>
