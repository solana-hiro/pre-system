<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\DefCustomerClassThing\SearchRequest;
use App\Services\DefCustomerClassThingService as DefCustomerClassThingService;
use Illuminate\Support\Facades\Log;

class DefCustomerClassThingController extends Controller
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
}
