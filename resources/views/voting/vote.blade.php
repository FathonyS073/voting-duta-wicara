<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Vote {{ $candidate->name }} - PICO
    </title>

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#f8faff] text-[#10204f] overflow-x-hidden">


    @include('partials.navbar')



    @php

        $totalVotes = (int) ($candidate->total_votes ?? 0);

    @endphp



    {{-- ========================================================= --}}
    {{-- BREADCRUMB --}}
    {{-- ========================================================= --}}

    <section class="pt-20 sm:pt-24">

        <div
            class="
        max-w-7xl
        mx-auto
        px-4
        sm:px-6
        pt-5
        sm:pt-7
        ">

            <div
                class="
            flex
            items-center
            gap-2

            text-xs
            sm:text-sm

            text-gray-500

            overflow-hidden
            ">

                <a href="{{ route('home') }}"
                    class="
                shrink-0
                hover:text-blue-600
                transition
                ">
                    Beranda
                </a>


                <span class="shrink-0">
                    ›
                </span>


                <a href="{{ route('event.detail', $event) }}"
                    class="
                truncate
                max-w-[110px]
                sm:max-w-xs

                hover:text-blue-600
                transition
                ">
                    {{ $event->name }}
                </a>


                <span class="shrink-0">
                    ›
                </span>


                <a href="{{ route('candidate.detail', $candidate) }}"
                    class="
                truncate
                max-w-[90px]
                sm:max-w-xs

                hover:text-blue-600
                transition
                ">
                    {{ $candidate->name }}
                </a>


                <span class="shrink-0">
                    ›
                </span>


                <span
                    class="
                shrink-0
                font-semibold
                text-[#10204f]
                ">
                    Vote
                </span>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <section class="pt-5 sm:pt-7 pb-6 sm:pb-8">

        <div class="
        max-w-7xl
        mx-auto
        px-4
        sm:px-6
        ">

            <div
                class="
            bg-linear-to-r
            from-[#e9f2ff]
            via-white
            to-[#edf4ff]

            border
            border-blue-100

            rounded-2xl
            sm:rounded-[28px]

            px-5
            sm:px-7
            lg:px-9

            py-6
            sm:py-7
            ">

                <p
                    class="
                text-blue-600

                text-xs

                uppercase

                tracking-[3px]
                sm:tracking-[4px]

                font-semibold
                ">
                    Voting PICO
                </p>


                <h1
                    class="
                mt-2

                text-2xl
                sm:text-3xl

                leading-tight

                font-extrabold

                break-words
                ">
                    Berikan Dukungan untuk {{ $candidate->name }}
                </h1>


                <p
                    class="
                text-sm
                sm:text-base

                text-gray-500

                mt-2
                ">
                    Pilih kategori dan jumlah vote yang ingin diberikan.
                </p>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <section class="pb-10 sm:pb-14">

        <div
            class="
        max-w-7xl
        mx-auto

        px-4
        sm:px-6

        grid
        grid-cols-1
        lg:grid-cols-[340px_1fr]

        gap-5
        sm:gap-6
        lg:gap-7

        items-start
        ">


            {{-- ================================================= --}}
            {{-- CANDIDATE CARD --}}
            {{-- ================================================= --}}

            <aside
                class="
            bg-white

            rounded-2xl
            sm:rounded-[28px]

            border
            border-gray-100

            shadow-sm

            p-4
            sm:p-5

            w-full
            ">


                <div
                    class="
                aspect-[4/5]

                max-w-[260px]
                sm:max-w-[300px]
                lg:max-w-none

                mx-auto

                rounded-2xl
                sm:rounded-[22px]

                overflow-hidden

                bg-gray-100
                ">

                    @if ($candidate->photo)
                        <img src="{{ asset('storage/' . $candidate->photo) }}" alt="{{ $candidate->name }}"
                            class="
                        w-full
                        h-full
                        object-cover
                        ">
                    @else
                        <div
                            class="
                        w-full
                        h-full

                        flex
                        items-center
                        justify-center

                        bg-blue-50

                        text-blue-600

                        text-5xl
                        sm:text-6xl

                        font-bold
                        ">
                            {{ mb_substr($candidate->name, 0, 1) }}
                        </div>
                    @endif

                </div>



                <div class="pt-5 sm:pt-6 text-center">

                    <p
                        class="
                    text-blue-600

                    text-xs

                    tracking-[3px]
                    sm:tracking-[4px]

                    uppercase
                    font-semibold
                    ">
                        Kandidat
                    </p>


                    <h2
                        class="
                    mt-2

                    text-xl
                    sm:text-2xl

                    leading-tight
                    font-extrabold

                    break-words
                    ">
                        {{ $candidate->name }}
                    </h2>


                    <p
                        class="
                    mt-2

                    text-sm
                    sm:text-base

                    text-gray-500
                    ">
                        {{ $candidate->city ?: '-' }}

                        @if ($candidate->province)
                            , {{ $candidate->province }}
                        @endif
                    </p>



                    <div
                        class="
                    mt-5

                    border-t
                    border-gray-100

                    pt-5

                    flex
                    items-center
                    justify-between
                    ">

                        <span class="text-gray-500 text-sm">
                            Total Vote
                        </span>


                        <strong
                            class="
                        text-blue-600
                        text-lg
                        ">
                            {{ number_format($totalVotes, 0, ',', '.') }}
                        </strong>

                    </div>



                    <a href="{{ route('candidate.detail', $candidate) }}"
                        class="
                    block

                    mt-5

                    w-full

                    border
                    border-blue-200

                    text-blue-600

                    py-3

                    rounded-xl

                    text-sm
                    sm:text-base

                    font-semibold

                    hover:bg-blue-50
                    transition
                    ">
                        Lihat Profil Kandidat
                    </a>

                </div>

            </aside>



            {{-- ================================================= --}}
            {{-- VOTING FORM --}}
            {{-- ================================================= --}}

            <div
                class="
            bg-white

            rounded-2xl
            sm:rounded-[28px]

            border
            border-gray-100

            shadow-sm

            p-5
            sm:p-6
            lg:p-8

            min-w-0
            ">

                <form id="voteForm" action="{{ route('candidate.checkout', $candidate) }}" method="POST">

                    @csrf



                    {{-- ================================================= --}}
                    {{-- CATEGORY --}}
                    {{-- ================================================= --}}

                    <div>

                        <p
                            class="
                        text-xs

                        text-blue-600

                        tracking-[3px]

                        uppercase
                        font-semibold
                        ">
                            Langkah 1
                        </p>


                        <h2
                            class="
                        text-xl
                        sm:text-2xl

                        font-extrabold

                        mt-2
                        ">
                            Pilih Kategori Vote
                        </h2>


                        <p
                            class="
                        text-sm
                        sm:text-base

                        text-gray-500

                        mt-1
                        ">
                            Harga vote dapat berbeda pada setiap kategori.
                        </p>



                        @if ($candidate->categories->count())

                            <div
                                class="
                            grid

                            grid-cols-1
                            sm:grid-cols-2

                            gap-3
                            sm:gap-4

                            mt-5
                            sm:mt-6
                            ">

                                @foreach ($candidate->categories as $category)
                                    <label
                                        class="
                                    category-card

                                    relative

                                    border-2
                                    border-gray-100

                                    rounded-2xl

                                    p-4
                                    sm:p-5

                                    cursor-pointer

                                    transition

                                    hover:border-blue-200
                                    ">

                                        <input type="radio" name="category_id" value="{{ $category->id }}"
                                            data-price="{{ $category->vote_price }}" class="category-radio sr-only"
                                            @checked($loop->first)>


                                        <div
                                            class="
                                        flex
                                        items-start
                                        justify-between

                                        gap-4
                                        ">

                                            <div class="min-w-0">

                                                <p
                                                    class="
                                                font-bold

                                                text-base
                                                sm:text-lg

                                                break-words
                                                ">
                                                    {{ $category->name }}
                                                </p>


                                                @if ($category->description)
                                                    <p
                                                        class="
                                                    text-sm
                                                    text-gray-500

                                                    mt-2

                                                    leading-6

                                                    break-words
                                                    ">
                                                        {{ \Illuminate\Support\Str::limit($category->description, 90) }}
                                                    </p>
                                                @endif

                                            </div>


                                            <div
                                                class="
                                            category-check

                                            w-6
                                            h-6

                                            rounded-full

                                            border-2
                                            border-gray-200

                                            shrink-0
                                            ">
                                            </div>

                                        </div>



                                        <div
                                            class="
                                        mt-5

                                        pt-4

                                        border-t
                                        border-gray-100

                                        flex
                                        items-center
                                        justify-between

                                        gap-3
                                        ">

                                            <span
                                                class="
                                            text-xs
                                            sm:text-sm

                                            text-gray-500
                                            ">
                                                Harga / Vote
                                            </span>


                                            <strong
                                                class="
                                            text-blue-600

                                            text-sm
                                            sm:text-base

                                            shrink-0
                                            ">
                                                Rp{{ number_format($category->vote_price, 0, ',', '.') }}
                                            </strong>

                                        </div>

                                    </label>
                                @endforeach

                            </div>
                        @else
                            <div
                                class="
                            mt-6

                            bg-amber-50

                            border
                            border-amber-100

                            text-amber-700

                            rounded-2xl

                            p-5
                            ">
                                Kandidat ini belum memiliki kategori voting aktif.
                            </div>

                        @endif

                    </div>



                    {{-- ================================================= --}}
                    {{-- VOTE AMOUNT --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                    mt-7
                    sm:mt-9

                    pt-7
                    sm:pt-8

                    border-t
                    border-gray-100
                    ">

                        <p
                            class="
                        text-xs

                        text-blue-600

                        tracking-[3px]

                        uppercase
                        font-semibold
                        ">
                            Langkah 2
                        </p>


                        <h2
                            class="
                        text-xl
                        sm:text-2xl

                        font-extrabold

                        mt-2
                        ">
                            Pilih Jumlah Vote
                        </h2>


                        <p
                            class="
                        text-sm
                        sm:text-base

                        text-gray-500

                        mt-1
                        ">
                            Pilih paket cepat atau masukkan jumlah vote sendiri.
                        </p>



                        {{-- PRESET VOTE --}}
                        <div
                            class="
                        grid

                        grid-cols-2
                        sm:grid-cols-4

                        gap-3
                        sm:gap-4

                        mt-5
                        sm:mt-6
                        ">

                            @foreach ([5, 10, 25, 50] as $amount)
                                <button type="button" data-vote="{{ $amount }}"
                                    class="
                                vote-option

                                border-2
                                border-gray-100

                                hover:border-blue-300

                                rounded-2xl

                                py-4
                                sm:py-6

                                text-center

                                transition
                                ">

                                    <span
                                        class="
                                    block

                                    text-2xl
                                    sm:text-3xl

                                    font-extrabold
                                    ">
                                        {{ $amount }}
                                    </span>


                                    <span
                                        class="
                                    block

                                    text-xs
                                    sm:text-sm

                                    text-gray-500

                                    mt-1
                                    ">
                                        Vote
                                    </span>

                                </button>
                            @endforeach

                        </div>



                        {{-- CUSTOM VOTE --}}
                        <div class="mt-6 sm:mt-7">

                            <label for="customVote"
                                class="
                            block

                            font-bold

                            text-sm
                            sm:text-base

                            mb-3
                            ">
                                Atau Masukkan Custom Vote
                            </label>


                            <div class="relative">

                                <input type="number" id="customVote" min="1" step="1"
                                    placeholder="Contoh: 30"
                                    class="
                                w-full

                                border-2
                                border-gray-100

                                focus:border-blue-400

                                outline-none

                                rounded-2xl

                                px-4
                                sm:px-5

                                py-3.5
                                sm:py-4

                                pr-20

                                text-base
                                sm:text-lg

                                transition
                                ">


                                <span
                                    class="
                                absolute
                                right-5
                                top-1/2
                                -translate-y-1/2

                                text-sm
                                text-gray-400
                                ">
                                    vote
                                </span>

                            </div>

                        </div>

                    </div>



                    {{-- ================================================= --}}
                    {{-- SUMMARY --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                    mt-7
                    sm:mt-9

                    bg-linear-to-br
                    from-[#f7f9ff]
                    to-[#eef4ff]

                    border
                    border-blue-100

                    rounded-2xl
                    sm:rounded-[24px]

                    p-5
                    sm:p-7
                    ">

                        <h2
                            class="
                        text-lg
                        sm:text-xl

                        font-extrabold
                        ">
                            Ringkasan Voting
                        </h2>



                        <div
                            class="
                        mt-5
                        sm:mt-6

                        space-y-4
                        ">


                            <div
                                class="
                            flex
                            items-start
                            justify-between

                            gap-5
                            ">

                                <span
                                    class="
                                text-sm
                                text-gray-500
                                ">
                                    Kandidat
                                </span>


                                <strong
                                    class="
                                text-sm
                                sm:text-base

                                text-right

                                max-w-[60%]

                                break-words
                                ">
                                    {{ $candidate->name }}
                                </strong>

                            </div>



                            <div
                                class="
                            flex
                            items-start
                            justify-between

                            gap-5
                            ">

                                <span
                                    class="
                                text-sm
                                text-gray-500
                                ">
                                    Kategori
                                </span>


                                <strong id="summaryCategory"
                                    class="
                                text-sm
                                sm:text-base

                                text-right

                                max-w-[60%]
                                ">
                                    -
                                </strong>

                            </div>



                            <div
                                class="
                            flex
                            items-center
                            justify-between

                            gap-5
                            ">

                                <span
                                    class="
                                text-sm
                                text-gray-500
                                ">
                                    Jumlah Vote
                                </span>

                                <strong id="summaryVote" class="text-sm sm:text-base">
                                    0 vote
                                </strong>

                            </div>



                            <div
                                class="
                            flex
                            items-center
                            justify-between

                            gap-5
                            ">

                                <span
                                    class="
                                text-sm
                                text-gray-500
                                ">
                                    Harga per Vote
                                </span>


                                <strong id="summaryPrice" class="text-sm sm:text-base">
                                    Rp0
                                </strong>

                            </div>



                            <div
                                class="
                            border-t
                            border-blue-100

                            pt-5
                            mt-5

                            flex
                            flex-col
                            sm:flex-row

                            sm:items-end
                            sm:justify-between

                            gap-2
                            sm:gap-5
                            ">

                                <span
                                    class="
                                font-bold

                                text-base
                                sm:text-lg
                                ">
                                    Total Pembayaran
                                </span>


                                <strong id="summaryTotal"
                                    class="
                                text-2xl
                                sm:text-3xl

                                font-extrabold

                                text-blue-600
                                ">
                                    Rp0
                                </strong>

                            </div>

                        </div>

                    </div>



                    {{-- HIDDEN VALUE --}}
                    <input type="hidden" name="vote_amount" id="selectedVoteInput">



                    {{-- SUBMIT --}}
                    <button type="submit" id="continueButton" disabled
                        class="
                    mt-5
                    sm:mt-6

                    w-full

                    bg-blue-600
                    hover:bg-blue-700

                    text-white

                    py-3.5
                    sm:py-4

                    rounded-xl

                    font-semibold

                    text-base
                    sm:text-lg

                    shadow-lg

                    transition

                    disabled:bg-gray-200
                    disabled:text-gray-400
                    disabled:shadow-none
                    disabled:cursor-not-allowed
                    ">
                        Lanjut Pembayaran →
                    </button>


                    <p
                        class="
                    mt-3

                    text-xs

                    leading-5

                    text-center
                    text-gray-400
                    ">
                        Pastikan kandidat, kategori, dan jumlah vote sudah sesuai
                        sebelum melanjutkan.
                    </p>

                </form>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="
    bg-[#0c1d46]
    text-white
    mt-4
    ">

        <div
            class="
        max-w-7xl
        mx-auto

        px-4
        sm:px-6

        py-7
        sm:py-8

        flex
        flex-col
        sm:flex-row

        sm:items-center
        sm:justify-between

        gap-5
        ">

            <div>

                <p class="font-extrabold text-xl">
                    PICO
                </p>

                <p class="text-white/50 text-xs mt-1">
                    Digital Voting Platform
                </p>

            </div>


            <p class="text-sm text-white/50">
                © {{ date('Y') }} PICO. All rights reserved.
            </p>

        </div>

    </footer>



    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {


            let selectedVote = 0;


            const categoryRadios =
                document.querySelectorAll(
                    '.category-radio'
                );


            const categoryCards =
                document.querySelectorAll(
                    '.category-card'
                );


            const voteOptions =
                document.querySelectorAll(
                    '.vote-option'
                );


            const customVote =
                document.getElementById(
                    'customVote'
                );


            const selectedVoteInput =
                document.getElementById(
                    'selectedVoteInput'
                );


            const summaryCategory =
                document.getElementById(
                    'summaryCategory'
                );


            const summaryVote =
                document.getElementById(
                    'summaryVote'
                );


            const summaryPrice =
                document.getElementById(
                    'summaryPrice'
                );


            const summaryTotal =
                document.getElementById(
                    'summaryTotal'
                );


            const continueButton =
                document.getElementById(
                    'continueButton'
                );


            const voteForm =
                document.getElementById(
                    'voteForm'
                );



            /*
            |--------------------------------------------------------------------------
            | FORMAT RUPIAH
            |--------------------------------------------------------------------------
            */

            function rupiah(value) {

                return new Intl.NumberFormat(
                    'id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        maximumFractionDigits: 0
                    }
                ).format(value);

            }



            /*
            |--------------------------------------------------------------------------
            | CATEGORY TERPILIH
            |--------------------------------------------------------------------------
            */

            function getSelectedCategory() {

                return document.querySelector(
                    '.category-radio:checked'
                );

            }



            /*
            |--------------------------------------------------------------------------
            | UPDATE CATEGORY STYLE
            |--------------------------------------------------------------------------
            */

            function updateCategoryStyle() {

                categoryCards.forEach(function(card) {

                    const radio =
                        card.querySelector(
                            '.category-radio'
                        );


                    const check =
                        card.querySelector(
                            '.category-check'
                        );


                    if (radio.checked) {

                        card.classList.add(
                            'border-blue-500',
                            'bg-blue-50'
                        );


                        card.classList.remove(
                            'border-gray-100'
                        );


                        check.classList.add(
                            'bg-blue-600',
                            'border-blue-600'
                        );


                        check.classList.remove(
                            'border-gray-200'
                        );

                    } else {

                        card.classList.remove(
                            'border-blue-500',
                            'bg-blue-50'
                        );


                        card.classList.add(
                            'border-gray-100'
                        );


                        check.classList.remove(
                            'bg-blue-600',
                            'border-blue-600'
                        );


                        check.classList.add(
                            'border-gray-200'
                        );

                    }

                });

            }



            /*
            |--------------------------------------------------------------------------
            | UPDATE VOTE OPTION STYLE
            |--------------------------------------------------------------------------
            */

            function updateVoteOptionStyle() {

                voteOptions.forEach(function(button) {

                    const amount =
                        parseInt(
                            button.dataset.vote
                        );


                    if (amount === selectedVote) {

                        button.classList.add(
                            'border-blue-500',
                            'bg-blue-50',
                            'text-blue-600'
                        );


                        button.classList.remove(
                            'border-gray-100'
                        );

                    } else {

                        button.classList.remove(
                            'border-blue-500',
                            'bg-blue-50',
                            'text-blue-600'
                        );


                        button.classList.add(
                            'border-gray-100'
                        );

                    }

                });

            }



            /*
            |--------------------------------------------------------------------------
            | UPDATE SUMMARY
            |--------------------------------------------------------------------------
            */

            function updateSummary() {

                const category =
                    getSelectedCategory();


                const price =
                    category ?
                    parseInt(
                        category.dataset.price
                    ) :
                    0;


                const categoryCard =
                    category ?
                    category.closest(
                        '.category-card'
                    ) :
                    null;


                const categoryName =
                    categoryCard ?
                    categoryCard
                    .querySelector('p')
                    .textContent
                    .trim() :
                    '-';


                const total =
                    selectedVote * price;


                summaryCategory.textContent =
                    categoryName;


                summaryVote.textContent =
                    selectedVote + ' vote';


                summaryPrice.textContent =
                    rupiah(price);


                summaryTotal.textContent =
                    rupiah(total);


                selectedVoteInput.value =
                    selectedVote > 0 ?
                    selectedVote :
                    '';


                continueButton.disabled = !category ||
                    selectedVote < 1 ||
                    price < 1;

            }



            /*
            |--------------------------------------------------------------------------
            | CATEGORY CHANGE
            |--------------------------------------------------------------------------
            */

            categoryRadios.forEach(function(radio) {

                radio.addEventListener(
                    'change',
                    function() {

                        updateCategoryStyle();

                        updateSummary();

                    }
                );

            });



            /*
            |--------------------------------------------------------------------------
            | PRESET VOTE
            |--------------------------------------------------------------------------
            */

            voteOptions.forEach(function(button) {

                button.addEventListener(
                    'click',
                    function() {

                        selectedVote =
                            parseInt(
                                button.dataset.vote
                            );


                        customVote.value = '';


                        updateVoteOptionStyle();

                        updateSummary();

                    }
                );

            });



            /*
            |--------------------------------------------------------------------------
            | CUSTOM VOTE
            |--------------------------------------------------------------------------
            */

            customVote.addEventListener(
                'input',
                function() {

                    const value =
                        parseInt(
                            customVote.value
                        );


                    selectedVote =
                        Number.isInteger(value) &&
                        value > 0 ?
                        value :
                        0;


                    updateVoteOptionStyle();

                    updateSummary();

                }
            );



            /*
            |--------------------------------------------------------------------------
            | PREVENT DOUBLE SUBMIT
            |--------------------------------------------------------------------------
            */

            voteForm.addEventListener(
                'submit',
                function() {

                    if (continueButton.disabled) {
                        return;
                    }


                    continueButton.disabled = true;


                    continueButton.textContent =
                        'Memproses...';

                }
            );



            /*
            |--------------------------------------------------------------------------
            | INITIAL
            |--------------------------------------------------------------------------
            */

            updateCategoryStyle();

            updateVoteOptionStyle();

            updateSummary();


        });
    </script>


</body>

</html>
