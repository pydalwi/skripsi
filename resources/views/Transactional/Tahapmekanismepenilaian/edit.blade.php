@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Edit Data Tahap dan Mekanisme Penilaian</div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('tahap_mekanisme_penilaian.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="cpl">CPL</label>
                            <input type="text" name="cpl" id="cpl" class="form-control" value="{{ $data->cpl }}" required>
                        </div>
                        <div class="form-group">
                            <label for="mk">MK</label>
                            <input type="text" name="mk" id="mk" class="form-control" value="{{ $data->mk }}" required>
                        </div>
                        <div class="form-group">
                            <label for="cpmk">CPMK</label>
                            <input type="text" name="cpmk" id="cpmk" class="form-control" value="{{ $data->cpmk }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tahap_penilaian">Tahap Penilaian</label>
                            <input type="text" name="tahap_penilaian" id="tahap_penilaian" class="form-control" value="{{ $data->tahap_penilaian }}" required>
                        </div>
                        <div class="form-group">
                            <label for="teknik_penilaian">Teknik Penilaian</label>
                            <input type="text" name="teknik_penilaian" id="teknik_penilaian" class="form-control" value="{{ $data->teknik_penilaian }}" required>
                        </div>
                        <div class="form-group">
                            <label for="instrumen">Instrumen</label>
                            <input type="text" name="instrumen" id="instrumen" class="form-control" value="{{ $data->instrumen }}" required>
                        </div>
                        <div class="form-group">
                            <label for="kriteria">Kriteria</label>
                            <input type="text" name="kriteria" id="kriteria" class="form-control" value="{{ $data->kriteria }}" required>
                        </div>
                        <div class="form-group">
                            <label for="bobot">Bobot (%)</label>
                            <input type="number" name="bobot" id="bobot" class="form-control" min="0" max="100" value="{{ $data->bobot }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
