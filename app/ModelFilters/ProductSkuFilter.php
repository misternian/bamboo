<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProductSkuFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function sku($id)
    {
        return $this->where('sku_id', $id);
    }

    public function skuCode($sku_code)
    {
        return $this->where('sku_code', $sku_code);
    }

    public function spuCode($spu_code)
    {
        return $this->related('spu', 'spu_code', $spu_code);
    }

    public function spu($id)
    {
        return $this->related('spu', 'spu_id', $id);
    }

    public function title($title)
    {
        return $this->related('spu', 'title', 'LIKE', '%'.$title.'%');
    }
}
