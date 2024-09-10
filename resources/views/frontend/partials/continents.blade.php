@section('style')
    <style>
         #globe-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f0f0f0;
        }
        svg { width: 80%; height: auto; }
        .flag {
            width: 30px;
            height: 20px;
            transform-origin: center;
        }
    </style>
@endsection
<div class="container">
    <div class="change-home">
        <div class="zoom-container zoom-div">
            <div id="map" class="zoom-in"></div>
        </div>
        <h3 id="continent-name" class="text-center  m-4 text-uppercase" style="margin-bottom: 2px !important;"></h3>
        <div id="country-slider"></div> 
    </div>
</div>
@section('scripts')
<script src="{{asset('continents/map.js')}}"></script>
<script src="{{ asset('continents/globe.js') }}"></script>
@endsection
