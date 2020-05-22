<?php

namespace App\Repositories;

use App\Contracts\MenuContract;
use App\Models\Menu;
use App\Traits\FileUpload;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MenuRepository extends BaseRepository implements MenuContract
{
    use FileUpload;
    public function __construct(Menu $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listMenus(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc')
    {
        return $this->all($columns,$orderBy,$sortBy);
    }

    public function findMenuById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function createMenu(array $params)
    {
        try {
            $collection = collect($params);
            $image = null;
            if ($collection->has('image') && ($params['image'] instanceof UploadedFile)) {
                $image = $this->uploadOne($params['image'],'menus');
            }
            $featured = $collection->has('featured') ? 1 : 0;
            $menu = $collection->has('menu') ? 1 : 0;
            $mergeData = $collection->merge(compact('menu','image','featured'));
            $newMenu = new Menu($mergeData->all());
            $newMenu->save();
            return $newMenu;
        } catch (QueryException $exception){
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateMenu(array $params)
    {
        try {
            $newMenu = $this->findMenuById($params['id']);
            $collection = collect($params)->except('delete');;
            $delete = collect($params)->only('delete')->has('delete') ? 1 : 0;
            $image = $newMenu->image;
            if (!($collection->has('image') && ($params['image'] instanceof UploadedFile))) {
                if ($delete){
                    if ($image != null) {
                        $this->deleteOne($newMenu->image);
                    }
                    $image = null;
                }
            }
            if ($collection->has('image') && ($params['image'] instanceof UploadedFile)) {
                if ($newMenu->image != null){
                    $this->deleteOne($newMenu->image);
                }
                $image = $this->uploadOne($params['image'],'menus');
            }
            $featured = $collection->has('featured') ? 1 : 0;
            $menu = $collection->has('menu') ? 1 : 0;
            $mergeData = $collection->merge(compact('menu','image','featured'));
            $newMenu->update($mergeData->all());
            return $newMenu;
        } catch (QueryException $exception){
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function deleteMenu(int $id)
    {
        $menu = $this->findMenuById($id);
        if ($menu->image != null){
            $this->deleteOne($menu->image);
        }
        $menu->delete();
        return $menu;
    }
}
