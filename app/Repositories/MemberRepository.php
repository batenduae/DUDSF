<?php

namespace App\Repositories;

use App\Contracts\MemberContract;
use App\Models\Member;
use App\Traits\FileUpload;
use Illuminate\Http\UploadedFile;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class MemberRepository extends BaseRepository implements MemberContract
{
    use FileUpload;
    public function __construct(Member $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listMembers(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc')
    {
        return $this->all($columns,$orderBy,$sortBy);
    }
    public function findMemberById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e){
            throw new ModelNotFoundException($e);
        }

    }
    public function createMember(array $params)
    {
        try {
            $collection = collect($params);
            $image = null;
            if($collection->has('image') && ($params['image'] instanceof UploadedFile)){
                $image =  $this->uploadOne($params['image'],'member');
            }
            if($collection->has('membership')){
                $membership = 1;
                $collection->merge(compact('membership'));
            }
//            $membership = $collection->has('membership') ? 1 : 0;
//            $display    = $collection->has('display') ? 1 : 0;
//            $banned     = $collection->has('banned') ? 1 : 0;
//            $active     = $collection->has('active') ? 1 : 0;
//            $inform     = $collection->has('inform') ? 1 : 0;
//            $edit       = $collection->has('edit') ? 1 : 0;
//            $imageShow  = $collection->has('imageShow') ? 1 : 0;
//            $mergeData = $collection->merge(compact('image','membership','display','banned','active','inform','edit','imageShow));

            $mergeData = $collection->merge(compact('image'));
            $newMember = new Member($mergeData->all());
            $newMember->save();
            return $newMember;
        }catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    public function updateMember(array $params)
    {
        try {
            $oldMember = $this->findMemberById($params['id']);
            $collection = collect($params)->except('delete');;
            $delete = collect($params)->only('delete')->has('delete') ? 1 : 0;
            $image = $oldMember->image;
            if (!($collection->has('image') && ($params['image'] instanceof UploadedFile))) {
                if ($delete){
                    if ($image != null) {
                        $this->deleteOne($oldMember->image);
                    }
                    $image = null;
                }
            }
            if ($collection->has('image') && ($params['image'] instanceof UploadedFile)) {
                if ($oldMember->image != null){
                    $this->deleteOne($oldMember->image);
                }
                $image = $this->uploadOne($params['image'],'menus');
            }

            $membership = $collection->has('membership') ? 1 : 0;
            $display    = $collection->has('display') ? 1 : 0;
            $banned     = $collection->has('banned') ? 1 : 0;
            $active     = $collection->has('active') ? 1 : 0;
            $inform     = $collection->has('inform') ? 1 : 0;
            $edit       = $collection->has('edit') ? 1 : 0;
            $imageShow  = $collection->has('imageShow') ? 1 : 0;

            $mergeData = $collection->merge(compact('image','membership','display','banned','active','inform','edit','imageShow'));
            $oldMember->update($mergeData->all());
            return $oldMember;
        } catch (QueryException $exception){
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
    public function deleteMember(int $id)
    {
        $member = $this->findMemberById($id);
        if ($member->image != null){
            $this->deleteOne($member->image);
        }
        $member->delete();
        return $member;
    }
}
