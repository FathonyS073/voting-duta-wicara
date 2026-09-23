<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
        Pembayaran Vote - Vooters
    </title>


    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#fffaf5] text-[#5A1520]">


    @include('partials.navbar')





    <!-- HEADER -->

    <section class="
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


            <h1 class="
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


            <div class="
lg:col-span-2
bg-white
rounded-3xl
shadow-sm
p-5
h-fit
">


                <img src="{{ asset('storage/' . $transaction->candidate->photo) }}"
                    class="
w-full
aspect-square
object-cover
rounded-2xl
">



                <div class="mt-5">


                    <h2 class="
text-xl
font-bold
">

                        {{ $transaction->candidate->name }}

                    </h2>


                    <p class="
text-gray-500
mt-1
">

                        {{ $transaction->event->name }}

                    </p>



                    <div class="
mt-5
bg-[#fff7ed]
rounded-2xl
p-4
">


                        <p class="
text-xs
uppercase
tracking-wider
text-gray-500
">

                            Kategori

                        </p>


                        <p class="
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


            <div class="
lg:col-span-3
bg-white
rounded-3xl
shadow-sm
p-5
md:p-8
">





                <!-- Invoice -->

                <div class="
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


                        <p class="
text-sm
text-gray-500
">

                            Invoice

                        </p>


                        <p class="
font-bold
break-all
text-sm
">

                            {{ $transaction->invoice_number }}

                        </p>


                    </div>




                    <span class="
w-fit
px-4
py-2
rounded-full
bg-yellow-100
text-yellow-700
font-semibold
text-sm
">

                        {{ ucfirst($transaction->payment_status) }}

                    </span>


                </div>
                <!-- Detail -->
                <div class="
mt-6
space-y-5
">


                    <div class="
flex
justify-between
gap-5
">


                        <span class="
text-gray-500
">

                            Event

                        </span>


                        <span class="
font-semibold
text-right
max-w-[60%]
">

                            {{ $transaction->event->name }}

                        </span>


                    </div>





                    <div class="
flex
justify-between
">


                        <span class="
text-gray-500
">

                            Jumlah Vote

                        </span>


                        <span class="
font-semibold
">

                            {{ number_format($transaction->vote_amount) }}

                            Vote

                        </span>


                    </div>





                    <div class="
flex
justify-between
">


                        <span class="
text-gray-500
">

                            Harga Vote

                        </span>


                        <span class="
font-semibold
">

                            Rp {{ number_format($transaction->category->vote_price) }}

                        </span>


                    </div>


                </div>








                <!-- TOTAL -->


                <div class="
mt-8
bg-gradient-to-r
from-[#fff7ed]
to-[#f5e6c8]
rounded-3xl
p-6
">


                    <div class="
flex
flex-col
sm:flex-row
justify-between
items-start
sm:items-center
gap-3
">


                        <span class="
font-semibold
">

                            Total Pembayaran

                        </span>


                        <span class="
text-3xl
font-bold
text-[#7A1F2B]
">

                            Rp {{ number_format($transaction->total_amount) }}

                        </span>


                    </div>


                </div>








                <!-- BUTTON -->


                <div class="
mt-8
space-y-3
">



                    <button
                        class="
w-full
bg-[#7A1F2B]
hover:bg-[#5A1520]
text-white
py-4
rounded-xl
font-bold
transition
">

                        💳 Bayar Sekarang

                    </button>





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





                    <p class="
text-center
text-sm
text-gray-400
">

                        🔒 Pembayaran akan diproses melalui payment gateway Vooters.

                    </p>


                </div>





            </div>


        </div>


    </section>







    @include('partials.footer')


</body>

</html>
