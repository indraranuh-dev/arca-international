<div>
    <div class="modal fade" wire:ignore.self id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form wire:submit.prevent="submitForm">

                    <div class="modal-header d-flex align-items-center justify-content-between">
                        <h5>{{$item ? 'Edit' : 'Tambah'}} Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input type="text" class="form-control" wire:model.defer="name">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Harga <sub>(dalam rupiah)</sub></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="form-control" wire:model.defer="price"
                                    data-action="inputmask">
                            </div>
                            @error('price')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="quantity">Jumlah <sub>(stok)</sub></label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <input type="text" class="form-control" wire:model.defer="quantity"
                                            data-action="inputmask">
                                        <div class="input-group-text">Buah</div>
                                    </div>
                                </div>
                                @error('quantity')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="discount">Diskon <sub>(dalam persen)</sub></label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <input type="text" class="form-control" wire:model.defer="discount"
                                            data-action="inputmask">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                                @error('discount')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
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