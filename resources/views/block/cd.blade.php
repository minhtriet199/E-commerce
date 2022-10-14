<div class="row">
    <div class="col-lg-6">
        <p>Thành phố</p>
        <select name="city_id" id="city" class="custom-select rounded-0 choose city">
            @if($account->profile['city'] == "0")
                <option value="">Chọn thành phố</option>
                @foreach($cities as $item)
                    <option value="{{ $item['id'] }}">
                    {{$item['name'] }}</option>
                @endforeach
            @else
                @foreach($cities as $item)
                    <option value="{{ $item['id'] }}"
                        {{ $account->profile['city'] == $item['id'] ? 'selected' : ' '}}    
                    >
                    {{$item['name'] }}</option>
                @endforeach
            @endif
            
        </select>
    </div>
    <div class="col-lg-6">
        <p>Quận,Huyện</p>
        <select  name="district" id="district" class="custom-select rounded-0 district">
            @if($account->profile['district'] == "0")
                <option value="">Chọn quận</option>
            @else
                @foreach($districts as $item_d)
                    <option value="{{ $item_d['id'] }}"
                        {{ $account->profile['district'] == $item_d['id'] ? 'selected' : ' '}}    
                    >
                    {{$item_d['name'] }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>