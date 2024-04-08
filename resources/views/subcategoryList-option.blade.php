@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}">{{ Helper::getParentsAttribute($subcategory) }} {{$subcategory->name}}</option>
    @if(count($subcategory->subcategory))
        @include('subCategoryList-option',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach