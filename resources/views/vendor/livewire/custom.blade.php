<div>
    @if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-end">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">Sebelumnya</span>
            </li>
            @else
            <li class="page-item">
                <button type="button" class="page-link" wire:click="previousPage" wire:loading.attr="disabled"
                    rel="prev">Sebelumnya</button>
            </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <button type="button" class="page-link" wire:click="nextPage" wire:loading.attr="disabled"
                    rel="next">Selanjutnya</button>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">Selanjutnya</span>
            </li>
            @endif
        </ul>
    </nav>
    @endif
</div>
