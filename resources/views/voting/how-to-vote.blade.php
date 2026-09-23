<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Cara Vote - Vooters
    </title>
    <link rel="icon" type="image/webp" href="{{ asset('Images/logo.webp') }}">

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#FFF9F2] text-[#5A1520]">


    @include('partials.navbar')



    <!-- HERO -->

    <section class="
pt-28
pb-16

bg-linear-to-br
from-[#FDF6F0]
via-white
to-[#F5E7D0]
">

        <div class="
max-w-7xl
mx-auto
px-6

text-center
">


            <p class="
text-[#7A1F2B]

uppercase

tracking-[4px]

text-sm

font-semibold
">
                Panduan Vooters
            </p>



            <h1 class="
mt-4

text-4xl
md:text-5xl

font-extrabold
">

                Cara Memberikan Vote

            </h1>



            <p class="
mt-5

text-gray-600

max-w-2xl

mx-auto

leading-8
">

                Ikuti langkah sederhana berikut untuk memberikan
                dukungan kepada kandidat favorit Anda melalui
                platform Vooters.

            </p>


        </div>

    </section>





    <!-- STEP -->

    <section class="
max-w-7xl

mx-auto

px-6

py-16
">


        <div class="
grid

grid-cols-1
md:grid-cols-5

gap-5
">


            @php

                $steps = [
                    [
                        'icon' => '🔎',
                        'title' => 'Pilih Event',
                        'desc' => 'Temukan event favorit yang ingin Anda dukung.',
                    ],

                    [
                        'icon' => '👤',
                        'title' => 'Pilih Kandidat',
                        'desc' => 'Lihat profil finalis dan pilih kandidat terbaik.',
                    ],

                    [
                        'icon' => '🗳️',
                        'title' => 'Tentukan Vote',
                        'desc' => 'Pilih jumlah vote atau masukkan jumlah custom.',
                    ],

                    [
                        'icon' => '💳',
                        'title' => 'Pembayaran',
                        'desc' => 'Lakukan pembayaran sesuai jumlah vote.',
                    ],

                    [
                        'icon' => '✅',
                        'title' => 'Vote Berhasil',
                        'desc' => 'Vote tercatat dan masuk ke peringkat event.',
                    ],
                ];

            @endphp



            @foreach ($steps as $index => $step)
                <div class="
bg-white

rounded-3xl

border

border-gray-100

shadow-sm

p-6

text-center

relative
">


                    <div
                        class="
mx-auto

w-14
h-14

rounded-2xl

bg-[#7A1F2B]

text-white

flex

items-center

justify-center

text-2xl
">

                        {{ $step['icon'] }}

                    </div>



                    <div class="
mt-4

text-[#D4AF37]

font-bold

text-sm
">

                        STEP {{ $index + 1 }}

                    </div>



                    <h3 class="
font-bold

text-lg

mt-2
">

                        {{ $step['title'] }}

                    </h3>



                    <p class="
text-sm

text-gray-500

mt-3

leading-6
">

                        {{ $step['desc'] }}

                    </p>



                </div>
            @endforeach


        </div>


    </section>
    <!-- DETAIL -->

    <section class="
bg-white

border-y

border-gray-100
">


        <div class="
max-w-7xl

mx-auto

px-6

py-16
">


            <div class="
grid

grid-cols-1

lg:grid-cols-2

gap-10
">



                <div>

                    <p class="
text-[#7A1F2B]

uppercase

tracking-[4px]

text-sm

font-semibold
">
                        Proses Voting
                    </p>


                    <h2 class="
text-3xl

font-bold

mt-3
">

                        Voting Mudah, Cepat, dan Transparan

                    </h2>


                    <p class="
text-gray-600

mt-5

leading-8
">

                        Vooters menyediakan proses voting digital yang
                        dirancang agar pengguna dapat memberikan
                        dukungan tanpa proses yang rumit.

                    </p>


                </div>





                <div class="
space-y-4
">



                    <div class="
bg-[#FDF6F0]

rounded-2xl

p-5
">

                        <h3 class="font-bold">

                            1. Pilih Event

                        </h3>

                        <p class="text-gray-500 text-sm mt-2">

                            Cari event yang sedang berlangsung.

                        </p>

                    </div>





                    <div class="
bg-[#FDF6F0]

rounded-2xl

p-5
">

                        <h3 class="font-bold">

                            2. Pilih Kandidat

                        </h3>

                        <p class="text-gray-500 text-sm mt-2">

                            Kenali kandidat melalui profil yang tersedia.

                        </p>

                    </div>





                    <div class="
bg-[#FDF6F0]

rounded-2xl

p-5
">

                        <h3 class="font-bold">

                            3. Berikan Dukungan

                        </h3>

                        <p class="text-gray-500 text-sm mt-2">

                            Jumlah vote akan dihitung secara realtime.

                        </p>

                    </div>



                </div>


            </div>


        </div>


    </section>









    <!-- FAQ -->

    <section class="
max-w-7xl

mx-auto

px-6

py-16
">


        <h2 class="
text-center

text-3xl

font-bold
">

            Pertanyaan Umum

        </h2>




        <div class="
mt-10

grid

md:grid-cols-2

gap-5
">



            <div class="
bg-white

rounded-2xl

p-6

border
">


                <h3 class="font-bold">

                    Apakah bisa vote lebih dari satu kali?

                </h3>


                <p class="
text-gray-500

text-sm

mt-3
">

                    Bisa, selama pengguna melakukan transaksi
                    vote kembali sesuai ketentuan event.

                </p>


            </div>






            <div class="
bg-white

rounded-2xl

p-6

border
">


                <h3 class="font-bold">

                    Bagaimana mengetahui hasil vote?

                </h3>


                <p class="
text-gray-500

text-sm

mt-3
">

                    Ranking setiap event akan menampilkan
                    perolehan vote kandidat.

                </p>


            </div>



        </div>


    </section>









    <!-- CTA -->

    <section class="
max-w-7xl

mx-auto

px-6

pb-16
">



        <div class="
rounded-3xl

bg-[#5A1520]

text-white

p-10

text-center
">



            <h2 class="
text-3xl

font-bold
">

                Siap Memberikan Dukungan?

            </h2>




            <p class="
text-white/70

mt-3
">

                Temukan event favorit dan berikan vote sekarang.

            </p>





            <a href="{{ route('home') }}#event"
                class="
inline-block

mt-6

bg-[#D4AF37]

text-[#5A1520]

px-8

py-3

rounded-xl

font-bold
">


                Lihat Event


            </a>




        </div>


    </section>






    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}


    @include('partials.footer')



</body>

</html>
