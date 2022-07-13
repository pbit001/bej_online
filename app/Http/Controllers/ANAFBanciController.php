<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Imports\ANAFBanciImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\ANAFBanci;

class ANAFBanciController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DosareDeschise = "";

        return Inertia::render('ANAFBanci/Index', [
            'DosareDeschise' => ANAFBanci::orderBy('DOSAR_NR','DESC')->paginate(100)
                ->through(fn ($DosareDeschise) => [
                    'Dosar_Nr' => $DosareDeschise->Dosar_Nr,
                    'CNPCUI_Debitor' => $DosareDeschise->CNPCUI_Debitor,
                    'Denumire_Debitor' => $DosareDeschise->Denumire_Debitor,
                    'Banca' => $DosareDeschise->Banca,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = Request::file('excelfile')->getRealPath();
           
        Excel::import(new ANAFBanciImport, $path);
        
        return redirect('/ANAFBanci')->with('success', 'Import has been completed!');
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
