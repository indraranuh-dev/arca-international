<?php

namespace App\Http\Livewire\Service;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Service\Entities\Service;

class Create extends Component
{
    use WithFileUploads;

    public $name, $description, $image, $showInHomepage = 1;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:191|' . Rule::unique('services', 'name'),
            'description' => 'required|min:10',
            'image' => 'required|image|max:512|mimes:jpg,jpeg,png,webp',
        ];
    }

    public function createService()
    {
        $this->dispatchBrowserEvent('init-packages');
        $this->validate();

        Service::create([
            'name' => $this->name,
            'slug_name' => Str::slug($this->name),
            'description' => $this->description,
            'image_path' => $this->image->store('/images/services', 'public'),
            'show_in_homepage' => $this->showInHomepage,
        ]);

        $this->dispatchBrowserEvent('created', 'Layanan berhasil ditambahkan !');
        $this->emitTo('service.table', 'refreshTable');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.service.create');
    }
}