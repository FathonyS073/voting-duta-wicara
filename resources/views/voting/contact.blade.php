<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Hubungi Kami - PICO
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

text-sm

font-semibold
">

                Contact PICO

            </p>



            <h1 class="
mt-4

text-4xl
md:text-5xl

font-extrabold
">

                Hubungi Kami

            </h1>



            <p class="
mt-5

text-gray-600

leading-8

max-w-2xl

mx-auto
">

                Kami siap membantu pertanyaan, kendala,
                maupun kebutuhan kerja sama terkait platform
                Digital Voting PICO.

            </p>


        </div>


    </section>








    <!-- CONTACT CONTENT -->

    <section class="
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





            <!-- LEFT -->

            <div class="
space-y-6
">


                <div>

                    <p class="
text-blue-600

uppercase

tracking-[3px]

font-semibold

text-sm
">
                        Informasi Kontak
                    </p>


                    <h2 class="
text-3xl

font-bold

mt-3
">

                        Mari Terhubung Dengan Tim PICO

                    </h2>


                    <p class="
text-gray-600

mt-4

leading-8
">

                        Apabila Anda memiliki pertanyaan mengenai
                        event, voting, kerja sama, atau layanan
                        PICO, silakan hubungi kami melalui kontak
                        berikut.

                    </p>


                </div>






                <!-- EMAIL -->

                <div class="
bg-white

rounded-3xl

border

p-6

flex

gap-5

items-center
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
                        ✉
                    </div>



                    <div>

                        <p class="
text-sm

text-gray-500
">
                            Email
                        </p>


                        <h3 class="
font-bold

text-lg

text-blue-600
">
                            support@pico.id
                        </h3>


                    </div>


                </div>







                <!-- PHONE -->

                <div class="
bg-white

rounded-3xl

border

p-6

flex

gap-5

items-center
">


                    <div class="
w-14

h-14

rounded-2xl

bg-green-50

flex

items-center

justify-center

text-2xl
">
                        ☎
                    </div>



                    <div>

                        <p class="
text-sm

text-gray-500
">
                            WhatsApp
                        </p>


                        <h3 class="
font-bold

text-lg
">
                            +62 8xx xxxx xxxx
                        </h3>


                    </div>


                </div>







                <!-- SOCIAL -->

                <div class="
bg-white

rounded-3xl

border

p-6
">


                    <h3 class="
font-bold

text-xl
">

                        Ikuti PICO

                    </h3>


                    <div class="
flex

gap-3

mt-5

flex-wrap
">


                        <a href="#" class="
px-5

py-3

rounded-xl

bg-blue-50

text-blue-600

font-semibold
">
                            Instagram
                        </a>


                        <a href="#" class="
px-5

py-3

rounded-xl

bg-blue-50

text-blue-600

font-semibold
">
                            TikTok
                        </a>


                        <a href="#" class="
px-5

py-3

rounded-xl

bg-blue-50

text-blue-600

font-semibold
">
                            LinkedIn
                        </a>


                    </div>


                </div>



            </div>









            <!-- FORM -->

            <div class="
bg-white

rounded-3xl

border

shadow-sm

p-6

md:p-10
">


                <h2 class="
text-2xl

font-bold
">

                    Kirim Pesan

                </h2>


                <p class="
text-gray-500

mt-2

text-sm
">

                    Isi formulir berikut dan tim PICO akan
                    menghubungi Anda.

                </p>




                <form class="
mt-8

space-y-5
">


                    <div>


                        <label class="
font-semibold

text-sm
">
                            Nama
                        </label>


                        <input type="text" placeholder="Nama lengkap"
                            class="
mt-2

w-full

border

rounded-xl

px-4

py-3

outline-none

focus:ring-2

focus:ring-blue-500
">

                    </div>





                    <div>


                        <label class="
font-semibold

text-sm
">
                            Email
                        </label>


                        <input type="email" placeholder="Email aktif"
                            class="
mt-2

w-full

border

rounded-xl

px-4

py-3

outline-none

focus:ring-2

focus:ring-blue-500
">

                    </div>






                    <div>


                        <label class="
font-semibold

text-sm
">
                            Pesan
                        </label>


                        <textarea rows="5" placeholder="Tuliskan pesan Anda..."
                            class="
mt-2

w-full

border

rounded-xl

px-4

py-3

outline-none

focus:ring-2

focus:ring-blue-500
"></textarea>


                    </div>





                    <button type="button"
                        class="
w-full

bg-blue-600

text-white

py-3

rounded-xl

font-bold

hover:bg-blue-700
">

                        Kirim Pesan

                    </button>



                </form>



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

bg-[#10204f]

text-white

p-10

text-center
">


            <h2 class="
text-3xl

font-bold
">

                Butuh Bantuan Cepat?

            </h2>


            <p class="
mt-3

text-white/70
">

                Hubungi tim PICO melalui WhatsApp untuk
                respon lebih cepat.

            </p>



            <a href="#"
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

                Chat WhatsApp

            </a>


        </div>


    </section>
    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    @include('partials.footer')



</body>

</html>
