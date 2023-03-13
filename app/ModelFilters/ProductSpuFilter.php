<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProductSpuFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function spu($id)
    {
        return $this->where('sku_id', $id);
    }

    public function spuCode($spu_code)
    {
        return $this->where('spu_code', $spu_code);
    }

    public function title($title)
    {
        return $this->where('title', 'LIKE', '%'.$title.'%');
    }
}
