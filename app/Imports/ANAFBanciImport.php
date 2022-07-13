<?php

namespace App\Imports;

use App\Models\ANAFBanci;
use Maatwebsite\Excel\Concerns\ToModel;

class ANAFBanciImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ANAFBanci([
            'Banca'     => $row[0],
            'CNPCUI_Debitor'    => $row[1], 
            'Denumire_Debitor' => $row[2],
            'Dosar_Nr' => $row[3],
            'Utilizator' => $row[4],
        ]);
    }
}
