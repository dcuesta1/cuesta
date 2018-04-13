<?php
/**
 * Base Model for Auto Telematic lib.
 *
 * @author: Cuesta
 */

namespace Api\AutoTelematic\models;


class BaseModel
{
    public function  __constructor($item){
        foreach ($item as $k => $v) {
            $this->$k = $v;
        }
    }

}