<?php 
namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuRepository{

    public static function getHijos($padres, $line){

        $children = [];
        foreach($padres as $line1){
            if($line['id'] == $line1['menu_id']){
                $children = array_merge($children, [array_merge($line1, ['submenu' => self::getHijos($padres, $line1)])]);
            }
        }
        return $children;


    }
    public static  function getPadres($front){
        
        if($front){
            
            
            return Menu::whereHas('roles', function ($query) {
                $query->where('role_id',Auth::user()->roles->pluck('id')->first())->orderby('menu_id');
            })->orderby('menu_id')
                ->orderby('order')
                ->get()
                ->toArray();

        }else{
            return Menu::orderBy('menu_id')
            ->orderBy('order')
            ->get()
            ->toArray();
        }

    }


    public static function getMenu( $front = false){
        $menus      = new Menu();
        $padres     = self::getPadres($front);
        $menuAll    = [];

        foreach($padres as $line){
            if($line['menu_id'] != 0)
                break;
            $item = [array_merge($line, ['submenu' => self::getHijos($padres, $line)])];
            $menuAll = array_merge($menuAll, $item);    
        }
    
        return $menuAll;

    }

    public function saveOrder($menu){
        $menus = json_decode($menu);
        
        foreach ($menus as $var => $value) {
            
            Menu::where('id', $value->id)->update(['menu_id' => 0, 'order' => $var + 1]);
            if (!empty($value->children)) {
                foreach ($value->children as $key => $vchild) {
                    $update_id = $vchild->id;
                    $parent_id = $value->id;
                    Menu::where('id', $update_id)->update(['menu_id' => $parent_id, 'order' => $key + 1]);
                    if (!empty($vchild->children)) {
                        foreach ($vchild->children as $key => $vchild1) {
                            $update_id = $vchild1->id;
                            $parent_id = $vchild->id;
                            Menu::where('id', $update_id)->update(['menu_id' => $parent_id, 'order' => $key + 1]);
                            if (!empty($vchild1->children)) {
                                foreach ($vchild1->children as $key => $vchild2) {
                                    $update_id = $vchild2->id;
                                    $parent_id = $vchild1->id;
                                    Menu::where('id', $update_id)->update(['menu_id' => $parent_id, 'order' => $key + 1]);
                                    if (!empty($vchild2->children)) {
                                        foreach ($vchild2->children as $key => $vchild3) {
                                            $update_id = $vchild3->id;
                                            $parent_id = $vchild2->id;
                                            Menu::where('id', $update_id)->update(['menu_id' => $parent_id, 'order' => $key + 1]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }



    }
    


}