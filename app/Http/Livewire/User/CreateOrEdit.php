<?php

namespace App\Http\Livewire\User;

use App\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateOrEdit extends Component
{
    public $user, $userId, $name, $email, $password, $password_confirmation, $role;

    protected function rules()
    {
        $passwordRule = $this->user ? 'nullable' : 'required';
        return [
            'name' => 'required|min:3|max:191',
            'email' => 'required|min:3|max:191|email|' . Rule::unique('users', 'email')
                ->ignore($this->user ? $this->user->id : null),
            'password' => $passwordRule . '|min:6|max:191|confirmed',
        ];
    }

    protected $listeners = [
        'getID' => 'findUser',
    ];

    public function findUser($id)
    {
        $user = User::findOrFail($id);
        $this->user = $user;
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first();
    }

    public function submitForm()
    {
        $this->validate();

        if ($this->user) {

            $user = User::findOrFail($this->userId);
            $user->name = strtolower($this->name);
            $user->email = strtolower($this->email);
            $user->password = bcrypt($this->password);
            $user->save();

            $user->syncRoles($this->role);

        } else {

            $user = new User();
            $user->name = strtolower($this->name);
            $user->email = strtolower($this->email);
            $user->password = bcrypt($this->password);
            $user->save();

            $find = User::where('email', $this->email)->firstOrFail();
            $find->assignRole($this->role);

        }

        $lang = $this->user ? 'diperbarui' : 'ditambahkan';
        $action = $this->user ? 'updated' : 'created';

        $message = 'User berhasil ' . $lang . ' !';
        $this->dispatchBrowserEvent($action, $message);
        $this->emitTo('user.table', 'refreshTable');
        $this->reset();

    }

    public function render()
    {
        return view('livewire.user.create-or-edit', [
            'roles' => Role::orderBy('name')->get(),
        ]);
    }
}