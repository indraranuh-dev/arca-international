<div>
    @php
    $total = 0;
    @endphp
    <div class="modal fade" wire:ignore.self id="preview" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h5>Invoice: {{$invoice ? $invoice->invoice_code : ''}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @if ($invoice)
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <p><strong>Status</strong></p>
                            <div class="bg-dark text-white text-capitalize pt-2 pb-1 px-3 d-inline-block rounded-lg">
                                <strong>{{$invoice->status}}</strong>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <p><strong>Tanggal Pembuatan</strong></p>
                            {{$invoice->created_at->format('D, d M Y')}}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hovered mb-3">
                            <thead class="bg-light">
                                <tr class="text-center">
                                    <td>Nama Barang</td>
                                    <td>Harga</td>
                                    <td>Diskon</td>
                                    <td>Qty</td>
                                    <td>SubTotal</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->details as $detail)
                                @php
                                $subTotal= ($detail->item_price - ($detail->item_price * ($detail->item_discount /
                                100))) * $detail->qty;
                                $total += $subTotal;
                                @endphp
                                <tr>
                                    <td width="35%">{{$detail->item_name}}</td>
                                    <td class="text-right" width="25%">{{currency($detail->item_price, 'Rp. ')}}</td>
                                    <td class="text-center" width="20%">{{$detail->item_discount}} %</td>
                                    <td class="text-center" width="20%">{{$detail->qty}} Buah</td>
                                    <td class="text-right" width="25%">
                                        {{currency($subTotal, 'Rp. ')}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="mt-3">
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <p><strong>Jumlah: </strong></p>
                                        <h4>{{currency($total, 'Rp. ')}}</h4>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @else
                    <div class="w-100 text-center">
                        <div class="spinner-border"></div>
                    </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
