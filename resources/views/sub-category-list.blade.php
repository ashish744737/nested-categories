<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
    <tr>
        <td>{{$_SESSION['i']}}</td>
        <td>{{$subcategory->id}}</td>
        <td>{{ Helper::getParentsAttribute($subcategory) }} {{$subcategory->name}}</td>
        <td>
            @if($subcategory->status == 1)
                Enabled
            @else
                Disabled
            @endif
        </td>
        <td>{{$subcategory->parent->id}}</td>
        <td>{{$subcategory->created_at}}</td>
        <td>{{$subcategory->updated_at}}</td>
        <td>
            <a href="{{Route('editCategory', $subcategory->id)}}">
                <button class="btn btn-sm btn-info">Edit</button>
            </a>
  	        <a href="{{Route('deleteCategory', $subcategory->id)}}">
                <button class="btn btn-sm btn-danger">Delete</button>
            </a>
        </td>
    </tr>
    @if(count($subcategory->subcategory))
        @include('sub-category-list',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach