<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class UpdateHelpService
{
    public function __construct(
        public Model $data,
    ){}

    public function createArray(): array
    {
        $arrayData = $this->data->toArray();
        $updatedChanges = [];
        
        foreach ($arrayData as $field => $value) {
            
            if($this->data->isDirty($field)) {                               
                $changes['old'] = $this->data->getOriginal($field);
                $changes['new'] = $value;
                $changes['field'] = $field;
                $updatedChanges[] = $changes;                
            }
        }
        return $updatedChanges;
    }   
}