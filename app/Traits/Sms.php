<?php

namespace App\Traits;

use App\Models\SmsCode;
use App\services\AuthService;
use Illuminate\Support\Facades\RateLimiter;

trait Sms
{
    protected function sendSmsCode($cb)
    {
        $validated = $this->validate();
        $validatedMobile = $validated['mobile'];

        $key = 'sms:' . $validatedMobile;

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('mobile', "لطفاً {$seconds} ثانیه دیگر تلاش کنید");
            return;
        }

        if (!$this->smsCode) {
            RateLimiter::hit($key, 120);
            $this->smsCode = SmsCode::generate($validatedMobile);
            // $this->dispatch('show-sms-code', code: $this->smsCode?->code);
            $this->isCodeSent = true;
            $this->userExists = AuthService::checkExistsMobile($validatedMobile);
        } else {
            $this->checkCode($cb);
        }
    }

    protected function getRuleMessages()
    {
        $rules = ['code' => 'required|digits:4'];
        $messages = [
            'code.required' => 'کد ارسال شده به موبایل را وارد نمایید',
            'code.digits' => 'کد ارسال شده صحیح نیست',
        ];

        if (!$this->userExists) {
            $rules += ['name' => 'required|min:2'];
            $messages += [
                'name.required' => 'نام را وارد کنید',
                'name.min' => 'نام باید بیشتر از دو حرف باشد',
            ];
        }

        return ['rules' => $rules, 'messages' => $messages];
    }

    protected function checkCode($cb)
    {
        $ruleMessages = $this->getRuleMessages();
        $this->validate($ruleMessages['rules'], $ruleMessages['messages']);

        if ($this->smsCode->checkCode($this->code)) {
            RateLimiter::clear('sms:' . $this->mobile);
            AuthService::registerOrLogin($this->mobile, $this->name);
            $this->smsCode->markAsUsed();
            $cb();
            // return redirect(request()->header('Referer'));
        } else {
            $this->addError('code', 'کد ارسالی درست نیست');
            // $this->dispatch('alert', type: 'info', message: 'hey');
            // $this->resetErrorBag();
            $this->smsCode->incrementAttempts();
        }
    }
}
