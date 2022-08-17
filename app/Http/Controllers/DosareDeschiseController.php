<?php

namespace App\Http\Controllers;

use App\Models\DosareDeschise;
use App\Models\IRDosar_LOG;
use App\Models\Notificari;
use App\Models\tbl_order;
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
            'DosareDeschise' => DosareDeschise::orderBy('Nr_Dosar', 'DESC')->where('Stadiu_Dosar', 'deschis')->paginate(10)
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
            'Notificari' => Notificari::orderBy('Nr_Dosar', 'DESC')->paginate(100)
                ->through(fn ($Notificari) => [
                    'Nr_Dosar'              => $Notificari['Nr_Dosar'],
                    'ID'              => $Notificari['ID'],
                    'ParteCare_Notifica'    => $Notificari['ParteCare_Notifica'],
                    'Date_ParteCareNotifica' => $Notificari['Date_ParteCareNotifica'],
                    'Parte_Notificata'       => $Notificari['Parte_Notificata'],
                    'Date_ParteNotificata'   => $Notificari['Date_ParteNotificata'],
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
        $orderNumber = 0;
        $lastOrderNumber = DosareDeschise::orderByDesc('Nr_Dosar', 'desc')->limit(1)->get();
        if (isset($lastOrderNumber[0]->order_no) && !empty($lastOrderNumber[0]->order_no)) {
            $orderNumber = $lastOrderNumber[0]->order_no;
        }
        $newOrder = $orderNumber + 1;

        return Inertia::render('DosareDeschise/Create',  [
            'NewOrder' => [
                'newOrder' => $newOrder,
            ]
        ],);
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
            //'Nr_Dosar' => ['unique:App\Models\DosareDeschise,Nr_Dosar', 'required'],
            'Nume_Debitor' => ['required'],
            'CNP_CUI' => ['required'],
            'Adresa_Debitor' => ['required'],
            'Primarie_Debitor' => ['required'],
            'Nume_Creditor' => ['required'],
            'Adresa_Creditor' => ['required'],
            'Taxa' => ['required'],
            'Cheltuieli' => ['required'],
        ]);

        $input = $request->all();


        $addedDosareDeschise = DosareDeschise::create([
            'Nr_Dosar'              => rand(),
            'Credit_Ipotecar'        => $input['Credit_Ipotecar'],
            'Nume_Creditor'         => $input['Nume_Creditor'],
            'Adresa_Creditor'       => $input['Adresa_Creditor'],
            'Nume_Reprezentant' => $input['Nume_Reprezentant'],
            'Adresa_Reprezentant' => $input['Adresa_Reprezentant'],
            'Identificare_Reprezentant' => $input['Identificare_Reprezentant'],
            'Creditor_Suplimentar' => $input['Creditor_Suplimentar'],
            'Grant_Imobiliar' => $input['Grant_Imobiliar'],
            'Nume_Debitor' => $input['Nume_Debitor'],
            'Prenume_Debitor' => $input['Prenume_Debitor'],
            'CNP_CUI' => $input['CNP_CUI'],
            'Adresa_Debitor' => $input['Adresa_Debitor'],
            'Debitor_Suplimentar' => $input['Debitor_Suplimentar'],

            'Primarie_Debitor' => $input['Primarie_Debitor'],
            'Obiect' => $input['Obiect'],
            'Obiect_Suplimentar' => $input['Obiect_Suplimentar'],
            'Titlu_Executoriu' => $input['Titlu_Executoriu'],

            'debit_variabil' => $input['debit_variabil'],
            'Taxa' => $input['Taxa'],
            'Taxa_Ad1' => $input['Taxa_Ad1'],
            'Taxa_Ad2' => $input['Taxa_Ad2'],
            'Taxa_Ad3' => $input['Taxa_Ad3'],
            'Taxa_Ad4' => $input['Taxa_Ad4'],

            'Cheltuieli' => $input['Cheltuieli'],
            'Stadiu_Dosar' => 'deschis',

        ]);

        $DosarUpdate = DosareDeschise::where('id', $addedDosareDeschise->id)->first();
        $DosarUpdate->Nr_Dosar = $addedDosareDeschise->id . '/' . date("Y");
        $DosarUpdate->save();


        return Redirect::route('DosareDeschise.index')->with('success', 'Dosare Deschise Inregistrare Dosar.');
    }

    /** DosareDeschiseNotificareStore  */
    public function DosareDeschiseNotificareStore(Request $request)
    {

        $request->validate([
            'ParteCare_Notifica' => ['required'],
            'Date_ParteCareNotifica' => ['required'],
            'Parte_Notificata' => ['required'],
            'Date_ParteNotificata' => ['required'],

        ]);

        $input = $request->all();

        $addedDosareDeschise = Notificari::create([

            'ParteCare_Notifica'    => $input['ParteCare_Notifica'],
            'Date_ParteCareNotifica' => $input['Date_ParteCareNotifica'],
            'Parte_Notificata'       => $input['Parte_Notificata'],
            'Date_ParteNotificata'   => $input['Date_ParteNotificata'],

        ]);

        $Notificari = Notificari::where('ID', $addedDosareDeschise->ID)->first();
        $Notificari->Nr_Dosar = $Notificari->ID . '/' . date("Y");
        $Notificari->save();

        return Redirect::route('DosareDeschise.index')->with('success', 'Notificare added!.');
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
        $DosareDeschise = DosareDeschise::where('id', $id)->first();
        return Inertia::render('DosareDeschise/Edit', [
            'DosareDeschise' => [
                'id' => $DosareDeschise->id,
                'Nr_Dosar' => $DosareDeschise->Nr_Dosar,
                'Credit_Ipotecar'        => $DosareDeschise->Credit_Ipotecar,
                'Nume_Creditor'         => $DosareDeschise->Nume_Creditor,
                'Adresa_Creditor'       => $DosareDeschise->Adresa_Creditor,
                'Nume_Reprezentant' => $DosareDeschise->Nume_Reprezentant,
                'Adresa_Reprezentant' => $DosareDeschise->Adresa_Reprezentant,
                'Identificare_Reprezentant' => $DosareDeschise->Identificare_Reprezentant,
                'Creditor_Suplimentar' => $DosareDeschise->Creditor_Suplimentar,
                'Grant_Imobiliar' => $DosareDeschise->Grant_Imobiliar,
                'Nume_Debitor' => $DosareDeschise->Nume_Debitor,
                'Prenume_Debitor' => $DosareDeschise->Prenume_Debitor,
                'CNP_CUI' => $DosareDeschise->CNP_CUI,
                'Adresa_Debitor' => $DosareDeschise->Adresa_Debitor,
                'Debitor_Suplimentar' => $DosareDeschise->Debitor_Suplimentar,

                'Primarie_Debitor' => $DosareDeschise->Primarie_Debitor,
                'Obiect' => $DosareDeschise->Obiect,
                'Obiect_Suplimentar' => $DosareDeschise->Obiect_Suplimentar,
                'Titlu_Executoriu' => $DosareDeschise->Titlu_Executoriu,

                'debit_variabil' => $DosareDeschise->debit_variabil,
                'Taxa' => $DosareDeschise->Taxa,
                'Taxa_Ad1' => $DosareDeschise->Taxa_Ad1,
                'Taxa_Ad2' => $DosareDeschise->Taxa_Ad2,
                'Taxa_Ad3' => $DosareDeschise->Taxa_Ad3,
                'Taxa_Ad4' => $DosareDeschise->Taxa_Ad4,

                'Cheltuieli' => $DosareDeschise->Cheltuieli,
            ],
        ]);
    }

    /** NotificariEdit */
    public function NotificariEdit($id)
    {
        $Notificari = Notificari::where('ID', $id)->first();
        return Inertia::render('DosareDeschise/NotificariEdit', [
            'Notificari' => [
                'Nr_Dosar'              => $Notificari['Nr_Dosar'],
                'ID'              => $Notificari['ID'],
                'ParteCare_Notifica'    => $Notificari['ParteCare_Notifica'],
                'Date_ParteCareNotifica' => $Notificari['Date_ParteCareNotifica'],
                'Parte_Notificata'       => $Notificari['Parte_Notificata'],
                'Date_ParteNotificata'   => $Notificari['Date_ParteNotificata'],
            ],
        ]);
    }

    /** NotificariUpdate */
    public function NotificariUpdate(Request $request, $id)
    {

        $request->validate([
            'ParteCare_Notifica' => ['required'],
            'Date_ParteCareNotifica' => ['required'],
            'Parte_Notificata' => ['required'],
            'Date_ParteNotificata' => ['required'],

        ]);

        $input = $request->all();
        $Notificari = Notificari::where('ID', $id)->first();

        $Notificari->ParteCare_Notifica = $input['ParteCare_Notifica'];
        $Notificari->Date_ParteCareNotifica = $input['Date_ParteCareNotifica'];
        $Notificari->Parte_Notificata = $input['Parte_Notificata'];
        $Notificari->Date_ParteNotificata = $input['Date_ParteNotificata'];

        $Notificari->save();

        return Redirect::route('DosareDeschise.index')->with('success', 'Notificari Updated.');
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
            //'Nr_Dosar' => ['unique:App\Models\DosareDeschise,Nr_Dosar', 'required'],
            'Nume_Debitor' => ['required'],
            'CNP_CUI' => ['required'],
            'Adresa_Debitor' => ['required'],
            'Primarie_Debitor' => ['required'],
            'Nume_Creditor' => ['required'],
            'Adresa_Creditor' => ['required'],
            'Taxa' => ['required'],
            'Cheltuieli' => ['required'],
        ]);

        $input = $request->all();
        $DosareDeschise = DosareDeschise::where('id', $id)->first();

        $DosareDeschise->Credit_Ipotecar       = $input['Credit_Ipotecar'];
        $DosareDeschise->Nume_Creditor        = $input['Nume_Creditor'];
        $DosareDeschise->Adresa_Creditor      = $input['Adresa_Creditor'];
        $DosareDeschise->Nume_Reprezentant = $input['Nume_Reprezentant'];
        $DosareDeschise->Adresa_Reprezentant = $input['Adresa_Reprezentant'];
        $DosareDeschise->Identificare_Reprezentant = $input['Identificare_Reprezentant'];
        $DosareDeschise->Creditor_Suplimentar = $input['Creditor_Suplimentar'];
        $DosareDeschise->Grant_Imobiliar = $input['Grant_Imobiliar'];
        $DosareDeschise->Nume_Debitor = $input['Nume_Debitor'];
        $DosareDeschise->Prenume_Debitor = $input['Prenume_Debitor'];
        $DosareDeschise->CNP_CUI = $input['CNP_CUI'];
        $DosareDeschise->Adresa_Debitor = $input['Adresa_Debitor'];
        $DosareDeschise->Debitor_Suplimentar = $input['Debitor_Suplimentar'];

        $DosareDeschise->Primarie_Debitor = $input['Primarie_Debitor'];
        $DosareDeschise->Obiect = $input['Obiect'];
        $DosareDeschise->Obiect_Suplimentar = $input['Obiect_Suplimentar'];
        $DosareDeschise->Titlu_Executoriu = $input['Titlu_Executoriu'];

        $DosareDeschise->debit_variabil = $input['debit_variabil'];
        $DosareDeschise->Taxa = $input['Taxa'];
        $DosareDeschise->Taxa_Ad1 = $input['Taxa_Ad1'];
        $DosareDeschise->Taxa_Ad2 = $input['Taxa_Ad2'];
        $DosareDeschise->Taxa_Ad3 = $input['Taxa_Ad3'];
        $DosareDeschise->Taxa_Ad4 = $input['Taxa_Ad4'];

        $DosareDeschise->Cheltuieli = $input['Cheltuieli'];


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
        $del = DosareDeschise::where('id', $id)->delete();
        return Redirect::route('DosareDeschise.index')->with('success', 'Dosare Deschise deleted.');
    }

    /** destroyNotificari */
    public function destroyNotificari($id)
    {
        $del = Notificari::where('ID', $id)->delete();
        return Redirect::route('DosareDeschise.index')->with('success', 'Notificari deleted.');
    }


    /** DosareDeschiseIstoric */
    public function DosareDeschiseIstoric($Nr_Dosare)
    {
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
        foreach ($IRDosarLog as $sigleLog) :

            $html .= '<tr>';
            $html .= '<td>' . $sigleLog->Nr_Dosar . '</td>';
            $html .= '<td>' . $sigleLog->Nume_Debitor . '</td>';
            $html .= '<td>' . $sigleLog->Prenume_Debitor . '</td>';
            $html .= '<td>' . $sigleLog->CNP_CUI . '</td>';
            $html .= '<td>' . $sigleLog->Adresa_Debitor . '</td>';
            $html .= '<td>' . $sigleLog->Nume_Creditor . '</td>';
            $html .= '<td>' . $sigleLog->Adresa_Creditor . '</td>';
            $html .= '<td>' . $sigleLog->Titlu_Executoriu . '</td>';
            $html .= '<td>' . $sigleLog->DataTitlu_Executoriu . '</td>';
            $html .= '<td>' . $sigleLog->Suma_TotalaInitiala . '</td>';
            $html .= '<td>' . $sigleLog->Suma_CreditorInitiala . '</td>';
            $html .= '<td>' . $sigleLog->Total_BEJInitial . '</td>';
            $html .= '<td>' . $sigleLog->Incasari_Totale . '</td>';
            $html .= '<td>' . $sigleLog->Data_Incasare . '</td>';
            $html .= '<td>' . $sigleLog->Suma_TrCreditor . '</td>';
            $html .= '<td>' . $sigleLog->Suma_TrBEJ . '</td>';
            $html .= '<td>' . $sigleLog->DataEmitere_Interogare . '</td>';
            $html .= '<td>' . $sigleLog->Poprire_Conturi . '</td>';
            $html .= '<td>' . $sigleLog->Stadiu_Dosar . '</td>';
            $html .= '</tr>';

        endforeach;

        $html .= '</table>';

        $response['html'] = $html;
        echo json_encode($response);
        exit;
    }
}
