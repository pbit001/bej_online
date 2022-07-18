<?php

namespace App\Http\Controllers;

use App\Models\DosareDeschise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ITMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('ITM/Index', [
            'DosareDeschise' => DosareDeschise::orderBy('Nr_Dosar','DESC')->where('Stadiu_Dosar', 'deschis')->paginate(10)
                ->through(fn ($DosareDeschise) => [
                    'id' => $DosareDeschise->id,
                    'Nr_Dosar' => $DosareDeschise->Nr_Dosar,
                    'Nume_Debitor' => $DosareDeschise->Nume_Debitor,
                    'Prenume_Debitor' => $DosareDeschise->Prenume_Debitor,
                    'CNP_CUI' => $DosareDeschise->CNP_CUI,
                    'Adresa_Debitor' => $DosareDeschise->Adresa_Debitor,
                    'Nume_Creditor' => $DosareDeschise->Nume_Creditor,
                    'Adresa_Creditor' => $DosareDeschise->Adresa_Creditor,
                    'Titlu_Executoriu' => $DosareDeschise->Titlu_Executoriu,
                    'DataTitlu_Executoriu' => $DosareDeschise->DataTitlu_Executoriu,
                    'Suma_TotalaInitiala' => $DosareDeschise->Suma_TotalaInitiala,
                    'Suma_CreditorInitiala' => $DosareDeschise->Suma_CreditorInitiala,
                    'Total_BEJInitial' => $DosareDeschise->Total_BEJInitial,
                    'Incasari_Totale' => $DosareDeschise->Incasari_Totale,
                    'Data_Incasare' => $DosareDeschise->Data_Incasare,
                    'DataEmitere_Interogare' => $DosareDeschise->DataEmitere_Interogare,
                    'Suma_TrCreditor' => $DosareDeschise->Suma_TrCreditor,
                    'Suma_TrBEJ' => $DosareDeschise->Suma_TrBEJ,
                    'Poprire_Conturi' => $DosareDeschise->Poprire_Conturi,
                    'Stadiu_Dosar' => $DosareDeschise->Stadiu_Dosar,
                    'Suma_TotalaRamasa' => $DosareDeschise->Suma_TotalaRamasa,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
