<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\dompet;

class DompetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_dompet = dompet::all();
        return view('Dompet.index', compact('data_dompet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dompet.create');
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
          'deskripsi' => 'required',
          'status_id' => 'required',
        ]);

        dompet::create([
          'nama'      => $input['nama'],
          'referensi' => $input['referensi'],
          'deskripsi' => $input['deskripsi'],
          'status_id' => $input['status_id'],
        ]);
        return redirect('/dompets')->with('success', 'Success Save Data Dompet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data_dompet = dompet::find($id);
      return view('Dompet.detail', compact('data_dompet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data_dompet = dompet::find($id);
      return view('Dompet.edit', compact('data_dompet'));
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
        'status_id' => 'required',
      ]);

      $data_dompet = dompet::find($request->get('id'));
      $data_dompet->nama      = $request->get('nama');
      $data_dompet->referensi = $request->get('referensi');
      $data_dompet->deskripsi = $request->get('deskripsi');
      $data_dompet->status_id = $request->get('status_id');
      $data_dompet->save();

      return redirect('/dompets')->with('success', 'Success Update Data Dompet!');
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
        dompet::where('id','=',$id)
          ->update([
              'status_id'      => 2,
          ]);
      }else{
        dompet::where('id','=',$id)
          ->update([
              'status_id'      => 1,
          ]);
      }
      return redirect('/dompets')->with('success', 'Success Update Status Dompet!');
    }

    /**
     * Filter Data Dompet By Status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterStatus($status_id){
      if($status_id == 0){
        $data_dompet = dompet::all();
      }else{
        $data_dompet = dompet::where('status_id',$status_id)->get();
      }
      return response()->json($data_dompet);
  }
}
