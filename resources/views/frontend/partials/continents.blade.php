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

<div class="change-home">
    <div class="zoom-container ">
        <div id="map" class="zoom-in"></div>
    </div>
    <h3 id="continent-name" class="text-center  m-4 text-uppercase" style="margin-bottom: 2px !important;"></h3>
    <div id="country-slider"></div> 
</div>
<div class=".threeD-globe"  style="display:none">
    <div id="globe-container">
    <svg viewBox="0 0 100 100">
            <!-- Globe Circle -->
            <circle cx="50" cy="50" r="40" stroke="black" stroke-width="1" fill="lightblue" />
            <!-- Flags will be added here -->
        </svg>
    </div>
</div>
@section('scripts')
<script src="{{asset('continents/map.js')}}"></script>
<script src="{{ asset('continents/globe.js') }}"></script>
@endsection
