    <footer class="
        bg-[#3b1018]
        text-white
        ">

        <div
            class="
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

                    <img src="{{ asset('Images/logo.webp') }}" alt="PICO"
                        class="
                h-14
                sm:h-13
                lg:h-14
                w-auto
                object-contain
                ">



                    <div>

                        <p
                            class="
                            font-bold

                            text-2xl
                            sm:text-3xl
                            ">
                            Vooters
                        </p>

                        <p class="text-xs text-white/50">
                            Digital Voting Platform
                        </p>

                    </div>

                </div>



                <p
                    class="
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

                    {{-- INSTAGRAM --}}
                    <div
                        class="
        w-9
        h-9
        rounded-lg
        border
        border-white/10
        flex
        items-center
        justify-center
        text-white/70
        hover:text-[#D4AF37]
        hover:border-[#D4AF37]/50
        transition
        ">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" class="w-5 h-5">

                            <rect x="3" y="3" width="18" height="18" rx="5" ry="5" />

                            <circle cx="12" cy="12" r="4" />

                            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none" />

                        </svg>

                    </div>


                    {{-- YOUTUBE --}}
                    <div
                        class="
        w-9
        h-9
        rounded-lg
        border
        border-white/10
        flex
        items-center
        justify-center
        text-white/70
        hover:text-[#D4AF37]
        hover:border-[#D4AF37]/50
        transition
        ">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">

                            <path
                                d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.6 15.6V8.4L15.8 12l-6.2 3.6Z" />

                        </svg>

                    </div>


                    {{-- TIKTOK --}}
                    <div
                        class="
        w-9
        h-9
        rounded-lg
        border
        border-white/10
        flex
        items-center
        justify-center
        text-white/70
        hover:text-[#D4AF37]
        hover:border-[#D4AF37]/50
        transition
        ">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">

                            <path
                                d="M16.7 3c.3 1.8 1.4 3.3 3 4.2v3.2a8.2 8.2 0 0 1-3-1v6.1a6.5 6.5 0 1 1-5.6-6.4v3.3a3.2 3.2 0 1 0 2.3 3.1V3h3.3Z" />

                        </svg>

                    </div>

                </div>

            </div>



            {{-- NAV --}}
            <div>

                <h3 class="font-bold">
                    Navigasi
                </h3>

                <div
                    class="
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
                        Tentang Vooters
                    </a>

                </div>

            </div>



            {{-- HELP --}}
            <div>

                <h3 class="font-bold">
                    Bantuan
                </h3>

                <div
                    class="
                    mt-5
                    space-y-3

                    text-sm
                    text-white/60
                    ">
                    <a href="{{ route('help') }}" class="hover:text-white">
                        Pusat Bantuan
                    </a> <br>
                    <a href="{{ route('privacy') }}" class="hover:text-white">
                        Kebijakan Privasi
                    </a> <br>
                    <a href="{{ route('terms') }}" class="hover:text-white">
                        Syarat & Ketentuan
                    </a> <br>
                    <a href="{{ route('contact') }}" class="hover:text-white">
                        Hubungi Kami
                    </a><br>
                    <a href="{{ route('faq') }}" class="hover:text-white">
                        FAQ
                    </a>

                </div>

            </div>



            {{-- CONTACT --}}
            <div>

                <h3 class="font-bold">
                    Kontak
                </h3>

                <div
                    class="
                    mt-5
                    space-y-4

                    text-sm
                    text-white/60
                    ">

                    <p class="break-all">
                        ✉ vooters.id@gmail.com
                    </p>

                    <p>
                        ☎ +62 xxx xxxx xxxx
                    </p>

                    <p>
                        📍 Indonesia
                    </p>

                </div>


                <p
                    class="
                    mt-8

                    text-[#D4AF37]

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

            <div
                class="
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
                    © {{ date('Y') }} Vooters. All rights reserved.
                </p>

                <p>
                    Dibangun untuk Indonesia ♥
                </p>

            </div>

        </div>

    </footer>
