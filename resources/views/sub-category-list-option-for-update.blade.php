@foreach($subcategories as $subcategory)
    @if($category->id != $subcategory->id )
        <option value="{{$subcategory->id}}" @if($category->parent_id == $subcategory->id ) selected @endif >
            {{ Helper::getParentsAttribute($subcategory) }} {{$subcategory->name}}
        </option>
    @endif
    @if(count($subcategory->subcategory))
        @include('sub-category-list-option-for-update',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach