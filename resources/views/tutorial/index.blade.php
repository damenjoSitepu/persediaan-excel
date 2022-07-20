@extends('template.index')

@section('content')
<div class="mt-5">
    <div class="mb-3 w-50 m-auto text-center">
        <label for="formFile" class="form-label fw-bold"><i class="fas fa-file-excel text-success"></i> Pilih File Import Excel</label>
        <input class="form-control" type="file" id="formFile">
    </div>
</div>
@endSection()
