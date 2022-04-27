<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class Models extends Controller
{
    public function getByManufacturerId($id)
    {
        $modelsObject = Manufacturer::findOrFail($id)->models;

        $models = [];

        foreach ($modelsObject as $model) {
            $models[] = ['id' => $model->id, 'name' => $model->name];
        }

        return json_encode($models);
    }
}
