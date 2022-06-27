@extends('layout/layout')

@section('content')
<div class="row">																				
    <div class=" col-3">
        <input type="date" class="btn btn-primary btn-rounded btn-custom btn-block waves-effect waves-light col-7" style="color:#FFF; font-size:14px" value="{{date('Y-m-d')}}" id="tgl_datang" name="tgl_datang" required>
        
        <button type="button" id="list_pasien" class="btn btn-primary waves-light waves-effect" alt="List Pasien"><i class="mdi mdi-account-multiple" style="font-size:16px"></i></button>
        <button type="button" id="btn_dashboard" class="btn btn-primary waves-light waves-effect" alt="Dashboard"><i class="mdi mdi-home" style="font-size:16px"></i></button>
        <div class="row">
            <div class="col-12">
                <input type="text" class="form-control mb-2" autocomplete="off" style="padding-bottom:8px; height:30px; color:#000; font-size:14px; margin-top:5px" placeholder="Nama/No.RM" value="" id="cari_nama" name="cari_nama" required>
            </div>
        </div>
        <div class="mail-list mt-3">
            <div>
                <table id="tbl_pasien" class="table" style="font-family:Arial; font-size:11px; color:#000000">
                    <thead>
                        <tr>
                            <th class="text-center" style="color:#000000; padding:5px; width:45px">STS</th>
                            <th class="text-center" style="color:#000000; padding:5px; width:55px">NO.RM.</th>
                            <th class="text-left" style="color:#000000; padding:5px">Nama Pasien</th>
                        </tr>
                    </thead>
                    <tbody align="center" style="font-family:Arial; font-size:11px; color:#000000" id="div_riwayat_kunjungan">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-9" id="dashboard_medis" style="display:none">
        <div class="card mt-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-9 col-xl-9 border-right">
                        <div class="card shadow-none mb-0 ">
                            <div class="card-body text-center">   
                                <img src="{{asset('icon/kasir.png')}}" alt="logo-small" class="logo-sm" style="width:115px; height:115px; margin-bottom:6px; margin-top:50px">
                                <br>
                                <span style="margin-top:0px; color:#000000; font-size:44px">SISTEM INFORMASI KASIR</span> <BR>
                            </div>
                        </div>                                       
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3">                                        
                        <div class="card mb-0 overview shadow-none">
                            <div class="card-body border-bottom">
                                <div class="">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <div class="overview-content">
                                                <i class="mdi mdi-share-variant  text-success"></i>
                                            </div>                                                            
                                        </div> 
                                        <div class="col-8 text-right">
                                            <p class="text-muted font-13 mb-0">Pasien Hari Ini</p>
                                            <h4 class="mb-0 font-20" id="ps_hari_ini">-</h4>
                                        </div>                                                                                                   
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-bottom">
                                <div class="">
                                    <div class="row  align-items-center">
                                        <div class="col-4">
                                            <div class="overview-content">
                                                <i class="mdi mdi-gesture-double-tap  text-purple"></i>
                                            </div>                                                            
                                        </div> 
                                        <div class="col-8 text-right">
                                            <p class="text-muted font-13 mb-0">Terbayar Hari ini</p>
                                            <h4 class="mb-0 font-20" id="ps_terlayani">-</h4>
                                        </div>                                                                                                    
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-bottom">
                                <div class="">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <div class="overview-content">
                                                <i class="mdi mdi-earth text-warning"></i>
                                            </div>                                                            
                                        </div> 
                                        <div class="col-8 text-right">
                                            <p class="text-muted font-13 mb-0">Terbayar Bulan Ini</p>
                                            <h4 class="mb-0 font-20" id="ps_bulan_ini">-</h4>
                                        </div>                             
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <div class="row  align-items-center">
                                        <div class="col-4">
                                            <div class="overview-content">
                                                <i class="mdi mdi-access-point text-pink"></i>
                                            </div>                                                            
                                        </div> 
                                        <div class="col-8 text-right">
                                            <p class="text-muted font-13 mb-0">Terbayar Tahun Ini</p>
                                            <h4 class="mb-0 font-20" id="ps_tahun_ini">-</h4>                                                            
                                        </div>
                                        <div class="col-12">
                                            <div class="progress mt-4" style="height:6px;">
                                                <div class="progress-bar progress-animated bg-pink" role="progressbar" style="max-width: 85%; border-radius:5px;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>                                  
                                    </div>                                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <div class="col-6">
        <div id="div_loading" class="text-center" style="height:700px; width:100%; padding-top:200px;"><img src="{{asset('loading_new.gif')}}" width="100" /></div>
        <!-- Dashboard Medis -->
        <div class="btn-toolbar" role="toolbar" id="tool_bar" style="display:none">
            <div class="btn-group">
                <button id="btn_warning" type="button" class="btn btn-light waves-light waves-effect"><i class="fas fa-inbox"></i></button>
                <button id="btn_setting" type="button" class="btn btn-light waves-light waves-effect"><i class="mdi mdi-settings"></i></button>
                <button id="btn_hapus" type="button" class="btn btn-light waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
            </div>
            <div class="btn-group ml-1">
                <button type="button" class="btn btn-light waves-light waves-effect" id="print_preview">
                    <i class="mdi mdi-printer"></i>
                </button>
            </div>

            <!-- <div class="btn-group ml-1">
                <button type="button" class="btn btn-light waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Transaksi Penunjang
                </button>
                <div class="dropdown-menu" style="background-color: #ABABAB">
                    <a class="dropdown-item" data-toggle="modal" data-animation="bounce" id="input_lab" data-target=".modal_add_lab" href="#">Laboratorium</a>
                    <a class="dropdown-item" data-toggle="modal" data-animation="bounce" id="input_radio" data-target=".modal_add_rad" href="#">Radiologi</a>
                    <a class="dropdown-item" data-toggle="modal" data-animation="bounce" id="input_fisio" data-target=".input_fisio" href="#">Fisioterapi</a>
                </div>
            </div> -->
            <div class="btn-group ml-1">
                <button class="btn btn-pink" style="width:80px" data-toggle="modal" data-animation="bounce" data-target=".modal_add_billing_obat" id="AddObat" type="button"><i class="fa fa-plus"></i> Obat</button>   
            </div>
            <!-- <div class="btn-group ml-1">
                <button class="btn btn-pink" style="width:80px" data-toggle="modal" data-animation="bounce" data-target=".modal_add_billing_paket" id="AddBillingPaket" type="button"><i class="fa fa-plus"></i> Paket</button>   
            </div>
            <div class="btn-group ml-1">
                <button class="btn btn-primary" style="width:100px" data-toggle="modal" data-animation="bounce" data-target=".modalchangeJaminan" id="changeJaminan" type="button"><i class="mdi mdi-cast"></i> Jaminan</button>   
            </div> -->
            
            
        </div>
        <!-- Transksi Poliklinik -->
        <div class="card mt-4" id="div_asesmen_medis" style="display:none">
            <input name="no_kunjungan_kasir" id="no_kunjungan_kasir" type="hidden" value="">
            <input name="no_rm" id="no_rm" type="hidden" value="">
            <input name="tgl_reg" id="tgl_reg" type="hidden" value="">
            <input name="id_unit_kasir" id="id_unit_kasir" type="hidden" value="">
            <input name="tgl_kunjung" id="tgl_kunjung" type="hidden" value="">
            <input name="waktu" id="waktu" type="hidden" value="">
            <input name="cara_bayar" id="cara_bayar" type="hidden" value="">
            <input name="model_jaminan" id="model_jaminan" type="hidden" value="">
            <input name="tgl_masuk" id="tgl_masuk" type="hidden" value="">
            <input name="tgl_keluar" id="tgl_keluar" type="hidden" value="">
            <input name="kelas" id="kelas" type="hidden" value="">
            <input name="waktu_transaksi" id="waktu_transaksi" type="hidden" value="{{ date('Y-m-d H:i:s')}}">
            <div class="card-body">
                <div class="row" id="div_dt_pasien">
                    <div class="col-md-12" style=" margin-top:-15px; margin-left:0px; border-bottom:1px solid #000;">
                        <label style="font-weight:bold; font-size:16px; color:#000000; margin-bottom:0px;" id="nm_pasien">DT Pasien</label><br>
                        <label style="font-size:12px; color:#000000;" id="dt_pasien">DT Pasien</label>
                    </div>
                </div>
                <div class="poli">
                    
                    <div id="tbl_poli1"></div>
                    <!-- <div id="tbl_tindakan"></div> -->
                </div>
                <form style="">										
                    <BR>
                    <div class="row" id="form_bayar" hidden>
                        <div class="col-sm-6">
                            <div class="form-group">											
                                <label class="control-label">Tagihan</label>
                                <div>
                                    <input type="text" id="t_gtot" name="t_gtot" class="form-control" data-horizontal="top" data-theme="theme" value="" readonly>	
                                </div>
                            </div>
                        </div>
                    </div>	
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group btn-act">
                                <div>
                                    <button type="button" id="ByrPoli" class="btn btn-danger" style="width:125px;dispaly:none">BAYAR</button>	
                                    <button type="button" id="PrintPoli" class="btn btn-primary" style="width:125px;dispaly:none">PRINT</button>	
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div>
                                    
                                </div>
                            </div>
                        </div>	
                    </div>
                </form>	
            </div>

        </div>
    </div>
    <div class="col-3" id="div_history_kunjungan" style="display:none">
        <div style="background-color:#000; color:#fff; text-align:center; height:40px; padding-top:10px">
            HISTORY KUNJUNGAN
        </div>
        <div id="history_kunjungan">
            <table id="tbl_pasien" class="table" style="font-family:Arial; font-size:11px; color:#000000">
                <thead>
                    <tr>
                        <th class="text-center" style="color:#000000; padding:5px; width:45px">NO</th>
                        <th class="text-center" style="color:#000000; padding:5px;">TGL</th>
                        <th class="text-left" style="color:#000000; padding:5px; ">CARA BAYAR</th>
                        <th class="text-center" style="color:#000000; padding:5px; width:25px">ACT</th>
                    </tr>
                </thead>
                <tbody align="center" style="font-family:Arial; font-size:11px; color:#000000" id="tbl_history">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Print ALL -->
<div class="modal" id="print_all" tabindex="-1" data-width="400">
    <div class="modal-dialog" style="width:400px" >
        <div class="modal-content" >
            <div class="modal-header">
                <a class="icon-toolsbar" style="font-size:18px; color:#000" href="#"  id="BtnPrintPoli"><i class="fa fa-print"></i> </a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //modal-header-->
                <div class="panel-body">
                    <form id="PrintTargetPoli">
                        <div style="width:360px">
                            <!-- <h5 class="control-label" style="text-align:center; font-family:arial; font-size:10px;">KLINIK dr. Harwidagdo</h5> -->
                            <!-- <h6 class="control-label" style="text-align:center; border-bottom:solid #ababab 2px; padding-bottom:5px; font-family:arial; font-size:10px; ">JL Yogya-Solo, Km.14, Kalasan, Yogyakarta, TLP.:(0274) 498278</h6> -->
                            <div class=" divPrintLeft">
                                <table style="font-size:10px; font-family:'Arial'; width:360px"  border="0" cellspacing="0" cellpadding="0">															  
                                    <tr>
                                        <td colspan="6" align="center" style="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" align="center" style="font-size:10px; font-weight:bold; font-family:'Arial'; padding-top:8px; padding-bottom:8px">SLIP PEMBAYARAN POLI KLINIK</td>
                                    </tr>
                                                            
                                    <tr>
                                        <td width="74">No. RM</td>
                                        <td>:</td>
                                        <td class="kasir_norm"></td>
                                        <td width="35" align="left">NO.</td>
                                        <td width="9" align="left">:</td>
                                        <td width="234" align="left" class="kasir_nokunjungan"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama/Umur</td>
                                        <td>:</td>
                                        <td colspan="4" class="kasir_nama"></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Pasien</td>
                                        <td width="15">:</td>
                                        <td width="251" class="kasir_jp"></td>
                                        <td width="35" align="left">TGL.</td>
                                        <td width="9" align="left">:</td>
                                        <td align="left" class="kasir_waktu"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" >Cara Bayar</td>
                                        <td valign="top" >:</td>
                                        <td class="kasir_cb"></td>
                                        <td width="35" align="left"></td>
                                        <td width="9" align="left"></td>
                                        <td align="left"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" >Alamat</td>
                                        <td valign="top" >:</td>
                                        <td height="15" colspan="4" class="kasir_alamat"></td>
                                    </tr>
                                </table>
                                <div id="tbl_nota_all"></div>
                            </div>
                        </div>
                    </form>
                </div>   
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 <!-- Modal Add Billing Poli -->
<div class="modal modal_add_billing_obat" id="ModalAddBiilingObat" tabindex="-1">
    <div class="modal-dialog modal-lg" style="max-width: 80% !important">
        <div class="modal-content">
            <div class="modal-header">
                <a class="icon-toolsbar" style="font-size:18px; color:#000" href="#">FORM INPUT OBAT</a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_billing_poli">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //modal-header-->
                <div class="panel-body" >
                    <form name="FormInputObat" id="FormInputObat" action="#">
                        <div class="form-row">
                            <div class="col-12 showObat" style="">
                                <h3 style="margin-top:10px">Data Obat</h3>	
                                <div id="div_input_tindakan">
                                        <table style="width:100%; font-size:14px; font-family:arial; ">
                                            <thead>
                                                <tr style="border-bottom:1px solid #000">
                                                    <th class="text-center" style="height:20px">NO.</th>
                                                    <th class="text-center">Nama Obat</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-center">SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_tindakan_obat"></tbody>
                                        </table>
                                    <br>
                                    <a href="#" id="InputObat" class="btn btn-primary btn-transparent"><i class="fa fa-plus"></i> Input Obat</a>
                                    <br>
                                    
                                </div>
                            </div>
                            <div class="col-12" id="addTindakanObat" style="display:none">
                                <div class="form-row">
                                    <button type="button" class="btn btn-warning col-1" id="btlAddTindakan"><i class="fa fa-arrow-left"></i> Batal</button>
                                    <div class="col-7">
                                        <input type="text" class="form-control rounded" id="BtnSrcTindakan" name="BtnSrcTindakan" placeholder="Cari Tindakan" />                                                                                    
                                    </div>
                                </div>
                                <br>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Act</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Nama Obat</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Harga</th>				
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_add_tindakan_obat">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>   
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout( "$('#div_loading').hide()", 1000 );
        setTimeout(data_dashboard, 1000 );
        function data_dashboard(){
            $("#dashboard_medis").show();
        }
        function swal(ikon,kata,judul){
            Swal.fire({
                type: ikon,
                title: judul,
                text: kata,
                showConfirmButton: false,
                timer: 1500
            })
        }
        function formatNumber( num, fixed ) { 
            var decimalPart;

            var array = Math.floor(num).toString().split('');
            var index = -3; 
            while ( array.length + index > 0 ) { 
                array.splice( index, 0, '.' );              
                index -= 4;
            }

            if(fixed > 0){
                decimalPart = num.toFixed(fixed).split(".")[1];
                return array.join('') + "," + decimalPart; 
            }
            return array.join(''); 
        };
        function BulatKoma(angka){
            var kelipatan = 100;
            var sisa = angka % kelipatan; 
            if (sisa > 0) {
                kekurangan = kelipatan - sisa;  
                hasilBulat = angka + kekurangan; 
            }	
            else
                hasilBulat = angka;
                Math.floor(hasilBulat);
            return hasilBulat;
        }
        function ListPasien(tgl){
            $("#div_riwayat_kunjungan").html("<tr><td colspan=3><img src='{{asset('loading_new.gif')}}' width='70' /></td></tr>")
            $.ajax({ 
                url: "/kasir/get_pasien_ralan",
                type: "get",
                data: "tgl_datang="+tgl,
                success:function(response){ 
                    var listItems = '';
                    var nums = 1;
                    $.each(response, function(i) {
                        if(response[i].tgl_bayar != "" && response[i].tgl_bayar != null) var sts = '<div class="circle_div_bill">B</div>';
                        else var sts = '<div class="circle_div">W</div>';
                        listItems += '<tr style="cursor:pointer;" nama="'+response[i].nama+'" jenis_pasien="'+response[i].jenispasien+'" id_dokter="'+response[i].id_dokter+'" nm_dokter="'+response[i].nm_dokter+'" nama_unit="'+response[i].nama_unit+'" tgl_reg="'+response[i].lastupdate+'" no_kun="'+response[i].no_kunjungan+'" no_rm="'+response[i].no_rm+'" id_unit="'+response[i].id_unit+'" tgl_lahir="'+response[i].tgl_lahir+'" alamat="'+response[i].alamat+'" nama_jaminan="'+response[i].nama_jaminan+'" waktu_t="'+response[i].waktu+'" waktu="" umur="'+response[i].umur+'" cara_bayar="'+response[i].cara_bayar+'" model_jaminan="'+response[i].id_model+'" >';																																									
                        listItems += '<td class="center"  style="color:#000000; padding:5px">'+sts+'</td>';
                        listItems += '<td row_id="'+nums+'" style="color:#000000; padding:5px">'+response[i].no_rm+'</td>';
                        listItems += '<td class="text-left"  style="color:#000000; padding:5px">'+response[i].nama+'<span class="badge badge-info badge-pill float-right">'+response[i].inisial+'</span></td>';	
                        listItems += '</tr>';
                        nums++;
                    })
                    $("#div_riwayat_kunjungan").html(listItems);
                    $("#div_riwayat_kunjungan").show();
                    $("#div_asesmen_medis").hide();
                },
                error: function (ts) {
                    console.log(ts)
                    alert('Error'+ts.responseText)
                }
            });
        }
        ListPasien($("#tgl_datang").val());
        $("#tgl_datang").on('change', function(e){
            ListPasien($(this).val());
        })
        $("#cari_nama").on('change', function(e){
            $("#div_riwayat_kunjungan").html("<tr><td colspan=3><img src='{{asset('loading_new.gif')}}' width='70' /></td></tr>")
            $.ajax({ 
                url: "/kasir/get_pasien_ralan",
                type: "get",
                data: "nama="+$("#cari_nama").val(),
                success:function(response){ 
                    var listItems = '';
                    var nums = 1;
                    $.each(response, function(i) {
                        if(response[i].tgl_bayar != "" && response[i].tgl_bayar != null) var sts = '<div class="circle_div_bill">B</div>';
                        else var sts = '<div class="circle_div">W</div>';
                        listItems += '<tr style="cursor:pointer;" nama="'+response[i].nama+'" jenis_pasien="'+response[i].jenispasien+'" id_dokter="'+response[i].id_dokter+'" nm_dokter="'+response[i].nm_dokter+'" nama_unit="'+response[i].nama_unit+'" tgl_reg="'+response[i].lastupdate+'" no_kun="'+response[i].no_kunjungan+'" no_rm="'+response[i].no_rm+'" id_unit="'+response[i].id_unit+'" tgl_lahir="'+response[i].tgl_lahir+'" alamat="'+response[i].alamat+'" nama_jaminan="'+response[i].nama_jaminan+'" waktu_t="'+response[i].waktu+'" waktu="" umur="'+response[i].umur+'" cara_bayar="'+response[i].cara_bayar+'" model_jaminan="'+response[i].id_model+'" >';																																									
                        listItems += '<td class="center"  style="color:#000000; padding:5px">'+sts+'</td>';
                        listItems += '<td row_id="'+nums+'" style="color:#000000; padding:5px">'+response[i].no_rm+'</td>';
                        listItems += '<td class="text-left"  style="color:#000000; padding:5px">'+response[i].nama+'<span class="badge badge-info badge-pill float-right">'+response[i].inisial+'</span></td>';	
                        listItems += '</tr>';
                        nums++;
                    })
                    $("#div_riwayat_kunjungan").html(listItems);
                    $("#div_riwayat_kunjungan").show();
                    $("#div_asesmen_medis").show();
                },
                error: function (ts) {
                    console.log(ts)
                    alert('Error'+ts.responseText)
                }
            });
        })
        $(document).on('click', '#tbl_pasien tr', function(e){
            $("#tbl_poli1").html("<img src='{{asset('loading_new.gif')}}' width='100' />")
            $(".btn-act").hide();
            var no_rm = $(this).attr('no_rm');
            var nama = $(this).attr('nama');
            var nama_jaminan = $(this).attr('nama_jaminan');
            var umur = parseInt($(this).attr('umur'))/365;
            var alamat = $(this).attr('alamat');
            var no_kun = $(this).attr('no_kun');
            var tgl_reg = $(this).attr('tgl_reg');
            var waktu_t = $(this).attr('waktu_t');
            var cara_bayar = $(this).attr('cara_bayar');
            var model_jaminan = $(this).attr('model_jaminan');
            var id_unit = $(this).attr('id_unit');
            var jenis_pasien = $(this).attr('jenis_pasien');
            $("#div_asesmen_medis").show();  
            $("#div_history_kunjungan").show();  
            $("#history_kunjungan").hide();  
            $("#dashboard_medis").hide();
            $(".btn-toolbar").show();
            $("#no_kunjungan_kasir").val(no_kun);
            $("#id_unit_kasir").val(id_unit);
            $("#cara_bayar").val(cara_bayar);
            $("#tgl_reg").val(tgl_reg);
            $("#no_rm").val(no_rm);
            $("#tgl_kunjung").val(waktu_t);
            $("#model_jaminan").val(model_jaminan);
            $("#nm_pasien").html(no_rm+' - '+nama+' - '+nama_jaminan);
            $("#dt_pasien").html(umur.toFixed(0)+' TAHUN - '+alamat); 
            $(".kasir_norm").html(no_rm);
            $(".kasir_nokunjungan").html('#'+no_kun);
            $(".kasir_nama").html(nama+"/"+umur.toFixed(0)+' Tahun');
            $(".kasir_jp").html(jenis_pasien);
            $(".kasir_cb").html(nama_jaminan);
            $(".kasir_waktu").html(waktu_t);
            $(".kasir_alamat").html(alamat);
            $.ajax({
                url: "/kasir/nota_ralan_all",
                type: "get",
                data: "no_kunjungan="+no_kun+'&tgl_reg='+tgl_reg+'&tgl_kunjung='+waktu_t+'&cara_bayar='+cara_bayar+'&model_jaminan='+model_jaminan+'&id_unit='+id_unit,
                success:function(retval){ 
                    $(".btn-act").show();
                    $("#tbl_nota_all").html(retval);
                    $("#tbl_poli1").html(retval);
                    $("#t_gtot").val(($("#g_tot").val()));
                    $("#no_kunjungan_nt").val(no_kun);
                    $("#id_unit_nt").val(id_unit);
                    $("#cara_bayar_nt").val(cara_bayar);
                    
                }
            });
            $.ajax({
                url: '/kasir/get_history_kunjungan',
                type: 'GET',
                data: "no_kunjungan="+no_kun,
                success: function (response) {
                    var listItems = '';
                    var nums = 1;
                    $.each(response, function(i) {
                        listItems +='<tr style="cursor:pointer;" no_kun="'+response[i].no_kunjungan+'">';																																										
                        listItems +='<td class="center"  style="color:#000000; padding:5px">'+nums+'</td>';
                        listItems +='<td class="center"  style="color:#000000; padding:5px">'+$.format.date(response[i].waktu + "00:00:00", "dd MMM yyyy")+'</td>';
                        listItems +='<td class="text-left" row_id="'+nums+'" style="color:#000000; padding:5px">'+response[i].nama_jaminan+'</td>';
                        listItems +='<td class="text-center"  style="color:#000000; padding:5px">x</td>';
                        listItems +='</tr>';
                        nums++;
                    })
                    $("#tbl_history").html(listItems);
                    $("#history_kunjungan").show();
                    $("#div_history_kunjungan").show();
                },
                error: function (ts) {
                    console.log(ts)
                    alert(ts.responseText)
                }
            });
            $.ajax({ 
                url: "/kasir/get_obat",
                type: "get",
                data: "no_kunjungan="+no_kun+"&id_unit="+id_unit,
                success:function(response){ 
                    var listItems = '';
                    var nums = 1;
                    var g_tot = 0;
                    var tot_apt = 0;
                    var tot_igd = 0;
                    var jm = 1500;
                    $.each(response, function(i) {
                        var total = (response[i].hrg_resep * (response[i].jumlah)) + jm;
                        tot_apt = tot_apt + total;
                        var hrg = total/response[i].jumlah;
                        listItems += '<tr>';
                        listItems += '<td class="text-center" style="height:0px; padding-left:4px; height:15px">'+nums+'</td>';
                        listItems += '<td class="text-left" style="padding-left:4px">'+response[i].nama+'</td>';
                        listItems += '<td class="text-right" style="padding-right:4px">'+formatNumber( hrg, 0 )+'</td>';
                        listItems += '<td class="text-center" style="padding-left:0px">'+response[i].jumlah+'</td>';
                        listItems += '<td class="text-right" style="padding-right:4px">'+formatNumber( total, 0 )+'</td>';
                        listItems += '</tr>';
                        nums++;
                    })
                    listItems += '<tr style="border-top:1px solid #ABABAB">';
                    listItems += '<td colspan="4" class="text-center" style="padding:4px; font-family:Arial">Total</td>';
                    listItems += '<td class="text-right" style="font-weight:normal; padding:4px; font-family:Arial">'+formatNumber( tot_apt, 0 )+'</td>';				
                    listItems += '</tr>';
                    $("#tbl_nota_all #tbl_obat").html(listItems);
                    $("#tbl_poli1 #tbl_obat").html(listItems);
                    $("#tot_apt").val(tot_apt);
                    var tot_igd = $("#tot_igd").val();
                    g_tot = BulatKoma(parseInt(tot_apt) + parseInt(tot_igd));
                    $("#g_tot").val(g_tot);
                    $(".grand_tot").html('Rp.' + formatNumber(g_tot,0));
                    if($("#sts_byr_poli").val() != 0 && ($("#tot_kasir").val() == $("#g_tot").val())){
                        $("#PrintPoli").show();
                        $("#ByrPoli").hide();
                    }
                    else{
                        $("#PrintPoli").hide();
                        $("#ByrPoli").show();
                    }

                },
                error: function (ts) {
                    console.log(ts)
                    alert('Error'+ts.responseText)
                }
            });
            
        })
        $("#print_preview").on("click", function(event){
            var no_kun = $("#no_kunjungan_kasir").val();	
            var tgl_reg = $("#tgl_reg").val();	
            var waktu = $("#tgl_kunjung").val();	
            var cara_bayar = $("#cara_bayar").val();	
            var model_jaminan = $("#model_jaminan").val();	
            var id_unit = $("#id_unit_kasir").val();
            $("#print_all").modal('show');
        });

        $("#ByrPoli").on("click", function(event){		
            $(this).hide();	
            $("#form_bayar").hide();
            $("#PrintPoli").show();
            let myform = document.getElementById("formBayarNota");
            let fd = new FormData(myform);
            $.ajax({
                url: "/kasir/transaksi_q",
                type: "POST",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success:function(retval){ 
                    swal('success','Berhasil tersimpan dan terbayar', 'Proses Berhasil !')
                },
                error: function() {
                    swal('error','Proses gagal dan tidak tersimpan', 'Proses Gagal !')
                }				
            });
            event.preventDefault();
            var data=$(this).data();
        });
        $("#PrintPoli").on("click", function(event){
            $("#print_all").modal("show")
        });

        function listObat(){
            $.ajax({ 
                url: "/kasir/get_obat",
                type: "get",
                data: "no_kunjungan="+$("#no_kunjungan_kasir").val()+"&id_unit="+$("#id_unit_kasir").val(),
                success:function(response){ 
                    var listItems = '';
                    var nums = 1;
                    var tot_apt = 0;
                    var jm = 1500;
                    $.each(response, function(i) {
                        var total = (response[i].hrg_resep * (response[i].jumlah)) + jm;
                        tot_apt = tot_apt + total;
                        var hrg = total/response[i].jumlah;
                        listItems += '<tr>';
                        listItems += '<td class="text-center" style="height:0px; padding-left:4px; height:15px">'+nums+'</td>';
                        listItems += '<td class="text-left" style="padding-left:4px">'+response[i].nama+'</td>';
                        listItems += '<td class="text-right" style="padding-right:4px">'+formatNumber( hrg, 0 )+'</td>';
                        listItems += '<td class="text-center" style="padding-left:0px">'+response[i].jumlah+'</td>';
                        listItems += '<td class="text-right" style="padding-right:4px">'+formatNumber( total, 0 )+'</td>';
                        listItems += '</tr>';
                        nums++;
                    })
                    $("#tbl_tindakan_obat").html(listItems);
                }
            }) 
        }

        $("#AddObat").click(function(e){
            $("#tbl_tindakan_obat").html("<tr><td colspan=3><img src='{{asset('loading_new.gif')}}' width='70' /></td></tr>")
            listObat();
        })
        
        $("#InputObat").on("click", function(event){
            $("#addTindakanObat").show();
            $(".showObat").hide();
            $("#BtnSrcTindakan").val('');
            $.ajax({
                url: "/kasir/get_list_obat",
                type: "get",
                data: "",
                success:function(response){ 
                    var listItems = '';
                    var nums = 1;
                    var jm = 1500;
                    $.each(response, function(i) {
                        if(response[i].stok_akhir > 0 && response[i].hrg_resep > 0) var link = '<a href="#" class="btn btn-pink btn-sm add-obat" id_hrg="'+response[i].id_hrg+'" id_obat="'+response[i].id_obat+'"  idx="'+nums+'" data-effect="md-scale"><i class="fa fa-shopping-cart"></i></a>';
			            else var link = '<a href="#" class="btn btn-theme btn-sm md-effect" style="background-color:#000; border:#000 solid 1px;" id_hrg="'+response[i].id_hrg+'" id_obat="'+response[i].id_obat+'"  idx="'+nums+'" data-effect="md-scale"><i class="fa fa-lock"></i></a>';       
                        if(response[i].stok_akhir != null) var stok = response[i].stok_akhir; 
                        else var stok = 0;                
                        listItems += '<tr class="odd gradeX" style="color:#000">';
                        listItems += '<td class="text-center">'+link+'</td>';
                        listItems += '<td style="width:25px" class="text-center"><input type="text" class="form-control" style="color:#000; font-size:14px;" value="1" id="jml_'+nums+'" name="jmlh[]" required></td>';
                        listItems += '<td class="text-left">'+response[i].nama+'</td>';
                        listItems += '<td class="text-right">'+response[i].stok_akhir+'</td>';
                        listItems += '<td class="text-right">'+formatNumber((parseInt(response[i].hrg_resep)+parseInt(jm)))+'</td>';			
                        listItems += '</tr>';
                        nums++;
                    })
                    $("#tbl_add_tindakan_obat").html(listItems);
                }
            })
        });
        $("#BtnSrcTindakan").on("change", function(event){
            event.preventDefault();
            $.ajax({
                url: "/kasir/get_list_obat",
                type: "get",
                data: "key="+$("#BtnSrcTindakan").val(),
                success:function(response){ 
                    var listItems = '';
                    var nums = 1;
                    var jm = 1500;
                    $.each(response, function(i) {
                        if(response[i].stok_akhir > 0 && response[i].hrg_resep > 0) var link = '<a href="#" class="btn btn-pink btn-sm add-obat" id_hrg="'+response[i].id_hrg+'" id_obat="'+response[i].id_obat+'"  idx="'+nums+'" data-effect="md-scale"><i class="fa fa-shopping-cart"></i></a>';
			            else var link = '<a href="#" class="btn btn-theme btn-sm md-effect" style="background-color:#000; border:#000 solid 1px;" id_hrg="'+response[i].id_hrg+'" id_obat="'+response[i].id_obat+'" idx="'+nums+'" data-effect="md-scale"><i class="fa fa-lock"></i></a>';                        
                        listItems += '<tr class="odd gradeX" style="color:#000">';
                        listItems += '<td class="text-center">'+link+'</td>';
                        listItems += '<td style="width:25px" class="text-center"><input type="text" class="form-control" style="color:#000; font-size:14px;" value="1" id="jmlh_'+nums+'" name="jmlh[]" required></td>';
                        listItems += '<td class="text-left">'+response[i].nama+'</td>';
                        listItems += '<td class="text-right">'+response[i].stok_akhir+'</td>';
                        listItems += '<td class="text-right">'+formatNumber((parseInt(response[i].hrg_resep)+parseInt(jm)))+'</td>';			
                        listItems += '</tr>';
                        nums++;
                    })
                    $("#tbl_add_tindakan_obat").html(listItems);
                }
            });
        })
        $(document).on("click", ".add-obat", function (e){		
			$(this).css('background-color', '#2A9FFF');
			$(this).css('border', '1px solid #2A9FFF');
			$(this).find('i').toggleClass('fa fa-shopping-cart fa fa-check');
			var no_kun = $("#no_kunjungan_kasir").val();
			var id_unit = $("#id_unit_kasir").val();
			var cara_bayar = $("#cara_bayar").val();
			var tgl_reg = $("#tgl_reg").val();
			var waktu_t = $("#tgl_kunjung").val();
			var model_jaminan = $("#model_jaminan").val();
			var idx = $(this).attr("idx");
			var qty =  $("#jmlh_"+idx).val();
			var id = $(this).attr("id_hrg");
			var id_obat = $(this).attr("id_obat");
			$.ajax({
				url: '/kasir/add_obat', 
				type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
				data: 'addCart=y&id_obat='+id_obat+"&qty="+qty+"&id_hrg="+id+"&no_kunjungan="+no_kun+"&id_unit="+id_unit+"&cara_bayar="+cara_bayar,					
				success: function (data){
                    listObat();
                    $.ajax({
                        url: "/kasir/nota_ralan_all",
                        type: "get",
                        data: "no_kunjungan="+no_kun+'&tgl_reg='+tgl_reg+'&tgl_kunjung='+waktu_t+'&cara_bayar='+cara_bayar+'&model_jaminan='+model_jaminan+'&id_unit='+id_unit,
                        success:function(retval){ 
                            $(".btn-act").show();
                            $("#tbl_nota_all").html(retval);
                            $("#tbl_poli1").html(retval);
                            $("#t_gtot").val(($("#g_tot").val()));
                            $("#no_kunjungan_nt").val(no_kun);
                            $("#id_unit_nt").val(id_unit);
                            $("#cara_bayar_nt").val(cara_bayar);
                            
                        }
                    });
                    $.ajax({ 
                        url: "/kasir/get_obat",
                        type: "get",
                        data: "no_kunjungan="+no_kun+"&id_unit="+id_unit,
                        success:function(response){ 
                            var listItems = '';
                            var nums = 1;
                            var g_tot = 0;
                            var tot_apt = 0;
                            var tot_igd = 0;
                            var jm = 1500;
                            $.each(response, function(i) {
                                var total = (response[i].hrg_resep * (response[i].jumlah)) + jm;
                                tot_apt = tot_apt + total;
                                var hrg = total/response[i].jumlah;
                                listItems += '<tr>';
                                listItems += '<td class="text-center" style="height:0px; padding-left:4px; height:15px">'+nums+'</td>';
                                listItems += '<td class="text-left" style="padding-left:4px">'+response[i].nama+'</td>';
                                listItems += '<td class="text-right" style="padding-right:4px">'+formatNumber( hrg, 0 )+'</td>';
                                listItems += '<td class="text-center" style="padding-left:0px">'+response[i].jumlah+'</td>';
                                listItems += '<td class="text-right" style="padding-right:4px">'+formatNumber( total, 0 )+'</td>';
                                listItems += '</tr>';
                                nums++;
                            })
                            listItems += '<tr style="border-top:1px solid #ABABAB">';
                            listItems += '<td colspan="4" class="text-center" style="padding:4px; font-family:Arial">Total</td>';
                            listItems += '<td class="text-right" style="font-weight:normal; padding:4px; font-family:Arial">'+formatNumber( tot_apt, 0 )+'</td>';				
                            listItems += '</tr>';
                            $("#tbl_nota_all #tbl_obat").html(listItems);
                            $("#tbl_poli1 #tbl_obat").html(listItems);
                            $("#tot_apt").val(tot_apt);
                            var tot_igd = $("#tot_igd").val();
                            g_tot = BulatKoma(parseInt(tot_apt) + parseInt(tot_igd));
                            $("#g_tot").val(g_tot);
                            $(".grand_tot").html('Rp.' + formatNumber(g_tot,0));
                            if($("#sts_byr_poli").val() != 0 && ($("#tot_kasir").val() == $("#g_tot").val())){
                                $("#PrintPoli").show();
                                $("#ByrPoli").hide();
                            }
                            else{
                                $("#PrintPoli").hide();
                                $("#ByrPoli").show();
                            }

                        },
                        error: function (ts) {
                            console.log(ts)
                            alert('Error'+ts.responseText)
                        }
                    });
				}
			});

		});
        $("#btlAddTindakan").on("click", function(){
            $("#addTindakanObat").hide();
            $(".showObat").show();
            listObat();
        })
        $("#BtnPrintPoli").on("click", function(){
            var contents = $("#PrintTargetPoli").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({ "position": "absolute", "top": "-1000000px" });
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>DIV Contents</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        });
    });
</script>
@stop