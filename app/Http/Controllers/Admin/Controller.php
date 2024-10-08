<?php

namespace App\Http\Controllers\Admin;

use App\Services\AuthService as AuthService;
use App\Services\CommonService as CommonService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * construct
     */
    public function __construct() {
        set_time_limit(20);
        ini_set("memory_limit", "6G");
        ini_set("max_input_time", "3600");
        ini_set("max_execution_time", "3600");
        ini_set("upload_max_filesize", "6000M");
        ini_set("post_max_size", "12000M");
        // ログインしていない場合、ログイン画面へ
        $this->middleware('auth:user');
        $this->middleware(function ($request, $next) {
            return $next($request);
        });
	}

    /**
    * 認証情報
    * @param string $userCd
    * @param AuthService $service
    * @return array $authInfo
    */
    public function getAuth($userCd, AuthService $service)
    {
        $authInfo =  $service->findUserById($userCd);
        return $authInfo;
    }

    /**
    * メニュー情報
    * @param CommonService $service
    * @return array $menu
    */
    public function getMenu()
    {
        $service = new CommonService();
        $menu =  $service->getMenu();

        return $menu;
    }

    /** 共通情報取得
     * @return $rows
     */
    public function getPageInfo()
    {
        $pageInfo = [
        	'title' => 'wondou',
            'description' => 'wondou基幹システム',
        	'keywords' => '',
        	'canonical' => '',
        ];
        return $pageInfo;
    }

    /**　メニューごとセキュリティ情報
     * @return $rows
     */
    public function getSecurityInfo()
    {

        $service = new CommonService();
        $userSecurity =  $service->getUserSecurity();

        return $userSecurity;
    }

    /**　機能別権限情報
     * @return $rows
     */
    public function commonExec($menuId = null)
    {
        $auth = $this->getSecurityInfo()->where('mt_user_id', Auth::user()->id)->where('def_3_menu_id', $menuId)->first();
        return $auth;
    }
}
