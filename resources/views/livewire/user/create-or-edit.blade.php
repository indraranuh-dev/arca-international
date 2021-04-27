<div>
    <div class="modal fade" wire:ignore.self id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form wire:submit.prevent="submitForm">

                    <div class="modal-header d-flex align-items-center justify-content-between">
                        <h5>{{$user ? 'Edit' : 'Tambah'}} User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" wire:model.defer="name">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" wire:model.defer="email">
                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select wire:model="role" class="form-control">
                                <option value="">Semua Role</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" wire:model.defer="password">
                                @error('password')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input type="password" class="form-control" wire:model.defer="password_confirmation">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>