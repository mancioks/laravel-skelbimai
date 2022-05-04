<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Manufacturer;
use App\Models\Model;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Color;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('manufacturer')) {
            $manufacturerId = $request->get('manufacturer');
            $ads = Ad::where('manufacturer_id', $manufacturerId)->paginate(42)->withQueryString();
        } else {
            $ads = Ad::paginate(42)->withQueryString();
        }

        $data['ads'] = $ads;
        $data['request'] = $request;

        $data['manufacturers'] = Manufacturer::all();
        return view('ads.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['colors'] = Color::all();
        $data['types'] = Type::all();
        $data['manufacturers'] = Manufacturer::all();

        $models = [];
        foreach (Model::all() as $model) {
            $models[$model->manufacturer_id][] = ['name' => $model->name, 'id' => $model->id];
        }

        $data['models'] = json_encode($models);

        return view('ads.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request)
    {
        $ad = new Ad();
        $ad->title = $request->post('title');
        $ad->content = $request->post('content');
        $ad->year = $request->post('year');
        $ad->price = $request->post('price');
        $ad->image = $request->post('image');
        $ad->vin = $request->post('vin');
        $ad->user_id = Auth::id();
        $ad->views = 0;
        $ad->color_id = $request->post('color_id');
        $ad->active = 1;
        $ad->model_id = $request->post('model_id');
        $ad->manufacturer_id = $request->post('manufacturer_id');
        $ad->category_id = 1;
        $ad->slug = Str::slug($ad->title);
        $ad->type_id = $request->post('type_id');

        $ad->save();

        return redirect()->route('ad.show', [$ad]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        $data['ad'] = $ad;
        $ad->views = $ad->views + 1;
        $ad->save();
        $data['comments'] = $ad->comments()->orderByDesc('id')->paginate(5);
        return view('ads.single', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        $data['ad'] = $ad;
        $data['colors'] = Color::all();
        $data['types'] = Type::all();
        $data['manufacturers'] = Manufacturer::all();

        $currentModels = Manufacturer::find($ad->manufacturer_id)->models;
        $data['current_models'] = $currentModels;

        return view('ads.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdRequest  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $ad->title = $request->post('title');
        $ad->content = $request->post('content');
        $ad->year = $request->post('year');
        $ad->price = $request->post('price');
        $ad->image = $request->post('image');
        $ad->vin = $request->post('vin');
        $ad->color_id = $request->post('color_id');
        $ad->type_id = $request->post('type_id');
        $ad->model_id = $request->post('model_id');
        $ad->manufacturer_id = $request->post('manufacturer_id');

        $ad->save();

        return redirect()->route('ad.show', [$ad]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->back();
    }
}
