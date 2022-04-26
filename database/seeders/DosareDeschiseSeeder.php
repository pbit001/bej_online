<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DosareDeschise;

class DosareDeschiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $number_of_records = [
            '1', '2', '3', '4', '5', '6','7', '8', '9', '10', '11'
        ];
        foreach ($number_of_records as $number) :
            DosareDeschise::create([
                'Nr_Dosar' => $number,
                'Nume_Debitor' => 'abc',
                'Prenume_Debitor' => 'def',
                'CNP_CUI' => '191000',
                'Nume_Creditor' => 'ING',
                'Adresa_Creditor' => 'arad',
                'Titlu_Executoriu' => 'Bilet la Ordin', 
                'TVA' => '0.19', 
                'DataTitlu_Executoriu' => '22.05.2021', 
                'Judecatoria' => 'ARAD',
                'Suma_TrBEJ' => '0.00', 
                'Suma_CreditorInitiala' => '50000.00',
                'Cheltuieli' => '5000.00', 
                'Procent_Onorariu' => '10', 
                'Taxa' => '20', 
                'Suma_TrCreditor' => '0.00', 
                'Stadiu_Dosar' => 'Deschis',
                'Nume_Ex' => 'Nume Prenume Executor',
                'Orar_Ex' => '08-16', 
                'Detalii_Ex' => 'numit in functie conform Ordinului Ministrului Justitiei nr.xxx/x/xx.xx.xxxx, cu sediul in Arad - 410034, Blvd. Revolutiei nr. x, Judetul Arad', 
                'Cont_Ex' => 'Nume Prenume, CIF ROxxxx, RO67BRDxxxxxxxxx sau (doar pentru debite in EURO)RO84BRDxxxxxxxx, deschis la B.R.D. GROUPE SOCIETE GENERALE S.A.', 
                'Oras_Ex' => "arad", 
                'Adresa_Debitor' => 'arad', 
                'Adresa_Ex' => 'blvd. revolutiei xx', 
                'Judet_Debitor' => 'waqar',
                'Data_Introducerii' => '2022-04-24', 
                'Cod_exec' => 'ATE',
                'Avans_Onorariu' => '1000.00'
            ]);
        endforeach;
    }
}
