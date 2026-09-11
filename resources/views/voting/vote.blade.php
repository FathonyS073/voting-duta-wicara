<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Vote {{ $candidate->name }} - Duta Wicara Jawa Timur
    </title>

    @vite(['resources/css/app.css'])

</head>


<body class="bg-[#faf8ff] text-[#172033]">


@include('partials.navbar', [
    'activePage' => 'finalis'
])



<!-- HEADER -->
<section class="pt-28 sm:pt-32">

    <div class="max-w-5xl mx-auto px-5 sm:px-8">

        <a
            href="{{ route('candidate.detail', $candidate->id) }}"
            class="
            inline-flex
            items-center
            gap-2
            text-sm
            text-gray-500
            hover:text-[#5b0b83]
            transition
            "
        >
            ← Kembali ke Detail Finalis
        </a>

    </div>

</section>



<!-- VOTING -->
<section class="pt-7 pb-20 sm:pt-10 sm:pb-24">

    <div class="max-w-5xl mx-auto px-5 sm:px-8">


        <div
            class="
            grid
            grid-cols-1
            lg:grid-cols-3
            gap-6
            lg:gap-8
            "
        >


            <!-- ================================================= -->
            <!-- FINALIS -->
            <!-- ================================================= -->

            <div>

                <div
                    class="
                    bg-white
                    rounded-3xl
                    border
                    border-gray-100
                    p-4
                    sticky
                    top-28
                    "
                >

                    <div
                        class="
                        aspect-[4/5]
                        overflow-hidden
                        rounded-2xl
                        bg-gray-100
                        "
                    >

                        <img
                            src="{{ asset('storage/' . $candidate->photo) }}"
                            alt="{{ $candidate->name }}"
                            class="w-full h-full object-cover"
                        >

                    </div>


                    <div class="pt-5 text-center">

                        <p
                            class="
                            text-[#c48621]
                            tracking-[4px]
                            text-[10px]
                            font-semibold
                            "
                        >
                            FINALIS
                        </p>


                        <h1
                            class="
                            mt-2
                            text-xl
                            sm:text-2xl
                            font-bold
                            "
                        >
                            {{ $candidate->name }}
                        </h1>


                        <p class="text-gray-500 text-sm mt-1">

                            {{ $candidate->city }}

                        </p>


                        <p
                            class="
                            mt-4
                            font-bold
                            text-[#5b0b83]
                            "
                        >

                            {{ number_format(
                                $candidate->total_votes ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                            <span class="text-sm font-medium text-gray-500">
                                vote
                            </span>

                        </p>

                    </div>

                </div>

            </div>



            <!-- ================================================= -->
            <!-- PILIH VOTE -->
            <!-- ================================================= -->

            <div class="lg:col-span-2">


                <div
                    class="
                    bg-white
                    rounded-3xl
                    border
                    border-gray-100
                    p-5
                    sm:p-8
                    "
                >


                    <p
                        class="
                        text-[#c48621]
                        tracking-[4px]
                        text-xs
                        font-semibold
                        "
                    >
                        BERIKAN DUKUNGAN
                    </p>


                    <h2
                        class="
                        mt-2
                        text-2xl
                        sm:text-3xl
                        font-bold
                        "
                    >
                        Pilih Jumlah Vote
                    </h2>


                    <p
                        class="
                        text-gray-500
                        mt-2
                        text-sm
                        sm:text-base
                        "
                    >
                        Tentukan kategori dan jumlah vote yang ingin
                        diberikan untuk {{ $candidate->name }}.
                    </p>




                    <!-- ========================================= -->
                    <!-- KATEGORI -->
                    <!-- ========================================= -->

                    <div class="mt-8">

                        <label class="font-semibold">
                            Pilih Kategori
                        </label>


                        <div
                            id="categoryContainer"
                            class="
                            grid
                            grid-cols-1
                            sm:grid-cols-2
                            gap-3
                            mt-4
                            "
                        >

                            @foreach($candidate->categories as $category)

                                <label
                                    class="
                                    category-option
                                    relative
                                    border
                                    border-gray-200
                                    rounded-2xl
                                    p-4
                                    cursor-pointer
                                    hover:border-[#5b0b83]
                                    transition
                                    "
                                >

                                    <input
                                        type="radio"
                                        name="category"
                                        value="{{ $category->id }}"
                                        data-price="{{ $category->vote_price }}"
                                        class="hidden category-radio"
                                        {{ $loop->first ? 'checked' : '' }}
                                    >


                                    <div>

                                        <p class="font-bold">
                                            {{ $category->name }}
                                        </p>


                                        <p class="text-sm text-gray-500 mt-1">

                                            Rp{{ number_format(
                                                $category->vote_price,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                            / vote

                                        </p>

                                    </div>

                                </label>

                            @endforeach

                        </div>

                    </div>




                    <!-- ========================================= -->
                    <!-- JUMLAH VOTE -->
                    <!-- ========================================= -->

                    <div class="mt-9">

                        <label class="font-semibold">
                            Pilih Jumlah Vote
                        </label>


                        <div
                            class="
                            grid
                            grid-cols-2
                            sm:grid-cols-4
                            gap-3
                            mt-4
                            "
                        >

                            @foreach([5, 10, 25, 50] as $amount)

                                <button
                                    type="button"
                                    data-vote="{{ $amount }}"
                                    class="
                                    vote-package
                                    border
                                    border-gray-200
                                    rounded-2xl
                                    px-4
                                    py-5
                                    hover:border-[#5b0b83]
                                    transition
                                    "
                                >

                                    <span
                                        class="
                                        block
                                        text-2xl
                                        font-bold
                                        "
                                    >
                                        {{ $amount }}
                                    </span>

                                    <span
                                        class="
                                        text-xs
                                        text-gray-500
                                        "
                                    >
                                        Vote
                                    </span>

                                </button>

                            @endforeach

                        </div>

                    </div>
                    <!-- ========================================= -->
                    <!-- CUSTOM -->
                    <!-- ========================================= -->

                    <div class="mt-6">

                        <label
                            for="customVote"
                            class="font-semibold"
                        >
                            Atau Masukkan Custom Vote
                        </label>


                        <div class="relative mt-3">

                            <input
                                id="customVote"
                                type="number"
                                min="1"
                                placeholder="Contoh: 30"
                                class="
                                w-full
                                border
                                border-gray-200
                                rounded-2xl
                                px-5
                                py-4
                                outline-none
                                focus:border-[#5b0b83]
                                focus:ring-2
                                focus:ring-[#5b0b83]/10
                                "
                            >


                            <span
                                class="
                                absolute
                                right-5
                                top-1/2
                                -translate-y-1/2
                                text-gray-400
                                text-sm
                                "
                            >
                                vote
                            </span>

                        </div>

                    </div>




                    <!-- ========================================= -->
                    <!-- RINGKASAN -->
                    <!-- ========================================= -->

                    <div
                        class="
                        mt-9
                        bg-[#faf7fc]
                        border
                        border-[#eee5f2]
                        rounded-3xl
                        p-5
                        sm:p-6
                        "
                    >

                        <h3 class="font-bold text-lg">
                            Ringkasan Voting
                        </h3>


                        <div
                            class="
                            mt-5
                            space-y-4
                            text-sm
                            "
                        >


                            <div
                                class="
                                flex
                                justify-between
                                gap-4
                                "
                            >

                                <span class="text-gray-500">
                                    Jumlah Vote
                                </span>

                                <span
                                    id="summaryVote"
                                    class="font-semibold"
                                >
                                    0 vote
                                </span>

                            </div>


                            <div
                                class="
                                flex
                                justify-between
                                gap-4
                                "
                            >

                                <span class="text-gray-500">
                                    Harga per Vote
                                </span>

                                <span
                                    id="summaryPrice"
                                    class="font-semibold"
                                >
                                    Rp0
                                </span>

                            </div>


                            <div
                                class="
                                border-t
                                border-gray-200
                                pt-4
                                flex
                                justify-between
                                items-end
                                gap-4
                                "
                            >

                                <span class="font-semibold">
                                    Total Pembayaran
                                </span>

                                <span
                                    id="summaryTotal"
                                    class="
                                    text-2xl
                                    font-bold
                                    text-[#5b0b83]
                                    "
                                >
                                    Rp0
                                </span>

                            </div>

                        </div>

                    </div>




            <!-- ========================================= -->
            <!-- BUTTON -->
            <!-- ========================================= -->
        <form
            id="voteForm"
            action="{{ route('candidate.checkout', $candidate->id) }}"
            method="POST"
            class="mt-6"
        >

            @csrf


            <input
                type="hidden"
                name="category_id"
                id="selectedCategoryInput"
            >


            <input
                type="hidden"
                name="vote_amount"
                id="selectedVoteInput"
            >


            <button
                type="submit"
                id="continueButton"
                disabled
                class="
                    w-full
                    bg-[#5b0b83]
                    hover:bg-[#430563]
                    text-white
                    py-4
                    px-6
                    rounded-full
                    font-semibold
                    text-center
                    transition
                    disabled:opacity-40
                    disabled:cursor-not-allowed
                "
            >
                Lanjut Pembayaran →
            </button>
        
        </form>
                    <p
                        class=" mt-3 text-xs text-center text-gray-400 ">
                        Pastikan finalis, kategori, dan jumlah vote
                        sudah sesuai sebelum melanjutkan.
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const votePackages =
        document.querySelectorAll('.vote-package');

    const customVote =
        document.getElementById('customVote');

    const categoryRadios =
        document.querySelectorAll('.category-radio');

    const categoryOptions =
        document.querySelectorAll('.category-option');

    const summaryVote =
        document.getElementById('summaryVote');

    const summaryPrice =
        document.getElementById('summaryPrice');

    const summaryTotal =
        document.getElementById('summaryTotal');

    const continueButton =
        document.getElementById('continueButton');
    const selectedCategoryInput =
    document.getElementById('selectedCategoryInput');

    const selectedVoteInput =
        document.getElementById('selectedVoteInput');

    const voteForm =
        document.getElementById('voteForm');
    let selectedVote = 0;
    function rupiah(number) {
        return new Intl.NumberFormat(
            'id-ID',
            {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }
        ).format(number);

    }



    function getSelectedPrice() {

        const selectedCategory =
            document.querySelector(
                '.category-radio:checked'
            );

        if (!selectedCategory) {
            return 0;
        }

        return parseInt(
            selectedCategory.dataset.price
        ) || 0;

    }


    voteForm.addEventListener('submit', function () {
        if (continueButton.disabled) {
            return;
        }
        continueButton.disabled = true;
        continueButton.textContent =
            'Memproses...';
    });
    function updateCategoryStyle() {
        categoryOptions.forEach(function (option) {
            const radio =
                option.querySelector('.category-radio');
            if (radio.checked) {
                option.classList.add(
                    'border-[#5b0b83]',
                    'bg-[#faf7fc]'
                );
            } else {
                option.classList.remove(
                    'border-[#5b0b83]',
                    'bg-[#faf7fc]'
                );
            }
        });
    }
    function updateSummary() {
        const selectedCategory =
            document.querySelector(
                '.category-radio:checked'
            );
        const price =
            getSelectedPrice();
        const total =
            selectedVote * price;
        summaryVote.textContent =
            selectedVote + ' vote';
        summaryPrice.textContent =
            rupiah(price);
        summaryTotal.textContent =
            rupiah(total);
        /*
        |--------------------------------------------------------------------------
        | Isi data yang akan dikirim ke Laravel
        |--------------------------------------------------------------------------
        */
        selectedCategoryInput.value =
            selectedCategory
                ? selectedCategory.value
                : '';
        selectedVoteInput.value =
            selectedVote > 0
                ? selectedVote
                : '';
        /*
        |--------------------------------------------------------------------------
        | Aktifkan tombol hanya jika valid
        |--------------------------------------------------------------------------
        */
        continueButton.disabled =
            !selectedCategory ||
            selectedVote < 1 ||
            price < 1;
    }
    votePackages.forEach(function (button) {
        button.addEventListener('click', function () {
            selectedVote =
                parseInt(button.dataset.vote);
            customVote.value = '';
            votePackages.forEach(function (item) {
                item.classList.remove(
                    'border-[#5b0b83]',
                    'bg-[#faf7fc]',
                    'text-[#5b0b83]'
                );
            });
            button.classList.add(
                'border-[#5b0b83]',
                'bg-[#faf7fc]',
                'text-[#5b0b83]'
            );
            updateSummary();
        });
    });
    customVote.addEventListener('input', function () {
        selectedVote =
            parseInt(customVote.value) || 0;
        votePackages.forEach(function (item) {
            item.classList.remove(
                'border-[#5b0b83]',
                'bg-[#faf7fc]',
                'text-[#5b0b83]'
            );
        });
        updateSummary();
    });
    categoryRadios.forEach(function (radio) {
        radio.addEventListener('change', function () {
            updateCategoryStyle();
            updateSummary();
        });
    });
    updateCategoryStyle();
    updateSummary();
});

</script>


</body>

</html>