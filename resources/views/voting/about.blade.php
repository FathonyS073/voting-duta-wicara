<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
        Tentang Vooters - Digital Voting Platform
    </title>
    <link rel="icon" type="image/webp" href="{{ asset('Images/logo.webp') }}">


    @vite(['resources/css/app.css'])

</head>


<body class="
bg-white
text-[#5A1520]
overflow-x-hidden
">


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

from-[#FDF6F0]

via-white

to-[#F5E7D0]

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
text-[#7A1F2B]

text-xs
sm:text-sm

font-semibold

uppercase

tracking-[3px]
sm:tracking-[4px]
">

                    Tentang Vooters

                </p>





                <h1 class="
mt-4

text-4xl
sm:text-5xl
lg:text-6xl

leading-[1.08]

font-extrabold

text-[#5A1520]
">


                    Satu Platform untuk


                    <span class="text-[#7A1F2B]">

                        Berbagai Voting Digital

                    </span>


                </h1>





                <p class="
mt-6

text-base
sm:text-lg

text-gray-600

leading-8

max-w-xl
">


                    Vooters adalah platform voting digital yang dirancang
                    untuk membantu penyelenggara mengelola berbagai event
                    voting secara lebih mudah, terstruktur, dan profesional.
                    Pengguna dapat menemukan event, mengenal finalis,
                    memberikan dukungan, serta mengikuti perkembangan
                    peringkat melalui satu platform.


                </p>





                <div class="
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


bg-[#7A1F2B]

hover:bg-[#5A1520]


text-white


px-7

py-3.5


rounded-xl


font-semibold


shadow-lg


transition
">


                        Jelajahi Event

                        <span>
                            →
                        </span>


                    </a>






                    <a href="#mengapa-Vooters"
                        class="
inline-flex

items-center

justify-center


border

border-[#D4AF37]


text-[#7A1F2B]


px-7

py-3.5


rounded-xl


font-semibold


hover:bg-[#FDF6F0]


transition
">


                        Pelajari Vooters


                    </a>




                </div>



            </div>
            {{-- VISUAL --}}


            <div class="
relative

min-h-[340px]
sm:min-h-[420px]

flex

items-center

justify-center
">


                <div class="
absolute

w-72
h-72

sm:w-96
sm:h-96


bg-[#D4AF37]/30


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

border-[#F1E3C0]


shadow-xl


rounded-[32px]


p-5
sm:p-7
">



                    <div class="
bg-[#5A1520]

rounded-2xl

p-5

text-white
">



                        <div class="
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

bg-[#7A1F2B]

flex

items-center

justify-center

font-bold
">

                                    P

                                </div>



                                <div>


                                    <p class="font-bold">

                                        Dashboard Vooters

                                    </p>


                                    <p class="
text-xs

text-white/50
">

                                        Digital Voting Platform

                                    </p>



                                </div>


                            </div>





                            <span class="
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





                        <div class="
mt-6

space-y-3
">


                            <div class="
bg-white/10

rounded-xl

p-4
">


                                <div class="
flex

justify-between

items-center
">


                                    <span class="text-sm">

                                        Duta Wicara Jatim 2026

                                    </span>


                                    <span class="
text-xs

bg-[#D4AF37]

text-[#5A1520]

px-2

py-1

rounded-full
">

                                        Active

                                    </span>


                                </div>



                                <div class="
mt-3

h-2

bg-white/20

rounded-full
">


                                    <div class="
h-full

w-3/4

bg-[#D4AF37]

rounded-full
">
                                    </div>


                                </div>


                            </div>





                            <div class="
grid

grid-cols-3

gap-3
">


                                <div class="
bg-white/10

rounded-xl

p-3

text-center
">


                                    <p class="
text-xl

font-bold
">

                                        125K

                                    </p>


                                    <p class="
text-xs

text-white/60
">

                                        Vote

                                    </p>


                                </div>




                                <div class="
bg-white/10

rounded-xl

p-3

text-center
">


                                    <p class="
text-xl

font-bold
">

                                        500+

                                    </p>


                                    <p class="
text-xs

text-white/60
">

                                        Event

                                    </p>


                                </div>




                                <div class="
bg-white/10

rounded-xl

p-3

text-center
">


                                    <p class="
text-xl

font-bold
">

                                        24/7

                                    </p>


                                    <p class="
text-xs

text-white/60
">

                                        Online

                                    </p>


                                </div>



                            </div>


                        </div>


                    </div>



                </div>


            </div>



        </div>


    </section>
    {{-- ========================================================= --}}
    {{-- MENGENAL Vooters --}}
    {{-- ========================================================= --}}


    <section id="mengapa-Vooters" class="
py-16
sm:py-20

bg-white
">


        <div class="
max-w-7xl

mx-auto

px-4
sm:px-6
">



            <div class="
text-center

max-w-3xl

mx-auto
">



                <p class="
text-[#7A1F2B]

uppercase

tracking-[4px]

text-sm

font-semibold
">

                    Mengenal Vooters

                </p>





                <h2 class="
mt-4

text-3xl
sm:text-4xl

font-extrabold

text-[#5A1520]
">


                    Platform Voting Digital Modern


                </h2>





                <p class="
mt-5

text-gray-600

leading-8
">


                    Vooters menghubungkan penyelenggara event dan
                    masyarakat dalam satu ekosistem voting digital.
                    Sistem dirancang untuk memberikan pengalaman
                    voting yang mudah, transparan, dan terpercaya.


                </p>




            </div>






            <div class="
mt-12

grid

grid-cols-1

md:grid-cols-3

gap-6
">





                <div class="
bg-[#FDF6F0]

rounded-3xl

p-8

border

border-[#F1E3C0]
">



                    <div
                        class="
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

                        🗳️

                    </div>





                    <h3 class="
mt-6

text-xl

font-bold

text-[#5A1520]
">

                        Voting Digital

                    </h3>





                    <p class="
mt-3

text-gray-600

leading-7
">


                        Memberikan pengalaman voting online
                        yang cepat, mudah, dan dapat dilakukan
                        kapan saja.


                    </p>



                </div>






                <div class="
bg-[#FFF9F2]

rounded-3xl

p-8

border

border-[#F1E3C0]
">



                    <div
                        class="
w-14

h-14

rounded-2xl

bg-[#D4AF37]

text-[#5A1520]

flex

items-center

justify-center

text-2xl
">

                        📊

                    </div>





                    <h3 class="
mt-6

text-xl

font-bold

text-[#5A1520]
">

                        Sistem Realtime

                    </h3>





                    <p class="
mt-3

text-gray-600

leading-7
">


                        Perolehan vote dapat dipantau secara
                        realtime sehingga proses kompetisi
                        lebih menarik.


                    </p>



                </div>







                <div class="
bg-[#FDF6F0]

rounded-3xl

p-8

border

border-[#F1E3C0]
">



                    <div
                        class="
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

                        🏆

                    </div>





                    <h3 class="
mt-6

text-xl

font-bold

text-[#5A1520]
">

                        Berbagai Event

                    </h3>





                    <p class="
mt-3

text-gray-600

leading-7
">


                        Mendukung berbagai jenis event mulai
                        dari pageant, komunitas, kompetisi,
                        hingga pemilihan publik.


                    </p>



                </div>





            </div>



        </div>


    </section>
    {{-- ========================================================= --}}
    {{-- VISI Vooters --}}
    {{-- ========================================================= --}}


    <section class="
py-16
sm:py-20

bg-[#FDF6F0]
">


        <div class="
max-w-7xl

mx-auto

px-4
sm:px-6
">


            <div class="
grid

grid-cols-1

lg:grid-cols-2

gap-10

items-center
">



                <div>


                    <p class="
text-[#7A1F2B]

uppercase

tracking-[4px]

text-sm

font-semibold
">

                        Visi Vooters

                    </p>





                    <h2 class="
mt-4

text-3xl
sm:text-4xl

font-extrabold

text-[#5A1520]
">

                        Membawa Voting Digital
                        Lebih Profesional

                    </h2>





                    <p class="
mt-5

text-gray-600

leading-8
">


                        Vooters hadir dengan tujuan membangun
                        ekosistem voting digital yang dapat
                        digunakan oleh berbagai penyelenggara
                        event dengan sistem yang aman,
                        transparan, dan mudah digunakan.


                    </p>


                </div>





                <div class="
bg-white

rounded-3xl

border

border-[#F1E3C0]

p-8

shadow-sm
">



                    <div class="
space-y-5
">



                        <div class="
flex

gap-4
">


                            <div
                                class="
w-12

h-12

rounded-xl

bg-[#7A1F2B]

text-white

flex

items-center

justify-center

font-bold
">

                                1

                            </div>



                            <div>

                                <h3 class="font-bold text-lg">

                                    Mudah Digunakan

                                </h3>


                                <p class="
text-gray-500

text-sm

mt-1
">

                                    Pengguna dapat melakukan voting
                                    melalui proses yang sederhana.

                                </p>


                            </div>


                        </div>





                        <div class="
flex

gap-4
">


                            <div
                                class="
w-12

h-12

rounded-xl

bg-[#D4AF37]

text-[#5A1520]

flex

items-center

justify-center

font-bold
">

                                2

                            </div>



                            <div>

                                <h3 class="font-bold text-lg">

                                    Transparan

                                </h3>


                                <p class="
text-gray-500

text-sm

mt-1
">

                                    Data voting tercatat secara
                                    sistematis dan realtime.

                                </p>


                            </div>


                        </div>





                        <div class="
flex

gap-4
">


                            <div
                                class="
w-12

h-12

rounded-xl

bg-[#7A1F2B]

text-white

flex

items-center

justify-center

font-bold
">

                                3

                            </div>



                            <div>

                                <h3 class="font-bold text-lg">

                                    Fleksibel

                                </h3>


                                <p class="
text-gray-500

text-sm

mt-1
">

                                    Mendukung berbagai kebutuhan
                                    event dan komunitas.

                                </p>


                            </div>


                        </div>



                    </div>



                </div>


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

py-16
">


        <div
            class="
rounded-3xl

bg-linear-to-r

from-[#5A1520]

via-[#7A1F2B]

to-[#9A3A4A]

text-white

p-8
sm:p-12

text-center
">


            <h2 class="
text-3xl

sm:text-4xl

font-bold
">

                Siap Menggunakan Vooters?

            </h2>



            <p class="
mt-4

text-white/80

max-w-2xl

mx-auto
">

                Temukan event menarik dan berikan dukungan
                kepada kandidat favorit Anda sekarang.

            </p>




            <a href="{{ route('events.index') }}"
                class="
inline-flex

items-center

justify-center

mt-8

bg-[#D4AF37]

hover:bg-[#E8C96B]

text-[#5A1520]

px-8

py-3.5

rounded-xl

font-bold

transition
">

                Jelajahi Event

            </a>



        </div>


    </section>





    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @include('partials.footer')



</body>

</html>
