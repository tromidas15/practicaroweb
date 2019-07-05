@extends('layouts.base')

@section('content')
<div class="container">
  <form method="POST" action="/home/{{$product->id}}">
    {{csrf_field()}}
    {{method_field('PATCH')}}
    <div class="form-group">
        <label for="Title">Title:</label>
      <input class="form-control" id='Title' name="Name" value="{{$product->Name}}" type="text" placeholder="Default input" required>
      @if($errors->has('Name'))
        @error('Name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      @endif
    </div>
    <div class="form-group">
        <label for="Quantity">Quantity:</label>
      <input class="form-control" id='Quantity' name="Quantity" type="text" value="{{$product->Quantity}}" placeholder="Default input" required>
      @if($errors->has('Quantity'))
        @error('Quantity')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      @endif
    </div>
    <div class="form-group">
        <label for="Price">Price:</label>
      <input class="form-control" id='Price' value="{{$product->Sale_Price}}" name="Sale_Price" type="text" placeholder="Default input" required>
    </div>
      @if($errors->has('Sale_Price'))
        @error('Sale_Price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      @endif
    <div class="form-group">
        <label for="Price">Category</label>
          <select class="form-control" id="Category" name="Category">
            @foreach($mainCategory as $category)
               <option value = '{{$category->id}}'> Categoria actuala este:{{$category->name}}</option>
            @endforeach
            @foreach($categorys as $category)
               <option value = '{{$category->id}}'> {{$category->name}}</option>
            @endforeach
          </select>
      @if($errors->has('Category'))
        @error('Category')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      @endif
    </div>
      <label for="Description">Description:</label>
      <TEXTAREA style='min-width: 100% ; max-height:200px; max-width: 100%' id='Description' name='Description' required> {{$product->Description}}</TEXTAREA>
      @if($errors->has('Description'))
        @error('Description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      @endif
      <button type="submit" class="btn btn-secondary" >Edit</button>
  </form>
</div>
@endsection
