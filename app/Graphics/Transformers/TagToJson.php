<?php
namespace Graphics\Transformers;

use Graphics\Transformers\ToJson;

class TagToJson extends ToJson {
    
    public function transform($tag) {
        return [
            "value" => $tag["name"],
            "tokens" => explode(" ", $tag["name"]),
            "id" => $tag["id"]
            ];
    }
}
?>