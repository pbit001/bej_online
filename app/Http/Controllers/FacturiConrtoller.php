<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Facturi;
use App\Models\Clienti;

class FacturiConrtoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DosareDeschise = "";
        
        return Inertia::render('Facturi/Index', [
            'DosareDeschise' => Facturi::orderBy('Nume_Client','DESC')->paginate(100)
                ->through(fn ($DosareDeschise) => [
                    'Nume_Client' => $DosareDeschise->Nume_Client
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        return Inertia::render('Facturi/Clienti', [
            'DosareDeschise' => Clienti::orderBy('Nume_Client','DESC')->where('Nume_Creditor', $input['records'])->paginate(100)
                ->through(fn ($DosareDeschise) => [
                    'Nr_Dosar' => $DosareDeschise->Nr_Dosar,
                    'Nume_Creditor' => $DosareDeschise->Nume_Creditor,
                    'Detalii_Client' => $DosareDeschise->Detalii_Client,
                    'Adresa_Client' => $DosareDeschise->Adresa_Client,
                ]),
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function senttobill(Request $request)
    {
        echo 'here in set to bill';
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
