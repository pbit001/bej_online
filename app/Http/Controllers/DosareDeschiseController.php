<?php

namespace App\Http\Controllers;
use App\Models\DosareDeschise;
use App\Models\IRDosar_LOG;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DosareDeschiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Inertia::render('DosareDeschise/Index', [
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
        return Inertia::render('DosareDeschise/Create');
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
            'Nume_Debitor' => ['required'],
            'CNP_CUI' => ['required'],
            'Adresa_Debitor' => ['required'],
            'Judet_Debitor' => ['required'],
            'Primarie_Debitor' => ['required'],
            'Nume_Creditor' => ['required'],
            'Adresa_Creditor' => ['required'],
            'DataTitlu_Executoriu' => ['required'],
            'Suma_CreditorInitiala' => ['required'],
            'Taxa' => ['required'],
            'Cheltuieli' => ['required'],
        ]);

        $input = $request->all();
        
        
        $addedDosareDeschise = DosareDeschise::create([
            'Nr_Dosar'              => $input['Nr_Dosar'],
            'Nume_Debitor'          => $input['Nume_Debitor'],
            'Prenume_Debitor'       => $input['Prenume_Debitor'],        
            'CNP_CUI'               => $input['CNP_CUI'],
            'Adresa_Debitor'        => $input['Adresa_Debitor'], 
            'Judet_Debitor'         => $input['Judet_Debitor'],
            'Primarie_Debitor'      => $input['Primarie_Debitor'],
            'CoDebitor_Girant'      => $input['CoDebitor_Girant'],
            'Nume_Creditor'         => $input['Nume_Creditor'],
            'Adresa_Creditor'       => $input['Adresa_Creditor'],
            'Titlu_Executoriu'      => $input['Titlu_Executoriu'],
            'DataTitlu_Executoriu'  => $input['DataTitlu_Executoriu'],
            'Suma_CreditorInitiala' => $input['Suma_CreditorInitiala'],
            'Judecatoria'           => $input['Judecatoria'],
            'Procent_Onorariu'      => $input['Procent_Onorariu'],        
            'Taxa'                  => $input['Taxa'],
            'Cheltuieli'            => $input['Cheltuieli'],
            'Data_Introducerii'     => date("Y.m.d"),
            'Stadiu_Dosar'          => $input['Stadiu_Dosar'],
            'Avans_Onorariu'        => $input['Avans_Onorariu'],
            'ID_User'               => Auth::user()->id,
            'Credit_Ipotecar'        => $input['Credit_Ipotecar'],
            'Grant_Imobiliar'        => $input['Grant_Imobiliar'],

        ]);


        return Redirect::route('DosareDeschise.index')->with('success', 'Dosare Deschise Inregistrare Dosar.');
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
        $DosareDeschise = DosareDeschise::where('Nr_Dosar', $id)->first();
        return Inertia::render('DosareDeschise/Edit', [
            'DosareDeschise' => [
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
                'Judet_Debitor' => $DosareDeschise->Judet_Debitor,
                'Primarie_Debitor' => $DosareDeschise->Primarie_Debitor,
                'Judecatoria' => $DosareDeschise->Judecatoria,
                'Taxa' => $DosareDeschise->Taxa,
                'Cheltuieli' => $DosareDeschise->Cheltuieli,
                'Procent_Onorariu' => $DosareDeschise->Procent_Onorariu,
                'Avans_Onorariu' => $DosareDeschise->Avans_Onorariu,
                'CoDebitor_Girant' => $DosareDeschise->CoDebitor_Girant,
                'Credit_Ipotecar' => $DosareDeschise->Credit_Ipotecar,
                'Grant_Imobiliar' => $DosareDeschise->Grant_Imobiliar,
            ],
        ]);
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

        $request->validate([
            'Nume_Debitor' => ['required'],
            'CNP_CUI' => ['required'],
            'Adresa_Debitor' => ['required'],
            'Judet_Debitor' => ['required'],
            'Primarie_Debitor' => ['required'],
            'Nume_Creditor' => ['required'],
            'Adresa_Creditor' => ['required'],
            'DataTitlu_Executoriu' => ['required'],
            'Suma_CreditorInitiala' => ['required'],
            'Taxa' => ['required'],
            'Cheltuieli' => ['required'],
        ]);

        $input = $request->all();
        $DosareDeschise = DosareDeschise::where('Nr_Dosar', $id)->first();
        
        $DosareDeschise->Nume_Debitor =  $input['Nume_Debitor'];
        $DosareDeschise->Prenume_Debitor = $input['Prenume_Debitor'];        
        $DosareDeschise->CNP_CUI = $input['CNP_CUI'];
        $DosareDeschise->Adresa_Debitor = $input['Adresa_Debitor']; 
        $DosareDeschise->Judet_Debitor = $input['Judet_Debitor'];
        $DosareDeschise->Primarie_Debitor = $input['Primarie_Debitor'];
        $DosareDeschise->CoDebitor_Girant = $input['CoDebitor_Girant'];
        $DosareDeschise->Nume_Creditor = $input['Nume_Creditor'];
        $DosareDeschise->Adresa_Creditor = $input['Adresa_Creditor'];
        $DosareDeschise->Titlu_Executoriu = $input['Titlu_Executoriu'];
        $DosareDeschise->DataTitlu_Executoriu = $input['DataTitlu_Executoriu'];
        $DosareDeschise->Suma_CreditorInitiala = $input['Suma_CreditorInitiala'];
        $DosareDeschise->Judecatoria = $input['Judecatoria'];
        $DosareDeschise->Procent_Onorariu = $input['Procent_Onorariu'];        
        $DosareDeschise->Taxa = $input['Taxa'];
        $DosareDeschise->Cheltuieli = $input['Cheltuieli'];
        $DosareDeschise->Stadiu_Dosar = $input['Stadiu_Dosar'];
        $DosareDeschise->Avans_Onorariu = $input['Avans_Onorariu'];
        $DosareDeschise->Credit_Ipotecar = $input['Credit_Ipotecar'];
        $DosareDeschise->Grant_Imobiliar = $input['Grant_Imobiliar'];
        $DosareDeschise->save();

        return Redirect::route('DosareDeschise.index')->with('success', 'Dosare Deschise Inregistrare Dosar updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = DosareDeschise::where('Nr_Dosar', $id)->delete();
        return Redirect::route('DosareDeschise.index')->with('success', 'Dosare Deschise deleted.');
    }

    /** DosareDeschiseIstoric */
    public function DosareDeschiseIstoric($Nr_Dosare) {
        $response = array();
        $html = "<table id='DosareDeschiseIstoric' class='table table-bordered table-striped'>
        <thead>
        <th>Nr Dosar</th>
        <th>Nume Debitor</th>
        <th>Prenume Debitor</th>
        <th>CNP/CUI</th>
        <th>Adresa Debitor</th>        
        <th>Nume Creditor</th>
        <th>Adresa Creditor</th>
        <th>Titlu Executoriu</th>
        <th>Data Titlu Executoriu</th>
        <th>Suma Totala Initiala (LEI)</th>         
        <th>Suma Creditor Initiala (LEI)</th>
        <th>Total BEJ Initial (LEI)</th>
        <th>Suma Consemnata (LEI)</th>         
        <th>Data Consemnare Suma</th>
        <th>Suma Distribuita Creditor (LEI)</th>
        <th>Suma Distribuita BEJ (LEI)</th>
        <th>Data Interogare ANAF </th>
        <th>Data Poprire Banca</th>
        <th>Stadiu Dosar</th>
        
        </thead>";

        $IRDosarLog = IRDosar_LOG::where('Nr_Dosar', $Nr_Dosare)->get();
        foreach($IRDosarLog as $sigleLog):
           
            $html .= '<tr>';
            $html .= '<td>'.$sigleLog->Nr_Dosar.'</td>';
            $html .= '<td>'.$sigleLog->Nume_Debitor.'</td>';
            $html .= '<td>'.$sigleLog->Prenume_Debitor.'</td>';
            $html .= '<td>'.$sigleLog->CNP_CUI.'</td>';
            $html .= '<td>'.$sigleLog->Adresa_Debitor.'</td>';
            $html .= '<td>'.$sigleLog->Nume_Creditor.'</td>';
            $html .= '<td>'.$sigleLog->Adresa_Creditor.'</td>';
            $html .= '<td>'.$sigleLog->Titlu_Executoriu.'</td>';
            $html .= '<td>'.$sigleLog->DataTitlu_Executoriu.'</td>';
            $html .= '<td>'.$sigleLog->Suma_TotalaInitiala.'</td>';
            $html .= '<td>'.$sigleLog->Suma_CreditorInitiala.'</td>';
            $html .= '<td>'.$sigleLog->Total_BEJInitial.'</td>';
            $html .= '<td>'.$sigleLog->Incasari_Totale.'</td>';
            $html .= '<td>'.$sigleLog->Data_Incasare.'</td>';
            $html .= '<td>'.$sigleLog->Suma_TrCreditor.'</td>';
            $html .= '<td>'.$sigleLog->Suma_TrBEJ.'</td>';
            $html .= '<td>'.$sigleLog->DataEmitere_Interogare.'</td>';
            $html .= '<td>'.$sigleLog->Poprire_Conturi.'</td>';
            $html .= '<td>'.$sigleLog->Stadiu_Dosar.'</td>';
            $html .= '</tr>';

        endforeach;

        $html .= '</table>';
        
        $response['html'] = $html;
        echo json_encode($response);
        exit;
    }

}
