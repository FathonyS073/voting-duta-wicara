<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Candidate;
use Illuminate\Http\Request;


class VotingController extends Controller
{

    public function index()
    {
        $events = Event::where('status', 1)
            ->get();

        $candidates = Candidate::where('status', 1)
            ->with('categories')
            ->withSum('votes as total_votes', 'vote_amount')
            ->orderByDesc('total_votes')
            ->limit(5)
            ->get();

        return view(
            'voting.index',
            compact(
                'events',
                'candidates'
            )
        );
    }


    public function event(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Daftar Kabupaten / Kota
        |--------------------------------------------------------------------------
        */
        $cities = Candidate::where('event_id', $id)
            ->where('status', 1)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');


        /*
        |--------------------------------------------------------------------------
        | Filter
        |--------------------------------------------------------------------------
        */
        $selectedCity = $request->query('city');

        $search = trim((string) $request->query('q', ''));


        /*
        |--------------------------------------------------------------------------
        | Query Finalis
        |--------------------------------------------------------------------------
        */
        $candidateQuery = Candidate::where('event_id', $id)
            ->where('status', 1)
            ->with('categories')
            ->withSum('votes as total_votes', 'vote_amount');


        /*
        |--------------------------------------------------------------------------
        | Filter Kabupaten / Kota
        |--------------------------------------------------------------------------
        */
        if ($selectedCity) {

            $candidateQuery->where('city', $selectedCity);

        }


        /*
        |--------------------------------------------------------------------------
        | Search Nama / Kota
        |--------------------------------------------------------------------------
        */
        if ($search !== '') {

            $candidateQuery->where(function ($query) use ($search) {

                $query
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Ambil Data
        |--------------------------------------------------------------------------
        */
        $candidates = $candidateQuery
            ->orderBy('name')
            ->get();


        return view(
            'voting.event',
            compact(
                'event',
                'candidates',
                'cities',
                'selectedCity',
                'search'
            )
        );
    }
    public function candidate($id)
    {
        $candidate = Candidate::where('status', 1)
            ->with([
                'event',
                'categories',
            ])
            ->withSum('votes as total_votes', 'vote_amount')
            ->findOrFail($id);

        $event = $candidate->event;

        return view(
            'voting.candidate',
            compact(
                'candidate',
                'event'
            )
        );
    }
    public function vote($id)
    {
        $candidate = Candidate::where('status', 1)
            ->with([
                'event',
                'categories',
            ])
            ->withSum('votes as total_votes', 'vote_amount')
            ->findOrFail($id);

        $event = $candidate->event;

        return view(
            'voting.vote',
            compact(
                'candidate',
                'event'
            )
        );
    }
    public function checkout(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil Finalis
        |--------------------------------------------------------------------------
        */
        $candidate = Candidate::where('status', 1)
            ->with('event')
            ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'category_id' => [
                'required',
                'integer',
            ],

            'vote_amount' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan kategori memang milik finalis
        |--------------------------------------------------------------------------
        */
        $category = $candidate
            ->categories()
            ->where('categories.id', $validated['category_id'])
            ->where('categories.status', 1)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Hitung Harga DI SERVER
        |--------------------------------------------------------------------------
        |
        | Jangan menggunakan total harga dari browser.
        |
        */
        $voteAmount = (int) $validated['vote_amount'];

        $votePrice = (int) $category->vote_price;

        $totalAmount = $voteAmount * $votePrice;


        /*
        |--------------------------------------------------------------------------
        | Buat Invoice
        |--------------------------------------------------------------------------
        */
        $invoiceNumber =
            'INV-' . Str::upper((string) Str::ulid());


        /*
        |--------------------------------------------------------------------------
        | Simpan Transaksi Pending
        |--------------------------------------------------------------------------
        */
        $transaction = Transaction::create([
            'invoice_number' => $invoiceNumber,

            'category_id' => $category->id,

            'candidate_id' => $candidate->id,

            'vote_amount' => $voteAmount,

            'total_amount' => $totalAmount,

            'payment_method' => null,

            'payment_status' => 'pending',

            'payment_reference' => null,

            'paid_at' => null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Masuk Halaman Pembayaran
        |--------------------------------------------------------------------------
        */
        return redirect()->route(
            'payment.show',
            $transaction->invoice_number
        );
    }
    public function payment($invoice)
    {
        $transaction = Transaction::with([
                'candidate',
                'category',
            ])
            ->where('invoice_number', $invoice)
            ->firstOrFail();
    
    
        return view(
            'voting.payment',
            compact('transaction')
        );
    }



}