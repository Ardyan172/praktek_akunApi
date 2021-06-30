<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// vendor/symfony/http-foundation/Response
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    // menginisialisasi Models\Transaction menjadi sebuah object
    public function __construct()
    {
        $this->Transaction = new Transaction();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semuaTransaksi = $this->Transaction->allData();

        $response = [
            'message' => 'Daftar Transaksi',
            'data' => $semuaTransaksi
        ];

        return response()->json($response, Response::HTTP_OK);
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
        // validasi dulu
        $validasiData = $request->validate([
            'nama' => ['required', 'max:50'],
            'jumlah' => ['required', 'numeric'],
            'type' => [
                'required', 
                Rule::in(['pemasukan', 'pengeluaran']) 
            ]
        ]);

        try {
            $tambahData = $this->Transaction->addData($request->all());

            $response = [
                'message' => 'Data berhasil ditambah',
                'data' =>  $tambahData
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (queryException $e) {
            // kalau gagal maka tangkap pengecualian query nya
            return response()->json('coba kegagalan ' . $e->errorInfo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // cari data berdasarkan id
        $detailData = $this->Transaction->showData($id);

        // lalu buat response
        $response = [
            'message' => 'Detail transaksi ' . $detailData->nama,
            'data' => $detailData
        ];

        // lalu kembalikkan response berupa json
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        // validasi dulu
        $validated = $request->validate([
            'nama' => ['required', 'min:3', 'max:50'],
            'jumlah' => ['required', 'min:1000', 'numeric', 'max:10000000'],
            'type' => [
                'required',
                Rule::in(['pemasukan', 'pengeluaran'])
                // hanya boleh diisi pemasukan atau pengeluaran
            ]
        ]);

        try {
        // try lakukan update data, buat array response lalu return json
            $data = $this->Transaction->updateData($request, $id);
            // kirim id lalu method update data yang memperbaruinya
            $response = [
                'message' => 'Data berhasil diperbarui',
                'data' => $data
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch(queryException $e) {
            // kalau gagal maka tangkap pengecualian query di $e
            return response()->json('Gagal ' . $e->errorInfo);
        }
        // catch queryException $e 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Transaction->deleteLah($id);

        $response = [
            'message' => 'Success Delete Data'
        ];

        return response()->json($response, Response::HTTP_OK); 
    }
}
