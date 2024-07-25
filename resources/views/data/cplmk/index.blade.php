@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
        
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title mt-1">
                        <i class="fas fa-angle-double-right text-md text-{{ $theme->card_outline }} mr-1"></i>
                        {!! $page->title !!}
                    </h3>
                    {{-- <div class="card-tools">
                        @if($allowAccess->create)
                            <button type="button" data-block="body" class="btn btn-sm btn-{{ $theme->button }} mt-1 ajax_modal" data-url="{{ $page->url }}/create"><i class="fas fa-plus"></i> Tambah</button>
                        @endif
                    </div> --}}
                </div>
                <form action="{{$page->url}}" enctype="multipart/form-data" method="post">
                    @method('POST')
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">   
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode MK</th>
                                    @foreach ($cpl_prodi as $cp)
                                        <th>{{$cp->cpl_prodi_kode}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matkul as $mk)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$mk->mk_kode}}</td>
                                        @foreach ($cpl_prodi as $cp)
                                            @foreach ($data as $cpm)
                                                @php
                                                    $check = $cpm->cpl_prodi_id == $cp->cpl_prodi_id && $cpm->mk_id == $mk->mk_id
                                                @endphp
                                                <td class="text-center">
                                                    <input type="checkbox" name="cpm-{{$cpm->cpl_mk_id}}" id="" {{$check && $cpm->is_active == '1' ? 'checked' : ''}}>
                                                </td>
                                                @php
                                                    break;
                                                @endphp
                                            @endforeach
                                            
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

 