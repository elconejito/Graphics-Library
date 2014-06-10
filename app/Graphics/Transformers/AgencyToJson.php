<?php
namespace Graphics\Transformers;

use Graphics\Transformers\ToJson;

class AgencyToJson extends ToJson {
    
    public function transform($agency) {
        return [
            "value" => $agency["name"],
            "tokens" => explode(" ", $agency["name"]),
            "id" => $agency["id"]
            ];
    }
}
?>