<div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>{{$role ? 'Edit' : 'Tambah'}} Role</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="submitForm">

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" wire:model.defer="name">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="guardName">Guard Name</label>
                    <input type="text" class="form-control" wire:model.defer="guardName">
                    @error('guardName')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>