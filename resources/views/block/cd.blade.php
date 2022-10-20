<div class="row">
    <div class="col-lg-6">
        <p>Thành phố</p>
        <select name="city" id="city" class="custom-select rounded-0 choose city">
            <!-- Check if user login -->
            @if(Auth::Check())
                <!-- Check if user has update their city -->
                @if($account->profile['city'] == "0")
                    <option value="">Chọn thành phố</option>
                    @foreach($cities as $city)
                        <option value="{{ $city['id'] }}">
                        {{$city['name'] }}</option>
                    @endforeach
                @else
                    <!-- login user has update their city -->
                    @foreach($cities as $item)
                        <option value="{{ $item['id'] }}"
                            {{ $account->profile['city'] == $item['id'] ? 'selected' : ' '}}    
                        >
                        {{$item['name'] }}</option>
                    @endforeach
                @endif
            <!-- For non Login User -->
            @else
                <option value="">Chọn thành phố</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id}}"> {{ $city->name}} </option>
                @endforeach
            @endif
            
        </select>
    </div>
    <div class="col-lg-6">
        <p>Quận,Huyện</p>
        <select  name="district" id="district" class="custom-select rounded-0 district">
            <!-- Check if user login -->
            @if(Auth::check())
                <!-- Check if login user has update their district -->
                @if($account->profile['district'] == "0")
                    <option value="">Chọn quận</option>
                @else
                    <!-- login user has update their district -->
                    @foreach($districts as $item_d)
                        <option value="{{ $item_d['id'] }}"
                            {{ $account->profile['district'] == $item_d['id'] ? 'selected' : ' '}}    
                        >
                        {{$item_d['name'] }}</option>
                    @endforeach
                @endif
            <!-- Non login user -->
            @else
                <option value="">---Chọn quận huyện---</option>  
            @endif
        </select>
    </div>
</div>