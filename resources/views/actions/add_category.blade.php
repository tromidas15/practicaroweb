@extends('layouts.base')

@section('content')
<div class="container">
<div class="box">
  <div class="box-header with-border">
      <h3 class="box-title">Add a new category</h3>
  </div>
  <div class="box-body">
	<form method="POST">
		{{csrf_field()}}
		<div class="form-group">
    		<label for="Name">Name:</label>
			<input class="form-control" id='Name' name="Name" type="text" placeholder="Default input" required>
			@if($errors->has('Name'))
				@error('Name')
    				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			@endif
		</div>
		<div class="form-check form-check-inline">
  			<input class="form-check-input" type="checkbox" name="Subcategory" id="inlineCheckbox1" value="option1">
  			<label class="form-check-label" for="inlineCheckbox1" >Subcategory</label>
		</div>
		  <div class="form-group" id="category_hide" style="display: none">
		    <label for="exampleFormControlSelect1">Please select main category</label>
		    <select class="form-control select2" id="exampleFormControlSelect1" name="Master_Category">
		    	@foreach($categorys_list as $category_list)
		    		@if($category_list->parent_id == 0)
		    			<option value="{{$category_list->id}}">{{$category_list->name}}</option>
		    		@endif
		    	@endforeach
		    </select>
		  </div>
			<button type="submit" class="btn btn-secondary" >Add</button>
	</form>
</div>
</div>

</div>

   <section class="content">
      <div class="row" >
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Products Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                <div style="display: none ">{{$nrcrt = 1}}</div>
                @foreach($categorys_list as $category_list)
                	<tr>
	                  <td>{{$nrcrt++}}</td>
                    <td>{{$category_list->name}}</td>
	                  <td>
                     @if($category_list->parent_id == 0)
                          Main Category
                     @else
                          Subcategory
                     @endif

                    </td>
	                  <td>
	                  	<a href="/category/{{$category_list->id}}/edit"><button class="btn btn-primary">Editeaza</button></a>
	                  </td>
	                  <td>
	                  	<form method='POST' action="/category/{{$category_list->id}}">
	                  		    {{csrf_field()}}
    							         {{method_field('DELETE')}}
	                  		<button class="btn btn-primary">Sterge</button>
	                  	</form>
	                  </td>
                 	</tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
				{{$categorys_list ->render()}}
              </ul>
            </div>
          </div>
@endsection


