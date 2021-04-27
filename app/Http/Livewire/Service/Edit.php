<?php

namespace App\Http\Livewire\Service;

use App\Traits\FileHandler;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Service\Entities\Service;

class Edit extends Component
{
    use WithFileUploads, FileHandler;

    public $serviceID, $name, $description, $oldImage, $image, $showInHomepage;

    protected $listeners = [
        'getID' => 'findService',
    ];

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:191|' . Rule::unique('services', 'name')->ignore($this->serviceID),
            'description' => 'required|min:10',
            'image' => 'nullable|image|max:512|mimes:jpg,jpeg,png,webp',
        ];
    }

    public function findService($id)
    {
        $service = Service::findOrFail($id);
        $this->serviceID = $service->id;
        $this->name = $service->name;
        $this->description = $service->description;
        $this->oldImage = $service->image_path;
        $this->showInHomepage = $service->show_in_homepage;
        $this->dispatchBrowserEvent('init-packages');
    }

    public function updateService()
    {
        $this->dispatchBrowserEvent('init-packages');
        $this->validate();

        $service = Service::findOrFail($this->serviceID);
        $service->name = $this->name;
        $service->slug_name = Str::slug($this->name);
        $service->description = $this->description;
        $service->show_in_homepage = $this->showInHomepage;

        if ($this->image) {
            $service->image_path = $this->image->store('images/services', 'public');
            $this->deleteMedia(explode('/', $this->oldImage)[2], 'services');
        }

        $service->save();

        $this->dispatchBrowserEvent('updated', 'Layanan berhasil diperbarui !');
        $this->emitTo('service.table', 'refreshTable');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.service.edit');
    }
}