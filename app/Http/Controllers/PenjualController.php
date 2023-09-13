<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualController extends Controller
{
    public function penjualdashboard()  {

        return view ('penjual.dash_penjual');

    }
}
