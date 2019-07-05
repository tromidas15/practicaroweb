@extends('layouts.base')

@section('content')
<div class="container">
	<div class="box">
		<div class="box-header with-border">
      		<h3 class="box-title">Create a new product</h3>
  		</div>
  		<div class="box-body">
			<form method="POST" action="{{url('/add_products')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
		    		<label for="Title">Title:</label>
					<input class="form-control" id='Title' name="Name" type="text" placeholder="Default input" required>
					@if($errors->has('Name'))
						@error('Name')
		    				<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					@endif
				</div>
				<div class="form-group">
		    		<label for="Quantity">Quantity:</label>
					<input class="form-control" id='Quantity' name="Quantity" type="text" placeholder="Default input" required>
					@if($errors->has('Quantity'))
						@error('Quantity')
		    				<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					@endif
				</div>
				<div class="form-group">
		    		<label for="Price">Price:</label>
					<input class="form-control" id='Price' name="Sale_Price" type="text" placeholder="Default input" required>
				</div>
					@if($errors->has('Sale_Price'))
						@error('Sale_Price')
		    				<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					@endif
				<div class="form-group">
		    		<label for="Price">Category</label>
					    <select class="form-control" id="Category" name="Category">
					    	@foreach($categorys as $category)
					      		<option value="{{$category->id}}">{{$category->name}}</option>
					      	@endforeach
					    </select>
					@if($errors->has('Category'))
						@error('Category')
		    				<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					@endif
				</div>
					<label for="Description">Description:</label>
					<TEXTAREA style='min-width: 100% ; max-height:200px; max-width: 100%' id='Description' name='Description' required></TEXTAREA>
					@if($errors->has('Description'))
						@error('Description')
		    				<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					@endif
					<input type="file" name="image" id='image'>
					<button type="submit" class="btn btn-secondary" >Add Product</button>
			</form>
		</div>
	</div>
</div>
@endsection
