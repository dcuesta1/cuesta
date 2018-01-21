<?php
use \App\AutoTelematic\AutoTelematic;


Route::get('/decode', function() {
    $it = new AutoTelematic();
    return $it->decode('1FTRW08L83KA45961');
});

Route::get('xml', function () {

    $xml = simplexml_load_file(base_path().'/routes/file.xml');
    $items = [];
    $avaiableAttributes = array("armor", "defense", "attack");

    foreach ($xml->item as $item) {
        $row = [];
        $attributes = $item->attributes();

        if(count($attributes)) {
            foreach ($attributes as $k => $v){
                $row[$k] = current($v);
            }
        }

        foreach ($item->children() as $x => $y) {
            $key = current($y)['key'];
            if(in_array($key, $avaiableAttributes)) {
                if ($key == "weight") {
                    $weightValue = current($y)['value'];
                    if ($weightValue < 10) {
                        $row->$key = "0.0".$weightValue.".oz";
                    } elseif (current($y)['value'] < 100) {
                        $row->$key = "0.".$weightValue.".oz";
                    } else {
                        $weightValue = substr($weightValue, 0, 2);
                        $row->$key = $weightValue.".00 oz";
                    }
                } else {
                    $row[$key] = current($y)['value'];
                }
            }
        }

        if ($itemId == $row->id) {
            $items[] = $row;
        }
    }

   echo $attr;
});

