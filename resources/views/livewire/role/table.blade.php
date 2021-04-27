<div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>Daftar Role</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-3 table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Role</th>
                            <th>Guard</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->guard_name}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn text-secondary btn-light px-2 py-1 font-sm"
                                        data-toggle="modal" title="Edit" wire:click="find('{{$role->id}}')">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn text-secondary btn-light px-2 py-1 font-sm"
                                        data-toggle="modal" title="Hapus" data-target="#deleteModal"
                                        wire:click="$set('deleteID', {{$role->id}})">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <p class="text-center py-3">Sayang sekali, role tidak ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-12">
                    {{$roles->links('livewire::simple-bootstrap')}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Role</h5>
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