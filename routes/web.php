<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Morilog\Jalali\Jalalian;

Route::view('/', 'index');

Route::middleware('auth')->group(function () {
    Route::livewire('/my-orders', 'pages::user.orders-list')->name('my-orders');
    Route::view('/order-registered', 'order-registered')->name('order-registered');
});

Route::middleware('guest')->group(function () {
    Route::view('/auth-error', 'errors.auth-error')->name('auth-error');
});

Route::livewire('/admin/login', 'pages::admin.login')->name('admin.login')->middleware("guest:admin");

Route::middleware("auth:admin")->prefix('admin')->name('admin.')->group(function () {
    Route::livewire('/', 'pages::admin.index')->name('index');
    Route::livewire('/orders', 'pages::admin.orders')->name('orders');
    Route::livewire('/services', 'pages::admin.services')->name('services');
    Route::livewire('/users', 'pages::admin.users')->name('users');
    Route::post('/logout', function () {
        auth()->guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('admin.login');
    })->name('logout');
});

Route::get('/test', function () {

    // $apiKey = 'd72abfd2-ba2f-4cb2-b4a8-29578c2d4875';
    // $username = 'username';
    // $password = 'password';
    // $api = new MelipayamakApi('9901209463', 'E8F4R765');
    // $sms = $api->sms();
    // $to = '09901209463';
    // $from = '50004001464354';
    // $text = 'تست وب سرویس ملی پیامک';
    // $response = $sms->send($to, $from, $text);
    // string(65) "{"Value":"5243690627088685351","RetStatus":1,"StrRetStatus":"Ok"}"
    // $data = array('username' => "9901209463", 'password' => "d72abfd2-ba2f-4cb2-b4a8-29578c2d4875", 'to' => "09393721208", 'from' => "50004001464354", "text" => 'تست پیامک');
    // $handle = curl_init('https://rest.payamak-panel.com/api/SendSMS/SendSMS');
    // $data = array(
    //     'username' => "9901209463",
    //     'password' => "d72abfd2-ba2f-4cb2-b4a8-29578c2d4875",
    //     'to' => "9901209463",
    //     'from' => "50004001464354",
    //     'bodyId' => '478949',
    //     "text" => ['112312']
    // );
    // $post_data = http_build_query($data);
    // $handle = curl_init('https://api.payamak-panel.com/post/Send.asmx?wsdl');

    // curl_setopt($handle, CURLOPT_HTTPHEADER, array(
    //     'content-type' => 'application/x-www-form-urlencoded'
    // ));
    // curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($handle, CURLOPT_POST, true);
    // curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    // $response = curl_exec($handle);
    // var_dump($response);

    // phpinfo();
    // die();
    ini_set("soap.wsdl_cache_enabled", "0");
    $sms_client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding' => 'UTF-8'));

    $parameters['username'] = "9901209463";
    $parameters['password'] = "d72abfd2-ba2f-4cb2-b4a8-29578c2d4875";
    $parameters['to'] = "09901209463";
    // $parameters['from'] = "50004001464354";
    $parameters['text'] = ['1111'];
    $parameters['bodyId'] = 478949;
    $parameters['isflash'] = true;

    print_r($sms_client->SendByBaseNumber($parameters)->SendByBaseNumberResult);
    exit(1);
    $response = "009278349827384";
    if (is_numeric($response) && strlen((string) $response) >= 15) {
        echo "ok";
    }else {
        echo "noth";
    }
    die();
    //بدون نیاز به پکیج گیت هاب Procedural PHP نمونه کدهای 
    $data = array('username' => "9901209463", 'password' => "d72abfd2-ba2f-4cb2-b4a8-29578c2d4875", 'to' => "09901209463", 'from' => "50004001464354", "code" => '1111');
    $post_data = http_build_query($data);
    $handle = curl_init('https://rest.payamak-panel.com/api/SendSMS/SendOtp');
    curl_setopt($handle, CURLOPT_HTTPHEADER, array(
        'content-type' => 'application/x-www-form-urlencoded'
    ));
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    $response = curl_exec($handle);
    print_r($response);
    die();

    // auth()->guard('admin')->logout();
    // session()->invalidate();
    // session()->regenerateToken();
    // die();
    // Admin::create([
    //     'mobile'=>'09336924836',
    //     'google2fa_secret' => '64VRAGR7VJ4KUS3KS7N6256ZMKYMOI6X',
    //     'is_active' => true

    // ]);
    dd('ss');
    User::factory()->count(30)->create();
    dd('cone');
    $admin = Admin::where(['mobile' => "09336924836", 'is_active' => true])->first();
    dd($admin->google2fa_secret);
    $nowHour = jdate()->subHours(2)->format("H:i");

    $days = [];
    // check if after 5pm
    $nowHour = (int) jdate()->format("H");

    if ($nowHour > 21) {
        $max = 4;
    } else {
        $now = Jalalian::now();
        $days[] = [
            'name' => $now->format('%A'),
            'date' => $now->format('Y/m/d'),
            'display' => $now->format('d F')
        ];

        $max = 3;
    }

    for ($i = 1; $i <= $max; $i++) {
        $date = Jalalian::now()->addDays($i);
        $dayOfWeek = $date->format('w'); // 0=Saturday in Jalali

        $days[] = [
            'name' => $date->format('%A'),
            'date' => $date->format('Y/m/d'),
            'display' => $date->format('d F')
        ];
    };
});
