<?php

use App\Models\Service;
use Livewire\Component;
use Illuminate\Validation\Rule;

new class extends Component {
    public $name;
    public $price;
    public  $active = true;
    public $serviceId = null;
    public $service = null;

    public $messages = [
        'name.required' => 'نام سرویس الزامی است',
        'name.unique' => 'این نام قبلاً استفاده شده است',
        'price.required' => 'قیمت الزامی است',
        'price.min' => 'قیمت نمی‌تواند منفی باشد',
        'price.max' => 'قیمت نمی‌تواند بیشتر از ۱۰۰ میلیون تومان باشد',
        'active.required' => 'وضعیت خدمت الزامی است',
    ];

    public function rules()
    {
        return  [
            'name' => ['required', 'string', 'max:255', Rule::unique('services', 'name')->ignore($this->serviceId)->whereNull('deleted_at')],
            'price' => 'required|integer|min:0', // Ensures non-negative
            // 'position' => 'nullable|integer|min:0',
            'active' => 'boolean',
        ];

    }

    public function mount($serviceId = null)
    {
        if ($serviceId) {
            $service = Service::findOrFail($serviceId);
            $this->serviceId = $service->id;
            $this->name = $service->name;
            $this->price = $service->price;
            $this->active = $service->active;
            // $this->position = $service->position;
        }
        // If no $serviceId, stays in Add mode with empty fields
    }


    public function submit()
    {
        $validated = $this->validate();

        if ($this->serviceId) {
            Service::find($this->serviceId)->update($validated);
        } else {
            Service::create($validated);
        }

        $this->dispatch('alert', type: 'success', message: 'عملیات با موفقیت انجام شد');
        $this->dispatch('refresh-list')->to('pages::admin.services');
    }
};
?>

<form wire:submit.prevent="submit">
    <div class="p-8 flex flex-col gap-5">
        <div>
            <label class="block text-gray-600  mb-2 text-right">
                عنوان خدمت
                <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input wire:model="name" maxlength="100"
                    class="w-full px-4 py-2  border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('name') border-red-500  @enderror">
            </div>
            @error('name')
            <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-600  mb-2 text-right">
                قیمت
                <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input wire:model="price" maxlength="10"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                    class="w-full px-4 py-2 ltr border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('price') border-red-500  @enderror"
                    placeholder="قیمت به هزار تومان">
            </div>
            @error('price')
            <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex w-full rounded-sm bg-gray-50 mt-5 p-2 items-center justify-center">
            <label class="cursor-pointer">
                <input type="radio" wire:model="active" value="1" class="peer hidden">
                <div
                    class="px-4 py-2 text-sm rounded-md peer-checked:bg-white peer-checked:shadow-sm peer-checked:text-green-600 text-gray-500 transition-all">
                    فعال
                </div>
            </label>

            <label class="cursor-pointer">
                <input type="radio" wire:model="active" value="0" class="peer hidden">
                <div
                    class="px-4 py-2 text-sm rounded-md peer-checked:bg-white peer-checked:shadow-sm peer-checked:text-red-600 text-gray-500 transition-all">
                    غیر فعال
                </div>
            </label>
        </div>

        <div class="mt-4">
            <button type="submit"
                class="w-full text-mist-900  border border-amber-300 font-bold py-3 px-6 bg-amber-50 cursor-pointer"
                wire:loading.attr="disabled">
                {{$this->serviceId ? 'ویرایش خدمت' : 'ثبت خدمت'}}
            </button>
        </div>
    </div>
</form>