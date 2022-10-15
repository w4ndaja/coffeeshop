<?php

namespace App\Traits\Model;

trait Search{
    public function scopeSearch($q, $search, ...$columns)
    {
        if(!empty($search)){
            foreach($columns as $key => $value){
                if($key == 0){
                    $q->where($value, 'like', '%'.$search.'%');
                }else{
                    $q->orWhere($value, 'like', '%'.$search.'%');
                }
            }
        }
    }
}
