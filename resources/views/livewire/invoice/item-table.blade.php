<div>
    <table class="table table-hovered mb-3">
        <thead class="thead-light">
            <tr>
                <td>Nama Barang</td>
                <td>Harga</td>
                <td>Diskon</td>
                <td>Qty</td>
                <td>
                    <button type="button" class="btn btn-light px-2 py-1" wire:click="addRow"
                        {{count($items) === count($temporaryItems) || end($temporaryItems)['itemQty'] ? '' : 'disabled'}}>
                        <I class="mdi mdi-plus"></I>Baris
                    </button>
                </td>
            </tr>
        </thead>
        <tbody>
            @forelse ($temporaryItems as $key => $temporaryItem)
            <tr>
                <td width="35%">
                    <select class="form-control" wire:model="temporaryItems.{{$key}}.itemId">
                        <option value="">Pilih Barang</option>
                        @foreach ($items as $item)
                        <option value="{{$item['id']}}">
                            {{$item['name']}}
                        </option>
                        @endforeach
                        <select>
                </td>
                <td width=" 25%">
                    <input type="text" class="form-control p-0 border-0 bg-white text-right"
                        wire:model="temporaryItems.{{$key}}.itemPriceDisplay" readonly>
                </td>
                <td width="20%">
                    <input type="text" class="form-control p-0 border-0 bg-white text-center"
                        wire:model="temporaryItems.{{$key}}.itemDiscountDisplay" readonly>
                </td>
                <td width="20%">
                    <input type="text" class="form-control" wire:model.debounce2000ms="temporaryItems.{{$key}}.itemQty">
                    @if ($temporaryItems[$key]['currentStock'] && $temporaryItems[$key]['currentStock'] !== 'failed')
                    <small>Tersisa: {{$temporaryItems[$key]['currentStock']}} Buah</small>
                    @elseif ($temporaryItems[$key]['currentStock'] === 'failed')
                    <small>Stok tidak cukup</small>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-danger px-2 py-1" wire:click="removeRow({{$key}})"
                        {{count($temporaryItems) <=1 ? 'disabled' : ''}}>
                        <I class="mdi mdi-delete"></I>
                    </button>
                </td>
            </tr>
            @empty
            null
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <p>Jumlah: </p>
                    <h4>{{$total ? currency($total, 'Rp. ') : ''}}</h4>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
