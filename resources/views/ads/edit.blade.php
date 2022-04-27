@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit - {{ $ad->title }}</div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form" method="post" action="{{ route('ad.update', $ad->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Pavadinimas" value="{{ $ad->title }}">
                                <textarea name="content" class="form-control" placeholder="Aprasymas">{{ $ad->content }}</textarea>
                                <input type="text" name="image" class="form-control" placeholder="image" value="{{ $ad->image }}">
                                <input type="text" name="year" class="form-control" placeholder="1990" value="{{ $ad->year }}">
                                <input type="text" name="vin" placeholder="WAUZZZ..." class="form-control" value="{{ $ad->vin }}">
                                <input type="text" name="price" placeholder="100e" class="form-control" value="{{ $ad->price }}">
                                <select name="color_id" class="form-select">
                                    <option>Color</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}" @if($color->id == $ad->color->id) selected @endif>{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                <select name="type_id" class="form-select">
                                    <option>Type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" @if($type->id == $ad->type->id) selected @endif>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <select name="manufacturer_id" class="form-select" id="manufacturerId">
                                    <option value="null">Manufacturer</option>
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}" @if($manufacturer->id == $ad->manufacturer_id) selected @endif>{{ $manufacturer->name }}</option>
                                    @endforeach
                                </select>
                                <select name="model_id" class="form-select" id="modelId">
                                    <option value="">Model</option>
                                    @foreach($current_models as $model)
                                        <option value="{{ $model->id }}" @if($model->id == $ad->model_id) selected @endif>{{ $model->name }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const selectManufacturers = document.getElementById('manufacturerId');
        const selectModels = document.getElementById('modelId');

        selectManufacturers.addEventListener('change', function (){
            selectModels.innerHTML = "";
            selectModels.append(new Option('Model', 'null'));

            if(selectManufacturers.value !== 'null') {
                fetch('{{ route('ajax.models', '') }}/' + selectManufacturers.value)
                    .then(response => response.json())
                    .then(function (data) {
                        for (const [key, value] of Object.entries(data)) {
                            selectModels.append(new Option(value.name, value.id));
                        }
                    });
            }
        });
    </script>

@endsection
