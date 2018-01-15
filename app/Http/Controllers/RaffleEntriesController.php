<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Raffle;
use App\RaffleEntry;
use App\EntryRepo;
use App\Http\Requests\FormRaffleEntryRequest;
use App\Mail\RaffleEntryThankyou;
use DB;


class RaffleEntriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'register']);
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

    public function register(FormRaffleEntryRequest $request, $raffle, $raffle_id)
    {
        $response = ['success' => false];

        try {

            if ($request->isMethod('get')) {
                $form = $request->all();

                $code = str_random(10);

                if (!RaffleEntry::check_reaffle_entry($raffle_id, $form['email'])) {
                    $response['message'] = "Email address is already registered.";
                    return response()->json($response);
                }

                // check if raffle id is valid
                if (Raffle::is_raffle_id_valid($raffle_id)) {

                    $form = [
                        'raffle_id' => $raffle_id,
                        'email'     => $form['email'],
                        'code'      => $code,
                    ];

                    DB::beginTransaction();

                    if ($id = RaffleEntry::create_entry($form)) {
                        $source = isset($form['source']) ? $form['source'] : 'web';

                        $entry_form = [
                            'raffle_entry_id' => $id->raffle_entry_id,
                            'source'          => $source
                        ];

                        if (EntryRepo::save_entry($entry_form)) {
                            DB::commit();

                            // email raffle entry notification
                            Mail::to($form['email'])
                                ->send(new RaffleEntryThankyou()
                            );

                            $response = ['success' => true, 'message' => 'Thank you for joining the raffle.'];
                        } else {
                            DB::rollback();
                        }

                    } else {
                        DB::rollback();
                    }

                }
            }

        } catch (\Exception $e) {
            throw $e;
        }


        return response()->json($response);
    }
}
