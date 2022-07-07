<?php

namespace App\Imports;

use App\Models\ANAFAngajatori;
use Maatwebsite\Excel\Concerns\ToModel;

class ANAFAngajatoriImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ANAFAngajatori([
            'CNP_DEBITOR'     => $row[0],
            'CIF_ANGAJATOR'    => $row[1], 
            'Denumire_ANGAJATOR' => $row[2],
            'SEDIU' => $row[3],
            'AN_RAPORTARE' => $row[4],
            'LUNA_RAPORTARE' => $row[5],
            'DOSAR_NR' => $row[6],
            'Utilizator' => $row[7],
        ]);
    }
}
