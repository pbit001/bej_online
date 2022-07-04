<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrdosarLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irdosar_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ID_Caz')->nullable();
            $table->string('Nr_Dosar')->nullable();
            $table->string('Nume_Debitor')->nullable();
            $table->string('Prenume_Debitor')->nullable();
            $table->string('CNP_CUI')->nullable();
            $table->string('Adresa_Debitor')->nullable();
            $table->string('Nume_Creditor')->nullable();
            $table->string('Adresa_Creditor')->nullable();
            $table->string('Titlu_Executoriu')->nullable();
            $table->string('Data_Introducerii')->nullable();
            $table->decimal('Suma_TotalaInitiala', 10, 2)->nullable();
            $table->decimal('Suma_TotalaRamasa', 10, 2)->nullable();
            $table->decimal('Suma_CreditorInitiala', 10, 2)->nullable();
            $table->decimal('Suma_TrBEJ', 10, 2)->nullable();
            $table->decimal('Suma_TrCreditor', 10, 2)->nullable();
            $table->decimal('Procent_Onorariu', 10, 2)->nullable();
            $table->decimal('Onorariu', 10, 2)->nullable();
            $table->decimal('Taxa', 10, 2)->nullable();
            $table->decimal('Cheltuieli', 10, 2)->nullable();
            $table->integer('Total_TrBEJ')->nullable();
            $table->decimal('Suma_CreditorRamasa', 10, 2)->nullable();
            $table->decimal('OnorariuTVA', 10, 2)->nullable();
            $table->decimal('Total_BEJInitial', 10, 2)->nullable();
            $table->decimal('Total_BEJRamas', 10, 2)->nullable();
            $table->string('Firma_Debitor')->nullable();
            $table->string('Adresa_Firma')->nullable();
            $table->string('CoDebitor_Girant')->nullable();
            $table->string('Stadiu_Dosar')->nullable();
            $table->string('Data_Modificarii')->nullable();
            $table->string('Data_Incasare')->nullable();
            $table->decimal('Total_IncasariCreditor', 10, 2)->nullable();
            $table->decimal('Total_IncasariBEJ', 10, 2)->nullable();
            $table->decimal('Incasari_Totale', 10, 2)->nullable();
            $table->string('DataEmitere_Interogare')->nullable();
            $table->string('Poprire_Angajator')->nullable();
            $table->string('Poprire_Conturi')->nullable();
            $table->string('Valuta_Credit')->nullable();
            $table->string('DataTitlu_Executoriu')->nullable();
            $table->decimal('Suma_ValutaInitiala', 10, 2)->nullable();
            $table->decimal('Suma_TrCreditorValuta', 10, 2)->nullable();
            $table->decimal('Suma_ValutaRamasa', 10, 2)->nullable();
            $table->string('Nume_Ex')->nullable();
            $table->decimal('Suma_BEJValuta', 10, 2)->nullable();
            $table->decimal('Cheltuieli_Valuta', 10, 2)->nullable();
            $table->decimal('Taxa_Valuta', 10, 2)->nullable();
            $table->decimal('Onorariu_TvaValuta', 10, 2)->nullable();
            $table->decimal('Suma_trBEJValuta', 10, 2)->nullable();
            $table->decimal('Suma_BEJValutaRamasa', 10, 2)->nullable();
            $table->decimal('Ultima_Incasare', 10, 2)->nullable();
            $table->decimal('BEJ_Incasat', 10, 2)->nullable();
            $table->decimal('Creditor_Incasat', 10, 2)->nullable();
            $table->decimal('BEJ_IncasatValuta', 10, 2)->nullable();
            $table->decimal('Creditor_IncasatValuta', 10, 2)->nullable();
            $table->string('Adresa_Ex')->nullable();
            $table->string('Detalii_Ex')->nullable();
            $table->string('Cont_Ex')->nullable();
            $table->string('Oras_Ex')->nullable();
            $table->string('Primarie_Debitor')->nullable();
            $table->decimal('Ultima_IncasareValuta', 10, 2)->nullable();
            $table->decimal('Incasari_TotaleValuta', 10, 2)->nullable();
            $table->string('Sursa_Incasare')->nullable();
            $table->string('Utilizator')->nullable();
            $table->string('Comentarii')->nullable();
            $table->string('ID_User')->nullable();
            $table->string('ID_UserIncasare')->nullable();
            $table->string('ID_UserComentarii')->nullable();
            $table->string('Data_Comentariu')->nullable();
            $table->string('ID_UserMod')->nullable();
            $table->string('ID_UserEmInt')->nullable();
            $table->decimal('Incasare_Nd', 10, 2)->nullable();
            $table->string('Utilizator_recipise')->nullable();
            $table->string('Incasare_NdData')->nullable();
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
        Schema::dropIfExists('irdosar_logs');
    }
}
