<?php

namespace App\Http\Livewire\Role;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateOrEdit extends Component
{
    public $role, $roleId, $name, $guardName;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:191|' . Rule::unique('roles', 'name')
                ->ignore($this->role ? $this->role->id : null),
        ];
    }

    protected $listeners = [
        'getID' => 'findRole',
    ];

    public function findRole($id)
    {
        $role = Role::findOrFail($id);
        $this->role = $role;
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->guardName = $role->guard_name;
    }

    public function submitForm()
    {
        $this->validate();

        if ($this->role) {

            $role = Role::findOrFail($this->roleId);
            $role->name = strtolower($this->name);
            $role->guard_name = strtolower($this->guardName);
            $role->save();

        } else {

            $role = new Role();
            $role->name = strtolower($this->name);
            $role->guard_name = strtolower($this->guardName);
            $role->save();

        }

        $lang = $this->role ? 'diperbarui' : 'ditambahkan';
        $action = $this->role ? 'updated' : 'created';

        $message = 'Role berhasil ' . $lang . ' !';
        $this->dispatchBrowserEvent($action, $message);
        $this->emitTo('role.table', 'refreshTable');
        $this->reset();

    }

    public function render()
    {
        return view('livewire.role.create-or-edit');
    }
}