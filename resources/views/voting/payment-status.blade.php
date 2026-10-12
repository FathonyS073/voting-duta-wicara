<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Status Pembayaran - Vooters
    </title>

    <link rel="icon" type="image/webp" href="{{ asset('Images/logo.webp') }}">

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#fffaf5] text-[#5A1520]">


    @include('partials.navbar')



    <section class="
            pt-32
            pb-16
        ">

        <div class="
                max-w-xl
                mx-auto
                px-6
            ">

            <div
                class="
                    bg-white
                    rounded-3xl
                    shadow-sm
                    p-8
                    text-center
                ">


                {{-- ========================= --}}
                {{-- STATUS --}}
                {{-- ========================= --}}

                @if ($transaction->payment_status === 'paid')
                    <div
                        class="
                            w-20
                            h-20
                            rounded-full
                            bg-green-100
                            text-green-600
                            flex
                            items-center
                            justify-center
                            mx-auto
                            text-4xl
                        ">
                        ✓
                    </div>


                    <h1
                        class="
                            mt-6
                            text-3xl
                            font-bold
                        ">
                        Pembayaran Berhasil
                    </h1>


                    <p
                        class="
                            mt-3
                            text-gray-500
                        ">
                        Terima kasih, vote Anda sudah berhasil masuk.
                    </p>
                @elseif ($transaction->payment_status === 'waiting_confirmation')
                    <div
                        class="
                            w-20
                            h-20
                            rounded-full
                            bg-yellow-100
                            text-yellow-600
                            flex
                            items-center
                            justify-center
                            mx-auto
                            text-4xl
                        ">
                        ⏳
                    </div>


                    <h1
                        class="
                            mt-6
                            text-3xl
                            font-bold
                        ">
                        Menunggu Verifikasi
                    </h1>


                    <p
                        class="
                            mt-3
                            text-gray-500
                        ">
                        Bukti pembayaran Anda sudah diterima dan sedang diverifikasi oleh admin.
                    </p>


                    <p
                        class="
                            mt-2
                            text-sm
                            text-gray-400
                        ">
                        Vote akan masuk setelah pembayaran disetujui.
                    </p>
                @elseif ($transaction->payment_status === 'pending')
                    <div
                        class="
                            w-20
                            h-20
                            rounded-full
                            bg-[#F5E6C8]
                            text-[#7A1F2B]
                            flex
                            items-center
                            justify-center
                            mx-auto
                            text-4xl
                        ">
                        !
                    </div>


                    <h1
                        class="
                            mt-6
                            text-3xl
                            font-bold
                        ">
                        Menunggu Pembayaran
                    </h1>


                    <p
                        class="
                            mt-3
                            text-gray-500
                        ">
                        Silakan selesaikan pembayaran untuk mengirimkan vote Anda.
                    </p>
                @elseif ($transaction->payment_status === 'expired')
                    <div
                        class="
                            w-20
                            h-20
                            rounded-full
                            bg-red-100
                            text-red-600
                            flex
                            items-center
                            justify-center
                            mx-auto
                            text-4xl
                        ">
                        ×
                    </div>


                    <h1
                        class="
                            mt-6
                            text-3xl
                            font-bold
                        ">
                        Pembayaran Kedaluwarsa
                    </h1>


                    <p
                        class="
                            mt-3
                            text-gray-500
                        ">
                        Transaksi ini sudah tidak dapat digunakan.
                    </p>
                @else
                    <div
                        class="
                            w-20
                            h-20
                            rounded-full
                            bg-red-100
                            text-red-600
                            flex
                            items-center
                            justify-center
                            mx-auto
                            text-4xl
                        ">
                        ×
                    </div>


                    <h1
                        class="
                            mt-6
                            text-3xl
                            font-bold
                        ">
                        Pembayaran Gagal
                    </h1>


                    <p
                        class="
                            mt-3
                            text-gray-500
                        ">
                        Pembayaran tidak dapat diproses.
                    </p>
                @endif



                {{-- ========================= --}}
                {{-- DETAIL TRANSACTION --}}
                {{-- ========================= --}}

                <div
                    class="
                        mt-8
                        bg-[#fff7ed]
                        rounded-2xl
                        p-5
                        text-left
                    ">

                    <div class="space-y-3">


                        <div
                            class="
                                flex
                                justify-between
                                gap-5
                            ">

                            <span>
                                Invoice
                            </span>


                            <span
                                class="
                                    font-semibold
                                    break-all
                                    text-right
                                ">
                                {{ $transaction->invoice_number }}
                            </span>

                        </div>



                        <div
                            class="
                                flex
                                justify-between
                                gap-5
                            ">

                            <span>
                                Kandidat
                            </span>


                            <span
                                class="
                                    font-semibold
                                    text-right
                                ">
                                {{ $transaction->candidate->name }}
                            </span>

                        </div>



                        <div
                            class="
                                flex
                                justify-between
                            ">

                            <span>
                                Jumlah Vote
                            </span>


                            <span class="font-semibold">
                                {{ number_format($transaction->vote_amount) }} Vote
                            </span>

                        </div>



                        <div
                            class="
                                flex
                                justify-between
                            ">

                            <span>
                                Total
                            </span>


                            <span
                                class="
                                    font-bold
                                    text-[#7A1F2B]
                                ">
                                Rp {{ number_format($transaction->total_amount) }}
                            </span>

                        </div>



                        @if ($transaction->payment_method)

                            <div
                                class="
                                    flex
                                    justify-between
                                ">

                                <span>
                                    Metode
                                </span>


                                <span class="font-semibold">

                                    @if ($transaction->payment_method === 'manual_qris')
                                        QRIS Manual
                                    @elseif ($transaction->payment_method === 'qris')
                                        QRIS
                                    @else
                                        {{ strtoupper($transaction->payment_method) }}
                                    @endif

                                </span>

                            </div>

                        @endif

                    </div>

                </div>



                {{-- ========================= --}}
                {{-- ACTION BUTTON --}}
                {{-- ========================= --}}

                <div class="mt-8 space-y-3">


                    @if ($transaction->payment_status === 'pending')
                        <a href="{{ route('payment.show', $transaction->invoice_number) }}"
                            class="
                                block
                                w-full
                                bg-[#7A1F2B]
                                hover:bg-[#5A1520]
                                text-white
                                py-4
                                rounded-xl
                                font-bold
                                transition
                            ">
                            💳 Lanjutkan Pembayaran
                        </a>


                        <a href="{{ route('payment.status', $transaction->invoice_number) }}"
                            class="
                                block
                                w-full
                                border-2
                                border-[#D4AF37]
                                text-[#7A1F2B]
                                hover:bg-[#fff7ed]
                                py-4
                                rounded-xl
                                font-bold
                                transition
                            ">
                            🔄 Cek Status Pembayaran
                        </a>
                    @elseif ($transaction->payment_status === 'waiting_confirmation')
                        <a href="{{ route('payment.status', $transaction->invoice_number) }}"
                            class="
                                block
                                w-full
                                border-2
                                border-[#D4AF37]
                                text-[#7A1F2B]
                                hover:bg-[#fff7ed]
                                py-4
                                rounded-xl
                                font-bold
                                transition
                            ">
                            🔄 Refresh Status
                        </a>


                        <a href="{{ route('event.detail', $transaction->event) }}"
                            class="
                                block
                                w-full
                                bg-[#7A1F2B]
                                hover:bg-[#5A1520]
                                text-white
                                py-4
                                rounded-xl
                                font-bold
                                transition
                            ">
                            Kembali ke Event
                        </a>
                    @elseif ($transaction->payment_status === 'paid')
                        <a href="{{ route('event.detail', $transaction->event) }}"
                            class="
                                block
                                w-full
                                bg-[#7A1F2B]
                                hover:bg-[#5A1520]
                                text-white
                                py-4
                                rounded-xl
                                font-bold
                                transition
                            ">
                            🏆 Lihat Event
                        </a>
                    @else
                        <a href="{{ route('event.detail', $transaction->event) }}"
                            class="
                                block
                                w-full
                                bg-[#7A1F2B]
                                hover:bg-[#5A1520]
                                text-white
                                py-4
                                rounded-xl
                                font-bold
                                transition
                            ">
                            Kembali ke Event
                        </a>
                    @endif

                </div>

            </div>

        </div>

    </section>


    @include('partials.footer')


</body>

</html>
