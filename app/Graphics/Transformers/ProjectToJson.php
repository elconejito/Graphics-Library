<?php
namespace Graphics\Transformers;

use Graphics\Transformers\ToJson;

class ProjectToJson extends ToJson {
    
    public function transform($project) {
        return [
            "value" => $project["name"],
            "tokens" => explode(" ", $project["name"]),
            "id" => $project["id"]
            ];
    }
}
?>