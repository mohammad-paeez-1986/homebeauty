<?php

use App\Models\Order;
use App\Models\User;
use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Component;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $mobile = '';
    public $address = '';
    public $day;
    public $time = '';
    public $today;
    public $description;
    public $lessHour = '';
    public $serviceId = null;
    public $showStep2 = false;
    public $code;
    public $userLogged;

    // Available days and times
    public $availableDays = [];
    public $availableTimes = [];
    public $serviceTypes = [];

    protected $messages = [
        'address.required' => 'آدرس را وارد کنید',
        'address.min' => 'آدرس باید حداقل ۵ کاراکتر باشد',
        'mobile.required' => 'شماره موبایل را وارد کنید',
        'mobile.regex' => 'شماره موبایل معتبر نیست (مثال: 09123456789)',
        'mobile.min' => 'شماره موبایل باید ۱۱ رقم باشد',
        'name.required' => 'نام را وارد کنید',
        'name.min' => 'نام باید بیشتر از دو حرف باشد',
        'day.required' => 'روز را انتخاب کنید',
        'serviceId.required' => 'سرویس مد نظر را انتخاب کنید',
        // 'day.after' => 'لطفا روزی از آینده را انتخاب کنید',
        'time.required' => 'ساعت را انتخاب کنید',
    ];

    protected function rules()
    {
        $rules = [
            'address' => 'required|min:5|max:255',
            'day' => 'required|date',
            'time' => 'required',
            'serviceId' => 'required|exists:services,id',
            'description' => 'nullable|string|max:1000',
        ];

        // Only require mobile if user is NOT logged in
        if (!auth()->check()) {
            $rules['mobile'] = 'required|regex:/^09[0-9]{9}$/|min:11|max:11';
        }

        return $rules;
    }

    public function mount()
    {
        $this->userLogged = auth()->check();
        $this->availableDays = $this->generateAvailableDays();
        $this->availableTimes = $this->generateAvailableTimes();
        $this->address = $_COOKIE['address'] ?? null;
        $this->serviceTypes = Service::orderBy('position')->get()->toarray();
    }

    protected function generateAvailableDays()
    {
        $days = [];

        // check if after 5pm
        $nowHour = jdate()->addHours(2)->format('H:i');

        if ($nowHour > 17) {
            $max = 4;
        } else {
            $this->lessHour = $nowHour;
            $this->today = jdate()->format('Y/m/d');
            $now = Jalalian::now();
            $days[] = [
                'is_today' => true,
                'name' => $now->format('%A'),
                'date' => $now->format('Y/m/d'),
                'display' => $now->format('d F'),
            ];

            $max = 3;
        }

        for ($i = 1; $i <= $max; $i++) {
            $date = Jalalian::now()->addDays($i);
            $dayOfWeek = $date->format('w'); // 0=Saturday in Jalali

            $days[] = [
                'name' => $date->format('%A'),
                'date' => $date->format('Y/m/d'),
                'display' => $date->format('d F'),
            ];
        }

        $this->day = $days[0]['date'];

        return $days;
    }

    protected function generateAvailableTimes()
    {
        return [
            [
                'value' => '09:00',
                'label' => '۹:۰۰',
            ],
            ['value' => '10:00', 'label' => '۱۰:۰۰'],
            ['value' => '11:00', 'label' => '۱۱:۰۰'],
            ['value' => '12:00', 'label' => '۱۲:۰۰'],
            ['value' => '14:00', 'label' => '۱۴:۰۰'],
            ['value' => '15:00', 'label' => '۱۵:۰۰'],
            ['value' => '16:00', 'label' => '۱۶:۰۰'],
            ['value' => '17:00', 'label' => '۱۷:۰۰'],
            ['value' => '18:00', 'label' => '۱۸:۰۰'],
            ['value' => '19:00', 'label' => '۱۹:۰۰'],
        ];
    }

    public function changeMobileNumber()
    {
        $this->mobile = '';
        $this->showStep2 = false;
    }

    public function submit()
    {
        try {
            $validated = $this->validate();
        } catch (\Throwable $e) {
            $this->js("requestAnimationFrame(() => requestAnimationFrame(() => {
                var e = document.querySelector('.livewire-error');
                if (e) e.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }))");
            throw $e;
        }

        if (auth()->check()) {
            $this->save();
            return;
        }

        $this->showStep2 = true;
    }

    #[On('auth-validated')]
    public function save($id = null)
    {
        $user = User::where('mobile', $this->mobile)->first();
        if (!$user) {
            $user = User::create([
                'mobile' => $this->mobile,
            ]);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'address' => $this->address,
            'day' => Jalalian::fromFormat('Y/m/d', $this->day)->toCarbon(),
            'time' => $this->time,
            'service_id' => $this->serviceId,
            'description' => $this->description,
        ]);

        Auth::login($user, true);

        setcookie('address', $this->address, time() + 86400 * 30, '/');
        session()->flash('orderId', $order->id);
        $this->redirect(route('order-registered'));
    }
};
?>

<div class=" bg-white border border-mist-100 rounded-sm">
    <div class="p-8">
        @if ($showStep2)
            <livewire:login-register-step2 wire:model="mobile" :wire:key="'verify-order' . $mobile"
                action-title='ثبت سفارش' is-order-process='true' />
        @else
            <form wire:submit.prevent="submit">
                <div wire:transition class="flex flex-col gap-8">
                    @if (!$userLogged)
                        <div>
                            <label class="block text-gray-600  text-right mb-2">
                                📱 شماره موبایل
                                <span class="text-red-500">*</span>
                            </label>

                            <input type="tel" wire:model="mobile" maxlength="11"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                                class="w-full px-4 py-2  border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('mobile') border-red-500  @enderror"
                                placeholder="09123456789">

                            @error('mobile')
                                <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                    <!-- Address -->
                    <div>
                        <label class="block text-gray-600 mb-2 text-right">
                            📍 آدرس
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea wire:model="address" rows="3"
                            class="w-full px-4 py-2 border border-gray-200  focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('address') border-red-500 @enderror"
                            placeholder="آدرس کامل خود را وارد کنید..."></textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- service -->
                    <div>
                        <label class="block text-gray-600 mb-2 text-right">
                            ✂️ سرویس مورد نظر
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col gap-2">
                            @foreach ($serviceTypes as $serviceType)
                                <label class="relative cursor-pointer">
                                    <input type="radio" wire:model="serviceId" value="{{ $serviceType['id'] }}"
                                        class="peer hidden">
                                    <div class="text-center p-4 rounded-sm  border border-gray-200 transition-all cursor-pointer hover:border-amber-400"
                                        wire:bind:class="serviceId == {{ $serviceType['id'] }} && '!border-amber-400 bg-amber-100 text-amber-900' ">
                                        <div
                                            class="flex justify-between text-mist-600 items-center text-xs sm:text-sm md:text-[14px] ">
                                            <div class="text-gray-600">{{ $serviceType['name'] }}</div>
                                            <div class="text-md text-amber-800">{{ $serviceType['price'] }} هزار تومان
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('serviceId')
                            <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- days -->
                    <div>
                        <label class="block text-gray-600 mb-2 text-right">
                            📅 روز مورد نظر
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            @foreach ($availableDays as $dayOption)
                                <label class="relative cursor-pointer">
                                    <input type="radio" wire:model="day" value="{{ $dayOption['date'] }}"
                                        class="peer hidden" x-on:change="$wire.time = ''">
                                    <div class="text-center p-3  border border-gray-200 transition-all cursor-pointer hover:border-amber-400"
                                        wire:bind:class="day === '{{ $dayOption['date'] }}' && '!border-amber-400 bg-amber-100 text-amber-700' ">
                                        <div class="">{{ $dayOption['name'] }}</div>
                                        <div class="text-xs text-gray-500">{{ $dayOption['display'] }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('day')
                            <p class="text-red-500 text-sm mt-1 livewire-error text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Time Selection -->
                    <div>
                        <label class="block text-gray-600 mb-2 text-right">
                            ⏰ ساعت مورد نظر
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                            @foreach ($availableTimes as $timeOption)
                                <label class="relative cursor-pointer">
                                    <input type="radio" wire:model="time" value="{{ $timeOption['value'] }}"
                                        class="peer hidden"
                                        wire:bind:disabled="day === '{{ $today }}' && '{{ $timeOption['value'] }}' < '{{ $lessHour }}'">
                                    <div class="text-center p-2  border border-gray-200 transition-all cursor-pointer text-md text-mist-800 font-normal"
                                        wire:bind:class="(time === '{{ $timeOption['value'] }}' ? '!border-amber-400 bg-amber-100 text-amber-700' : '') +
                            (day === '{{ $today }}' && ('{{ $timeOption['value'] }}' < '{{ $lessHour }}') && ' opacity-40')
">
                                        {{ $timeOption['label'] }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('time')
                            <p class="text-red-500 text-sm mt-1 livewire-error text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- description -->

                    <div>
                        <label class="block text-gray-600 mb-2 text-right">
                            ملاحظات
                            (اختیاری)
                        </label>
                        <textarea wire:model="description" rows="3"
                            class="w-full px-4 py-2 border border-gray-200  focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('address') border-red-500 @enderror"
                            placeholder=""></textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1 text-right livewire-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit"
                        class="w-full text-mist-900  border border-amber-300 font-bold py-3 px-6 bg-amber-50 cursor-pointer"
                        wire:loading.attr="disabled">
                        ثبت درخواست
                        {{-- <span wire:loading.remove>ثبت نوبت</span>
                    <span wire:loading.delay>
                        در حال ثبت...
                    </span> --}}
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
