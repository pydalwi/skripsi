@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Tambah Data Tahap dan Mekanisme Penilaian</div>
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
                    <form action="{{ route('tahap_mekanisme_penilaian.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="cpl">CPL</label>
                            <input type="text" name="cpl" id="cpl" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mk">MK</label>
                            <input type="text" name="mk" id="mk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cpmk">CPMK</label>
                            <input type="text" name="cpmk" id="cpmk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tahap_penilaian">Tahap Penilaian</label>
                            <input type="text" name="tahap_penilaian" id="tahap_penilaian" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="teknik_penilaian">Teknik Penilaian</label>
                            <input type="text" name="teknik_penilaian" id="teknik_penilaian" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="instrumen">Instrumen</label>
                            <input type="text" name="instrumen" id="instrumen" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="kriteria">Kriteria</label>
                            <input type="text" name="kriteria" id="kriteria" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="bobot">Bobot (%)</label>
                            <input type="number" name="bobot" id="bobot" class="form-control" min="0" max="100" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
