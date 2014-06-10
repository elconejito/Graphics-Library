<?php
namespace Graphics\Transformers;

abstract class ToJson {
    public function transformCollection(array $items) {
        return array_map([$this, 'transform'], $items);
    }
    
    public abstract function transform($item);
}
?>