@extends('layouts.base')

@section('content')
<div class="container">
	<form method="POST" action="/category/{{$categorys->id}}">
		{{csrf_field()}}
    {{method_field('PATCH')}}
		<div class="form-group">
    		<label for="Name">Name:</label>
			<input class="form-control" id='Name' name="Name" type="text" placeholder="Default input" value="{{$categorys->name}}" required>
			@if($errors->has('Name'))
				@error('Name')
    				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			@endif
		</div>
          @if(isset($main))
		  <div class="form-group" id="category_hide" >
		    <label for="exampleFormControlSelect1">Please select main category</label>
		    <select class="form-control" id="exampleFormControlSelect1" name="Master_Category">

          @foreach($main as $main)
          <option value="{{$main->id}}">Categoria mama:{{$main->name}}</option>
          @endforeach
          @foreach($categorys_list as $category_list)
            @if($category_list->parent_id == 0)
              <option value="{{$category_list->id}}">{{$category_list->name}}</option>
            @endif
          @endforeach


		    </select>
		  </div>
        @endif
			<button type="submit" class="btn btn-secondary" >Add</button>
	</form>
</div>

@endsection


