<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Tentang PICO - Digital Voting Platform
    </title>

    @vite(['resources/css/app.css'])

</head>


<body class="bg-white text-[#10204f] overflow-x-hidden">


    @include('partials.navbar')



    {{-- ========================================================= --}}
    {{-- HERO --}}
    {{-- ========================================================= --}}

    <section
        class="
    pt-28
    sm:pt-32
    pb-14
    sm:pb-20

    bg-linear-to-br
    from-blue-50
    via-white
    to-blue-100

    overflow-hidden
    ">

        <div
            class="
        max-w-7xl
        mx-auto

        px-4
        sm:px-6

        grid
        grid-cols-1
        lg:grid-cols-2

        gap-10
        lg:gap-14

        items-center
        ">


            {{-- TEXT --}}
            <div>

                <p
                    class="
                text-blue-600

                text-xs
                sm:text-sm

                font-semibold

                uppercase

                tracking-[3px]
                sm:tracking-[4px]
                ">
                    Tentang PICO
                </p>


                <h1
                    class="
                mt-4

                text-4xl
                sm:text-5xl
                lg:text-6xl

                leading-[1.08]

                font-extrabold

                text-[#14285a]
                ">
                    Satu Platform untuk

                    <span class="text-blue-600">
                        Berbagai Voting Digital
                    </span>
                </h1>


                <p
                    class="
                mt-6

                text-base
                sm:text-lg

                text-gray-600

                leading-8

                max-w-xl
                ">
                    PICO adalah platform voting digital yang dirancang
                    untuk membantu penyelenggara mengelola berbagai event
                    voting secara lebih mudah, terstruktur, dan profesional.
                    Pengguna dapat menemukan event, mengenal finalis,
                    memberikan dukungan, serta mengikuti perkembangan
                    peringkat melalui satu platform.
                </p>


                <div
                    class="
                mt-8

                flex
                flex-col
                sm:flex-row

                gap-3
                sm:gap-4
                ">

                    <a href="{{ route('events.index') }}"
                        class="
                    inline-flex
                    items-center
                    justify-center

                    gap-2

                    bg-blue-600
                    hover:bg-blue-700

                    text-white

                    px-7
                    py-3.5

                    rounded-xl

                    font-semibold

                    shadow-lg

                    transition
                    ">
                        Jelajahi Event
                        <span>→</span>
                    </a>


                    <a href="#mengapa-pico"
                        class="
                    inline-flex
                    items-center
                    justify-center

                    border
                    border-blue-200

                    text-blue-600

                    px-7
                    py-3.5

                    rounded-xl

                    font-semibold

                    hover:bg-blue-50

                    transition
                    ">
                        Pelajari PICO
                    </a>

                </div>

            </div>



            {{-- VISUAL --}}
            <div
                class="
            relative

            min-h-[340px]
            sm:min-h-[420px]

            flex
            items-center
            justify-center
            ">

                <div
                    class="
                absolute

                w-72
                h-72

                sm:w-96
                sm:h-96

                bg-blue-300/30

                rounded-full

                blur-3xl
                ">
                </div>


                <div
                    class="
                relative

                w-full
                max-w-[520px]

                bg-white/80
                backdrop-blur

                border
                border-blue-100

                shadow-xl

                rounded-[32px]

                p-5
                sm:p-7
                ">


                    <div
                        class="
                    bg-[#10204f]

                    rounded-2xl

                    p-5

                    text-white
                    ">

                        <div
                            class="
                        flex
                        items-center
                        justify-between
                        ">

                            <div class="flex items-center gap-3">

                                <div
                                    class="
                                w-10
                                h-10

                                rounded-xl

                                bg-blue-600

                                flex
                                items-center
                                justify-center

                                font-bold
                                ">
                                    P
                                </div>


                                <div>

                                    <p class="font-bold">
                                        Dashboard PICO
                                    </p>

                                    <p class="text-xs text-white/50">
                                        Digital Voting Platform
                                    </p>

                                </div>

                            </div>


                            <span
                                class="
                            text-xs

                            bg-green-500/20
                            text-green-300

                            px-3
                            py-1.5

                            rounded-full
                            ">
                                Realtime
                            </span>

                        </div>



                        <div
                            class="
                        grid
                        grid-cols-2

                        gap-3

                        mt-5
                        ">

                            <div
                                class="
                            bg-white/10

                            rounded-xl

                            p-4
                            ">

                                <p
                                    class="
                                text-2xl
                                font-bold
                                ">
                                    250+
                                </p>

                                <p class="text-xs text-white/60 mt-1">
                                    Event
                                </p>

                            </div>


                            <div
                                class="
                            bg-white/10

                            rounded-xl

                            p-4
                            ">

                                <p
                                    class="
                                text-2xl
                                font-bold
                                ">
                                    1,2 Juta
                                </p>

                                <p class="text-xs text-white/60 mt-1">
                                    Vote
                                </p>

                            </div>

                        </div>



                        <div
                            class="
                        mt-4

                        bg-white/10

                        rounded-xl

                        p-4
                        ">

                            <div
                                class="
                            flex
                            items-end
                            gap-2

                            h-24
                            ">

                                <div class="w-full h-[30%] bg-blue-400 rounded-t"></div>
                                <div class="w-full h-[45%] bg-blue-400 rounded-t"></div>
                                <div class="w-full h-[38%] bg-blue-400 rounded-t"></div>
                                <div class="w-full h-[62%] bg-blue-400 rounded-t"></div>
                                <div class="w-full h-[55%] bg-blue-400 rounded-t"></div>
                                <div class="w-full h-[80%] bg-blue-400 rounded-t"></div>
                                <div class="w-full h-full bg-blue-400 rounded-t"></div>

                            </div>

                        </div>

                    </div>


                    <div
                        class="
                    grid
                    grid-cols-3

                    gap-3

                    mt-4
                    ">

                        <div
                            class="
                        bg-blue-50
                        rounded-xl
                        p-3
                        text-center
                        ">
                            <div class="text-xl">🗳️</div>
                            <p class="text-xs font-semibold mt-1">
                                Voting
                            </p>
                        </div>


                        <div
                            class="
                        bg-green-50
                        rounded-xl
                        p-3
                        text-center
                        ">
                            <div class="text-xl">📊</div>
                            <p class="text-xs font-semibold mt-1">
                                Ranking
                            </p>
                        </div>


                        <div
                            class="
                        bg-amber-50
                        rounded-xl
                        p-3
                        text-center
                        ">
                            <div class="text-xl">🎯</div>
                            <p class="text-xs font-semibold mt-1">
                                Event
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- APA ITU PICO --}}
    {{-- ========================================================= --}}

    <section id="mengapa-pico" class="
    max-w-7xl
    mx-auto

    px-4
    sm:px-6

    py-16
    sm:py-20
    ">

        <div
            class="
        grid
        grid-cols-1
        lg:grid-cols-[0.9fr_1.1fr]

        gap-10
        lg:gap-16

        items-center
        ">


            <div>

                <p
                    class="
                text-blue-600

                text-xs

                uppercase

                tracking-[4px]

                font-semibold
                ">
                    Mengenal PICO
                </p>


                <h2
                    class="
                mt-3

                text-3xl
                sm:text-4xl

                font-extrabold

                text-[#14285a]
                ">
                    Voting Digital yang Lebih Sederhana
                </h2>


                <p
                    class="
                mt-5

                text-gray-600

                leading-8
                ">
                    PICO dibangun sebagai platform multi-event sehingga tidak
                    terbatas pada satu kompetisi atau satu jenis pemilihan saja.
                    Pageant, kompetisi kampus, penghargaan, komunitas,
                    organisasi, dan berbagai bentuk voting lainnya dapat
                    dikelola melalui sistem yang sama.
                </p>


                <p
                    class="
                mt-4

                text-gray-600

                leading-8
                ">
                    Setiap event memiliki ruang tersendiri untuk menampilkan
                    informasi acara, finalis, peringkat, kategori voting,
                    periode pelaksanaan, hingga proses pembayaran.
                </p>

            </div>



            <div
                class="
            grid
            grid-cols-1
            sm:grid-cols-2

            gap-4
            ">


                <div
                    class="
                bg-blue-50

                border
                border-blue-100

                rounded-3xl

                p-6
                ">

                    <div
                        class="
                    w-12
                    h-12

                    rounded-2xl

                    bg-blue-600

                    text-white

                    flex
                    items-center
                    justify-center

                    text-xl
                    ">
                        📅
                    </div>


                    <h3 class="font-bold text-lg mt-5">
                        Multi Event
                    </h3>


                    <p
                        class="
                    text-sm
                    text-gray-500

                    leading-6

                    mt-2
                    ">
                        Banyak event voting dapat dikelola secara terpisah
                        dalam satu platform.
                    </p>

                </div>



                <div
                    class="
                bg-emerald-50

                border
                border-emerald-100

                rounded-3xl

                p-6
                ">

                    <div
                        class="
                    w-12
                    h-12

                    rounded-2xl

                    bg-emerald-500

                    text-white

                    flex
                    items-center
                    justify-center

                    text-xl
                    ">
                        📊
                    </div>


                    <h3 class="font-bold text-lg mt-5">
                        Ranking Realtime
                    </h3>


                    <p
                        class="
                    text-sm
                    text-gray-500

                    leading-6

                    mt-2
                    ">
                        Perolehan dukungan dapat dipantau melalui papan
                        peringkat setiap event.
                    </p>

                </div>



                <div
                    class="
                bg-violet-50

                border
                border-violet-100

                rounded-3xl

                p-6
                ">

                    <div
                        class="
                    w-12
                    h-12

                    rounded-2xl

                    bg-violet-500

                    text-white

                    flex
                    items-center
                    justify-center

                    text-xl
                    ">
                        👥
                    </div>


                    <h3 class="font-bold text-lg mt-5">
                        Profil Finalis
                    </h3>


                    <p
                        class="
                    text-sm
                    text-gray-500

                    leading-6

                    mt-2
                    ">
                        Pengguna dapat mengenal finalis melalui profil,
                        prestasi, visi, misi, dan informasi lainnya.
                    </p>

                </div>



                <div
                    class="
                bg-amber-50

                border
                border-amber-100

                rounded-3xl

                p-6
                ">

                    <div
                        class="
                    w-12
                    h-12

                    rounded-2xl

                    bg-amber-500

                    text-white

                    flex
                    items-center
                    justify-center

                    text-xl
                    ">
                        🔐
                    </div>


                    <h3 class="font-bold text-lg mt-5">
                        Transaksi Terstruktur
                    </h3>


                    <p
                        class="
                    text-sm
                    text-gray-500

                    leading-6

                    mt-2
                    ">
                        Setiap transaksi voting dicatat dan diproses melalui
                        sistem pembayaran yang terintegrasi.
                    </p>

                </div>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- VISI --}}
    {{-- ========================================================= --}}

    <section class="
    bg-[#f8faff]

    border-y
    border-gray-100
    ">

        <div
            class="
        max-w-7xl
        mx-auto

        px-4
        sm:px-6

        py-16
        sm:py-20
        ">

            <div class="
            max-w-3xl
            mx-auto

            text-center
            ">

                <p
                    class="
                text-blue-600

                text-xs

                uppercase

                tracking-[4px]

                font-semibold
                ">
                    Tujuan Kami
                </p>


                <h2
                    class="
                mt-3

                text-3xl
                sm:text-4xl

                font-extrabold

                text-[#14285a]
                ">
                    Setiap Suara Punya Arti
                </h2>


                <p
                    class="
                mt-5

                text-gray-600

                leading-8
                ">
                    PICO ingin menghadirkan pengalaman voting yang mudah
                    digunakan oleh peserta, pendukung, maupun penyelenggara.
                    Kami percaya teknologi dapat membantu proses dukungan
                    dan partisipasi publik menjadi lebih praktis,
                    informatif, dan terorganisasi.
                </p>

            </div>



            <div
                class="
            grid
            grid-cols-1
            md:grid-cols-3

            gap-5

            mt-12
            ">


                <div
                    class="
                bg-white

                rounded-3xl

                border
                border-gray-100

                shadow-sm

                p-7
                ">

                    <div class="text-3xl">
                        💡
                    </div>


                    <h3 class="font-bold text-xl mt-4">
                        Mudah
                    </h3>


                    <p
                        class="
                    text-gray-500
                    text-sm
                    leading-6
                    mt-2
                    ">
                        Alur voting dibuat sederhana sehingga pengguna
                        dapat memberikan dukungan tanpa proses yang rumit.
                    </p>

                </div>



                <div
                    class="
                bg-white

                rounded-3xl

                border
                border-gray-100

                shadow-sm

                p-7
                ">

                    <div class="text-3xl">
                        ⚡
                    </div>


                    <h3 class="font-bold text-xl mt-4">
                        Cepat
                    </h3>


                    <p
                        class="
                    text-gray-500
                    text-sm
                    leading-6
                    mt-2
                    ">
                        Informasi event, peserta, transaksi, dan ranking
                        dapat dikelola melalui sistem yang terintegrasi.
                    </p>

                </div>



                <div
                    class="
                bg-white

                rounded-3xl

                border
                border-gray-100

                shadow-sm

                p-7
                ">

                    <div class="text-3xl">
                        🤝
                    </div>


                    <h3 class="font-bold text-xl mt-4">
                        Terpercaya
                    </h3>


                    <p
                        class="
                    text-gray-500
                    text-sm
                    leading-6
                    mt-2
                    ">
                        PICO dirancang dengan pemisahan data event,
                        transaksi, finalis, dan vote yang terstruktur.
                    </p>

                </div>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- UNTUK SIAPA --}}
    {{-- ========================================================= --}}

    <section class="
    max-w-7xl
    mx-auto

    px-4
    sm:px-6

    py-16
    sm:py-20
    ">

        <div class="text-center">

            <p
                class="
            text-blue-600

            text-xs

            uppercase

            tracking-[4px]

            font-semibold
            ">
                Ekosistem PICO
            </p>


            <h2
                class="
            mt-3

            text-3xl
            sm:text-4xl

            font-extrabold

            text-[#14285a]
            ">
                Dibuat untuk Semua Pihak
            </h2>


            <p
                class="
            text-gray-500
            mt-3

            max-w-2xl
            mx-auto
            ">
                PICO mempertemukan penyelenggara, finalis, dan pendukung
                dalam satu ekosistem voting digital.
            </p>

        </div>



        <div class="
        grid
        grid-cols-1
        md:grid-cols-3

        gap-5

        mt-10
        ">


            {{-- ORGANIZER --}}
            <div
                class="
            relative
            overflow-hidden

            bg-[#10204f]

            text-white

            rounded-[28px]

            p-7
            ">

                <div
                    class="
                absolute

                -right-16
                -top-16

                w-40
                h-40

                rounded-full

                bg-blue-500/20

                blur-2xl
                ">
                </div>


                <div class="relative">

                    <div class="text-4xl">
                        🏢
                    </div>


                    <h3 class="font-bold text-2xl mt-5">
                        Penyelenggara
                    </h3>


                    <p
                        class="
                    text-white/65

                    text-sm

                    leading-7

                    mt-3
                    ">
                        Membuat event, mengelola kategori, finalis,
                        transaksi, serta memantau hasil voting.
                    </p>

                </div>

            </div>



            {{-- CANDIDATE --}}
            <div
                class="
            bg-blue-50

            border
            border-blue-100

            rounded-[28px]

            p-7
            ">

                <div class="text-4xl">
                    👤
                </div>


                <h3 class="font-bold text-2xl mt-5">
                    Finalis
                </h3>


                <p
                    class="
                text-gray-500

                text-sm

                leading-7

                mt-3
                ">
                    Mendapat ruang profil khusus untuk memperkenalkan
                    diri kepada pendukung dalam setiap event.
                </p>

            </div>



            {{-- VOTER --}}
            <div
                class="
            bg-amber-50

            border
            border-amber-100

            rounded-[28px]

            p-7
            ">

                <div class="text-4xl">
                    ❤️
                </div>


                <h3 class="font-bold text-2xl mt-5">
                    Pendukung
                </h3>


                <p
                    class="
                text-gray-500

                text-sm

                leading-7

                mt-3
                ">
                    Menemukan event, melihat profil finalis,
                    mengikuti ranking, dan memberikan vote kepada
                    kandidat favorit.
                </p>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- CTA --}}
    {{-- ========================================================= --}}

    <section class="
    max-w-7xl
    mx-auto

    px-4
    sm:px-6

    pb-16
    sm:pb-20
    ">

        <div
            class="
        relative
        overflow-hidden

        bg-linear-to-r
        from-[#0c2858]
        via-[#0d3975]
        to-[#1265c7]

        rounded-3xl

        px-6
        sm:px-10
        lg:px-12

        py-9
        sm:py-11

        text-white
        ">

            <div
                class="
            absolute
            -right-28
            -top-32

            w-96
            h-96

            bg-blue-300/20

            rounded-full

            blur-3xl
            ">
            </div>


            <div
                class="
            relative

            flex
            flex-col
            lg:flex-row

            lg:items-center
            lg:justify-between

            gap-7
            ">

                <div>

                    <p
                        class="
                    text-blue-200

                    text-xs

                    uppercase

                    tracking-[4px]

                    font-semibold
                    ">
                        Mulai Bersama PICO
                    </p>


                    <h2
                        class="
                    text-3xl
                    sm:text-4xl

                    font-bold

                    mt-3
                    ">
                        Temukan Event Favorit Anda
                    </h2>


                    <p
                        class="
                    text-white/65

                    mt-3

                    max-w-2xl
                    ">
                        Jelajahi event yang sedang berlangsung dan
                        berikan dukungan kepada finalis pilihan Anda.
                    </p>

                </div>


                <a href="{{ route('events.index') }}"
                    class="
                w-full
                sm:w-auto

                text-center

                bg-[#ffd45c]
                hover:bg-[#ffcb37]

                text-[#10204f]

                px-8
                py-4

                rounded-xl

                font-bold

                shadow-lg

                shrink-0

                transition
                ">
                    Lihat Semua Event →
                </a>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="bg-[#0a1b3d] text-white">

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
            <div class="sm:col-span-2 lg:col-span-1">

                <div class="flex items-center gap-3">

                    <div
                        class="
                    w-12
                    h-12

                    rounded-xl

                    bg-blue-600

                    flex
                    items-center
                    justify-center

                    font-bold
                    text-2xl
                    ">
                        P
                    </div>


                    <div>

                        <p class="font-bold text-3xl">
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


                    <a href="{{ route('events.index') }}" class="block hover:text-white">
                        Event
                    </a>


                    <a href="{{ route('home') }}#cara-vote" class="block hover:text-white">
                        Cara Vote
                    </a>


                    <a href="{{ route('about') }}" class="block hover:text-white">
                        Tentang
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

                    <p>Pusat Bantuan</p>
                    <p>Kebijakan Privasi</p>
                    <p>Syarat & Ketentuan</p>
                    <p>FAQ</p>

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
                        📍 Indonesia
                    </p>

                </div>


                <p
                    class="
                mt-8

                text-[#ffd45c]

                italic

                leading-6
                ">
                    “Setiap suara membuat perubahan.”
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


</body>

</html>
