@extends('layouts.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<style>
    table tr td {
        vertical-align: top !important
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Invoice</h4>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('main.index')}}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invoice</li>
        </ol>
    </nav>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sukses !</strong> {{session()->get('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-12">
        @livewire('invoice.table')
    </div>
    @livewire('invoice.create-or-edit')
</div>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>

@endpush

@push('custom-scripts')
<script>
    $(function() {
    function initToast(text) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            timer: 5000,
            closeModal: true
        });

        Toast.fire({
            icon: 'success',
            title: text
        })
    }

    document.addEventListener('created', function(e) {
        $('#modal').modal('hide');
        initToast(e.detail);
    })

    document.addEventListener('updated', function(e) {
        $('#modal').modal('hide');
        initToast(e.detail);
    })

    document.addEventListener('deleted', function(e) {
        $('#deleteModal').modal('hide');
        initToast(e.detail);
    })
})
</script>
@endpush
