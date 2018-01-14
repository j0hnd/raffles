<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRafflesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case "GET":
            case "DELETE":
                return [];
                break;

            case "POST":
                $this->sanitize();
                return [
                    'name'       => 'required|min:5|max:100|unique:raffles',
                    // 'raffle_url' => 'required|url',
                    'start_date' => 'required|date',
                    'end_date'   => 'required|date',
                ];
                break;

            case "PUT":
            case "PATCH":
                $this->sanitize();
                return [
                    'name'       => 'required|min:5|max:100',
                    // 'raffle_url' => 'required|url',
                    'start_date' => 'required|date',
                    'end_date'   => 'required|date',
                ];
                break;

            default:
                break;
        }
    }

    /**
     * Sanitize input fields
     *
     */
    public function sanitize()
    {
        $input = $this->all();
        $input['name']       = filter_var($input['name'], FILTER_SANITIZE_STRING);
        // $input['raffle_url'] = filter_var($input['raffle_url'], FILTER_SANITIZE_URL);
        $input['start_date'] = filter_var($input['start_date'], FILTER_SANITIZE_STRING);
        $input['end_date']   = filter_var($input['end_date'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }
}
