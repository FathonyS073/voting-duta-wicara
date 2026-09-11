<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Duta Wicara Jawa Timur 2026
    </title>
    @vite(['resources/css/app.css'])
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>
<body class="bg-white text-gray-800">
    <!-- NAVBAR -->

    @include('partials.navbar', [
        'activePage' => 'home'
    ])
    <!-- HERO -->

    <section
    id="beranda"
    class="relative min-h-180 lg:min-h-screen
           bg-cover bg-center flex items-center overflow-hidden pt-20"
    style="background-image:url('{{ asset('Images/background_hero.webp') }}');">


        <div class="absolute inset-0 bg-[#16052b]/40"></div>


        <div class="relative max-w-7xl mx-auto px-8 w-full">
            <div class="grid md:grid-cols-2 items-center">
                <!-- TEXT -->
                <div class="text-white text-center lg:text-left pt-10 lg:pt-0">
                    <p class="tracking-[8px] text-sm mb-5">
                        PEMILIHAN
                    </p>

                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-serif leading-tight">
                        DUTA WICARA
                        <br>

                        JAWA TIMUR 2026

                    </h1>



                    <p class="mt-5 sm:mt-6 text-base sm:text-lg lg:text-xl">

                        Suara Muda untuk<br>
                        Jawa Timur yang Lebih Baik

                    </p>



                    <button class="mt-8 bg-[#e7b24b]
text-black
px-8 py-3
rounded-full
font-semibold">

                        Vote Sekarang →
                    </button>
                </div>
                <!-- HERO IMAGE -->

                <div class="flex justify-center items-end mt-8 lg:mt-0">
                
                    <img
                        src="{{ asset('Images/Hero.webp') }}"
                        alt="Duta Wicara Jawa Timur"
                        class="max-h-100 sm:max-h-125 lg:max-h-162.5
                               w-auto object-contain">
                
                </div>


            </div>


        </div>


    </section>





    <!-- STATISTIC -->

        <!-- STATISTIC -->
        <section class="-mt-8 sm:-mt-12 lg:-mt-10 relative z-20 px-4 sm:px-6">
        
            <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-xl p-4 sm:p-6 lg:p-8">
            
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-6 sm:gap-6 text-center">
                
                    <!-- FINALIS -->
                    <div class="min-w-0 px-1 sm:px-2">
                    
                        <h3 class="font-bold text-base sm:text-lg lg:text-xl text-[#172033] leading-tight">
                            30 Peserta
                        </h3>
                    
                        <p class="mt-1 text-xs sm:text-sm lg:text-base text-gray-500">
                            Finalis
                        </p>
                    
                    </div>
                
                
                    <!-- PERIODE -->
                    <div class="min-w-0 px-1 sm:px-2">
                    
                        <h3 class="font-bold text-sm sm:text-lg lg:text-xl text-[#172033] leading-snug">
                            1 Ags - 7 Okt 2026
                        </h3>
                    
                        <p class="mt-1 text-xs sm:text-sm lg:text-base text-gray-500">
                            Periode Voting
                        </p>
                    
                    </div>
                
                
                    <!-- TOTAL VOTE -->
                    <div class="min-w-0 px-1 sm:px-2">
                    
                        <h3 class="font-bold text-base sm:text-lg lg:text-xl text-[#172033] leading-tight">
                            125.430+
                        </h3>
                    
                        <p class="mt-1 text-xs sm:text-sm lg:text-base text-gray-500">
                            Total Vote
                        </p>
                    
                    </div>
                
                
                    <!-- MEDIA -->
                    <div class="min-w-0 px-1 sm:px-2 overflow-hidden">
                    
                        <h3 class="font-bold text-sm sm:text-lg lg:text-xl text-[#172033] leading-snug break-words">
                            @dutawicarajatim
                        </h3>
                    
                        <p class="mt-1 text-xs sm:text-sm lg:text-base text-gray-500">
                            Official Media
                        </p>
                    
                    </div>
                
                </div>
            
            </div>
        
        </section>
    <!-- ABOUT -->
    <section id="tentang" class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center">
                <div>
                    <p class="text-yellow-600 tracking-[5px]">
                        TENTANG ACARA
                    </p>
                    <h2 class="text-3xl sm:text-4xl font-bold mt-3">
                        Duta Wicara Jawa Timur
                    </h2>
                    <p class="mt-6 leading-relaxed">

                        Duta Wicara Jawa Timur merupakan ajang pencarian
                        generasi muda Jawa Timur yang berprestasi,
                        berkarakter dan mampu menjadi inspirasi masyarakat.

                    </p>
                    <button class="mt-6 border border-yellow-500 px-6 py-3 rounded-full">
                        Selengkapnya
                    </button>
                </div>
                <div class="rounded-3xl overflow-hidden">

                    <img src="{{ asset('Images/background_hero.webp') }}" class="w-full">

                </div>
            </div>
        </div>
    </section>
    <!-- FINALIS PREVIEW -->

            <!-- FINALIS PREVIEW -->
        <section id="finalis" class="bg-[#faf8ff] py-16 sm:py-20">
        
            <div class="max-w-7xl mx-auto px-5 sm:px-8">
            
                <!-- HEADER FINALIS -->
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-10">
                
                    <div>
                    
                        <p class="text-[#c48621] tracking-[5px] text-xs sm:text-sm font-medium">
                            FINALIS
                        </p>
                    
                        <h2 class="text-3xl sm:text-4xl font-bold mt-2 text-[#172033]">
                            Kenali Para Finalis
                        </h2>
                    
                        <p class="text-gray-500 mt-2">
                            Dukung finalis favoritmu dan jadilah bagian dari perjalanan mereka.
                        </p>
                    
                    </div>
                
                
                    <a
                        href="#"
                        class="self-start sm:self-auto border border-[#d49b2d]
                            px-5 py-2.5 rounded-full text-sm
                            hover:bg-[#d49b2d] hover:text-white transition">
                
                        Lihat Semua Finalis →
                
                    </a>
                
                </div>
            
            
            
                <!-- GRID FINALIS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                
                
                    @foreach($candidates as $candidate)
                
                        <div
                            class="bg-white rounded-2xl border border-gray-100
                                shadow-sm overflow-hidden
                                hover:-translate-y-1 hover:shadow-lg
                                transition duration-300">
                
                            <!-- FOTO -->
                            <div class="p-3 pb-0">
                            
                                <img
                                    src="{{ asset('storage/'.$candidate->photo) }}"
                                    alt="{{ $candidate->name }}"
                                    class="w-full h-[260px] sm:h-[250px] lg:h-[230px]
                                        object-cover rounded-xl">
                            
                            </div>
                        
                        
                            <!-- INFO -->
                            <div class="px-4 pt-4 pb-4 text-center">
                            
                                <h3 class="font-bold text-[#172033] text-base">
                                    {{ $candidate->name }}
                                </h3>
                            
                                <p class="text-gray-500 text-sm mt-1">
                                    {{ $candidate->city }}
                                </p>
                            
                            
                                <p class="font-semibold text-[#172033] mt-3">
                                    {{ number_format(
                                        $candidate->total_votes ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }} vote
                                </p>
                            
                            
                                <a
                                    href="{{ route('candidate.detail', $candidate->id) }}"
                                    class="block mt-4 bg-[#5b0b83]
                                        hover:bg-[#430563]
                                        text-white py-2.5 rounded-full
                                        text-sm font-medium transition">
                            
                                    Vote Sekarang
                            
                                </a>
                            
                            </div>
                        
                        </div>
                    
                    @endforeach
                    
                    
                </div>
            
            </div>
        
        </section>
    </section>





    <!-- CTA VOTE -->

    <section class="bg-[#16052b] py-16 text-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="flex flex-col lg:flex-row text-center lg:text-left items-center justify-between gap-8">
                <div>
                    <p class="text-yellow-400 tracking-[5px] text-sm">
                        AJAKAN VOTE
                    </p>
                    <h2 class="text-4xl font-bold mt-3">
                        Suaramu Berarti!
                    </h2>
                    <p class="mt-4 text-gray-300 max-w-xl">
                        Dukung finalis favoritmu dan jadilah bagian
                        dari perjalanan mereka menuju Duta Wicara
                        Jawa Timur 2026.
                    </p>
                </div>
                <a href="#finalis"
                    class="bg-[#e7b24b] text-black px-8 py-3 rounded-full font-semibold whitespace-nowrap hover:bg-[#f3c65f] transition">
                    Vote Sekarang
                </a>
            </div>
        </div>
    </section>
    <!-- CARAVOTE -->
    <section id="cara-vote" class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center">
                <p class="text-yellow-600 tracking-[5px] text-sm">
                    INFORMASI VOTING
                </p>
                <h2 class="text-4xl font-bold mt-3">
                    Bagaimana Cara Vote?
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mt-14">
                <div class="text-center">
                    <div
                        class=" w-14 h-14 mx-auto rounded-full bg-purple-900 text-white flex items-center justify-center font-bold text-xl">
                        1
                    </div>
                    <h3 class="font-bold mt-5">
                        Pilih Finalis
                    </h3>
                    <p class="text-gray-500 mt-2">
                        Pilih finalis favoritmu
                        dari daftar peserta.
                    </p>
                </div>
                <div class="text-center">
                    <div
                        class=" w-14 h-14 mx-auto rounded-full bg-purple-900 text-white flex items-center justify-center font-bold text-xl">
                        2
                    </div>
                    <h3 class="font-bold mt-5">
                        Pilih Paket Vote
                    </h3>
                    <p class="text-gray-500 mt-2">
                        Tentukan jumlah vote
                        yang ingin diberikan.
                    </p>
                </div>
                <div class="text-center">
                    <div
                        class=" w-14 h-14 mx-auto rounded-full bg-purple-900 text-white flex items-center justify-center font-bold text-xl">
                        3
                    </div>
                    <h3 class="font-bold mt-5">
                        Pembayaran
                    </h3>
                    <p class="text-gray-500 mt-2">
                        Selesaikan pembayaran
                        melalui metode tersedia.
                    </p>
                </div>
                <div class="text-center">
                    <div
                        class=" w-14 h-14 mx-auto rounded-full bg-purple-900 text-white flex items-center justify-center font-bold text-xl">
                        ✓
                    </div>
                    <h3 class="font-bold mt-5">
                        Vote Berhasil
                    </h3>
                    <p class="text-gray-500 mt-2">
                        Vote langsung dihitung
                        ke finalis pilihan.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER -->

    <footer class="bg-[#16052b] text-white py-10">


        <div class="text-center">
            Duta Wicara Jawa Timur 2026
        </div>
    </footer>
    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        document.querySelectorAll('#mobileMenu a').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    </script>
</body>

</html>
