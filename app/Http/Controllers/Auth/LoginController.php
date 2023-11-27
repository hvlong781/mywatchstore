<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\DailyStat;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated()
    {
        if (auth()->user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } else {
            $this->recordVisit();

            return redirect('/');
        }
    }

    private function recordVisit()
    {
        // Lấy ngày hiện tại
        $currentDate = now()->toDateString();

        // Kiểm tra xem đã có dữ liệu cho ngày hiện tại chưa
        $dailyStat = DailyStat::whereDate('date', $currentDate)->first();

        if ($dailyStat) {
            // Nếu đã có, tăng số lượt truy cập
            $dailyStat->increment('count');
        } else {
            // Nếu chưa có, tạo mới và đặt số lượt truy cập là 1
            DailyStat::create([
                'date' => $currentDate,
                'count' => 1,
            ]);
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Tìm hoặc tạo người dùng trong cơ sở dữ liệu
            $authUser = $this->findOrCreateUser($googleUser);

            // Kiểm tra xem người dùng đã đăng nhập bằng Google trước đó hay chưa
            if ($authUser->google_id) {
                // Người dùng đã đăng nhập bằng Google trước đó, đăng nhập vào hệ thống
                Auth::login($authUser, true);

                $this->recordVisit();

                return redirect()->intended('/');
            } else {
                // Người dùng chưa liên kết với Google, thực hiện quy trình liên kết
                return $this->linkGoogleAccount($authUser, $googleUser);
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Đăng nhập bằng Google thất bại.');
        }
    }

    // Hàm liên kết Google ID với tài khoản đã đăng ký
    protected function linkGoogleAccount($user, $googleUser)
    {
        $existingUser = User::where('google_id', $googleUser->id)->first();

        if ($existingUser) {
            // Google ID đã được liên kết với một tài khoản khác
            return redirect('/login')->with('error', 'Google ID đã được sử dụng cho một tài khoản khác.');
        }

        // Liên kết Google ID với tài khoản đã đăng ký
        $user->update([
            'google_id' => $googleUser->id,
            'google_name' => $googleUser->name,
            'google_email' => $googleUser->email,
            // ... (cập nhật các thông tin khác nếu cần)
        ]);

        // Đăng nhập người dùng
        Auth::login($user, true);

        $this->recordVisit();

        return redirect()->intended('/');
    }

    // Hàm tìm hoặc tạo người dùng mới
    protected function findOrCreateUser($googleUser)
    {
        // Kiểm tra xem Google ID đã tồn tại trong cơ sở dữ liệu hay chưa
        $authUser = User::where('google_id', $googleUser->id)->first();

        if ($authUser) {
            // Người dùng đã đăng nhập bằng Google trước đó, trả về người dùng
            return $authUser;
        }

        // Lấy avatar từ đối tượng GoogleUser
        $avatar = $googleUser->avatar;
        // Kiểm tra xem avatar có phải là một URL hợp lệ không
        if (filter_var($avatar, FILTER_VALIDATE_URL)) {
            // Nếu là URL hợp lệ, sử dụng nó
        } else {
            // Nếu không phải URL hợp lệ, sử dụng avatar mặc định
            $avatar = 'storage/avatar.jpg';
        }

        // Nếu bạn có một cột trong bảng Users để lưu avatar, hãy sử dụng nó
        $user = User::firstOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'password' => Hash::make(Str::random(16)),
                'google_id' => $googleUser->id,
                'google_name' => $googleUser->name,
                'google_email' => $googleUser->email,
                'avatar' => $avatar, // Lưu avatar vào cột avatar
                // ... (thêm các trường khác nếu cần)
            ]
        );

        return $user;
    }


}
