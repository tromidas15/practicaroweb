@extends('layouts.base')

@section('content')
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
                  <th>Description</th>
                  <th>Category</th>
                  <th>Photo</th>
                  <th>Full Price</th>
                  <th>Sales Price</th>
                  <th>Quantity</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                <div style="display: none ">{{$nrcrt = 1}}</div>
                @foreach($products as $product)
                	<tr>
	                  <td>{{$nrcrt++}}</td>
	                  <td>{{$product->Name}}</td>
	                  <td>{{$product->Description}}</td>
	                  <td>{{$product->Category}}</td>
	                  <td><img src="/images/{{$product->Photo}}" style="max-width: 100px; max-height: 60px;"></td>
	                  <td>{{$product->Full_Price}}</td>
	                  <td>{{$product->Sale_Price}}</td>
	                  <td>{{$product->Quantity}}</td>
	                  <td>
	                  	<a href="/home/{{$product->id}}/edit"><button class="btn btn-primary">Editeaza</button></a>
	                  </td>
	                  <td>
	                  	<form method='POST' action="/home/{{$product->id}}">
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
				{{$products ->render()}}
              </ul>
            </div>
          </div>
@endsection
