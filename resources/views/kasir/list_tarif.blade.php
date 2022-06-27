@extends('layout/layout')

@section('content')
<h5>LIST TARIF</h5>
<div class="row">																				
    <div class="col-9">
        <input class="form-control " style="" type="text" name="nama" id="nama" placeholder="Nama Tarif"  data-horizontal="top" data-theme="theme">
    </div>
    <div class="col-3">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#add_modal" style="float:right">
            <i class="fa fa-plus"></i> Tambah Tarif
        </button>
    </div>
    <div class="col-12 mt-3">
        <div class="panel-body" style="font-family:arial; text-align:center">
            <table class="table table-striped" id="table-example" style="font-family:Arial; font-size:12px">
                <thead>
                    <tr>
                        <th class="text-center">NO.</th>
                        <th class="text-center">Nama Tindakan.</th>
                        <th class="text-left">Jasa Pelayanan</th>
                        <th class="text-left">Jasa Sarana</th>
                        <th class="text-left">AMBHP</th>
                        <th class="text-left">Tarif</th>
                        <th class="text-left">JKN</th>
                        <th class="text-center">Act</th>
                    </tr>
                </thead>
                <tbody class="tbl_list">
                    <tr>
                        <td colspan="9" class="div_loading"><img src="/assets/images/loading_new.gif" alt="" width="100px"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tarif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="InputData">
            <div class="row">
                <input name="StsUser" id="StsUser" type="hidden" value="">
                <input name="AddNew" id="AddNew" type="hidden" value="1">
                <input name="id_tindakan" id="id_tindakan" type="hidden" value>
                <div class="col-md-4 mb-2"><label>Nama Tindakan</label></div>
                <div class="col-md-8 mb-2">
                    <input type="text" class="form-control" style="" id="nm_tindakan" name="nm_tindakan" value="" /></td>
                </div>
                <div class="col-md-4 mb-2"><label>Jasa Pelayanan</label></div>
                <div class="col-md-8 mb-2">
                    <input type="text" class="form-control" style="" id="tjp" name="tjp" />
                </div>
                <div class="col-md-4 mb-2"><label>Jasa Sarana</label></div>
                <div class="col-md-8 mb-2">
                    <input type="text" class="form-control" style="" id="tjs" name="tjs" />
                </div>
                <div class="col-md-4 mb-2"><label>AMBHP</label></div>
                <div class="col-md-8 mb-2">
                    <input type="text" class="form-control" style="" id="tamb" name="tamb" />
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection