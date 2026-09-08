<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Finalis - {{ $event->name }}
    </title>

    @vite(['resources/css/app.css'])

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>


<body class="bg-[#faf8ff] text-[#172033]">


<!-- ===================================================== -->
<!-- NAVBAR -->
<!-- ===================================================== -->

@include('partials.navbar', [
    'activePage' => 'finalis'
])




<!-- ===================================================== -->
<!-- HEADER FINALIS -->
<!-- ===================================================== -->

<section class=" pt-36 pb-16 sm:pt-40 sm:pb-20 relative overflow-hidden bg-[#fbf7f2] ">
    <!-- DEKORASI -->
    <div
        class="
        absolute
        inset-0
        bg-cover
        bg-center
        "
        style="background-image:
        url('{{ asset('Images/background_finalis.webp') }}');"
    ></div>
    <div class="relative max-w-7xl mx-auto px-5 sm:px-8 text-center">


        <p
            class="
            text-[#e7b24b]
            tracking-[6px]
            text-xs
            sm:text-sm
            font-medium
            "
        >

            PARA FINALIS

        </p>



        <h1
            class="
            text-white
            mt-4
            text-3xl
            sm:text-4xl
            lg:text-5xl
            font-bold
            leading-tight
            "
        >

            Finalis {{ $event->name }}

        </h1>



        <p
            class="
            max-w-xl
            mx-auto
            mt-4
            text-gray-200
            text-sm
            sm:text-base
            "
        >

            Kenali para finalis dan dukung kandidat favoritmu
            menjadi bagian dari perjalanan Duta Wicara Jawa Timur.

        </p>

    </div>

</section>





<!-- ===================================================== -->
<!-- FINALIS -->
<!-- ===================================================== -->

<section
    id="finalis"
    class="py-14 sm:py-20"
>

    <div class="max-w-7xl mx-auto px-5 sm:px-8">


        <!-- HEADER -->

        <!-- HEADER FINALIS -->
        <div class="mb-8 sm:mb-10">
        
            <div
                class="
                flex
                flex-col
                lg:flex-row
                lg:items-end
                lg:justify-between
                gap-6
                "
            >
        
                <!-- JUDUL -->
                <div>
                
                    <p class="text-[#c48621] tracking-[5px] text-xs font-medium">
                        FINALIS
                    </p>
                
                    <h2
                        class="
                        mt-2
                        text-2xl
                        sm:text-3xl
                        lg:text-4xl
                        font-bold
                        text-[#172033]
                        "
                    >
                        Pilih Finalis Favoritmu
                    </h2>
                
                    <p class="text-gray-500 mt-2 text-sm sm:text-base">
                    
                        @if($search !== '' || $selectedCity)
                    
                            Ditemukan
                            <span class="font-semibold text-[#172033]">
                                {{ $candidates->count() }}
                            </span>
                            finalis.
                        
                        @else
                        
                            Terdapat
                            <span class="font-semibold text-[#172033]">
                                {{ $candidates->count() }}
                            </span>
                            finalis yang dapat kamu dukung.
                        
                        @endif
                        
                    </p>
                
                </div>
            
            
                <!-- SEARCH -->
                <form
                    action="{{ route('event.detail', $event->id) }}"
                    method="GET"
                    class="w-full lg:w-[420px]"
                >
            
                    @if($selectedCity)
                        <input
                            type="hidden"
                            name="city"
                            value="{{ $selectedCity }}"
                        >
                    @endif
            
            
                    <div class="relative">
                    
                        <!-- ICON SEARCH -->
                        <div
                            class="
                            absolute
                            inset-y-0
                            left-0
                            pl-4
                            flex
                            items-center
                            pointer-events-none
                            text-gray-400
                            "
                        >
                    
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                    
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                />
                    
                            </svg>
                        
                        </div>
                    
                    
                        <!-- INPUT -->
                        <input
                            type="text"
                            name="q"
                            value="{{ $search }}"
                            placeholder="Cari nama atau kabupaten/kota..."
                            class="
                            w-full
                            bg-white
                            border
                            border-gray-200
                            rounded-full
                            pl-12
                            pr-28
                            py-3.5
                            text-sm
                            outline-none
                            transition
                            focus:border-[#5b0b83]
                            focus:ring-2
                            focus:ring-[#5b0b83]/10
                            "
                        >
                    
                    
                        <!-- BUTTON -->
                        <button type="submit" class=" absolute right-1.5 top-1/2 -translate-y-1/2 bg-[#5b0b83] hover:bg-[#430563] text-white px-5 py-2 rounded-full text-sm font-medium transition ">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
            <!-- FILTER KOTA -->
            <div class="mb-8 sm:mb-10">
                <div
                    class=" flex gap-2 sm:gap-3 overflow-x-auto pb-3 sm:flex-wrap sm:overflow-visible scrollbar-hide "
                >
                    <!-- SEMUA -->
                    <a
                        href="{{ route('event.detail', [
                            'id' => $event->id,
                            'q' => $search ?: null
                        ]) }}"
                        class=" shrink-0 px-5 py-2.5 rounded-full text-sm font-medium border whitespace-nowrap transition
            
                        {{ empty($selectedCity)
                            ? 'bg-[#5b0b83] text-white border-[#5b0b83]'
                            : 'bg-white text-gray-600 border-gray-200 hover:border-[#5b0b83] hover:text-[#5b0b83]'
                        }}
                        "
                    >
                        Semua
                    </a>
                
                
                    @foreach($cities as $city)
                
                        <a
                            href="{{ route('event.detail', [
                                'id' => $event->id,
                                'city' => $city,
                                'q' => $search ?: null
                            ]) }}"
                            class=" shrink-0 px-5 py-2.5 rounded-full text-sm font-medium border whitespace-nowrap transition
                
                            {{ $selectedCity === $city
                                ? 'bg-[#5b0b83] text-white border-[#5b0b83]'
                                : 'bg-white text-gray-600 border-gray-200 hover:border-[#5b0b83] hover:text-[#5b0b83]'
                            }}
                            "
                        >
                            {{ $city }}
                        </a>
                    @endforeach
                </div>
                <!-- RESET FILTER -->
                @if($search !== '' || $selectedCity)
                    <div class="mt-3">
                        <a
                            href="{{ route('event.detail', $event->id) }}"
                            class=" inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#5b0b83] transition ">
                            <span>×</span>
                            Hapus semua filter
                        </a>
                    
                    </div>
                
                @endif
                
            </div>



        <!-- GRID -->

        @if($candidates->count())


            <div
                class=" grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 ">
                @foreach($candidates as $candidate)
                    <div class=" bg-white rounded-[22px] border border-gray-100 shadow-sm overflow-hidden group hover:-translate-y-1 hover:shadow-xl transition duration-300 flex flex-col ">
                        <!-- FOTO -->
                        <div class="p-3 pb-0">
                            <div
                                class=" overflow-hidden rounded-2xl bg-gray-100 aspect-4/5 ">
                                <img
                                    src="{{ asset('storage/'.$candidate->photo) }}"
                                    alt="{{ $candidate->name }}"
                                    class=" w-full h-full object-cover group-hover:scale-105 transition duration-500 "
                                >
                            </div>
                        </div>
                        <!-- DATA -->
                        <div class="p-4 sm:p-5 text-center flex flex-col flex-1">
                            <h3 class=" font-bold text-base sm:text-lg text-[#172033] leading-snug ">
                                {{ $candidate->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 ">
                                {{ $candidate->city }}
                            </p>
                            <!-- KATEGORI -->
                            @if($candidate->categories->count())
                                <div
                                    class=" flex flex-wrap justify-center gap-1.5 mt-3 ">
                                    @foreach($candidate->categories as $category)
                                        <span
                                            class="
                                            text-[11px]
                                            bg-[#f6effa]
                                            text-[#5b0b83]
                                            px-2.5
                                            py-1
                                            rounded-full
                                            "
                                        >

                                            {{ $category->name }}

                                        </span>

                                    @endforeach

                                </div>

                            @endif




                            <!-- VOTE -->

                            <p
                                class="
                                mt-4
                                text-lg
                                font-bold
                                text-[#172033]
                                "
                            >

                                {{ number_format(
                                    $candidate->total_votes ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                                <span class="text-sm font-medium">
                                    vote
                                </span>

                            </p>




                            <!-- BUTTON -->

                            <a
                                href="{{ route(
                                    'candidate.detail',
                                    $candidate->id
                                ) }}"
                                class="
                                mt-5
                                block
                                w-full
                                bg-[#5b0b83]
                                hover:bg-[#430563]
                                text-white
                                py-2.5
                                rounded-full
                                font-medium
                                text-sm
                                transition
                                "
                            >

                                Vote Sekarang

                            </a>


                        </div>


                    </div>


                @endforeach


            </div>


    @else

        <div
            class="
            bg-white
            border
            border-gray-100
            rounded-3xl
            px-6
            py-14
            sm:py-20
            text-center
            "
        >

            <!-- ICON -->
            <div
                class="
                w-16
                h-16
                mx-auto
                rounded-full
                bg-[#f6effa]
                flex
                items-center
                justify-center
                text-[#5b0b83]
                "
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
                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                    />

                </svg>

            </div>


            <h3 class="text-xl font-bold mt-5 text-[#172033]">
                Finalis Tidak Ditemukan
            </h3>


            <p class="text-gray-500 mt-2 max-w-md mx-auto">

                Tidak ada finalis yang sesuai dengan pencarian atau
                filter yang Anda gunakan.

            </p>


            <a
                href="{{ route('event.detail', $event->id) }}"
                class="
                inline-flex
                mt-6
                bg-[#5b0b83]
                hover:bg-[#430563]
                text-white
                px-6
                py-2.5
                rounded-full
                text-sm
                font-medium
                transition
                "
            >
                Tampilkan Semua Finalis
            </a>

        </div>

    @endif


    </div>

</section>





<!-- ===================================================== -->
<!-- CTA -->
<!-- ===================================================== -->

<section class="bg-[#16052b] text-white py-14">

    <div
        class="
        max-w-7xl
        mx-auto
        px-5
        sm:px-8
        flex
        flex-col
        md:flex-row
        items-center
        justify-between
        gap-6
        text-center
        md:text-left
        "
    >


        <div>

            <p class="text-[#e7b24b] tracking-[4px] text-xs">
                DUKUNG FINALISMU
            </p>


            <h2 class="text-2xl sm:text-3xl font-bold mt-2">

                Suaramu Berarti

            </h2>


            <p class="mt-2 text-gray-300">

                Pilih finalis favoritmu dan berikan dukungan terbaikmu.

            </p>

        </div>


        <a
            href="#finalis"
            class="
            bg-[#e7b24b]
            text-black
            px-8
            py-3
            rounded-full
            font-semibold
            whitespace-nowrap
            "
        >

            Vote Sekarang →

        </a>

    </div>

</section>





<!-- ===================================================== -->
<!-- FOOTER -->
<!-- ===================================================== -->

<footer class="bg-[#10001d] text-white py-12">

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
            class="h-10"
            alt="Duta Wicara Jawa Timur"
        >


        <p class="text-sm text-gray-400 text-center sm:text-right">

            © 2026 Duta Wicara Jawa Timur.
            All rights reserved.

        </p>


    </div>

</footer>





<!-- ===================================================== -->
<!-- MOBILE MENU SCRIPT -->
<!-- ===================================================== -->

<script>

    const mobileMenuButton =
        document.getElementById('mobileMenuButton');

    const mobileMenu =
        document.getElementById('mobileMenu');


    mobileMenuButton.addEventListener('click', () => {

        mobileMenu.classList.toggle('hidden');

    });


    document
        .querySelectorAll('#mobileMenu a')
        .forEach((link) => {

            link.addEventListener('click', () => {

                mobileMenu.classList.add('hidden');

            });

        });

</script>
</body>

</html>