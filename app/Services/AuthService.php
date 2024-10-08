<?php

namespace App\Services;

use App\Repositories\MtUser\MtUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

/**
 * 認証関連 サービスクラス
 */
class AuthService
{

    /**
     * @var MtUserRepository
     */
    private MtUserRepository $mtUserRepository;

    /**
     * @param MtUserRepository $mtUserRepository
     */
    public function __construct()
    {
        $this->mtUserRepository = new MtUserRepository();
    }

    /**
    * ログイン機能 guard
    *
    */
    protected function guard()
    {
        return Auth::guard('user');
    }

    /** ログイン
     * @param $params
     * @return $rows
     */
    public function login($params, $request)
    {
        $datas = $this->mtUserRepository->login($params);
        if ($datas) {
            //パスワード確認
            if (!Hash::check($params['password'], $datas['password'])){
                $sessionErrors[] = __("validation.error_messages.password_is_incorrect");
                $result['sessionErrors'] = $sessionErrors;
                return $result;
            } else {
		        $credentials = [
		            'user_cd' => $request['user_cd'],
		            'password' => $request['password'],
		        ];
		        if($this->guard()->attempt($credentials, $request->filled('remember'))) {
		            $this->guard()->login($datas);
                    $result['datas'] = $datas;
			        return $result;
		        }
		    }
	    } else {
            $sessionErrors[] = __("validation.error_messages.user_code_is_incorrect");
            $result['sessionErrors'] = $sessionErrors;
            return $result;
	    }
    }

    /** ログアウト
     * @return $rows
     */
    public function logout()
    {
        return $this->guard()->logout();
    }

    /** 認証情報取得
     * @param string $userId
     * @return array $rows
     */
    public static function findUserById($userId)
    {
        $rows = MtUserRepository->getUserInfo($userID);
        if($rows) {
            return $rows->toArray();
        }else{
            return null;
        }
    }

}
