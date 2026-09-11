<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
        PICO - Digital Voting Platform
    </title>


    @vite(['resources/css/app.css'])

</head>


<body class="bg-white text-gray-900">


    @include('partials.navbar')





    <!-- ================================================= -->
    <!-- HERO SECTION -->
    <!-- ================================================= -->


    <section class="
pt-32
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
grid
lg:grid-cols-2
gap-10
items-center
">



            <!-- TEXT -->


            <div>


                <p class="
text-blue-600
font-semibold
uppercase
tracking-[4px]
text-sm
">

                    Suara Untuk Perubahan

                </p>




                <h1 class="
mt-5
text-5xl
lg:text-6xl
font-bold
leading-tight
text-[#14285a]
">


                    Platform Voting Digital

                    <br>


                    <span class="text-blue-600">

                        untuk Berbagai Event

                    </span>


                </h1>





                <p class="
mt-6
text-gray-600
text-lg
leading-relaxed
max-w-xl
">


                    PICO memudahkan Anda untuk membuat,
                    mengikuti, dan mengelola voting online
                    dengan aman, mudah, dan realtime.
                    Dukung talenta, karya, dan komunitas favorit Anda.


                </p>





                <div class="
mt-8
flex
gap-4
flex-wrap
">



                    <a href="#event" class="
bg-blue-600
text-white
px-8
py-3
rounded-xl
font-semibold
shadow-lg
hover:bg-blue-700
">


                        Mulai Voting →

                    </a>




                    <a href="#" class="
border
border-blue-500
text-blue-600
px-8
py-3
rounded-xl
font-semibold
">


                        + Buat Event


                    </a>



                </div>





                <div class="
mt-8
flex
items-center
gap-4
">


                    <div class="flex -space-x-3">


                        <img src="{{ asset('Images/people1.webp') }}"
                            class="w-10 h-10 rounded-full border-2 border-white">


                        <img src="{{ asset('Images/people2.webp') }}"
                            class="w-10 h-10 rounded-full border-2 border-white">


                        <img src="{{ asset('Images/people3.webp') }}"
                            class="w-10 h-10 rounded-full border-2 border-white">


                    </div>



                    <p class="text-sm text-gray-600">

                        Bergabung dengan
                        <b>100.000+</b>
                        pengguna di seluruh Indonesia

                    </p>


                </div>


            </div>





            <!-- IMAGE HERO -->
            <div class="
relative
flex
justify-center
">
                <div class="
absolute
w-96
h-96
bg-blue-300
rounded-full
blur-3xl
opacity-30
">

                </div>
                <img src="{{ asset('Images/hero.webp') }}" class="
relative
max-w-xl
w-full
">
            </div>
        </div>
    </section>









    <!-- ================================================= -->
    <!-- SEARCH EVENT -->
    <!-- ================================================= -->


    <section class="
max-w-7xl
mx-auto
px-6
-mt-8
relative
z-10
">


        <div class="
bg-white
rounded-3xl
shadow-xl
p-5
border
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


                <input type="text" placeholder="Cari event, voting, atau kategori..." class="
w-full
outline-none
">


                <button class="
bg-blue-600
text-white
px-5
py-2
rounded-full
">

                    →

                </button>


            </div>





            <div class="
flex
gap-3
mt-5
flex-wrap
">


                <button class="
bg-blue-600
text-white
px-5
py-2
rounded-full
text-sm
">

                    🔥 Populer

                </button>



                <button class="
border
px-5
py-2
rounded-full
text-sm
">

                    Terbaru

                </button>



                <button class="
border
px-5
py-2
rounded-full
text-sm
">

                    ♛ Pageant

                </button>




                <button class="
border
px-5
py-2
rounded-full
text-sm
">

                    👥 Organisasi

                </button>



                <button class="
border
px-5
py-2
rounded-full
text-sm
">

                    🏆 Kompetisi

                </button>



            </div>



        </div>


    </section>









    <!-- ================================================= -->
    <!-- STATISTIC -->
    <!-- ================================================= -->


    <section class="
max-w-7xl
mx-auto
px-6
py-16
">


        <div class="
grid
md:grid-cols-4
gap-6
">



            <div class="
bg-blue-50
rounded-3xl
p-6
">


                <h2 class="text-3xl font-bold text-blue-600">

                    500+

                </h2>


                <p>

                    Event Telah Dibuat

                </p>


            </div>





            <div class="
bg-green-50
rounded-3xl
p-6
">


                <h2 class="text-3xl font-bold text-green-600">

                    50.000+

                </h2>


                <p>

                    Peserta Terdaftar

                </p>


            </div>





            <div class="
bg-yellow-50
rounded-3xl
p-6
">


                <h2 class="text-3xl font-bold text-yellow-600">

                    1 Juta+

                </h2>


                <p>

                    Vote Terkumpul

                </p>


            </div>





            <div class="
bg-purple-50
rounded-3xl
p-6
">


                <h2 class="text-3xl font-bold text-purple-600">

                    24/7

                </h2>


                <p>

                    Sistem Realtime

                </p>


            </div>




        </div>


    </section>









    <!-- ================================================= -->
    <!-- POPULAR EVENT -->
    <!-- ================================================= -->


    <section id="event" class="
max-w-7xl
mx-auto
px-6
pb-20
">


        <div class="
flex
justify-between
items-center
mb-8
">


            <div>


                <h2 class="
text-3xl
font-bold
text-[#14285a]
">

                    Vote Terpopuler

                </h2>


                <p class="text-gray-500">

                    Temukan event menarik dan dukung favorit Anda

                </p>


            </div>



            <a href="#" class="
text-blue-600
font-semibold
">

                Lihat Semua Event →

            </a>


        </div>





        <div class="
grid
md:grid-cols-3
gap-8
">



            @forelse($popularEvents as $event)
            <div class="
bg-white
rounded-3xl
shadow-lg
border
overflow-hidden
">



                <img src="{{ asset('storage/' . $event->banner) }}" class="
w-full
h-52
object-cover
">



                <div class="p-5">


                    <h3 class="
font-bold
text-xl
">

                        {{ $event->name }}

                    </h3>



                    <p class="
text-gray-500
mt-2
line-clamp-2
">

                        {{ $event->description }}

                    </p>



                    <div class="
mt-5
flex
justify-between
text-sm
text-gray-500
">


                        <span>

                            📅 {{ $event->start_date }}

                        </span>



                        <span>

                            👥 {{ $event->candidates_count ?? 0 }}

                            Finalis

                        </span>


                    </div>




                    <a href="{{ route('event.detail', $event->id) }}" class="
block
mt-5
text-center
bg-blue-600
text-white
py-3
rounded-xl
font-semibold
">

                        Lihat Event →

                    </a>



                </div>


            </div>



            @empty


            <p>

                Belum ada event tersedia.

            </p>
            @endforelse



        </div>


    </section>