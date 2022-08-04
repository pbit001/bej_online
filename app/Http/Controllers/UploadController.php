<?php

namespace App\Http\Controllers;


use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Doc;
use Illuminate\Support\Facades\Redirect;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Upload/Index', [
            'Docs' => Doc::orderBy('Nr_Dosar','DESC')->paginate(100)
                ->through(fn ($Docs) => [
                    'Nr_Dosar' => $Docs->Nr_Dosar,
                    'Nume_Creditor' => $Docs->Nume_Creditor,
                    'Doc_Name' => $Docs->Doc_Name,
                    'Document' => $Docs->Document,
                    'Utilizator' => $Docs->Utilizator
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
        $request->validate([
            'Nr_Dosar' => ['required'],
            'Nume_Creditor' => ['required'],
            'excelfile' => ['required'],
            
        ]);
        $input = $request->all(); 
        $filedestination = "";
        
        if ($image = $request->file('excelfile')) {
            $destinationPath = 'uploads/';
            $filedestination = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $filedestination);
            $input['Doc_Name'] = $filedestination;
        }
        
        $Docs = Doc::create([
            'Nr_Dosar'        => $input['Nr_Dosar'],
            'Nume_Creditor'        => $input['Nume_Creditor'],
            'Document'        => $filedestination,
            'Doc_Name'        => $request->file('excelfile')->getClientOriginalName(),
            'Utilizator'        => 'ARTESTEXECUTOR',
        ]);

        return Redirect::route('Upload')->with('success', 'File Uploaded!.');
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
