<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Pusat Bantuan - Vooters
    </title>

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#f8faff] text-[#10204f]">


    @include('partials.navbar')



    <!-- HERO -->

    <section class="
pt-28
pb-16

bg-linear-to-br
from-blue-50
via-white
to-blue-100
">


        <div class="
max-w-7xl
mx-auto

px-6

text-center
">


            <p class="
uppercase

tracking-[4px]

text-blue-600

text-sm

font-semibold
">
                Vooters Help Center
            </p>



            <h1 class="
mt-4

text-4xl
md:text-5xl

font-extrabold
">

                Bagaimana Kami Bisa Membantu?

            </h1>



            <p class="
mt-5

max-w-2xl

mx-auto

text-gray-600

leading-8
">

                Temukan jawaban seputar voting,
                pembayaran, event, dan penggunaan
                platform Vooters.

            </p>



            <!-- SEARCH -->

            <div
                class="
mt-8

max-w-xl

mx-auto

bg-white

rounded-full

shadow-lg

border

flex

items-center

px-5

py-3
">


                <span>
                    🔍
                </span>


                <input type="text" placeholder="Cari pertanyaan..."
                    class="
w-full

ml-3

outline-none

bg-transparent

">


            </div>


        </div>


    </section>






    <!-- CATEGORY -->

    <section class="
max-w-7xl

mx-auto

px-6

py-16
">


        <h2 class="
text-3xl

font-bold

text-center
">

            Kategori Bantuan

        </h2>



        <div class="
grid

grid-cols-1
md:grid-cols-4

gap-5

mt-10
">


            @php

                $categories = [
                    [
                        'icon' => '🗳️',
                        'title' => 'Voting',
                        'desc' => 'Cara memilih kandidat dan memberikan vote.',
                    ],

                    [
                        'icon' => '💳',
                        'title' => 'Pembayaran',
                        'desc' => 'Informasi transaksi dan pembayaran vote.',
                    ],

                    [
                        'icon' => '👤',
                        'title' => 'Akun',
                        'desc' => 'Masalah akun dan akses pengguna.',
                    ],

                    [
                        'icon' => '🏆',
                        'title' => 'Event',
                        'desc' => 'Informasi event dan finalis.',
                    ],
                ];

            @endphp



            @foreach ($categories as $item)
                <div class="
bg-white

border

rounded-3xl

p-6

hover:shadow-lg

transition
">


                    <div class="
w-14
h-14

rounded-2xl

bg-blue-50

flex

items-center

justify-center

text-2xl
">

                        {{ $item['icon'] }}

                    </div>



                    <h3 class="
font-bold

text-xl

mt-5
">

                        {{ $item['title'] }}

                    </h3>



                    <p class="
text-sm

text-gray-500

mt-3

leading-6
">

                        {{ $item['desc'] }}

                    </p>



                </div>
            @endforeach


        </div>


    </section>







    <!-- FAQ -->

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


            <div class="text-center">


                <p class="
text-blue-600

uppercase

tracking-[4px]

text-sm

font-semibold
">
                    FAQ
                </p>



                <h2 class="
text-3xl

font-bold

mt-3
">

                    Pertanyaan yang Sering Ditanyakan

                </h2>


            </div>





            <div class="
grid

grid-cols-1

md:grid-cols-2

gap-5

mt-10
">


                @php

                    $faq = [
                        [
                            'q' => 'Bagaimana cara melakukan vote?',
                            'a' => 'Pilih event, pilih kandidat, tentukan jumlah vote, lalu lanjutkan pembayaran.',
                        ],

                        [
                            'q' => 'Apakah bisa vote lebih dari sekali?',
                            'a' => 'Bisa. Setiap transaksi baru akan dihitung sebagai tambahan vote.',
                        ],

                        [
                            'q' => 'Bagaimana jika pembayaran gagal?',
                            'a' => 'Silakan cek kembali transaksi atau hubungi bantuan Vooters.',
                        ],

                        [
                            'q' => 'Apakah hasil vote realtime?',
                            'a' => 'Perolehan vote akan diperbarui berdasarkan transaksi yang berhasil.',
                        ],
                    ];

                @endphp



                @foreach ($faq as $item)
                    <div class="
bg-[#f8faff]

rounded-2xl

p-6

border
">


                        <h3 class="
font-bold

text-lg
">

                            {{ $item['q'] }}

                        </h3>


                        <p class="
text-gray-500

text-sm

mt-3

leading-6
">

                            {{ $item['a'] }}

                        </p>


                    </div>
                @endforeach


            </div>


        </div>


    </section>







    <!-- CONTACT -->

    <section class="
max-w-7xl

mx-auto

px-6

py-16
">


        <div
            class="
bg-[#10204f]

rounded-3xl

p-8
md:p-12

text-white

flex

flex-col

lg:flex-row

lg:items-center

lg:justify-between

gap-8
">


            <div>


                <p class="
text-blue-200

uppercase

tracking-[4px]

text-sm
">
                    Masih Membutuhkan Bantuan?
                </p>


                <h2 class="
text-3xl

font-bold

mt-3
">

                    Hubungi Tim Support Vooters

                </h2>


                <p class="
text-white/70

mt-3
">

                    Tim kami siap membantu permasalahan
                    terkait penggunaan platform.

                </p>


            </div>



            <div class="
space-y-3
">


                <a href="mailto:support@Vooters.id"
                    class="
block

bg-white

text-[#10204f]

px-7

py-3

rounded-xl

font-bold

text-center
">

                    ✉ support@Vooters.id

                </a>



                <a href="#"
                    class="
block

border

border-white/30

px-7

py-3

rounded-xl

font-semibold

text-center
">

                    WhatsApp Support

                </a>


            </div>



        </div>


    </section>
    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @include('partials.footer')



</body>

</html>
