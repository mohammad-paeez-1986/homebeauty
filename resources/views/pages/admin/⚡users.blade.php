<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts.admin')] class extends Component {
    use WithPagination;

    #[Modelable]
    public $filters = [];

    public $showModal = false;

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function getUsersProperty()
    {
        return User::query()
            ->when(!empty($this->filters['name']), fn($q) => $q->where('name', 'like', '%' . $this->filters['name'] . '%'))
            ->when(!empty($this->filters['mobile']), fn($q) => $q->where('mobile', 'like', '%' . $this->filters['mobile'] . '%'))
            ->when(!empty($this->filters['is_active']), fn($q) => $q->where('is_active', $this->filters['is_active']))
            ->latest('id')
            ->paginate(10);
    }

    public function openModal($id = null)
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function toggleActive($userId, $status)
    {
        $user = User::find($userId);

        $user->update([
            'is_active' => $status,
        ]);

        $this->dispatch('alert', type: 'success', message: sprintf('کاربر با موفقیت %s شد', $status ? 'فعال' : 'غیر فعال'));
    }
};
?>

<div>
    <div class="pr-4  pb-3 w-full border-mist-300 flex justify-between items-center">
        <div class="flex justify-between w-full items-center">
            <span>کاربران</span>
            <livewire:admin.users-filter wire:model.live="filters" />
        </div>
    </div>
    <div class="bg-white rounded-md shadow ">



        <!-- Orders Table -->
        <table
            class=" divide-y divide-gray-200 [&_th]:px-4 [&_td]:text-sm [&_th]:!text-[14px] [&_th]:border-gray-100 [&_th]:border [&_th]:py-2">
            <thead class="bg-white px-9">
                <tr>
                    <th class=" font-normal text-gray-600 ">شناسه</th>
                    <th class=" font-normal text-gray-600">نام</th>
                    <th class=" font-normal text-gray-600 ">موبایل</th>
                    <th class=" font-normal text-gray-600 w-10">فعال</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 ">
                @forelse ($this->users as $user)
                    <tr>
                        <td>
                            <div class="text-sm  text-gray-600"># {{ $user->id }}</div>
                        </td>
                        <td>
                            <div class="text-sm  text-gray-900">{{ $user->name }}</div>
                        </td>
                        <td>
                            <div class="text-sm text-gray-500 ">{{ $user->mobile }}</div>
                        </td>
                        <td class="text-sm text-gray-900 ">
                            <div class="text-center w-full">
                                <label class="relative inline-flex items-center cursor-pointer ltr">
                                    <input type="checkbox"
                                        wire:change="toggleActive({{ $user->id }}, $event.target.checked)"
                                        class="sr-only peer"   @checked($user->is_active)>
                                    <div
                                        class="w-9 h-5 bg-gray-200 rounded-full peer  peer-checked:after:translate-x-full 
                                rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] 
                                after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300
                                 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-sky-600">
                                    </div>
                                </label>
                            </div>
                            {{-- {{ $user->active  ? 'yes' : 'no'}} --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">
                            <div class="text-center py-16">
                                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-500">نتیجه‌ای یافت نشد</h3>
                                <p class="text-sm text-gray-400 mt-1">موردی با این مشخصات پیدا نکردیم</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="px-6 py-4 bg-gray-50 shadow-none">
            <div dir="rtl" class="[&_nav]:flex [&_nav]:justify-end [&_ul]:flex [&_ul]:gap-1 [&_li]:inline-block">
                {{ $this->users->links() }}
            </div>
        </div>
    </div>

</div>
