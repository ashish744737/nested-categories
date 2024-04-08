<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<section class="content" style="padding:50px 20%;">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Category List</h3>
                    <hr>
                        <a class="add-new" href="{{Route('createCategory')}}">
                            <button class="btn btn-primary btn-xs">Add New Category</button>
                        </a>
                    <hr>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Cat Id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Parent Id</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th width="150px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($categories))
                            <?php $_SESSION['i'] = 0; ?>
                            @foreach($categories as $category)
                                <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                                <tr>
                                    <?php $dash=''; ?>
                                    <td>{{$_SESSION['i']}}</td>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @if($category->status == 1)
                                            Enabled
                                        @else
                                            Disabled
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($category->parent_id))
                                            {{$category->subcategory->id}}
                                        @else
                                            None
                                        @endif
                                    </td>
                                    <td>{{$category->created_at}}</td>    
                                    <td>{{$category->updated_at}}</td>    
                                    <td>                                  
                                        <a href="{{Route('editCategory', $category->id)}}">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                         <a href="{{Route('deleteCategory', $category->id)}}">
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </a>
                                    </td>
                                 </tr>
                                 @if(count($category->subcategory))
                                     @include('sub-category-list',['subcategories' => $category->subcategory])
                                 @endif

                            @endforeach
                            <?php unset($_SESSION['i']); ?>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>