<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fakultas = fakultas::all(); // select * from fakultas
        return response()->json($fakultas, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'nama' => 'required|unique:fakultas',
                'kode' =>'required'
            ]
        );

        $fakultas = fakultas::create($validate);
        if($fakultas){
            $data['success'] = true;
            $data['message'] = "Data fakultas berhasil disimpan";
            $data['data'] = $fakultas;
            return response() ->json($data, 201);
        }
    }

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
        $fakultas = fakultas::find($id);
        if ($fakultas){
            $validate = $request->validate(
                [
                    'nama' => 'required',
                    'kode' =>'required'
                    ]
                );
                
                fakultas::where('id', $id)->update($validate);
                $fakultas = fakultas::find($id);
                if($fakultas){
                    $data['success'] = true;
                    $data['message'] = "Data fakultas berhasil diperbaharui";
                    $data['data'] = $fakultas;
                    return response() ->json($data, 201);
                }
        }else{
            $data['success'] = false;
            $data['message'] = "data fakultas tidak ditemukan";
            return response() ->json($data, 200);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fakultas = fakultas::where('id', $id);
        if($fakultas){
            $fakultas ->delete();
            $data['success'] = true;
            $data['message'] = "Data fakultas berhasil dihapus";
            return response() ->json($data, 2004);
        }else {
            $data['success'] = false;
            $data['message'] = "Data fakultas tidak berhasil dihapus";
            $data['data'] = $fakultas;
            return response() ->json($data, 2004);
        }
    }
}
