<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Candidate;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class VotingController extends Controller
{

    public function index()
    {

        $events = Event::where('status','active')
            ->latest()
            ->take(6)
            ->get();


        $popularEvents = Event::withCount('votes')
            ->orderBy('votes_count','desc')
            ->take(6)
            ->get();



        return view('voting.index',[
            'events'=>$events,
            'popularEvents'=>$popularEvents
        ]);

    }

          /*
        |--------------------------------------------------------------------------
        | Event Candidate
        |--------------------------------------------------------------------------
        */
        public function event(Request $request, Event $event)
        {
            $event->load([
                'categories' => function ($query) {
                    $query->where('status', 1);
                },
            ]);
    
        /*
        |--------------------------------------------------------------------------
        | Daftar Kota/Kabupaten Finalis
        |--------------------------------------------------------------------------
        */
    
        $cities = Candidate::where('event_id', $event->id)
            ->where('status', 1)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');
    
    
    
        /*
        |--------------------------------------------------------------------------
        | Filter Request
        |--------------------------------------------------------------------------
        */
    
        $selectedCity = $request->query('city');
    
        $search = trim((string) $request->query('q', ''));
    
    
    
        /*
        |--------------------------------------------------------------------------
        | Query Candidate
        |--------------------------------------------------------------------------
        */
    
        $candidateQuery = Candidate::where('event_id', $event->id)
            ->where('status', 1)
            ->with('categories')
            ->withSum('votes as total_votes', 'vote_amount');
    
    
    
        /*
        |--------------------------------------------------------------------------
        | Filter Kota
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
        | Ambil Candidate
        |--------------------------------------------------------------------------
        */
    
        $candidates = $candidateQuery
            ->orderByDesc('total_votes')
            ->get();
    
    
    
        return view(
            'voting.detail',
            compact(
                'event',
                'candidates',
                'cities',
                'selectedCity',
                'search'
            )
        );
    
    }       
            
            /*
            |--------------------------------------------------------------------------
            | Event Candidate
            |--------------------------------------------------------------------------
        */
    public function candidate(Candidate $candidate)
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan Candidate Aktif
        |--------------------------------------------------------------------------
        */
    
        abort_if(!$candidate->status, 404);
    
    
        /*
        |--------------------------------------------------------------------------
        | Load Relasi dan Total Vote
        |--------------------------------------------------------------------------
        */
    
        $candidate->load([
            'event',
            'categories',
        ]);
    
    
        $candidate->loadSum(
            'votes as total_votes',
            'vote_amount'
        );
    
    
        /*
        |--------------------------------------------------------------------------
        | Event Candidate
        |--------------------------------------------------------------------------
        */
    
        $event = $candidate->event;
    
    
        return view(
            'voting.candidate',
            compact(
                'candidate',
                'event'
            )
        );
    }
    public function vote(Candidate $candidate)
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan Candidate Aktif
        |--------------------------------------------------------------------------
        */
    
        abort_if(!$candidate->status, 404);
    
    
        /*
        |--------------------------------------------------------------------------
        | Load Event, Category, dan Total Vote
        |--------------------------------------------------------------------------
        */
    
        $candidate->load([
            'event',
            'categories' => function ($query) {
                $query->where('categories.status', 1);
            },
        ]);
    
    
        $candidate->loadSum(
            'votes as total_votes',
            'vote_amount'
        );
    
    
        /*
        |--------------------------------------------------------------------------
        | Event Candidate
        |--------------------------------------------------------------------------
        */
    
        $event = $candidate->event;
    
    
        /*
        |--------------------------------------------------------------------------
        | Pastikan Event Tersedia
        |--------------------------------------------------------------------------
        */
    
        abort_if(!$event, 404);
    
    
        return view(
            'voting.vote',
            compact(
                'candidate',
                'event'
            )
        );
    }
    public function checkout(Request $request, Candidate $candidate)
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan Candidate Aktif
        |--------------------------------------------------------------------------
        */
        abort_if(!$candidate->status, 404);
        /*
        |--------------------------------------------------------------------------
        | Load Event
        |--------------------------------------------------------------------------
        */

        $candidate->load('event');

        $event = $candidate->event;

        abort_if(!$event, 404);


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
                'max:100000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan Category Benar-Benar Milik Candidate
        |--------------------------------------------------------------------------
        */

        $category = $candidate
            ->categories()
            ->where('categories.id', $validated['category_id'])
            ->where('categories.event_id', $event->id)
            ->where('categories.status', true)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Hitung Harga di Server
        |--------------------------------------------------------------------------
        |
        | Jangan menggunakan total harga dari browser.
        | Harga harus dihitung ulang menggunakan vote_price di database.
        |
        */

        $voteAmount = (int) $validated['vote_amount'];

        $votePrice = (int) $category->vote_price;

        $totalAmount = $voteAmount * $votePrice;


        /*
        |--------------------------------------------------------------------------
        | Generate Invoice
        |--------------------------------------------------------------------------
        */

        $invoiceNumber = 'PICO-' . strtoupper((string) \Illuminate\Support\Str::ulid());


        /*
        |--------------------------------------------------------------------------
        | Create Transaction
        |--------------------------------------------------------------------------
        */

        $transaction = Transaction::create([

            'invoice_number' => $invoiceNumber,

            'event_id' => $event->id,

            'category_id' => $category->id,

            'candidate_id' => $candidate->id,

            'vote_amount' => $voteAmount,

            'total_amount' => $totalAmount,

            'payment_status' => 'pending',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect Payment
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