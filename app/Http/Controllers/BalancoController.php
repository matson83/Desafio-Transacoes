<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalancoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $userId = auth()->id();

    $entradas = Transaction::where('user_id', $userId)
                ->where('status', 'Aprovada')
                ->where('valor', '>', 0)
                ->sum('valor');

    $saidas = Transaction::where('user_id', $userId)
                ->where('status', 'Aprovada')
                ->where('valor', '<', 0)
                ->sum('valor');

    $balanco = $entradas + $saidas;

    return view('balanco.index', compact('entradas', 'saidas', 'balanco'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
