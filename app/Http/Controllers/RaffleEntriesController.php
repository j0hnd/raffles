<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RaffleEntry;


class RaffleEntriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_raffle_entries(Request $request, $raffle_id)
    {
        $response = ['success' => false];

        try {

            if ($request->ajax()) {

                $entries = RaffleEntry::get_raffle_entries($raffle_id, $this->per_page);

                $list = view('Partials.RaffleEntries._list', compact('entries'))->render();

                $response = ['success' => true, 'data' => ['list' => $list]];

            }

        } catch (\Exception $e) {
            throw $e;
        }


        return response()->json($response);
    }
}
