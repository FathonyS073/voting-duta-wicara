<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Pembayaran {{ $transaction->invoice_number }}
    </title>

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#faf8ff] text-[#172033]">


    @include('partials.navbar', [
        'activePage' => 'finalis',
    ])



    <section class="pt-28 sm:pt-32 pb-20">

        <div class="max-w-4xl mx-auto px-5 sm:px-8">


            <!-- BACK -->
            <a href="{{ route('candidate.vote', $transaction->candidate_id) }}"
                class="
            inline-flex
            items-center
            gap-2
            text-sm
            text-gray-500
            hover:text-[#5b0b83]
            transition
            ">
                ← Kembali ke Pilihan Vote
            </a>



            <!-- HEADER -->
            <div class="mt-8 text-center">

                <p
                    class="
                text-[#c48621]
                tracking-[5px]
                text-xs
                font-semibold
                ">
                    PEMBAYARAN
                </p>


                <h1
                    class="
                mt-3
                text-3xl
                sm:text-4xl
                font-bold
                ">
                    Selesaikan Pembayaran
                </h1>


                <p class="mt-3 text-gray-500">

                    Periksa kembali detail voting sebelum
                    melakukan pembayaran.

                </p>

            </div>



            <div
                class="
            mt-10
            grid
            grid-cols-1
            md:grid-cols-5
            gap-6
            ">


                <!-- FINALIS -->
                <div class="md:col-span-2">

                    <div
                        class="
                    bg-white
                    border
                    border-gray-100
                    rounded-3xl
                    p-4
                    ">

                        <div
                            class="
                        aspect-[4/5]
                        overflow-hidden
                        rounded-2xl
                        ">

                            <img src="{{ asset('storage/' . $transaction->candidate->photo) }}"
                                class="w-full h-full object-cover" alt="{{ $transaction->candidate->name }}">

                        </div>


                        <div class="pt-5 text-center">

                            <p class="font-bold text-xl">

                                {{ $transaction->candidate->name }}

                            </p>


                            <p class="text-gray-500 text-sm mt-1">

                                {{ $transaction->candidate->city }}

                            </p>

                        </div>

                    </div>

                </div>



                <!-- PAYMENT SUMMARY -->
                <div class="md:col-span-3">

                    <div
                        class="
                    bg-white
                    border
                    border-gray-100
                    rounded-3xl
                    p-6
                    sm:p-8
                    ">

                        <h2 class="text-xl font-bold">
                            Ringkasan Pembayaran
                        </h2>



                        <div class="mt-6 space-y-5 text-sm">


                            <div
                                class="
                            flex
                            justify-between
                            gap-4
                            ">

                                <span class="text-gray-500">
                                    Invoice
                                </span>

                                <span
                                    class="
                                font-medium
                                text-right
                                break-all
                                ">
                                    {{ $transaction->invoice_number }}
                                </span>

                            </div>



                            <div
                                class="
                            flex
                            justify-between
                            gap-4
                            ">

                                <span class="text-gray-500">
                                    Kategori
                                </span>

                                <span class="font-medium text-right">

                                    {{ $transaction->category->name }}

                                </span>

                            </div>



                            <div
                                class="
                            flex
                            justify-between
                            gap-4
                            ">

                                <span class="text-gray-500">
                                    Jumlah Vote
                                </span>

                                <span class="font-semibold">

                                    {{ number_format($transaction->vote_amount, 0, ',', '.') }}

                                    vote

                                </span>

                            </div>



                            <div
                                class="
                            flex
                            justify-between
                            gap-4
                            ">

                                <span class="text-gray-500">
                                    Harga / Vote
                                </span>

                                <span class="font-semibold">

                                    Rp{{ number_format($transaction->category->vote_price, 0, ',', '.') }}

                                </span>

                            </div>



                            <div
                                class="
                            border-t
                            border-gray-100
                            pt-5
                            flex
                            justify-between
                            items-end
                            gap-4
                            ">

                                <span class="font-semibold">
                                    Total Pembayaran
                                </span>


                                <span
                                    class="
                                text-2xl
                                sm:text-3xl
                                font-bold
                                text-[#5b0b83]
                                ">

                                    Rp{{ number_format($transaction->total_amount, 0, ',', '.') }}

                                </span>

                            </div>


                        </div>



                        <!-- STATUS -->
                        <div
                            class="
                        mt-7
                        bg-[#fff8e8]
                        border
                        border-[#f5dfaa]
                        rounded-2xl
                        px-5
                        py-4
                        ">

                            <p class="text-sm">

                                Status pembayaran:

                                <span
                                    class="
                                font-bold
                                text-[#a86d00]
                                uppercase
                                ">
                                    {{ $transaction->payment_status }}
                                </span>

                            </p>

                        </div>



                        <!-- PAYMENT GATEWAY PLACEHOLDER -->
                        <div
                            class="
                        mt-7
                        border
                        border-dashed
                        border-gray-300
                        rounded-2xl
                        p-6
                        text-center
                        ">

                            <p class="font-bold">
                                Metode Pembayaran
                            </p>


                            <p
                                class="
                            text-sm
                            text-gray-500
                            mt-2
                            ">
                                Payment gateway akan dihubungkan
                                pada tahap berikutnya.
                            </p>


                            <button type="button" disabled
                                class="
                            mt-5
                            w-full
                            bg-[#5b0b83]
                            text-white
                            py-3.5
                            rounded-full
                            font-semibold
                            opacity-40
                            cursor-not-allowed
                            ">
                                Bayar Sekarang
                            </button>

                        </div>


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
