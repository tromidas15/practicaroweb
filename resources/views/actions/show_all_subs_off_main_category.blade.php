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
                  <th>Delete</th>
                </tr>
                <div style="display: none ">{{$nrcrt = 1}}</div>
                @foreach($all_subs as $subcat)
                	<tr>
	                  <td>{{$nrcrt++}}</td>
                    <td>{{$subcat->name}}</td>
	                  <td>
	                  	<form method='POST' action="/category/{{$subcat->id}}">
	                  		    {{csrf_field()}}
    							         {{method_field('DELETE')}}
	                  		<button class="btn btn-primary">Delete</button>
	                  	</form>
	                  </td>
                 	</tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
@endsection


