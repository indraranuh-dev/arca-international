<div>
    <div>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Daftar Invoice</h5>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                    <i class="mdi mdi-plus"></i> Invoice
                </button>
            </div>
            <div class="card-body">

                {{-- Filter --}}
                <div class="row justify-content-end">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model="keyword">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mb-3 table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Invoice</th>
                                <th>Atas Nama</th>
                                <th>Tgl. Approve</th>
                                <th>Status</th>
                                <th>Tgl. Pembuatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$invoice->invoice_code}}</td>
                                <td>{{$invoice->user->name}}</td>
                                <td>{{$invoice->created_at->format('D, d M Y')}}</td>
                                <td class="text-capitalize">{{$invoice->status}}</td>
                                <td>{{$invoice->created_at->format('D, d M Y')}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn text-secondary btn-light px-2 py-1 font-sm"
                                            data-toggle="modal" data-target="#modal" title="Edit"
                                            wire:click="find('{{$invoice->id}}')">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn text-secondary btn-light px-2 py-1 font-sm"
                                            data-toggle="modal" title="Hapus" data-target="#deleteModal"
                                            wire:click="$set('deleteID', {{$invoice->id}})">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <p class="text-center py-3">Sayang sekali, invoice tidak ditemukan.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-12">
                        {{$invoices->links('livewire::simple-bootstrap')}}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" wire:ignore.self id="deleteModal" tabindex="-1" invoice="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" invoice="document">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Invoice</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Anda yakin akan menghapus data ini ?
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-danger" wire:click="destroy">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
