<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\transaksi;
use App\dompet;
use App\kategori;

class TransaksiController extends Controller
{
    public function index()
    {
        $data_transaksi = transaksi::with(['dompet','kategori'])->get();
        return view('Transaksi.index', compact('data_transaksi'));
    }

    public function create()
    {
        $dataTransaksi = \DB::table('transaksis')
        ->select(\DB::raw('max(RIGHT(code, 4)) as kode'))
        ->where('status_id',1)
        ->get();

        if($dataTransaksi != null){   
            foreach($dataTransaksi as $key){
                $first = $key->kode + 1; 
            }
        }else{  
            $first = 1;
        }   
        $kode = sprintf('%06d',$first);
        $data_dompet = dompet::where('status_id',1)->orderBy('nama', 'asc')->get();
        $data_kategori = kategori::where('status_id',1)->orderBy('nama', 'asc')->get();
        return view('Transaksi.create', compact('data_kategori','data_dompet','kode'));
    }

    public function store(Request $request){
        $input = $request->all();
        // echo "<pre>";print_r($input);exit;
        transaksi::create([
          'code'         => $input['code'],
          'tanggal'      => $input['tanggal'],
          'deskripsi'    => $input['deskripsi'],
          'kategori_id'  => $input['kategori_id'],
          'dompet_id'    => $input['dompet_id'],
          'nilai'        => $input['nilai'],
          'status_id'    => 1,
        ]);
        return redirect('/transaksis')->with('success', 'Success Save Data Dompet Masuk');
    }

    public function indexDompetKeluar()
    {
        $data_transaksi = transaksi::with(['dompet','kategori'])->where('status_id',2)->get();
        return view('Transaksi.indexDompetKeluar', compact('data_transaksi'));
    }

    public function createDompetKeluar()
    {
        $dataTransaksi = \DB::table('transaksis')
        ->select(\DB::raw('max(RIGHT(code, 4)) as kode'))
        ->where('status_id',2)
        ->get();

        if($dataTransaksi != null){   
            foreach($dataTransaksi as $key){
                $first = $key->kode + 1; 
            }
        }else{  
            $first = 1;
        }   
        $kode = sprintf('%06d',$first);
        $data_dompet = dompet::where('status_id',1)->orderBy('nama', 'asc')->get();
        $data_kategori = kategori::where('status_id',1)->orderBy('nama', 'asc')->get();
        return view('Transaksi.createDompetKeluar', compact('data_kategori','data_dompet','kode'));
    }

    public function storeDompetKeluar(Request $request){
        $input = $request->all();
        // echo "<pre>";print_r($input);exit;
        transaksi::create([
          'code'         => $input['code'],
          'tanggal'      => $input['tanggal'],
          'deskripsi'    => $input['deskripsi'],
          'kategori_id'  => $input['kategori_id'],
          'dompet_id'    => $input['dompet_id'],
          'nilai'        => $input['nilai'],
          'status_id'    => 2,
        ]);
        return redirect('/transaksis/DompetKeluar')->with('success', 'Success Save Data Dompet Masuk');
    }

    public function indexLaporan(){
        $data_dompet = dompet::where('status_id',1)->orderBy('nama', 'asc')->get();
        $data_kategori = kategori::where('status_id',1)->orderBy('nama', 'asc')->get();
        return view('Transaksi.indexLaporan', compact('data_kategori','data_dompet','kode'));
    }

    public function filterLaporan(Request $request){
        $input = $request->all();
        if($input['dompet_id'] == "all" && $input['kategori_id'] == "all"){
            $data_transaksi = transaksi::where('tanggal','>=',$input['tanggal_awal'])
            ->where('tanggal','<=',$input['tanggal_akhir'])
            ->get();
        }else if($input['dompet_id'] == "all"){
            $data_transaksi = transaksi::where('tanggal','>=',$input['tanggal_awal'])
            ->where('tanggal','<=',$input['tanggal_akhir'])
            ->where('kategori_id',$input['kategori_id'])
            ->get();
        }else if($input['kategori_id'] == "all"){
            $data_transaksi = transaksi::where('tanggal','>=',$input['tanggal_awal'])
            ->where('tanggal','<=',$input['tanggal_akhir'])
            ->where('dompet_id',$input['dompet_id'])
            ->get();
        }else{
            $data_transaksi = transaksi::where('tanggal','>=',$input['tanggal_awal'])
            ->where('tanggal','<=',$input['tanggal_akhir'])
            ->where('dompet_id',$input['dompet_id'])
            ->where('kategori_id',$input['kategori_id'])
            ->get();
        }
        // echo "<pre>";print_r($input);exit;
        return view('Transaksi.laporan', compact('data_transaksi'));
    }
}
