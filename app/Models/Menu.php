<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'featured', 'menu', 'order', 'image'
    ];

    protected $casts = [
        'parent_id'     =>  'integer',
        'featured'      =>  'boolean',
        'menu'          =>  'boolean',
        'order'         =>  'integer'
    ];

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setParentIdAttribute($value){
        $this->attributes['parent_id'] = $value;
        $maxOrder = Menu::where('parent_id',$value)->max('order');
        $this->attributes['order'] = $maxOrder+1;
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

}
