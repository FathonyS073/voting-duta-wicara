<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Status Pembayaran - PICO
    </title>


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


            <div class="
bg-white

rounded-3xl

shadow-sm


p-8

text-center
">


                @if ($transaction->payment_status == 'paid')
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



                    <h1 class="
mt-6
text-3xl
font-bold
">

                        Pembayaran Berhasil

                    </h1>



                    <p class="
mt-3
text-gray-500
">

                        Terima kasih, vote Anda sudah berhasil masuk.

                    </p>
                @elseif($transaction->payment_status == 'pending')
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



                    <h1 class="
mt-6
text-3xl
font-bold
">

                        Menunggu Pembayaran

                    </h1>



                    <p class="
mt-3
text-gray-500
">

                        Silahkan selesaikan pembayaran untuk
                        mengirimkan vote Anda.

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



                    <h1 class="
mt-6
text-3xl
font-bold
">

                        Pembayaran Gagal

                    </h1>



                    <p class="
mt-3
text-gray-500
">

                        Pembayaran tidak dapat diproses.

                    </p>
                @endif







                <div class="
mt-8

bg-[#fff7ed]

rounded-2xl

p-5

text-left
">


                    <div class="
space-y-3
">


                        <div class="
flex
justify-between
">

                            <span>
                                Invoice
                            </span>


                            <span class="
font-semibold
break-all
">

                                {{ $transaction->invoice_number }}

                            </span>


                        </div>




                        <div class="
flex
justify-between
">

                            <span>
                                Kandidat
                            </span>


                            <span class="
font-semibold
">

                                {{ $transaction->candidate->name }}

                            </span>


                        </div>




                        <div class="
flex
justify-between
">

                            <span>
                                Jumlah Vote
                            </span>


                            <span class="
font-semibold
">

                                {{ $transaction->vote_amount }}

                                Vote

                            </span>


                        </div>




                        <div class="
flex
justify-between
">

                            <span>
                                Total
                            </span>


                            <span class="
font-bold
text-[#7A1F2B]
">

                                Rp {{ number_format($transaction->total_amount) }}

                            </span>


                        </div>


                    </div>


                </div>
                <div class="mt-8 space-y-3">


                    @if ($transaction->payment_status == 'pending')
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
border-blue-600
text-[#7A1F2B]
hover:bg-[#fff7ed]
py-4
rounded-xl
font-bold
transition
">

                            🔄 Cek Status Pembayaran

                        </a>
                    @elseif($transaction->payment_status == 'paid')
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
                            💳 Bayar Ulang
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('partials.footer')


</body>

</html>
