<div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>Daftar Barang</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                <i class="mdi mdi-plus"></i> Barang
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
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Discount</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="text-capitalize">{{$item->name}}</td>
                            <td class="text-right">{{currency($item->price, 'Rp.')}}</td>
                            <td class="text-center">{{$item->qty}} Buah</td>
                            <td class="text-center">{{$item->discount}}%</td>
                            <td class="text-center">
                                <div class="btn-group" barang="group">
                                    <button type="button" class="btn text-secondary btn-light px-2 py-1 font-sm"
                                        data-toggle="modal" data-target="#modal" title="Edit"
                                        wire:click="find('{{$item->id}}')">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn text-secondary btn-light px-2 py-1 font-sm"
                                        data-toggle="modal" title="Hapus" data-target="#deleteModal"
                                        wire:click="$set('deleteID', {{$item->id}})">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <p class="text-center py-3">Sayang sekali, barang tidak ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-12">
                    {{$items->links('livewire::simple-bootstrap')}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="deleteModal" tabindex="-1" barang="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" barang="document">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Barang</h5>
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
