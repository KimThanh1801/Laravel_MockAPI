<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        // Kiển tra xem tính hợp lệ là đã nhập chưa
        $request->validate([
            'email' => 'required|email|unique:users',
            'fullname' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ]);
    
        // gọi và lưu dữ liệu vào bảng user
        User::create([
            'email' => $request->email,
            'name' => $request->fullname,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
    
        // Chuyển hướng đến trang đăng nhập
        return redirect()->route('user.login')->with('success', 'Đăng ký thành công, vui lòng đăng nhập.');
    }
    
    public function showLoginForm()
    {
        return view('user.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('index')->with('success', 'Đăng nhập thành công.');
        }
        

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.']);
    }
}
