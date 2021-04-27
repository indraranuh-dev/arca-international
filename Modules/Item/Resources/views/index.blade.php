@extends('layouts.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Barang</h4>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('main.index')}}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Barang</li>
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
        @livewire('item.table')
    </div>
    @livewire('item.create-or-edit')
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

        $('[data-action="inputmask"]').on('input', function(event) {
            this.value = this.value.replace(/[^0-9+]/g, '');
            this.value = this.value.substr(0, 191)
        });

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
