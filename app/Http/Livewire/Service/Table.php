<?php

namespace App\Http\Livewire\Service;

use App\Traits\FileHandler;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Service\Entities\Service;

class Table extends Component
{
    use WithPagination, FileHandler;

    public $search, $deleteID;

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function find($id)
    {
        $this->emitTo('service.edit', 'getID', $id);
        $this->emitTo('service.preview', 'getID', $id);
    }

    public function getAll($search)
    {
        $services = Service::orderBy('created_at', 'desc');

        if ($search !== '') {
            $services->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->where('description', 'like', '%' . $search . '%');
            });
        }

        return $services->simplePaginate(10);
    }

    public function destroyService()
    {
        $service = Service::findOrFail($this->deleteID);

        if ($service->image_path) {
            $this->deleteMedia(explode('/', $service->image_path)[2], 'services');
        }

        $service->delete();

        $this->dispatchBrowserEvent('deleted', 'Layanan berhasil dihapus !');
        $this->reset('deleteID');
    }

    public function updateStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->show_in_homepage = $service->show_in_homepage === 1 ? 0 : 1;
        $service->save();

        $this->dispatchBrowserEvent('updated', 'Status layanan berhasil diperbarui !');
    }

    public function render()
    {
        return view('livewire.service.table', [
            'services' => $this->getAll($this->search),
        ]);
    }
}