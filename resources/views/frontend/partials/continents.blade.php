@section('style')
    <style>
    
    </style>
@endsection

<div class="change-home">
    <div class="zoom-container ">
        <div id="map" class="zoom-in"></div>
    </div>
    <h3 id="continent-name" class="text-center  m-4 text-uppercase" style="margin-bottom: 2px !important;"></h3>
    <!-- <h3 class="text-center" id="continent-info"></h3> -->
    <div id="country-slider"></div> 
</div>
@section('scripts')
<script src="{{asset('continents/map.js')}}"></script>
@endsection
