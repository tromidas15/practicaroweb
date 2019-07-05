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
                  <th>Name</th>
                  <th>Type</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                @foreach($categorys_list as $category_list)
                	<tr>
                    <td>{{$category_list->name}}</td>
	                  <td>
                     @if($category_list->parent_id == 0)
                          Main Category
                     @else
                          Subcategory
                     @endif

                    </td>
	                  <td>
	                  	<a href="/home/{{$category_list->id}}/edit"><button class="btn btn-primary">Editeaza</button></a>
	                  </td>
	                  <td>
	                  	<form method='POST' action="/home/{{$category_list->id}}">
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
