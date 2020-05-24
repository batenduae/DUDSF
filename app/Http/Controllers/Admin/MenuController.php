<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\MenuContract;
use App\Http\Controllers\BaseController;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    protected $menuRepository;
    public function __construct(MenuContract $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {
        $menus = $this->menuRepository->listMenus();
        $this->setPageTitle('Menus', 'List of all menus');
        return view('admin.menus.index',compact('menus'));
    }

    public function create()
    {
        $menus = $this->menuRepository->listMenus();
        $this->setPageTitle('Menus','Create Menu');
        return view('admin.menus.create',compact('menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:40',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $maxOrder = Menu::where('parent_id',$request->parent_id)->max('order');
        $request->request->add(['order' => $maxOrder+1]);

        $params = $request->except('_token');
        $menu = $this->menuRepository->createMenu($params);
        if(!$menu) {
            return $this->responseRedirectBack('Error Occurred while adding menu','error',true,true);
        }
        return $this->responseRedirect('admin.menus.index','Menu added successfully.','success',false,false);
    }

    public function edit($id)
    {
        $targetMenu = $this->menuRepository->findMenuById($id);
        $menus = $this->menuRepository->listMenus();
        $this->setPageTitle('Menus','Edit Menu: '.$targetMenu->name);
        return view('admin.menus.edit',compact('menus','targetMenu'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:40',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);
        if (Menu::where('id',$request->id)->first()->order == null){
            $maxOrder = Menu::where('parent_id',$request->parent_id)->max('order');
            $request->request->add(['order' => $maxOrder+1]);
        }
        $params = $request->except('_token');
        $menu = $this->menuRepository->updateMenu($params);
        if(!$menu) {
            return $this->responseRedirectBack('Error Occurred while updating menu','error',true,true);
        }
        return $this->responseRedirectBack('Menu updated successfully.','success',false,false);
    }

    public function delete($id)
    {
        $menu = $this->menuRepository->deleteMenu($id);
        if (!$menu){
            return $this->responseRedirectBack('Error Occurred while deleting menu','error',true,true);
        }
        return $this->responseRedirect('admin.menus.index','Menu deleted successfully.','success',false,false);
    }

    public function actionOnMenu($action,$item,$id = null)
    {
        switch ($action){
            case 'up':
                $value = 1;
                break;
            case 'down':
                $value = 0;
                break;
        }
        switch ($id){
            case is_numeric($id):{
                    $justMenu = $this->menuRepository->findMenuById($id);
                    $menus = [$justMenu];
                } break;
            case 'all':
                $menus = $this->menuRepository->all();
                break;
            default:
                return $this->responseRedirectBack('Nothing Changed','warning',true,true);
                break;
        }
        foreach ($menus as $menu){
            switch ($item){
                case 'featured':
                    $menu->featured = $value;
                    break;
                case 'menu':
                    $menu->menu = $value;
                    break;
            }
            $menu->save();
        }
        return $this->responseRedirectBack('Updated successfully','success',true,true);
    }
}
