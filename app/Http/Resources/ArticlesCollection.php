<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticlesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'count' => $this->count(),
            'page' => $this->currentPage(),
            'per_page' => $this->perPage(),
            'has_more' => $this->hasMorePages(),
            'data' => $this->collection,
        ];
    }
}
