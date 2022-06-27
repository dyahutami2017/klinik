<input name="sts_byr_poli" id="sts_byr_poli" type="hidden" value="{{$nsts}}">
<input name="tot_kasir" id="tot_kasir" type="hidden" value="{{$sts_byr}}">
<form id="formBayarNota" name="formBayarNota" enctype="multipart/form-data">
    @csrf
    <table style="width:100%; font-size:10px; color:#000; font-family:arial; ">
        <tbody>
            <tr class="odd gradeX" style="border-top:1px solid #ABABAB; border-bottom:1px solid #ABABAB;">
                <td colspan="2" class="text-left"><strong>ADMINISTRASI</strong></td>
                <td class="text-right">{{number_format($adm)}}</td>
            </tr>
            @php
                $tot_igd = 0;
                $i = 1;
                $ix = 1;
                $tot_apt = 0; 
                $jm = 1500; 
                $nama_obat = '';
                $tarif_obat = '';
                function BulatKoma($angka){
                    $kelipatan = 100;
                    $sisa = $angka % $kelipatan; 
                    if ($sisa > 0) {
                        $kekurangan = $kelipatan - $sisa;  
                        $hasilBulat = $angka + $kekurangan; 
                    }	
                    else
                        $hasilBulat = $angka;
                    floor($hasilBulat);
                    return $hasilBulat;
                }
            @endphp
            @foreach($reg_igd as $rigd)
                <tr class="odd gradeX">
                    <td colspan="2" class="text-left"><strong>INSTALASI GAWAT DARURAT</strong></td>
                    <td class="text-right"></td>
                </tr>
                <tr class="odd gradeX">
                    <td colspan="2" class="text-left"><strong>DOKTER: {{$rigd->nm_dokter}}</strong></td>
                    <td class="text-right"></td>
                </tr>
                @foreach($q_igd as $rj)
                    @php
                        $sub_igd = $rj->jmlh * ($rj->jasa_sarana+$rj->jasa_pelayanan+$rj->ambhp);
                        if($rj->jmlh > 1)
                            $nama = $rj->nama." (".$rj->jmlh."x)";
                        else
                            $nama = $rj->nama;
                    @endphp
                    <tr class="odd gradeX">
                        <td class="text-center">{{$i}}</td>
                        <td class="text-left">{{$nama}}</td>
                        <td class="text-right">{{number_format($sub_igd)}}</td>
                    </tr>
                    @php
                        $tot_igd = $tot_igd + $sub_igd;	
                        $i++;
                    @endphp
                @endforeach
                @foreach($q_konsul as $rjx)
                    <tr class="odd gradeX">
                        <td class="text-center">K</td>
                        <td class="text-left">KONSULTASI {{$rjx->nm_dokter}}</td>
                        <td class="text-right"></td>
                    </tr>
                @endforeach
                @if($tot_igd > 0)
                    <tr style="border-top:1px solid #ABABAB">
                        <td class="text-center" style="height:20px; width:25px"></td>	
                        <td colspan="0" class="text-left" style="padding:0px; font-family:Arial">Total</td>
                        <td class="text-right" style="font-weight:normal; padding:0px; font-family:Arial">Rp {{number_format(floor(BulatKoma($tot_igd)),0, ',','.')}}</td>				
                    </tr>
                @else
                    <tr style="border-top:1px solid #ABABAB;">
                        <td colspan="3" class="text-center" style="height:20px; width:25px"></td>	
                    </tr>
                @endif
            @endforeach
            @if($q_apt > 0)
            <tr class="odd gradeX">
                <td colspan="2" class="text-left"><strong><br>OBAT</strong></td>
                <td class="text-right"></td>
            </tr>
            <tr class="odd gradeX">
                <td colspan="3" class="text-left">	
                    <input name="tot_apt" id="tot_apt" type="hidden" value="">
                    <table style="width:100%; font-size:10px; font-family:arial; ">
                        <thead>
                            <tr style="border-bottom:1px solid #000">
                                <th class="text-center" style="height:20px">NO.</th>
                                <th class="text-center">Nama Obat</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">SubTotal</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_obat"></tbody>
                    </table>
                </td>
            </tr>
            @endif
            <tr style="border-top:1px solid #ABABAB">
                <td colspan="2" class="text-left" style="padding:0px; font-family:Arial; font-weight:bold; padding-top:10px">
                    <input name="tot_igd" id="tot_igd" type="hidden" value="{{BulatKoma($tot_igd)}}">
                    <input name="g_tot" id="g_tot" type="hidden" value="">
                    <input name="no_kunjungan_nt" id="no_kunjungan_nt" type="hidden" value="">
                    <input name="id_unit_nt" id="id_unit_nt" type="hidden" value="">
                    <input name="cara_bayar_nt" id="cara_bayar_nt" type="hidden" value="">
                    <input name="SaveOk" id="SaveOk" type="hidden" value="1">
                    <input name="tot_adm" id="tot_adm" type="hidden" value="{{$adm}}">
                    GRAND TOTAL</td>
				<td class="text-right grand_tot" style="font-weight:normal; font-weight:bold;  padding-top:10px; font-family:Arial"></td>				
			</tr>
        </tbody>    
    </table>
</form>