<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Exceptions\MenuNotFoundException;

use App\Helpers\ResponseAPI;

use App\Menu;

class MenuController extends BaseController
{
    public function index()
    {
        $menu = Menu::all();
        
        if (!$menu) {
            throw new MenuNotFoundException('Menu not found', 404);
        }

        return ResponseAPI::success('Data successfully consulted',
                                   ['data' => $menu]);
    }
}
