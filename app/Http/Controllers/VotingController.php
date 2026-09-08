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



}