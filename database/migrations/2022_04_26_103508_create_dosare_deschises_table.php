<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosareDeschisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosare_deschises', function (Blueprint $table) {
            $table->id();
            $table->string('Nr_Dosar')->nullable();
            $table->string('Nume_Debitor')->nullable();
            $table->string('Prenume_Debitor')->nullable();
            $table->string('CNP_CUI')->nullable();
            $table->string('Nume_Creditor')->nullable();
            $table->string('Adresa_Creditor')->nullable();
            $table->string('Titlu_Executoriu')->nullable();
            $table->string('Suma_CreditorRamasa')->storedAs('Suma_CreditorInitiala - Suma_TrCreditor')->nullable();
            $table->decimal('TVA', 3, 3)->default('0.190');
            $table->string('DataEmitere_Interogare')->nullable();
            $table->string('DataTitlu_Executoriu')->nullable();
            $table->string('Judecatoria')->nullable();
            $table->string('Valuta_Credit')->nullable();
            $table->string('Firma_Debitor')->nullable();
            $table->string('CoDebitor_Girant')->nullable();
            $table->decimal('Suma_TrBEJ', 10, 2)->nullable();
            $table->decimal('Suma_CreditorInitiala', 10, 2)->nullable(); 
            $table->decimal('Cheltuieli', 10, 2)->nullable();        
            $table->integer('Procent_Onorariu')->nullable();
            $table->decimal('Onorariu', 10, 2)->storedAs('((Procent_Onorariu * Suma_CreditorInitiala) * 0.01 ) -  Avans_Onorariu ')->nullable();        
            $table->decimal('OnorariuTVA', 10, 2)->storedAs('(Onorariu * TVA) + Onorariu ')->nullable();
            $table->integer('Taxa')->nullable();
            $table->decimal('Total_BEJInitial', 10, 2)->storedAs('(OnorariuTVA + Taxa) + Cheltuieli')->nullable();
            $table->decimal('Suma_TrCreditor', 10, 2)->nullable();
            $table->decimal('Total_BEJRamas', 10, 2)->storedAs('Total_BEJInitial - Suma_TrBEJ')->nullable();
            $table->decimal('Suma_TotalaInitiala', 10, 2)->storedAs('(Suma_CreditorInitiala + Total_BEJInitial) + Avans_Onorariu')->nullable();
            $table->string('Stadiu_Dosar')->nullable();
            $table->string('Nume_Ex')->nullable();
            $table->string('Orar_Ex')->nullable();
            $table->string('Detalii_Ex')->nullable();
            $table->string('Cont_Ex')->nullable();
            $table->string('Oras_Ex')->nullable();
            $table->string('Adresa_Debitor')->nullable();
            $table->string('Primarie_Debitor')->nullable();
            $table->string('Adresa_Firma')->nullable();
            $table->string('Adresa_Ex')->nullable();
            $table->date('Data_Incasare')->nullable();
            $table->string('Judet_Debitor')->nullable();
            $table->decimal('Total_IncasariBEJ', 10, 2)->storedAs('Total_BEJInitial - Total_BEJRamas')->nullable();
            $table->decimal('Total_IncasariCreditor', 10, 2)->storedAs('Suma_CreditorInitiala - Suma_CreditorRamasa')->nullable();
            $table->date('Data_Introducerii')->nullable();
            $table->string('Data_Modificarii')->nullable();
            $table->decimal('Suma_ValutaInitiala', 10, 2)->nullable();
            $table->decimal('Suma_TrCreditorValuta', 10, 2)->nullable();
            $table->decimal('Onorariu_Valuta', 10, 2)->nullable();
            $table->decimal('Suma_ValutaRamasa', 10, 2)->storedAs('Suma_ValutaInitiala - Suma_TrCreditorValuta')->nullable();
            $table->decimal('Cheltuieli_Valuta', 10, 2)->nullable();
            $table->decimal('Taxa_Valuta', 10, 2)->nullable();
            $table->decimal('Onorariu_TvaValuta', 10, 2)->nullable();
            $table->decimal('Suma_trBEJValuta', 10, 2)->nullable();
            $table->string('Cod_exec')->nullable();
            $table->string('ID_Caz')->virtualAs('concat(Cod_exec,Nr_Dosar)')->nullable();
            $table->string('Poprire_Angajator')->nullable();
            $table->string('Poprire_Conturi')->nullable();
            $table->decimal('Incasari_Totale', 10, 2)->storedAs('Total_IncasariBEJ + Total_IncasariCreditor')->nullable();
            $table->decimal('Suma_TotalaRamasa', 10, 2)->storedAs('Suma_TotalaInitiala - Incasari_Totale')->nullable();
            $table->decimal('Suma_BEJValuta', 10, 2)->storedAs('(Cheltuieli_Valuta + Taxa_Valuta) + Onorariu_Valuta')->nullable();
            $table->decimal('Suma_BEJValutaRamasa', 10, 2)->storedAs('Suma_BEJValuta - Suma_trBEJValuta')->nullable();
            $table->string('Nr_Sentinta')->nullable();
            $table->string('Data_Sentinta')->nullable();
            $table->string('Dosar_Instanta')->nullable();
            $table->string('Nr_HotarareInst')->nullable();
            $table->string('Data_HotarareInst')->nullable();
            $table->decimal('Ultima_Incasare', 10, 2)->nullable();
            $table->decimal('Distribuire_Procent', 10, 2)->nullable();
            $table->decimal('BEJ_Incasat', 10, 2)->storedAs('(Ultima_Incasare * Distribuire_Procent) * 0.01')->nullable();
            $table->decimal('Creditor_Incasat', 10, 2)->storedAs('Ultima_Incasare - BEJ_Incasat')->nullable();
            $table->decimal('BEJ_IncasatValuta', 10, 2)->nullable();
            $table->decimal('Creditor_IncasatValuta', 10, 2)->nullable();
            $table->string('Sursa_Incasare')->nullable();
            $table->decimal('Ultima_IncasareValuta', 10, 2)->storedAs('BEJ_IncasatValuta + Creditor_IncasatValuta')->nullable();
            $table->decimal('Incasari_TotaleValuta', 10, 2)->storedAs('Suma_trBEJValuta + Suma_TrCreditorValuta')->nullable();
            $table->string('Utilizator')->nullable();
            $table->string('Comentarii')->nullable();
            $table->string('ID_User')->nullable();
            $table->string('ID_UserIncasare')->nullable();
            $table->string('ID_UserComentarii')->nullable();
            $table->string('Data_Comentariu')->nullable();
            $table->decimal('Avans_Onorariu', 10, 2)->nullable();
            $table->string('ID_UserMod')->nullable();
            $table->string('ID_UserEmInt')->nullable();
            $table->decimal('Incasare_Nd', 10, 2)->nullable();
            $table->string('Utilizator_recipise')->nullable();
            $table->string('Incasare_NdData')->nullable()->generatedAs();
            $table->decimal('Suma_RamasaNd', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosare_deschises');
    }
}
