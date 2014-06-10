<?php
namespace Graphics\Transformers;

use Graphics\Transformers\ToJson;

class GraphicToJson extends ToJson {
    
    public function transform($graphic) {
        return [
            "value" => $graphic["name"],
            "tokens" => explode(" ", $graphic["name"]),
            "id" => $graphic["id"]
            ];
    }
}
?>