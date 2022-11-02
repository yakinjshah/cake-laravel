<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class AdminBaseController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    use AuthorizesRequests {
        authorize as protected baseAuthorize;

    }
    public function authorize($ability,$arguments =[]){
        if(\Auth::guard('admin_api')->check()){
            \Auth::shouldUse('admin_api');
        }
        $this->baseAuthorize($ability,$arguments);
    }
}
