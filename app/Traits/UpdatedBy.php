<?php


namespace App\Traits;


trait UpdatedBy
{
    public static function bootUpdatedBy()
    {
        static::updating(function($model){
            $property = $model->editor();
            if(auth()->check()){
                $model->$property = auth()->id();
            }

        });
    }

    abstract public function editor() :string;
}
