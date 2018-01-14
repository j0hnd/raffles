<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Raffle;

use App\Http\Requests\FormRafflesRequest;


class RafflesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raffles = Raffle::get_raffles();

        return view('Raffles.index', compact('raffles'));
    }

    public function store(FormRafflesRequest $request)
    {
        $response = ['success' => true];

        try {

            if ($request->ajax()) {

                $form = $request->all();

                if ($request->isMethod('post')) {
                    $id = Raffle::create([
                        'name'       => $form['name'],
                        'raffle_url' => $form['raffle_url'],
                        'start_date' => $form['start_date'],
                        'end_date'   => $form['end_date'],
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
                $raffles = Raffle::get_raffles();

                $list = view('Partials.Raffles._list', compact('raffles'))->render();

                $response = ['success' => true, 'data' => ['list' => $list]];
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($response);
    }
}
