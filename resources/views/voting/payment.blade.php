<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Pembayaran Vote - Vooters
    </title>

    <link rel="icon" type="image/webp" href="{{ asset('Images/logo.webp') }}">

    @if ($midtransEnabled)
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#fffaf5] text-[#5A1520]">


    @include('partials.navbar')


    <!-- HEADER -->

    <section
        class="
            relative
            pt-32
            pb-16
            overflow-hidden
            bg-gradient-to-br
            from-[#fff7ed]
            via-white
            to-[#f5e6c8]
        ">

        <div class="
                max-w-7xl
                mx-auto
                px-6
            ">

            <h1
                class="
                    text-3xl
                    md:text-4xl
                    font-bold
                ">
                Konfirmasi Pembayaran
            </h1>


            <p class="
                    mt-3
                    text-gray-500
                ">
                Selesaikan pembayaran untuk mengirimkan suara Anda.
            </p>

        </div>

    </section>



    <section class="
            max-w-7xl
            mx-auto
            px-6
            py-10
        ">

        <div class="
                grid
                lg:grid-cols-5
                gap-6
            ">


            <!-- ========================= -->
            <!-- CANDIDATE -->
            <!-- ========================= -->

            <div
                class="
                    lg:col-span-2
                    bg-white
                    rounded-3xl
                    shadow-sm
                    p-5
                    h-fit
                ">

                <img src="{{ asset('storage/' . $transaction->candidate->photo) }}"
                    alt="{{ $transaction->candidate->name }}"
                    class="
                        w-full
                        aspect-square
                        object-cover
                        rounded-2xl
                    ">


                <div class="mt-5">

                    <h2
                        class="
                            text-xl
                            font-bold
                        ">
                        {{ $transaction->candidate->name }}
                    </h2>


                    <p
                        class="
                            text-gray-500
                            mt-1
                        ">
                        {{ $transaction->event->name }}
                    </p>


                    <div
                        class="
                            mt-5
                            bg-[#fff7ed]
                            rounded-2xl
                            p-4
                        ">

                        <p
                            class="
                                text-xs
                                uppercase
                                tracking-wider
                                text-gray-500
                            ">
                            Kategori
                        </p>


                        <p
                            class="
                                font-semibold
                                mt-1
                            ">
                            {{ $transaction->category->name }}
                        </p>

                    </div>

                </div>

            </div>



            <!-- ========================= -->
            <!-- PAYMENT -->
            <!-- ========================= -->

            <div
                class="
                    lg:col-span-3
                    bg-white
                    rounded-3xl
                    shadow-sm
                    p-5
                    md:p-8
                ">


                <!-- INVOICE -->

                <div
                    class="
                        flex
                        flex-col
                        sm:flex-row
                        sm:items-center
                        justify-between
                        gap-4
                        border-b
                        pb-5
                    ">

                    <div>

                        <p
                            class="
                                text-sm
                                text-gray-500
                            ">
                            Invoice
                        </p>


                        <p
                            class="
                                font-bold
                                break-all
                                text-sm
                            ">
                            {{ $transaction->invoice_number }}
                        </p>

                    </div>


                    @php
                        $statusLabel = match ($transaction->payment_status) {
                            'pending' => 'Pending',
                            'waiting_confirmation' => 'Menunggu Verifikasi',
                            'paid' => 'Berhasil',
                            'failed' => 'Gagal',
                            'expired' => 'Kedaluwarsa',
                            default => ucfirst($transaction->payment_status),
                        };

                        $statusClass = match ($transaction->payment_status) {
                            'paid' => 'bg-green-100 text-green-700',
                            'waiting_confirmation' => 'bg-yellow-100 text-yellow-700',
                            'failed', 'expired' => 'bg-red-100 text-red-700',
                            default => 'bg-yellow-100 text-yellow-700',
                        };
                    @endphp


                    <span
                        class="
                            w-fit
                            px-4
                            py-2
                            rounded-full
                            font-semibold
                            text-sm
                            {{ $statusClass }}
                        ">
                        {{ $statusLabel }}
                    </span>

                </div>



                <!-- DETAIL -->

                <div class="
                        mt-6
                        space-y-5
                    ">

                    <div
                        class="
                            flex
                            justify-between
                            gap-5
                        ">

                        <span class="text-gray-500">
                            Event
                        </span>


                        <span
                            class="
                                font-semibold
                                text-right
                                max-w-[60%]
                            ">
                            {{ $transaction->event->name }}
                        </span>

                    </div>


                    <div
                        class="
                            flex
                            justify-between
                        ">

                        <span class="text-gray-500">
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

                        <span class="text-gray-500">
                            Harga Vote
                        </span>


                        <span class="font-semibold">
                            Rp {{ number_format($transaction->category->vote_price) }}
                        </span>

                    </div>

                </div>



                <!-- TOTAL -->

                <div
                    class="
                        mt-8
                        bg-gradient-to-r
                        from-[#fff7ed]
                        to-[#f5e6c8]
                        rounded-3xl
                        p-6
                    ">

                    <div
                        class="
                            flex
                            flex-col
                            sm:flex-row
                            justify-between
                            items-start
                            sm:items-center
                            gap-3
                        ">

                        <span class="font-semibold">
                            Total Pembayaran
                        </span>


                        <span
                            class="
                                text-3xl
                                font-bold
                                text-[#7A1F2B]
                            ">
                            Rp {{ number_format($transaction->total_amount) }}
                        </span>

                    </div>

                </div>



                <!-- ========================= -->
                <!-- PAYMENT METHODS -->
                <!-- ========================= -->

                <div class="mt-8 space-y-4">

                    @if ($transaction->payment_status === 'pending')

                        <div>

                            <p class="text-lg font-bold">
                                Pilih Metode Pembayaran
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                Pilih metode pembayaran yang ingin digunakan.
                            </p>

                        </div>



                        <!-- ========================= -->
                        <!-- QRIS MANUAL -->
                        <!-- ========================= -->

                        @if ($manualQrisEnabled)

                            <button type="button" id="manual-qris-button"
                                class="
                                    w-full
                                    border-2
                                    border-[#7A1F2B]
                                    rounded-2xl
                                    p-5
                                    text-left
                                    hover:bg-[#fff7ed]
                                    transition
                                ">

                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-4
                                    ">

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="
                                                w-12
                                                h-12
                                                rounded-xl
                                                bg-[#fff7ed]
                                                flex
                                                items-center
                                                justify-center
                                                text-xl
                                            ">
                                            📱
                                        </div>


                                        <div>

                                            <p
                                                class="
                                                    font-bold
                                                    text-[#7A1F2B]
                                                ">
                                                QRIS Manual
                                            </p>

                                            <p
                                                class="
                                                    mt-1
                                                    text-sm
                                                    text-gray-500
                                                ">
                                                Scan QRIS lalu upload bukti pembayaran.
                                            </p>

                                        </div>

                                    </div>


                                    <span
                                        class="
                                            px-3
                                            py-1
                                            rounded-full
                                            bg-green-100
                                            text-green-700
                                            text-xs
                                            font-bold
                                        ">
                                        Tersedia
                                    </span>

                                </div>

                            </button>



                            <!-- QRIS PANEL -->

                            <div id="manual-qris-panel"
                                class="
                                    {{ $errors->has('payment_proof') ? '' : 'hidden' }}
                                    border
                                    border-[#E8C96B]
                                    rounded-3xl
                                    bg-[#fffaf5]
                                    p-6
                                ">

                                @if ($manualQrisImage)
                                    <div class="text-center">

                                        <p class="text-sm text-gray-500">
                                            QRIS Merchant
                                        </p>


                                        <p
                                            class="
                                                mt-1
                                                text-lg
                                                font-bold
                                            ">
                                            {{ $manualQrisMerchantName }}
                                        </p>


                                        <div
                                            class="
                                                mt-5
                                                flex
                                                justify-center
                                            ">

                                            <img src="{{ asset('storage/' . $manualQrisImage) }}"
                                                alt="QRIS {{ $manualQrisMerchantName }}"
                                                class="
                                                    w-full
                                                    max-w-sm
                                                    rounded-2xl
                                                    bg-white
                                                    border
                                                    p-3
                                                ">

                                        </div>



                                        <!-- NOMINAL -->

                                        <div
                                            class="
                                                mt-6
                                                bg-white
                                                rounded-2xl
                                                border
                                                p-5
                                            ">

                                            <p class="text-sm text-gray-500">
                                                Masukkan nominal tepat sebesar
                                            </p>


                                            <p
                                                class="
                                                    mt-1
                                                    text-3xl
                                                    font-bold
                                                    text-[#7A1F2B]
                                                ">
                                                Rp {{ number_format($transaction->total_amount) }}
                                            </p>

                                        </div>



                                        <!-- INSTRUCTION -->

                                        <div
                                            class="
                                                mt-4
                                                rounded-xl
                                                bg-yellow-50
                                                border
                                                border-yellow-200
                                                p-4
                                                text-left
                                            ">

                                            <p
                                                class="
                                                    text-sm
                                                    text-yellow-800
                                                ">
                                                <strong>Penting:</strong>
                                                {{ $manualQrisInstruction }}
                                            </p>

                                        </div>

                                    </div>



                                    <!-- UPLOAD PAYMENT PROOF -->

                                    <form action="{{ route('payment.manual.submit', $transaction->invoice_number) }}"
                                        method="POST" enctype="multipart/form-data" class="mt-6">

                                        @csrf


                                        <label for="payment_proof"
                                            class="
                                                block
                                                font-semibold
                                                mb-2
                                            ">
                                            Upload Bukti Pembayaran
                                        </label>


                                        <input type="file" id="payment_proof" name="payment_proof"
                                            accept=".jpg,.jpeg,.png,.webp" required
                                            class="
                                                block
                                                w-full
                                                rounded-xl
                                                border
                                                border-gray-300
                                                bg-white
                                                p-3
                                                text-sm
                                            ">


                                        <p
                                            class="
                                                mt-2
                                                text-xs
                                                text-gray-500
                                            ">
                                            Format JPG, JPEG, PNG, atau WEBP.
                                            Maksimal 2 MB.
                                        </p>


                                        @error('payment_proof')
                                            <p
                                                class="
                                                    mt-2
                                                    text-sm
                                                    text-red-600
                                                ">
                                                {{ $message }}
                                            </p>
                                        @enderror


                                        <button type="submit"
                                            class="
                                                mt-5
                                                w-full
                                                bg-[#7A1F2B]
                                                hover:bg-[#5A1520]
                                                text-white
                                                py-4
                                                rounded-xl
                                                font-bold
                                                transition
                                            ">
                                            Kirim Bukti Pembayaran
                                        </button>

                                    </form>
                                @else
                                    <div
                                        class="
                                            rounded-xl
                                            bg-yellow-50
                                            border
                                            border-yellow-200
                                            p-4
                                        ">

                                        <p
                                            class="
                                                text-sm
                                                text-yellow-800
                                            ">
                                            QRIS belum dikonfigurasi oleh administrator.
                                        </p>

                                    </div>
                                @endif

                            </div>

                        @endif



                        <!-- ========================= -->
                        <!-- PAYMENT GATEWAY -->
                        <!-- ========================= -->

                        @if ($midtransEnabled)
                            <button id="pay-button" type="button"
                                class="
                                    w-full
                                    border-2
                                    border-[#D4AF37]
                                    rounded-2xl
                                    p-5
                                    text-left
                                    hover:bg-[#fff7ed]
                                    transition
                                ">

                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-4
                                    ">

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="
                                                w-12
                                                h-12
                                                rounded-xl
                                                bg-[#fff7ed]
                                                flex
                                                items-center
                                                justify-center
                                                text-xl
                                            ">
                                            💳
                                        </div>


                                        <div>

                                            <p
                                                class="
                                                    font-bold
                                                    text-[#7A1F2B]
                                                ">
                                                Payment Gateway
                                            </p>

                                            <p
                                                class="
                                                    mt-1
                                                    text-sm
                                                    text-gray-500
                                                ">
                                                Pembayaran otomatis melalui Midtrans.
                                            </p>

                                        </div>

                                    </div>


                                    <span
                                        class="
                                            px-3
                                            py-1
                                            rounded-full
                                            bg-green-100
                                            text-green-700
                                            text-xs
                                            font-bold
                                        ">
                                        Tersedia
                                    </span>

                                </div>

                            </button>
                        @else
                            <div
                                class="
                                    w-full
                                    border
                                    border-gray-200
                                    bg-gray-50
                                    rounded-2xl
                                    p-5
                                    opacity-75
                                ">

                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-4
                                    ">

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="
                                                w-12
                                                h-12
                                                rounded-xl
                                                bg-gray-100
                                                flex
                                                items-center
                                                justify-center
                                                text-xl
                                            ">
                                            💳
                                        </div>


                                        <div>

                                            <p class="font-bold text-gray-700">
                                                Payment Gateway
                                            </p>

                                            <p
                                                class="
                                                    mt-1
                                                    text-sm
                                                    text-gray-500
                                                ">
                                                Pembayaran otomatis melalui Midtrans.
                                            </p>

                                        </div>

                                    </div>


                                    <span
                                        class="
                                            px-3
                                            py-1
                                            rounded-full
                                            bg-gray-200
                                            text-gray-600
                                            text-xs
                                            font-bold
                                        ">
                                        Coming Soon
                                    </span>

                                </div>

                            </div>
                        @endif



                        <!-- CHECK STATUS -->

                        <a href="{{ route('payment.status', $transaction->invoice_number) }}"
                            class="
                                block
                                w-full
                                border-2
                                border-[#D4AF37]
                                text-[#7A1F2B]
                                py-4
                                rounded-xl
                                font-bold
                                text-center
                                hover:bg-[#fff7ed]
                                transition
                            ">
                            🔍 Cek Status Pembayaran
                        </a>



                        <p
                            class="
                                text-center
                                text-xs
                                text-gray-400
                            ">
                            Vote akan ditambahkan setelah pembayaran berhasil diverifikasi.
                        </p>
                    @else
                        <a href="{{ route('payment.status', $transaction->invoice_number) }}"
                            class="
                                block
                                w-full
                                bg-[#7A1F2B]
                                hover:bg-[#5A1520]
                                text-white
                                py-4
                                rounded-xl
                                font-bold
                                text-center
                                transition
                            ">
                            Lihat Status Pembayaran
                        </a>

                    @endif

                </div>

            </div>

        </div>

    </section>



    @include('partials.footer')



    <!-- ========================= -->
    <!-- QRIS MANUAL SCRIPT -->
    <!-- ========================= -->

    <script>
        const manualQrisButton =
            document.getElementById('manual-qris-button');

        const manualQrisPanel =
            document.getElementById('manual-qris-panel');


        if (manualQrisButton && manualQrisPanel) {

            manualQrisButton.addEventListener('click', function() {

                manualQrisPanel.classList.toggle('hidden');

            });

        }
    </script>



    <!-- ========================= -->
    <!-- MIDTRANS SCRIPT -->
    <!-- ========================= -->

    @if ($midtransEnabled)
        <script>
            const payButton =
                document.getElementById('pay-button');


            if (payButton) {

                payButton.addEventListener('click', function() {

                    const button = this;


                    button.disabled = true;

                    button.innerText =
                        '⏳ Memuat Pembayaran...';


                    fetch(
                            "{{ route('payment.token', $transaction->invoice_number) }}", {

                                method: 'POST',

                                headers: {

                                    'Accept': 'application/json',

                                    'Content-Type': 'application/json',

                                    'X-Requested-With': 'XMLHttpRequest',

                                    'X-CSRF-TOKEN': document
                                        .querySelector(
                                            'meta[name="csrf-token"]'
                                        )
                                        .getAttribute('content'),

                                },

                            }
                        )

                        .then(response => response.json())

                        .then(data => {

                            if (!data.snap_token) {

                                throw new Error(
                                    data.message ||
                                    'Snap Token tidak ditemukan.'
                                );

                            }


                            window.snap.pay(
                                data.snap_token, {

                                    onSuccess: function(result) {

                                        window.location.href =
                                            "{{ route('payment.status', $transaction->invoice_number) }}";

                                    },


                                    onPending: function(result) {

                                        window.location.href =
                                            "{{ route('payment.status', $transaction->invoice_number) }}";

                                    },


                                    onError: function(result) {

                                        console.error(result);

                                        alert(
                                            'Pembayaran gagal. Silakan coba kembali.'
                                        );

                                        button.disabled = false;

                                        button.innerText =
                                            '💳 Payment Gateway';

                                    },


                                    onClose: function() {

                                        button.disabled = false;

                                        button.innerText =
                                            '💳 Payment Gateway';

                                    },

                                }
                            );

                        })

                        .catch(error => {

                            console.error(error);

                            alert(
                                'Gagal memuat pembayaran. Silakan coba kembali.'
                            );

                            button.disabled = false;

                            button.innerText =
                                '💳 Payment Gateway';

                        });

                });

            }
        </script>
    @endif


</body>

</html>
