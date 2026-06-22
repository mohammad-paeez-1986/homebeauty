@switch($status)
    @case('pending')
        <div class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 px-2.5 py-1 text-xs font-medium">ثبت شده</div>
    @break
    @case('confirmed')
        <div class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-2.5 py-1 text-xs font-medium">تایید شده</div>
    @break
    @case('done')
        <div class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-2.5 py-1 text-xs font-medium">انجام شده</div>
    @break
    @case('canceled')
        <div class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 px-2.5 py-1 text-xs font-medium">لغو شده</div>
    @break
@endswitch
