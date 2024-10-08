<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $layout, $dir, $assets, $isHeader1, $isFooter, $isFooter1, $isFooter2 ;

    public function __construct($layout = '', $dir=false, $assets = [], $isHeader1 = false, $isFooter=false, $isFooter1=false, $isFooter2=false)
    {
        $this->layout = $layout;
        $this->dir = $dir;
        $this->assets = $assets;
        $this->isHeader1 = $isHeader1;
        $this->isFooter = $isFooter;
        $this->isFooter1 = $isFooter1;
        $this->isFooter2 = $isFooter2;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $userId = Auth::user()->id;
         $user = User::find($userId);

         $userProfile = $user ? $user->userProfile()->first() : null;
         
         $navItems = [
             'bike' => $userProfile ? in_array('project_bike', json_decode($userProfile->project_implemented_type, true) ?? []) : false,
             'solar' => $userProfile ? in_array('project_solar', json_decode($userProfile->project_implemented_type, true) ?? []) : false,
         ];

         // Check if the user has the 'user' role
        if ($user && $user->hasRole('user')) {
            // Automatically set layout to 'horizontal' for users with the 'user' role
            $this->layout = 'horizontal';
        }

        switch($this->layout){
            case 'horizontal':
                return view('layouts.dashboard.horizontal');
            break;
            case 'dualhorizontal':
                return view('layouts.dashboard.dual-horizontal');
            break;
            case 'dualcompact':
                return view('layouts.dashboard.dual-compact');
            break;
            case 'boxed':
                return view('layouts.dashboard.boxed');
            break;
            case 'boxedfancy':
                return view('layouts.dashboard.boxed-fancy');
            break;
            case 'simple':
                return view('layouts.dashboard.simple');
            break;
            case 'landing':
                return view('landing-pages.layouts.default');
            break;
            default:
                return view('layouts.dashboard.dashboard');
            break;
        }
    }
}
