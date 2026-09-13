<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Semua Event - PICO</title>

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#f8faff] text-gray-900 overflow-x-hidden">


    @include('partials.navbar')



    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <section
        class="
    pt-28
    sm:pt-32
    pb-10
    sm:pb-14

    bg-linear-to-br
    from-blue-50
    via-white
    to-blue-100
    ">

        <div class="
        max-w-7xl
        mx-auto
        px-4
        sm:px-6
        ">

            <div class="
            max-w-3xl
            ">

                <p
                    class="
                text-blue-600
                uppercase
                tracking-[4px]
                text-xs
                sm:text-sm
                font-semibold
                ">
                    Jelajahi PICO
                </p>


                <h1
                    class="
                mt-3

                text-3xl
                sm:text-4xl
                lg:text-5xl

                font-extrabold
                text-[#14285a]
                ">
                    Temukan Event Voting
                </h1>


                <p
                    class="
                mt-4
                text-gray-500
                text-sm
                sm:text-base
                leading-7
                max-w-2xl
                ">
                    Jelajahi berbagai event voting di PICO.
                    Dukung kandidat favorit Anda pada event yang masih aktif
                    atau lihat hasil dari event yang telah ditutup.
                </p>

            </div>



            {{-- QUICK STATS --}}
            <div
                class="
            mt-8

            grid
            grid-cols-2

            gap-3
            sm:gap-4

            max-w-lg
            ">

                <div
                    class="
                bg-white/80
                border
                border-blue-100
                rounded-2xl
                p-4
                ">

                    <p
                        class="
                    text-2xl
                    font-extrabold
                    text-blue-600
                    ">
                        {{ $activeCount }}
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        Event Aktif
                    </p>

                </div>


                <div
                    class="
                bg-white/80
                border
                border-gray-200
                rounded-2xl
                p-4
                ">

                    <p
                        class="
                    text-2xl
                    font-extrabold
                    text-gray-600
                    ">
                        {{ $closedCount }}
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        Event Selesai
                    </p>

                </div>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- SEARCH + FILTER --}}
    {{-- ========================================================= --}}

    <section class="
    max-w-7xl
    mx-auto
    px-4
    sm:px-6
    -mt-2
    relative
    z-10
    ">

        <div
            class="
        bg-white

        rounded-2xl
        sm:rounded-3xl

        border
        border-gray-100

        shadow-lg

        p-4
        sm:p-5
        ">

            <form action="{{ route('events.index') }}" method="GET">

                <div
                    class="
                flex
                items-center
                gap-3

                border
                border-gray-200

                rounded-full

                px-4
                sm:px-5

                py-3
                ">

                    <span>
                        🔍
                    </span>


                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama event..."
                        class="
                    w-full
                    min-w-0
                    outline-none
                    bg-transparent
                    ">


                    @if ($status !== 'all')
                        <input type="hidden" name="status" value="{{ $status }}">
                    @endif


                    @if ($search !== '')
                        <a href="{{ route('events.index', [
                            'status' => $status !== 'all' ? $status : null,
                        ]) }}"
                            class="
                        text-gray-400
                        hover:text-red-500
                        ">
                            ✕
                        </a>
                    @endif


                    <button type="submit"
                        class="
                    shrink-0

                    bg-blue-600
                    hover:bg-blue-700

                    text-white

                    w-10
                    h-10

                    sm:w-auto
                    sm:px-6

                    rounded-full

                    flex
                    items-center
                    justify-center

                    transition
                    ">
                        <span class="sm:hidden">
                            →
                        </span>

                        <span class="hidden sm:inline">
                            Cari Event
                        </span>
                    </button>

                </div>

            </form>



            {{-- STATUS FILTER --}}
            <div
                class="
            mt-5

            flex
            items-center
            gap-2
            sm:gap-3

            flex-wrap
            ">

                <a href="{{ route('events.index', [
                    'q' => $search ?: null,
                ]) }}"
                    class="
                px-5
                py-2.5
                rounded-full
                text-sm
                font-medium
                transition

                {{ $status === 'all' ? 'bg-blue-600 text-white' : 'border border-gray-200 text-gray-600 hover:border-blue-300' }}
                ">
                    Semua Event
                </a>


                <a href="{{ route('events.index', [
                    'status' => 'active',
                    'q' => $search ?: null,
                ]) }}"
                    class="
                px-5
                py-2.5
                rounded-full
                text-sm
                font-medium
                transition

                {{ $status === 'active'
                    ? 'bg-green-600 text-white'
                    : 'border border-gray-200 text-gray-600 hover:border-green-300' }}
                ">
                    ● Aktif
                </a>


                <a href="{{ route('events.index', [
                    'status' => 'closed',
                    'q' => $search ?: null,
                ]) }}"
                    class="
                px-5
                py-2.5
                rounded-full
                text-sm
                font-medium
                transition

                {{ $status === 'closed'
                    ? 'bg-gray-700 text-white'
                    : 'border border-gray-200 text-gray-600 hover:border-gray-400' }}
                ">
                    Ditutup
                </a>


                <a href="{{ route('events.index', [
                    'status' => 'finished',
                    'q' => $search ?: null,
                ]) }}"
                    class="
                px-5
                py-2.5
                rounded-full
                text-sm
                font-medium
                transition

                {{ $status === 'finished'
                    ? 'bg-indigo-600 text-white'
                    : 'border border-gray-200 text-gray-600 hover:border-indigo-300' }}
                ">
                    Selesai
                </a>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- EVENT LIST --}}
    {{-- ========================================================= --}}

    <section class="
    max-w-7xl
    mx-auto
    px-4
    sm:px-6
    py-12
    sm:py-16
    ">

        <div
            class="
        flex
        flex-col
        sm:flex-row
        sm:items-end
        sm:justify-between
        gap-4
        mb-8
        ">

            <div>

                <h2
                    class="
                text-2xl
                sm:text-3xl
                font-bold
                text-[#14285a]
                ">
                    @if ($status === 'active')
                        Event Aktif
                    @elseif($status === 'closed')
                        Event Ditutup
                    @elseif($status === 'finished')
                        Event Selesai
                    @else
                        Semua Event
                    @endif
                </h2>


                <p class="text-gray-500 mt-1">
                    {{ $events->count() }} event ditemukan
                </p>

            </div>


            @if ($search !== '')
                <p class="text-sm text-gray-500">

                    Hasil pencarian:

                    <strong class="text-[#14285a]">
                        "{{ $search }}"
                    </strong>

                </p>
            @endif

        </div>



        {{-- GRID --}}
        <div
            class="
        grid

        grid-cols-1
        sm:grid-cols-2
        lg:grid-cols-3
        xl:grid-cols-4

        gap-5
        lg:gap-6
        ">

            @forelse($events as $event)
                @php

                    $isActive = $event->status === 'active';

                    $isClosed = in_array($event->status, ['closed', 'finished'], true);

                @endphp


                <article
                    class="
                relative

                bg-white

                rounded-2xl

                border
                border-gray-100

                shadow-sm

                overflow-hidden

                flex
                flex-col

                transition

                {{ $isActive ? 'hover:-translate-y-1 hover:shadow-lg' : '' }}
                ">


                    {{-- BANNER --}}
                    <div
                        class="
                    relative

                    h-44

                    bg-gray-100

                    overflow-hidden
                    ">

                        @if ($event->banner)
                            <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->name }}"
                                class="
                            w-full
                            h-full
                            object-cover

                            {{ $isClosed ? 'grayscale-[35%] opacity-80' : '' }}
                            ">
                        @else
                            <div
                                class="
                            w-full
                            h-full
                            bg-blue-50

                            flex
                            items-center
                            justify-center

                            text-blue-600
                            font-bold
                            ">
                                PICO
                            </div>
                        @endif



                        {{-- STATUS BADGE --}}
                        <div
                            class="
                        absolute
                        top-3
                        right-3
                        ">

                            @if ($event->status === 'active')
                                <span
                                    class="
                                inline-flex
                                items-center
                                gap-2

                                bg-green-500
                                text-white

                                px-3
                                py-1.5

                                rounded-full

                                text-xs
                                font-semibold

                                shadow
                                ">
                                    <span
                                        class="
                                    w-2
                                    h-2
                                    bg-white
                                    rounded-full
                                    "></span>

                                    Aktif
                                </span>
                            @elseif($event->status === 'closed')
                                <span
                                    class="
                                bg-gray-800/90
                                text-white

                                px-3
                                py-1.5

                                rounded-full

                                text-xs
                                font-semibold
                                ">
                                    Voting Ditutup
                                </span>
                            @elseif($event->status === 'finished')
                                <span
                                    class="
                                bg-indigo-600
                                text-white

                                px-3
                                py-1.5

                                rounded-full

                                text-xs
                                font-semibold
                                ">
                                    Selesai
                                </span>
                            @endif

                        </div>



                        {{-- CLOSED OVERLAY --}}
                        @if ($isClosed)
                            <div
                                class="
                            absolute
                            inset-0

                            bg-[#10204f]/10

                            pointer-events-none
                            ">
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

                        <h3
                            class="
                        font-bold
                        text-lg
                        leading-6

                        min-h-[48px]

                        line-clamp-2
                        ">
                            {{ $event->name }}
                        </h3>



                        <p
                            class="
                        text-sm
                        text-gray-500

                        leading-6

                        mt-2

                        line-clamp-2

                        min-h-[48px]
                        ">
                            {{ $event->description }}
                        </p>



                        {{-- INFO --}}
                        <div
                            class="
                        mt-5
                        pt-4

                        border-t
                        border-gray-100

                        space-y-2

                        text-xs
                        text-gray-500
                        ">

                            <div
                                class="
                            flex
                            items-center
                            justify-between
                            gap-3
                            ">

                                <span>
                                    📅
                                    {{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y') : '-' }}
                                </span>


                                <span>
                                    👥
                                    {{ $event->candidates_count ?? 0 }}
                                    Finalis
                                </span>

                            </div>


                            <div
                                class="
                            flex
                            items-center
                            justify-between
                            gap-3
                            ">

                                <span>
                                    Total Vote
                                </span>


                                <strong
                                    class="
                                {{ $isActive ? 'text-blue-600' : 'text-gray-500' }}
                                ">
                                    {{ number_format($event->total_votes ?? 0, 0, ',', '.') }}
                                </strong>

                            </div>

                        </div>



                        {{-- BUTTON --}}
                        <a href="{{ route('event.detail', $event) }}"
                            class="
                        mt-auto
                        pt-5
                        ">

                            @if ($isActive)
                                <span
                                    class="
                                block
                                w-full

                                text-center

                                bg-blue-600
                                hover:bg-blue-700

                                text-white

                                py-3

                                rounded-xl

                                text-sm
                                font-semibold

                                transition
                                ">
                                    Lihat Event →
                                </span>
                            @else
                                <span
                                    class="
                                block
                                w-full

                                text-center

                                bg-gray-100
                                hover:bg-gray-200

                                text-gray-600

                                py-3

                                rounded-xl

                                text-sm
                                font-semibold

                                transition
                                ">
                                    Lihat Hasil →
                                </span>
                            @endif

                        </a>

                    </div>

                </article>


            @empty

                <div
                    class="
                col-span-full

                bg-white

                border
                border-gray-100

                rounded-3xl

                py-16

                text-center
                ">

                    <div class="text-5xl">
                        🔍
                    </div>


                    <h3 class="font-bold text-xl mt-4">
                        Event Tidak Ditemukan
                    </h3>


                    <p class="text-gray-500 mt-2">
                        Coba ubah kata pencarian atau filter event Anda.
                    </p>


                    <a href="{{ route('events.index') }}"
                        class="
                    inline-block
                    mt-5

                    text-blue-600
                    font-semibold
                    ">
                        Tampilkan Semua Event
                    </a>

                </div>
            @endforelse

        </div>
        {{-- ========================================================= --}}
        {{-- PAGINATION --}}
        {{-- ========================================================= --}}

        @if ($events->hasPages())
            <div
                class="
        mt-10
        sm:mt-12

        pt-7

        border-t
        border-gray-100
        ">

                {{ $events->onEachSide(1)->links() }}

            </div>
        @endif

    </section>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="
    bg-[#0a1b3d]
    text-white
    ">

        <div
            class="
        max-w-7xl
        mx-auto

        px-4
        sm:px-6

        py-10
        sm:py-12

        flex
        flex-col
        sm:flex-row

        sm:items-center
        sm:justify-between

        gap-6
        ">

            <div>

                <div class="flex items-center gap-3">

                    <div
                        class="
                    w-11
                    h-11

                    rounded-xl

                    bg-blue-600

                    flex
                    items-center
                    justify-center

                    font-bold
                    text-xl
                    ">
                        P
                    </div>


                    <div>

                        <p class="font-bold text-xl">
                            PICO
                        </p>

                        <p class="text-xs text-white/50">
                            Digital Voting Platform
                        </p>

                    </div>

                </div>

            </div>


            <p class="text-sm text-white/50">
                © {{ date('Y') }} PICO. All rights reserved.
            </p>

        </div>

    </footer>


</body>

</html>
