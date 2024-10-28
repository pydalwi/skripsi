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
                <form action="{{$page->url}}" method="post">
                    @csrf
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
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Kode CPL</th>
                                    <th colspan="100%" class="text-center"> Profil Lulusan (PL) </th>
                                </tr>
                                <tr>
                                    @foreach ($profil_lulusan as $pl)
                                        <th>{{$pl->kode_pl}}</th> 
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cpl_prodi as $cp)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$cp->cpl_prodi_kode}}</td>
                                        @foreach ($profil_lulusan as $pl)  
                                        <td>
                                            @if(isset($cplpl[$cp->cpl_prodi_id][$pl->pl_id]))
                                                <input {{ ($cplpl[$cp->cpl_prodi_id][$pl->pl_id] == 1)? 'checked' : '' }} type="checkbox" name="cplpl[{{$cp->cpl_prodi_id}}][{{$pl->pl_id}}]" value="1">
                                            @else
                                                <input type="checkbox" name="cplpl[{{$cp->cpl_prodi_id}}][{{$pl->pl_id}}]" value="1">
                                            @endif
                                        </td>
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


 