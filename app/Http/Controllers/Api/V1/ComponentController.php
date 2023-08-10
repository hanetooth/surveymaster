<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComponentResource;
use App\Http\Resources\ComponentResourceCollection;
use App\Models\Component;

/**
 * @group ComponentCRUD
 *
 * CRUD Api for Component
 */
class ComponentController extends Controller
{
    /**
     * Get all components
     *
     * @return ComponentResourceCollection
     */
    public function getAll()
    {
        return new ComponentResourceCollection(
            new ComponentResource(Component::all())
        );
    }
}
