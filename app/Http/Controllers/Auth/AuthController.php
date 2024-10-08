<?php

namespace App\Http\Controllers\Auth;

use App\Services\AuthService as AuthService;
use App\Http\Requests\AuthRequest as AuthRequest;
use App\Exceptions\HttpAuthException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    /**
     * ログインに使用するカラムの設定
     *
     * @return string
     */
    public function username()
    {
        return 'user_cd';
    }

    /**
     * ログイン画面表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index()
    {
		return view('auth.login');
    }

    /**
     * ログイン処理
     * @param $request
     * @param $service
     * @return Object
     */
    public function login(AuthRequest $request, AuthService $service)
    {
        $params = $request->validated();
		$result = $service->login($params, $request);
        if(array_key_exists('sessionErrors', $result)) {
            return back()->withInput()->with('sessionErrors', $result['sessionErrors']);
        } else {
		    return redirect(route('top.index'));
        }
    }

    /**
     * ログインアウト処理
     * @param $request
     * @param $service
     * @return Object
     */
    public function logout(AuthService $service)
    {
        $result = $service->logout();
		return redirect(route('auth.login'));
    }
}
