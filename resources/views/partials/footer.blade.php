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

                    <div
                        class="
                        w-11
                        h-11
                        sm:w-12
                        sm:h-12

                        rounded-xl

                        bg-[#7A1F2B]

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

                        <p
                            class="
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
                        ">
                        IG
                    </div>


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
                        ">
                        YT
                    </div>


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
                        Tentang PICO
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
                        ✉ hello@pico.id
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
                    © {{ date('Y') }} PICO. All rights reserved.
                </p>

                <p>
                    Dibangun untuk Indonesia ♥
                </p>

            </div>

        </div>

    </footer>
