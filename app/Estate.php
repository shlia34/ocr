<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Defs\DefStatus;

class Estate extends Model
{
    protected $fillable = ['id','file_id','info','status_code'];

    public function scopeSearch($query,$conditions)
    {

        $text = $conditions['text'] ?? null;
        $arr = $this->separateWithBlanks($text);

        foreach($arr as $val){
            $query->where('info','like','%'.$val.'%');
        }
        return $query;
    }

    private function SeparateWithBlanks($text)
    {
        $pattern = '/\s/u';
        $pieces =  preg_split($pattern ,$text);
        return $pieces;
    }

    public function getStatusNameAttribute()
    {
        return DefStatus::getStatusName($this->status_code);
    }
}
