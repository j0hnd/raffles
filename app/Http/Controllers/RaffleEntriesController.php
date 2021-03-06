<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

use App\Raffle;
use App\RaffleEntry;
use App\RaffleAction;
use App\Http\Requests\FormRaffleEntryRequest;
use App\Mail\RaffleEntryThankyou;
use DB;
use DateTime;


class RaffleEntriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['register', 'registration']]);
    }

    public function get_raffle_entries(Request $request, $raffle_id)
    {
        $response = ['success' => false];

        try {

            if ($request->ajax()) {

                $entries = RaffleEntry::get_raffle_entries($raffle_id, $this->per_page);

                $list = view('Partials.RaffleEntries._entries', compact('entries'))->render();

                $response = ['success' => true, 'data' => ['list' => $list]];

            }

        } catch (\Exception $e) {
            throw $e;
        }


        return response()->json($response);
    }

    public function registration(Request $request, $raffle)
    {
        try {
            if (!Raffle::is_raffle_valid($raffle)) {
                abort(404);
            }

            // get raffle info
            $raffle_info = Raffle::get_raffle_by_slug($raffle);

            // check if raffle is not ended
            if (strtotime('now') >= strtotime($raffle_info->start_date) and strtotime('now') <= strtotime($raffle_info->end_date)) {
            } else {
                abort(404, 'Raffle is already expired!');
            }

            $raffle_info = Raffle::get_raffle_by_slug($raffle);

            if ($raffle_info) {
                $form_action    = URL::to('/').'/r/'.$raffle_info->slug.'/'.$raffle_info->raffle_id;

                // calculate days remaining
                $end_date       = new DateTime($raffle_info->end_date);
                $current_date   = new DateTime('now');
                $diff           = $current_date->diff($end_date)->format("%a");
                $days_remaining = intval($diff);
            }

        } catch (\Exception $e) {
            throw $e;
        }

        return view('RaffleEntries.registration', compact('raffle_info', 'form_action', 'days_remaining'));
    }

    public function register(FormRaffleEntryRequest $request, $raffle, $raffle_id)
    {
        $response = ['success' => false];

        try {

            if ($request->isMethod('post')) {
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
                        $entry_form = [
                            'raffle_entry_id' => $id->raffle_entry_id,
                            'name'            => "Sign up for the contest",
                            'value'           => 1
                        ];

                        if (RaffleAction::save_entry($entry_form)) {
                            DB::commit();

                            $raffle_info = Raffle::get_raffle_info($raffle_id);

                            $mail_data = [
                                'raffle_code' => $code,
                                'raffle_name' => $raffle_info->name,
                                'end_date'    => $raffle_info->end_date
                            ];

                            // email raffle entry notification
                            Mail::to($form['email'])
                                ->send(new RaffleEntryThankyou($mail_data));
                        } else {
                            DB::rollback();

                            abort(500, 'Something went wrong!');
                        }

                    } else {
                        DB::rollback();

                        abort(500, 'Something went wrong!');
                    }

                }
            }

        } catch (\Exception $e) {
            throw $e;
        }


        return view('RaffleEntries.thankyou');
    }
}
