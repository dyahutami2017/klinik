<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;

class KasirController extends Controller
{
    public function GetPasien(Request $request){
        if(isset($request->tgl_datang) && $request->tgl_datang != ''){
            $skr = $request->tgl_datang;
        }
        else{
            // $skr = date('Y-m-d');
            $skr = '2021-01-27';
        }
        $data = DB::table('rm_rujukan_internal as ri')->select('rk.no_kunjungan', 'p.lastupdate', 'p.tgl_lahir', 'rk.umur', 'p.no_rm', 'p.nama', 'mj.nama_jaminan', 'mj.inisial','mj.id_model', 'jp.jenispasien', 'd.nm_dokter', 'd.id_dokter',
                'ul.nama_unit', 'ul.inisial as inisial_unit', 'rk.waktu', 'ul.id_unit', 'k.alamat', 'ot.tgl_bayar', 'ri.cara_bayar', 'ot.id_unit as unit_bayar', 'jp.jenispasien')
                ->leftjoin('rm_kunjungan as rk', 'rk.no_kunjungan','=', 'ri.no_kunjungan') 
                ->leftjoin('kasir_ralan as ot', 'ot.no_kunjungan','=','rk.no_kunjungan')
                ->leftjoin('unit_layanan as ul', 'ul.id_unit', '=', 'ri.id_unit') 
                ->leftjoin('dokter as d', 'd.id_dokter', '=', 'ri.id_dokter') 
                ->leftjoin('rm_personal as p', 'p.no_rm', '=', 'rk.no_rm')
                ->leftjoin('jenis_pasien as jp' , 'jp.id' ,'=', 'p.jenis_pasien')
                ->leftjoin('rm_kontak as k' , 'k.no_rm', '=', 'p.no_rm')	
                ->leftjoin('model_jaminan as mj', 'mj.id_model', '=', 'ri.cara_bayar')
                ->where('ri.id_unit','01')
                ->where('rk.waktu','2021-01-27')
                ->whereNotNull('p.nama')
                ->whereNotIn('ri.cara_bayar',['17','8']);
                
                
        if(isset($request->nama) && $request->nama != ''){
            $dtl = $data->where('p.nama', 'like', '%'.$request->nama.'%')->orWhere('p.no_rm', 'like', '%'.$request->nama.'%')->groupBy('rk.no_kunjungan')->limit(100)->get();
        } 
        else{
            $dtl = $data->groupBy('rk.no_kunjungan')->limit(100)->get();
        }

        return Response::json($dtl);
    }

    public function GetHistory(Request $request){
        $data = DB::table('rm_rujukan_internal as ri')
                ->leftjoin('rm_kunjungan as rk', 'rk.no_kunjungan', '=','ri.no_kunjungan')
                ->leftjoin('unit_layanan as ul', 'ul.id_unit', '=','ri.id_unit')
                ->leftjoin('model_jaminan as mj', 'mj.id_model', '=', 'ri.cara_bayar')
                ->where('rk.no_kunjungan', $request->no_kunjungan)
                ->get();

        return Response::json($data);
    }
    public function GetNota(Request $request){
        $kasir = DB::table('kasir_ralan')->where('no_kunjungan', $request->no_kunjungan)->where('id_unit', $request->id_unit);

        $nsts = $kasir->count(); 
        $st = $kasir->first();
        if(!is_null($st)){$sts_byr = $st->total;}
        else{$sts_byr = 0;}

        if(date("Y-m-d", strtotime($request->tgl_reg)) == date("Y-m-d", strtotime($request->tgl_kunjung))) $pendaftaran = "15000";
        else $pendaftaran = "10000";

        $rbill=DB::table('rm_kunjungan as rk')->select('jp','js', 'ambhp')->leftjoin('tarif_adm as ta','ta.id_tarif', '=', 'rk.tarif_billing')
                ->where('no_kunjungan', $request->no_kunjungan)->first();

        $tarif_billing = $rbill->jp + $rbill->js + $rbill->ambhp;

        $adm = $pendaftaran + $tarif_billing;

        $reg_igd = DB::table('igd_register as reg')->select('dok.nm_dokter')
                ->leftjoin('dokter as dok', 'dok.id_dokter', '=', 'reg.id_dokter')
                ->where('reg.no_kunjungan',$request->no_kunjungan)
                ->get();		
                
        $q_igd = DB::table('igd_pakai_tindakan as pt')
                ->leftjoin('tarif_tindakan as tt', 'tt.id_tarif' ,'=', 'pt.id_tindakan')
                ->leftjoin('tindakan as t', 't.id_tindakan' ,'=', 'tt.id_tindakan')
                ->where('pt.no_kunjungan', $request->no_kunjungan)
                ->orderBy('t.nama','asc')
                ->get();
        
        $q_konsul = DB::table('igd_konsul as v')->select('v.waktu', 'd1.nm_dokter', 'v.no_kunjungan', 'v.waktu')
                ->leftjoin('dokter as d1', 'd1.id_dokter', '=', 'v.dokter')
                ->where('v.no_kunjungan', $request->no_kunjungan)
                ->orderBy('v.waktu', 'desc')
                ->get();
        $q_apt = DB::table("obat_transaksi as t")
                ->where("t.no_kunjungan",$request->no_kunjungan)
                ->where("t.id_unit", $request->id_unit)
                ->count();

        return view('kasir.inc.nota', compact(['nsts','sts_byr','adm','reg_igd', 'q_igd', 'q_konsul','q_apt']));
    }

    public function GetNotaObat(Request $request){
        $result = DB::table("obat_transaksi_detail as td") 
                    ->select("o.nama","hrg.hrg_resep","td.jumlah")
                    ->leftjoin("obat_transaksi as t","t.id_transaksi", "=", "td.id_transaksi")
                    ->leftjoin("obat_hrg as hrg","hrg.id_hrg", "=", "td.id_obat")
                    ->leftjoin("obat as o","o.id_obat", "=", "hrg.id_obat")
                ->where("t.no_kunjungan",$request->no_kunjungan)
                ->where("t.id_unit",$request->id_unit)
                ->whereNotNull("o.id_obat")
                ->get();

        return Response::json($result);
    }

    public function GetListObat(Request $request){
        if(isset($request->key)){
			$qj= DB::table("obat as o")
            ->leftJoin("obat_hrg as hrg", function($join){
                $join->on("hrg.id_obat", "=", "o.id_obat");
            })
            ->leftJoin("obat_stock as stk", function($join){
                $join->on("stk.id_obat", "=", "o.id_obat")
                ->whereYear('stk.tgl_stok', date('Y'))
                ->whereMonth('stk.tgl_stok', date('m'));
            })
            ->select("o.nama", "stk.stok_akhir", "hrg.id_hrg", "o.id_obat", "hrg.hrg_resep", "o.indikasi")
            ->where("o.nama", "like", '%'.$request->key.'%')
            ->where("o.status_obat", "=", 'A')
            ->where("hrg.status_hrg", "=", 'A')
            ->limit(100)
            ->orderBy("o.nama","asc")
            ->get();
        }
		else{
        $qj= DB::table("obat as o")
            ->leftJoin("obat_hrg as hrg", function($join){
                $join->on("hrg.id_obat", "=", "o.id_obat");
            })
            ->leftJoin("obat_stock as stk", function($join){
                $join->on("stk.id_obat", "=", "o.id_obat")
                ->whereYear('stk.tgl_stok', date('Y'))
                ->whereMonth('stk.tgl_stok', date('m'));
            })
            ->select("o.nama", "stk.stok_akhir", "hrg.id_hrg", "o.id_obat", "hrg.hrg_resep", "o.indikasi")
            ->where("o.status_obat", "=", 'A')
            ->where("hrg.status_hrg", "=", 'A')
            ->limit(100)
            ->orderBy("o.nama","asc")
            ->get();
        }
        return Response::json($qj);
    }

    public function PostTransaksi(Request $request){
        if(isset($request->SaveOk)){
            $no_kunjungan 	= $request->no_kunjungan_nt;
            $id_unit	 	= $request->id_unit_nt;
            $id_user		= '01';
            $total			= $request->g_tot;
            $iur			= 0;
            $total_adm		= $request->tot_adm;
            $cara_bayar		= $request->cara_bayar_nt;
            $tgl_bayar		= date("Y-m-d");
            $ck_kasir = DB::table('kasir_ralan')->where('no_kunjungan', $no_kunjungan)->where('id_unit',$id_unit)->get();
            if(count($ck_kasir) < 1){
                DB::table('kasir_ralan')->insert([
                    "no_kunjungan" => $no_kunjungan,
                    "id_unit" => $id_unit, 
                    "id_user" => $id_user, 
                    "total" => $total, 
                    "tgl_bayar" => $tgl_bayar, 
                    "tagihan" => $iur, 
                    "cara_bayar" => $cara_bayar
                ]);            }
            else{
                DB::table('kasir_ralan')->where('no_kunjungan', $no_kunjungan)->where('id_unit',$id_unit)->update([
                    "id_user" => $id_user, 
                    "total" => $total, 
                    "tgl_bayar" => $tgl_bayar, 
                    "tagihan" => $iur, 
                    "cara_bayar" => $cara_bayar
                ]);    
            }
            
            $ck_adm = DB::table('kasir_ralan_adm')->where('no_kunjungan', $no_kunjungan)->get();
            if(count($ck_adm) < 1){
                DB::table('kasir_ralan_adm')->insert([
                    "no_kunjungan" => $no_kunjungan,
                    "total" => $total_adm
                ]);
            }
            else{
                DB::table('kasir_ralan_adm')->where('no_kunjungan', $no_kunjungan)->update([
                    "total" => $total_adm
                ]);
            }
        }
    }

    public function PostTransaksiObat(Request $request){
        $no_kunjungan 	= $request->no_kunjungan;
        $id_unit 		= $request->id_unit;
        $cara_bayar 	= $request->cara_bayar;
        $id_obat 	    = $request->id_obat;
        $id_hrg 	    = $request->id_hrg;
        $qty 	        = $request->qty;
        $id_user 		= "1";
        $no_trans       = "";
        if(isset($request->tgl_transaksi) && $request->tgl_transaksi!=""){
            $skr = date("Y-m-d H:i:s", strtotime($request->tgl_transaksi));
            $skrx = date("Y-m-d", strtotime($request->tgl_transaksi));
        }
        else{
            $skr = date("Y-m-d H:i:s");
            $skrx = date("Y-m-d");
        }
        $crm = DB::table('obat_transaksi')->where('no_kunjungan', $no_kunjungan)->where('id_unit',$id_unit);
        if($crm->count() > 0){
            $id_t = $crm->first();
            $id_order = DB::table('obat_transaksi_detail')->insertGetId([
                "id_transaksi" => $id_t->id_transaksi,
                "id_obat" => $id_obat,
                "jumlah" => $qty,
                "jumlah_jkn" => $qty,
                "cara_bayar" => $cara_bayar
            ]);
            $id_transaksi = $id_t->id_transaksi;
        }
        else{
            $id_transaksi = DB::table('obat_transaksi')->insertGetId([
                "no_kunjungan" => $no_kunjungan, 
                "id_unit" => $id_unit, 
                "waktu" => $skr,
                "id_user" => $id_user,
                "jenis_transaksi" => "R"
            ]);
    
            $id_order = DB::table('obat_transaksi_detail')->insertGetId([
                "id_transaksi" => $id_transaksi,
                "id_obat" => $id_obat,
                "jumlah" => $qty,
                "jumlah_jkn" => $qty,
                "cara_bayar" => $cara_bayar
            ]);
            DB::table('obat_transaksi_tmp')->insert([
                "id_transaksi" => $id_transaksi, 
                "no_kunjungan" => $no_kunjungan, 
                "id_unit" => $id_unit, 
                "waktu" => $skr,
                "id_user" => "1",
                "jenis_transaksi" => "R"
            ]);
        }
                
        DB::table('obat_transaksi_detail_tmp')->insertGetId([
            "id_transaksi" => $id_transaksi,
            "id_obat" => $id_obat,
            "jumlah" => $qty,
            "jumlah_jkn" => $qty,
            "cara_bayar" => $cara_bayar
        ]);
        DB::table('obat_transaksi_lengkap')->insert([
            "id_order" => $id_order, 
            "no_kunjungan" => $no_kunjungan, 
            "id_unit" => $id_unit, 
            "id_hrg" => $id_hrg, 
            "jumlah" => $qty, 
            "jumlah_jkn" => $qty,
            "jenis_transaksi" => "H", 
            "sts_transaksi" => "W", 
            "tgl_transaksi" => $skr, 
            "cara_bayar" => $cara_bayar
        ]);

        $m_stk 			= date("m", strtotime($skr)); 
		$y_stk 			= date("Y", strtotime($skr)); 
        $ceks = DB::table('obat_stock')->where('id_obat', $id_obat)->whereYear('tgl_stok', $y_stk)->whereMonth('tgl_stok',$m_stk);
        $rrs= $ceks->first();    
        if($ceks->count() > 0){
            $tgl_ed = date("Y-m-d", strtotime($rrs->tgl_ed));
            $stok_awal = $rrs->stok_akhir;
            $id_satuan = $rrs->id_satuan;
            $pengeluaran_tot = $rrs->pengeluaran + $qty;
            $stk_akhir = $stok_awal - $qty;
            DB::table('obat_stock')->where('id_obat',$id_obat)->whereYear('tgl_stok', $y_stk)->whereMonth('tgl_stok',$m_stk)->update([
                'stok_akhir' => $stk_akhir, 
                'pengeluaran' => $pengeluaran_tot,
                'id_satuan' => $id_satuan, 
                'tgl_ed' => $tgl_ed, 
            ]);    
        }
        else{
            $ceks = DB::table('obat_stock')->where('id_obat', $id_obat)->orderBy('tgl_stok', 'desc')->limit(1);
            $rrs= $ceks->first();    
            $tgl_ed = date("Y-m-d", strtotime($rrs->tgl_ed));
            $stok_awal = $rrs->stok_akhir;
            $id_satuan = $rrs->id_satuan;
            $pengeluaran_tot = $rrs->pengeluaran + $qty;
            $stk_akhir = $stok_awal - $qty;
            DB::table('obat_stock')->insert([
                'id_obat' => $id_obat,
                'stok_awal' => $stok_awal, 
                'stok_akhir' => $stk_akhir, 
                'pengeluaran' => $pengeluaran_tot,
                'id_satuan' => $id_satuan, 
                'tgl_ed' => $tgl_ed, 
                'tgl_stok' => $skr
            ]);  
        }
    }
}
