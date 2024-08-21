@section('style')
    <style>
        #map {
            height: 500px; /* Adjust the height as needed */
            width: 100%;
        }

        .continent-highlight {
            fill-opacity: 0.6;
            fill-color: #f39c12; /* Highlight color */
            stroke: #e67e22; /* Border color */
            stroke-width: 2;
        }

        #continent-info {
            margin-top: 15px;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            font-size: 16px;
            text-align: center;
        }

        #country-slider {
            margin-top: 15px;
            overflow: hidden;
            white-space: nowrap;
        }

        .country-item {
            display: inline-block;
            margin-right: 10px;
            text-align: center;
        }

        .country-item img {
            width: 100px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .country-item span {
            display: block;
            margin-top: 5px;
            font-size: 14px;
            font-weight: bold;
        }
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
