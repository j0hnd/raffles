<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use App\Raffle;
use App\Http\Requests\FormRafflesRequest;


class RafflesController extends Controller
{
    protected $raffle_per_page = 20;


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
        $raffles = Raffle::get_raffles($this->raffle_per_page);

        return view('Raffles.index', compact('raffles'));
    }

    public function store(FormRafflesRequest $request)
    {
        $response = ['success' => true];

        try {

            if ($request->ajax()) {

                $form = $request->all();

                if ($request->isMethod('post')) {

                    // generate raffle url
                    $raffle_name = str_replace(' ', '-', strtolower($form['name']));
                    $base_url = str_replace("/raffle", "", URL::current());
                    $url = URL::to('/')."/".$raffle_name;

                    $id = Raffle::create([
                        'name'       => $form['name'],
                        'raffle_url' => $url,
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
                        $raffle_name = str_replace(' ', '-', strtolower($form['name']));
                        $base_url = str_replace("/raffle", "", URL::current());
                        $url = URL::to('/')."/".$raffle_name;

                        $raffle = $raffle_info->first();
                        $raffle->name       = $form['name'];
                        $raffle->raffle_url = $url;
                        $raffle->start_date = $form['start_date'];
                        $raffle->end_date   = $form['end_date'];

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
                $raffles = Raffle::get_raffles($this->raffle_per_page);

                $list = view('Partials.Raffles._list', compact('raffles'))->render();

                $response = ['success' => true, 'data' => ['list' => $list]];
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($response);
    }
}
