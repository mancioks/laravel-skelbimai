@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Sukurti skelbima') }}</div>

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

                        <form class="form" method="post" action="{{ route('ad.store') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Pavadinimas" value="{{ old('title') }}">
                                <textarea name="content" class="form-control" placeholder="Aprasymas">{{ old('content') }}</textarea>
                                <input type="text" name="image" class="form-control" placeholder="image" value="{{ old('image') }}">
                                <input type="text" name="year" class="form-control" placeholder="1990" value="{{ old('year') }}">
                                <input type="text" name="vin" placeholder="WAUZZZ..." class="form-control" value="{{ old('vin') }}">
                                <input type="text" name="price" placeholder="100e" class="form-control" value="{{ old('price') }}">
                                <select name="color_id" class="form-select">
                                    <option>Color</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                <select name="type_id" class="form-select">
                                    <option>Type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <select name="manufacturer_id" class="form-select" id="manufacturerId">
                                    <option value="null">Manufacturer</option>
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                    @endforeach
                                </select>
                                <select name="model_id" class="form-select" id="modelId">
                                    <option value="">Model</option>
                                </select>
                                <input type="submit" value="Sukurti" class="btn btn-primary">
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
