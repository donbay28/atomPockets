<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\kategori;

class KategoriController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kategori = kategori::all();

        return view('Kategori.index', compact('data_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Kategori.create');
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
        $request->validate([
          'nama'      => 'required',
        ]);

        kategori::create([
          'nama'      => $input['nama'],
          'deskripsi' => $input['deskripsi'],
          'status_id' => $input['status_id'],
        ]);
        return redirect('/kategoris')->with('success', 'Success Save Data Kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data_kategori = kategori::find($id);
      return view('Kategori.detail', compact('data_kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data_kategori = kategori::find($id);
      return view('Kategori.edit', compact('data_kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $request->validate([
        'nama'      => 'required',
        'deskripsi' => 'required',
      ]);

      $data_kategori = kategori::find($request->get('id'));
      $data_kategori->nama      = $request->get('nama');
      $data_kategori->deskripsi = $request->get('deskripsi');
      $data_kategori->status_id = $request->get('status_id');
      $data_kategori->save();

      return redirect('/kategoris')->with('success', 'Success Update Data Kategori!');
    }

    /**
     * Change Status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id,$status_id)
    {
      if($status_id == 1){
        kategori::where('id','=',$id)
          ->update([
              'status_id'      => 2,
          ]);
      }else{
        kategori::where('id','=',$id)
          ->update([
              'status_id'      => 1,
          ]);
      }
      return redirect('/kategoris')->with('success', 'Success Update Status Kategori!');
    }

    /**
     * Filter Data Dompet By Status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterStatus($status_id){
      if($status_id == 0){
        $data_kategori = kategori::all()->toArray();
      }else{
        $data_kategori = kategori::where('status_id',$status_id)->get()->toArray();
      }
      return response()->json($data_kategori);
  }
}
