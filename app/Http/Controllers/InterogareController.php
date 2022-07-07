<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\DosareDeschise;

class InterogareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Inertia::render('Interogare/Index', [
            'DosareDeschise' => DB::connection('mysql2')->table('ARTESTEXECUTOR_IRDosar')->select("ARTESTEXECUTOR_IRDosar.*", DB::raw("SUBSTRING(ARTESTEXECUTOR_IRDosar.Nr_Dosar, -4) as AN_d"))
            ->leftJoin('ARTESTEXECUTOR_Incuviintare', 'ARTESTEXECUTOR_IRDosar.Nr_Dosar', '=', 'ARTESTEXECUTOR_Incuviintare.Nr_Dosar')
            ->paginate(100)->through(fn ($DosareDeschise) => [
                'id' => $DosareDeschise->Nr_Dosar,
                'Nr_Dosar' => $DosareDeschise->Nr_Dosar,
                'CNP_CUI' => $DosareDeschise->CNP_CUI,
                'Nume_Debitor' => $DosareDeschise->Nume_Debitor,
                'Prenume_Debitor' => $DosareDeschise->Prenume_Debitor,
                'AN_d' => $DosareDeschise->AN_d,
                'Nume_Creditor' => $DosareDeschise->Nume_Creditor,
                'DataEmitere_Interogare' => $DosareDeschise->DataEmitere_Interogare,
                'Stadiu_Dosar' => $DosareDeschise->Stadiu_Dosar,
                'ID_UserEmInt' => $DosareDeschise->ID_UserEmInt,
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

    public function interogare_data(Request $request) {

        $DataEmitere_Interogare = date('d-m-Y'); 

        DB::connection('mysql2')->table('ARTESTEXECUTOR_IRDosar')
            ->where('Nr_Dosar', $_REQUEST['id'])
            ->update(['DataEmitere_Interogare' => $DataEmitere_Interogare]);


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
