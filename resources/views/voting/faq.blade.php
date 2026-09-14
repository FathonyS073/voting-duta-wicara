<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        FAQ - PICO
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
max-w-5xl
mx-auto

px-6

text-center
">


            <p class="
text-blue-600

uppercase

tracking-[4px]

font-semibold

text-sm
">
                Frequently Asked Questions
            </p>



            <h1 class="
text-4xl
md:text-5xl

font-extrabold

mt-4
">

                Pertanyaan Umum

            </h1>



            <p class="
mt-5

text-gray-600

leading-8

max-w-2xl

mx-auto
">

                Temukan jawaban mengenai penggunaan
                platform voting digital PICO.

            </p>


        </div>


    </section>







    <!-- SEARCH -->

    <section class="
max-w-4xl

mx-auto

px-6

-mt-8

relative
">


        <div class="
bg-white

rounded-3xl

shadow-xl

border

p-5
">


            <div class="
flex

items-center

gap-3

border

rounded-full

px-5

py-3
">


                <span>
                    🔍
                </span>


                <input type="text" placeholder="Cari pertanyaan..." class="
w-full

outline-none
">


            </div>


        </div>


    </section>







    <!-- FAQ -->

    <section class="
max-w-5xl

mx-auto

px-6

py-16
">



        @php

            $faq = [
                [
                    'category' => 'Voting',

                    'items' => [
                        [
                            'q' => 'Bagaimana cara melakukan voting di PICO?',
                            'a' =>
                                'Pilih event yang tersedia, pilih kandidat favorit, tentukan jumlah vote, kemudian lanjutkan proses pembayaran.',
                        ],

                        [
                            'q' => 'Apakah saya dapat memberikan vote lebih dari satu kali?',
                            'a' =>
                                'Ya. Pengguna dapat melakukan voting kembali melalui transaksi baru sesuai aturan event.',
                        ],

                        [
                            'q' => 'Apakah vote langsung masuk?',
                            'a' => 'Vote akan masuk setelah transaksi berhasil diverifikasi oleh sistem.',
                        ],
                    ],
                ],

                [
                    'category' => 'Pembayaran',

                    'items' => [
                        [
                            'q' => 'Berapa harga satu vote?',
                            'a' => 'Harga vote ditentukan oleh masing-masing event dan kategori voting.',
                        ],

                        [
                            'q' => 'Metode pembayaran apa yang tersedia?',
                            'a' => 'Metode pembayaran mengikuti sistem pembayaran yang digunakan oleh PICO.',
                        ],

                        [
                            'q' => 'Apa yang dilakukan jika pembayaran gagal?',
                            'a' => 'Silakan periksa status transaksi atau hubungi tim bantuan PICO.',
                        ],
                    ],
                ],

                [
                    'category' => 'Event',

                    'items' => [
                        [
                            'q' => 'Siapa yang dapat membuat event?',
                            'a' => 'Event dapat dibuat oleh penyelenggara yang bekerja sama dengan PICO.',
                        ],

                        [
                            'q' => 'Apakah semua event dapat dipilih?',
                            'a' => 'Hanya event yang telah dipublikasikan dan aktif yang dapat diikuti.',
                        ],
                    ],
                ],

                [
                    'category' => 'Kandidat',

                    'items' => [
                        [
                            'q' => 'Bagaimana informasi kandidat ditampilkan?',
                            'a' => 'Informasi kandidat berasal dari data yang diberikan oleh penyelenggara event.',
                        ],

                        [
                            'q' => 'Bagaimana menentukan pemenang?',
                            'a' =>
                                'Pemenang mengikuti aturan masing-masing event berdasarkan jumlah vote atau ketentuan yang berlaku.',
                        ],
                    ],
                ],
            ];

        @endphp





        @foreach ($faq as $section)
            <div class="
mb-10
">


                <h2 class="
text-2xl

font-bold

mb-5
">

                    {{ $section['category'] }}

                </h2>



                <div class="
space-y-4
">


                    @foreach ($section['items'] as $item)
                        <details class="
bg-white

rounded-2xl

border

p-5

group
">


                            <summary
                                class="
cursor-pointer

font-semibold

list-none

flex

justify-between

items-center
">

                                {{ $item['q'] }}


                                <span class="
text-blue-600
">
                                    +
                                </span>


                            </summary>



                            <p class="
text-gray-600

mt-4

leading-7
">

                                {{ $item['a'] }}

                            </p>



                        </details>
                    @endforeach


                </div>


            </div>
        @endforeach



    </section>







    <!-- CTA -->


    <section class="
max-w-7xl

mx-auto

px-6

pb-16
">


        <div class="
bg-[#10204f]

rounded-3xl

text-white

p-10

text-center
">


            <h2 class="
text-3xl

font-bold
">

                Masih Memiliki Pertanyaan?

            </h2>



            <p class="
mt-3

text-white/70
">

                Tim PICO siap membantu menyelesaikan
                kendala Anda.

            </p>



            <a href="{{ route('contact') }}"
                class="
inline-block

mt-6

bg-yellow-400

text-[#10204f]

px-8

py-3

rounded-xl

font-bold
">

                Hubungi Kami

            </a>


        </div>


    </section>
    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @include('partials.footer')



</body>

</html>
