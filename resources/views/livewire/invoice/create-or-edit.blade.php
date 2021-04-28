<div>
    <div class="modal fade" wire:ignore.self id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <form wire:submit.prevent="submitForm">

                    <div class="modal-header d-flex align-items-center justify-content-between">
                        <h5>{{$invoice ? 'Edit' : 'Tambah'}} Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="invoiceCode"><strong>Kode Invoice</strong></label>
                                <input type="text" class="form-control bg-white border-0 p-0" readonly
                                    wire:model.defer="invoiceCode">
                                @error('invoiceCode')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0 text-right">
                                <label for="dateCreated"><strong>Tanggal Pembuatan</strong></label>
                                <input type="text" class="form-control text-right bg-white border-0 p-0" readonly
                                    wire:model.defer="dateCreated">
                                @error('dateCreated')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <livewire:invoice.item-table />

                        @role('admin')
                        <div class="form-group">
                            <label for="">Status</label>
                            <div>
                                @foreach ($statuses as $status)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="status-{{$loop->iteration}}" name="status"
                                        wire:model.defer="status" class=" custom-control-input"
                                        value="{{$status['slug_name']}}">
                                    <label class="custom-control-label"
                                        for="status-{{$loop->iteration}}">{{$status['name']}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endrole
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