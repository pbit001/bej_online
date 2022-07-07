<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosareDeschise extends Model
{

    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_IRDosar';
    public $timestamps = false;

    use HasFactory;
    protected $fillable = ['Nr_Dosar', 'Nume_Debitor', 'Prenume_Debitor',  'CNP_CUI', 'Nume_Creditor', 'Adresa_Creditor', 'Titlu_Executoriu', 'Suma_CreditorRamasa', 
    'TVA', 'DataEmitere_Interogare', 'DataTitlu_Executoriu', 'Judecatoria', 'Valuta_Credit', 'Firma_Debitor', 'CoDebitor_Girant', 'Suma_TrBEJ', 'Suma_CreditorInitiala',
     'Cheltuieli', 'Procent_Onorariu', 'Onorariu', 'OnorariuTVA', 'Taxa', 'Total_BEJInitial', 'Suma_TrCreditor', 'Total_BEJRamas', 'Suma_TotalaInitiala', 'Stadiu_Dosar', 
     'Nume_Ex', 'Orar_Ex', 'Detalii_Ex', 'Cont_Ex', 'Oras_Ex', 'Adresa_Debitor', 'Primarie_Debitor', 'Adresa_Firma', 'Adresa_Ex', 'Data_Incasare', 'Judet_Debitor',
    'Total_IncasariBEJ', 'Total_IncasariCreditor', 'Data_Introducerii', 'Data_Modificarii', 'Suma_ValutaInitiala', 'Suma_TrCreditorValuta', 'Onorariu_Valuta', 
    'Suma_ValutaRamasa', 'Cheltuieli_Valuta', 'Taxa_Valuta', 'Onorariu_TvaValuta', 'Suma_trBEJValuta', 'Cod_exec', 'ID_Caz', 'Poprire_Angajator', 'Poprire_Conturi', 
    'Incasari_Totale', 'Suma_TotalaRamasa', 'Suma_BEJValuta', 'Suma_BEJValutaRamasa', 'Nr_Sentinta', 'Data_Sentinta', 'Dosar_Instanta', 'Nr_HotarareInst', 
    'Data_HotarareInst', 'Ultima_Incasare', 'Distribuire_Procent', 'BEJ_Incasat', 'Creditor_Incasat', 'BEJ_IncasatValuta', 'Creditor_IncasatValuta', 'Sursa_Incasare',
     'Ultima_IncasareValuta', 'Incasari_TotaleValuta', 'Utilizator', 'Comentarii', 'ID_User', 'ID_UserIncasare', 'ID_UserComentarii', 'Data_Comentariu', 
     'Avans_Onorariu', 'ID_UserMod', 'ID_UserEmInt', 'Incasare_Nd', 'Utilizator_recipise', 'Incasare_NdData', 'Suma_RamasaNd'];
}
