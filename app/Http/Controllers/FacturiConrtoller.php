<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Facturi;
use App\Models\Clienti;
use App\Models\ARTESTEXECUTOR_Prod;
use App\Models\tbl_order;
use App\Models\tbl_order_item;
use Illuminate\Support\Facades\Redirect;

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
            'DosareDeschise' => Facturi::orderBy('Nume_Client', 'DESC')->paginate(100)
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
            'DosareDeschise' => Clienti::orderBy('Nume_Client', 'DESC')->where('Nume_Creditor', $input['records'])->paginate(100)
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
        $input = $request->all();

        $Nume_Client = "";
        $Detalii_Client = "";
        if (isset($input['records'][0]) && !empty($input['records'][0])) {
            $recordsSingle = $input['records'][0];
            $Client = Clienti::where('Nr_Dosar', $recordsSingle)->first();
            $Nume_Client = $Client->Nume_Client;
            $Detalii_Client = $Client->Detalii_Client;
        }


        return Inertia::render('Facturi/CreateBill', [
            'Nume_Client' => $Nume_Client,
            'Detalii_Client' => $Detalii_Client,
            'ClientAll' => Clienti::whereIn('Nr_Dosar', $input['records'])->paginate(100)
                ->through(fn ($DosareDeschise) => [
                    'Nr_Dosar' => $DosareDeschise->Nr_Dosar,
                    'item_name' => '',
                    'order_item_quantity' => '',
                    'order_item_price' =>  '',
                    'order_item_actual_amount' => '',
                    'order_item_tax1_rate' => '19',
                    'order_item_tax1_amount' => '',
                    'order_item_final_amount' => '',
                ]),
            'Product' => ARTESTEXECUTOR_Prod::paginate(100)
                ->through(fn ($Product) => [
                    'Nume_Prod' => $Product->Nume_Prod,
                ]),

        ]);
    }

    /** Savebill */

    public function saveBill(Request $request)
    {
        $input = $request->all();
        
        $order_total_before_tax = 0;
        $order_total_tax1 = 0;
        $today  = date("Y.m.d");
        $order_total_tax = 0;
        $order_total_after_tax = 0;

        $tbl_order = tbl_order::create([
            'order_no'              => '15',
            'order_receiver_name'    => $input['order_receiver_name'],
            'order_receiver_address' => $input['order_receiver_address'],
            'order_total_before_tax' => 0,
            'order_total_tax1'       => $order_total_tax1,
            'order_total_tax'        => 0,
            'order_total_after_tax'  => 0,
            'order_datetime' => $today,
            'Suma_Incasata'  => 0,
        ]);
        
        
        $order_id = $tbl_order->order_id;
        
        foreach($input['xyz'] as $singRecrd):
            $order_total_before_tax = $order_total_before_tax + floatval(trim($singRecrd['order_item_actual_amount']));
            $order_total_tax1 = $order_total_tax1 + floatval(trim($singRecrd['order_item_tax1_amount']));
            $order_total_after_tax = $order_total_after_tax + floatval(trim($singRecrd["order_item_final_amount"]));

            tbl_order_item::create([
                'order_id'              => $order_id,
                'item_name'    => $singRecrd['item_name'],
                'order_item_quantity' => $singRecrd['order_item_quantity'],
                'order_item_price' => $singRecrd['order_item_price'],
                'order_item_actual_amount'       => $singRecrd['order_item_actual_amount'],
                'order_item_tax1_rate'        => $singRecrd['order_item_tax1_rate'],
                'order_item_tax1_amount'  => $singRecrd['order_item_tax1_amount'],
                'order_item_final_amount' => $singRecrd['order_item_final_amount'],
                'Detalii'  => $singRecrd['Nr_Dosar'],
            ]);

        endforeach;
        
        $order_total_tax = $order_total_tax1;


        $tbl_order->order_total_before_tax = $order_total_before_tax ;
        $tbl_order->order_total_tax1 = $order_total_tax1;
        $tbl_order->order_total_tax = $order_total_tax;
        $tbl_order->order_total_after_tax = $order_total_after_tax;
        
        $tbl_order->save();
        return Redirect::route('Facturi')->with('success', 'Order added.');
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
