<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Candidate;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class VotingController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
    
        $search = trim((string) $request->query('q', ''));
    
    
        /*
        |--------------------------------------------------------------------------
        | Event Terbaru
        |--------------------------------------------------------------------------
        */
    
        $events = Event::where('status', 'active')
            ->withCount('candidates')
            ->latest()
            ->take(12)
            ->get();
    
    
        /*
        |--------------------------------------------------------------------------
        | Event Populer
        |--------------------------------------------------------------------------
        */
    
        $popularEventsQuery = Event::query()
            ->where('status', 'active')
            ->withCount('candidates')
            ->withSum('votes as total_votes', 'vote_amount');
    
    
        /*
        |--------------------------------------------------------------------------
        | Search Event
        |--------------------------------------------------------------------------
        */
    
        if ($search !== '') {
    
            $popularEventsQuery->where(function ($query) use ($search) {
    
                $query
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
    
            });
    
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | Ambil Event
        |--------------------------------------------------------------------------
        */
    
        $popularEvents = $popularEventsQuery
            ->orderByDesc('total_votes')
            ->latest()
            ->take(12)
            ->get();
    
    
        return view('voting.index', [
            'events' => $events,
            'popularEvents' => $popularEvents,
            'search' => $search,
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

                /*
        |--------------------------------------------------------------------------
        | Validasi Event Aktif
        |--------------------------------------------------------------------------
        */
        
        abort_if(
            !$event ||
            $event->status !== 'active',
            404
        );
    
    
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
            'categories' => function ($query) use ($candidate) {
            
                $query
                    ->where('categories.status',1)
                    ->where(
                        'categories.event_id',
                        $candidate->event_id
                    );
            
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
        
        
        /*
        |--------------------------------------------------------------------------
        | Validasi Event
        |--------------------------------------------------------------------------
        */
        
        abort_if(
            !$event ||
            $event->status !== 'active',
            404
        );


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
        abort_if(
            $votePrice <= 0,
            400
        );
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

        /*
        |--------------------------------------------------------------------------
        | Ambil Transaction
        |--------------------------------------------------------------------------
        */

        $transaction = Transaction::where(
                'invoice_number',
                $invoice
            )
            ->with([
                'event',
                'candidate',
                'category'
            ])
            ->firstOrFail();



        /*
        |--------------------------------------------------------------------------
        | Pastikan transaksi valid
        |--------------------------------------------------------------------------
        */

        abort_if(
            !$transaction->event ||
            !$transaction->candidate ||
            !$transaction->category,
            404
        );



        return view(
            'voting.payment',
            compact(
                'transaction'
            )
        );

    }


    public function events(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Filter Request
        |--------------------------------------------------------------------------
        */

        $search = trim((string) $request->query('q', ''));

        $status = $request->query('status', 'all');


        /*
        |--------------------------------------------------------------------------
        | Query Event Publik
        |--------------------------------------------------------------------------
        */

        $eventQuery = Event::query()
            ->whereIn('status', [
                'active',
                'closed',
                'finished',
            ])
            ->withCount('candidates')
            ->withSum('votes as total_votes', 'vote_amount');


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($search !== '') {

            $eventQuery->where(function ($query) use ($search) {

                $query
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $status,
                [
                    'active',
                    'closed',
                    'finished',
                ],
                true
            )
        ) {

            $eventQuery->where('status', $status);

        }


        /*
        |--------------------------------------------------------------------------
        | Jumlah Event Per Halaman
        |--------------------------------------------------------------------------
        |
        | Mobile  : 4
        | Desktop : 8
        |
        */

        $perPage = (int) $request->query('per_page', 8);


        if (!in_array($perPage, [4, 8], true)) {

            $perPage = 8;

        }


        /*
        |--------------------------------------------------------------------------
        | Ambil Event
        |--------------------------------------------------------------------------
        */

        $events = $eventQuery
            ->orderByRaw("
                CASE
                    WHEN status = 'active' THEN 1
                    WHEN status = 'closed' THEN 2
                    WHEN status = 'finished' THEN 3
                    ELSE 4
                END
            ")
            ->orderByDesc('start_date')
            ->paginate($perPage)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistik Event
        |--------------------------------------------------------------------------
        */

        $activeCount = Event::where('status', 'active')
            ->count();


        $closedCount = Event::whereIn(
            'status',
            [
                'closed',
                'finished',
            ]
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'voting.events',
            compact(
                'events',
                'search',
                'status',
                'activeCount',
                'closedCount'
            )
        );
    }
    public function about()
    {
        return view('voting.about');
    }
    public function howToVote()
    {
        return view('voting.how-to-vote');
    }

    public function help()
    {
        return view('voting.help');
    }
    public function privacy()
    {
        return view('voting.privacy');
    }

    public function terms()
    {
        return view('voting.terms');
    }
    public function contact()
    {
        return view('voting.contact');
    }
    public function faq()
    {
        return view('voting.faq');
    }

    public function paymentStatus($invoice)
    {

        $transaction = Transaction::where(
            'invoice_number',
            $invoice
        )
        ->with([
            'event',
            'candidate',
            'category'
        ])
        ->firstOrFail();



        return view(
            'voting.payment-status',
            compact(
                'transaction'
            )
        );

    }

}