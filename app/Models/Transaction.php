<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    public function allData()
    {
        return DB::table('transactions')->orderBy('waktu', 'desc')->get();
    }

    public function addData($request)
    {
        return DB::table('transactions')->insert($request);
    }

    public function showData($id)
    {
        return DB::table('transactions')->find($id);
    }

    public function deleteLah($id) 
    {
        return DB::table('transactions')->delete($id);
    }

    public function updateData($request, $id) 
    {
        $affected = DB::table('transactions')
                    ->where('id', $id)
                    ->update([
                        'nama' => $request->nama,
                        'jumlah' => $request->jumlah,
                        'type' => $request->type
                        // nama, jumlah dan type di dapatkan dari name kalau ada form
                    ]);

        return $affected;
    }
}
