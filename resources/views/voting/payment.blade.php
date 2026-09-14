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

    @include('partials.footer')


</body>

</html>
