<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Table extends Component
{
    use WithPagination;

    public $deleteID;

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function find($id)
    {
        $this->emitTo('role.create-or-edit', 'getID', $id);
    }

    public function getAll()
    {
        return Role::orderBy('created_at', 'desc')->simplePaginate(10);
    }

    public function destroy()
    {
        $career = Role::findOrFail($this->deleteID);
        $career->delete();

        $this->dispatchBrowserEvent('deleted', 'Role berhasil dihapus !');
        $this->reset('deleteID');
    }

    public function render()
    {
        return view('livewire.role.table', [
            'roles' => $this->getAll(),
        ]);
    }
}