<?php

namespace App\Http\Livewire\User;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Table extends Component
{
    use WithPagination;

    public $deleteID, $role = '', $keyword = '';

    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function find($id)
    {
        $this->emitTo('user.create-or-edit', 'getID', $id);
    }

    public function getAll($keyword, $role)
    {
        $user = User::search($keyword)->orderBy('created_at', 'desc')->with('roles');

        if ($role) {
            $user->whereHas('roles', function (Builder $query) use ($role) {
                $query->where('name', $role);
            });
        }

        return $user->simplePaginate(10);
    }

    public function destroy()
    {
        $career = User::findOrFail($this->deleteID);
        $career->delete();

        $this->dispatchBrowserEvent('deleted', 'User berhasil dihapus !');
        $this->reset('deleteID');
    }

    public function render()
    {
        return view('livewire.user.table', [
            'users' => $this->getAll($this->keyword, $this->role),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }
}