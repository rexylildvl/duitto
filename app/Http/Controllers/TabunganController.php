<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TabunganController extends Controller
{
    public function index()
    {
        $tabunganList = Session::get('tabungan_list', []);
        $saldo = Session::get('saldo', 0);
        return view('tabungan.index', compact('tabunganList', 'saldo'));
    }
}
