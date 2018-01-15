<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use App\Raffle;
use App\RaffleEntry;
use App\Http\Requests\FormRafflesRequest;


class RafflesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raffles = Raffle::get_raffles($this->per_page);

        return view('Raffles.index', compact('raffles'));
    }

    public function store(FormRafflesRequest $request)
    {
        $response = ['success' => true];

        try {

            if ($request->ajax()) {

                $form = $request->all();

                if ($request->isMethod('post')) {

                    // generate slug
                    $slug = str_replace(' ', '-', strtolower($form['name']));

                    $start_date = !is_null($form['start_date']) ? date('Y-m-d H:i:00', strtotime($form['start_date'])) : null;
                    $end_date   = !is_null($form['end_date']) ? date('Y-m-d H:i:00', strtotime($form['end_date'])) : null;

                    $id = Raffle::create([
                        'name'        => $form['name'],
                        'slug'        => $slug,
                        'description' => $form['description'],
                        'start_date'  => $start_date,
                        'end_date'    => $end_date,
                    ]);

                    if ($id) {
                        $response = ['success' => true, 'message' => 'Raffle created!'];
                    }
                }

            }

        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($response);
    }

    public function update(FormRafflesRequest $request)
    {
        $response = ['success' => false];

        try {
            if ($request->ajax()) {

                if ($request->isMethod('put')) {
                    $form = $request->all();

                    $raffle_info = Raffle::where(['raffle_id' => $form['id'], 'is_active' => 1]);

                    if ($raffle_info->count()) {
                        // regenerate raffle url
                        $slug = str_replace(' ', '-', strtolower($form['name']));

                        $start_date = !is_null($form['start_date']) ? date('Y-m-d H:i:00', strtotime($form['start_date'])) : null;
                        $end_date   = !is_null($form['end_date']) ? date('Y-m-d H:i:00', strtotime($form['end_date'])) : null;

                        $raffle = $raffle_info->first();
                        $raffle->name        = $form['name'];
                        $raffle->slug        = $slug;
                        $raffle->description = $form['description'];
                        $raffle->start_date  = $start_date;
                        $raffle->end_date    = $end_date;

                        if ($raffle->save()) {
                            $response = ['success' => true, 'message' => 'Raffle updated!'];
                        }
                    }
                }

            }

        } catch (\Exception $e) {
            throw $e;
        }


        return response()->json($response);
    }

    public function destroy(FormRafflesRequest $request)
    {
        $response = ['success' => false];

        try {

            if ($request->ajax()) {

                if ($request->isMethod('delete')) {

                    $form = $request->all();

                    $raffle_info = Raffle::where(['raffle_id' => $form['id']]);

                    if ($raffle_info->count()) {
                        $raffle_info->delete();

                        $response = ['success' => true, 'message' => 'Raffle deleted!'];
                    }

                }

            }

        } catch (\Exception $e) {
            throw $e;
        }


        return response()->json($response);
    }

    /**
     * Reload list of raffles
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function reload(Request $request)
    {
        $response = ['success' => false];

        try {

            if ($request->ajax()) {
                $raffles = Raffle::get_raffles($this->per_page);

                $list = view('Partials.Raffles._list', compact('raffles'))->render();

                $response = ['success' => true, 'data' => ['list' => $list]];
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($response);
    }
}
