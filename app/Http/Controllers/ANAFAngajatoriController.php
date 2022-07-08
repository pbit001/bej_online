<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Imports\ANAFAngajatoriImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\ANAFAngajatori;

class ANAFAngajatoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo 'here in index';
        // exit;
        $DosareDeschise = "";

        return Inertia::render('Ananfangajatori/Index', [
            'DosareDeschise' => ANAFAngajatori::orderBy('DOSAR_NR','DESC')->paginate(100)
                ->through(fn ($DosareDeschise) => [
                    'DOSAR_NR' => $DosareDeschise->DOSAR_NR,
                    'CIF_ANGAJATOR' => $DosareDeschise->CIF_ANGAJATOR,
                    'Denumire_ANGAJATOR' => $DosareDeschise->Denumire_ANGAJATOR,
                    'SEDIU' => $DosareDeschise->SEDIU,
                    'AN_RAPORTARE' => $DosareDeschise->AN_RAPORTARE,
                    'LUNA_RAPORTARE' => $DosareDeschise->LUNA_RAPORTARE,
                    'Data_Raspuns' => $DosareDeschise->Data_Raspuns,
                    'Utilizator' => $DosareDeschise->Utilizator,
                ]),
        ]);

        return Inertia::render('Ananfangajatori/Index', ['DosareDeschise']);

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
     * @param  Illuminate\Support\Facades\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = Request::file('excelfile')->getRealPath();
           
        Excel::import(new ANAFAngajatoriImport, $path);
        
        return redirect('/ANAFAngajatori')->with('success', 'Import has been completed!');
        
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
