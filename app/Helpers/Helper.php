<?php

namespace App\Helpers;

class Helper{
    
    public static function getParentsAttribute($category)
    {
        $parents = collect([]);
    
        $parent = $category->parent;
    
        while(!is_null($parent)) {
            $parents->prepend($parent);
            $parent = $parent->parent;
        }
        $result = "";
        foreach ($parents as $key => $value) {
            $result .= $value->name." > ";
        }
        return $result;
    }
}
