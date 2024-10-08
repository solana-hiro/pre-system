<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    /**
    * commonParams: 共通パラメータ
    */
    private $commonParams;

    public function __construct()
    {
        parent::__construct();
        $menus = $this->getMenu();
        $pageInfo = $this->getPageInfo();
        $this->commonParams = ['menus' => $menus, 'pageInfo' => $pageInfo];
    }

    /**
     * TOP表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request)
    {
        $this->commonParams['pageInfo']['title'] = 'TOP';
        //dd($this->commonParams['menus']);
        /*
        foreach($this->commonParams['menus']['def1'] as $def1) {
            dd($def1['menu_1_name']);
        }
            */
		return view('admin.top.index', ['commonParams' => $this->commonParams]);
    }

}
