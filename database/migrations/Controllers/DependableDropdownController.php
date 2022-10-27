<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DependableDropdownController extends Controller
{
    public function getTabCategories(Request $request)
    {
        $dollar = $request->get('value');

        echo $dollar;
    }

    public function getStates(Request $request)
    {

        $output = '';

        $country_id = $request->get('country_id');

        DB::statement("SET SQL_MODE=''");

        $data = State::where('country_id', $country_id)->get();

        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }

        echo $output;
    }
}
