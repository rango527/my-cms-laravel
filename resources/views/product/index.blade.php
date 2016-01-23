@extends('layout/template')
@section('content')
    @include('messages/flash_message')
    <h1>Products Store</h1>
    <a href="{{url('/products/create')}}" class="btn btn-success">Create Product</a>
    <hr>
    @include('product/search', ['url'=>'/products/search'])
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
            <th>ID</th>
            <th>Slug</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Size</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Front Image</th>
            <th>Side Image</th>
            <th>Left Image</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $p)
            {{-- {{ dd($p->size) }}--}}
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->slug }}</td>
                <td>{{ $p->name}}</td>
                <td>{{ $p->brands->brand }}</td>
                <td>
                    @foreach ($p->size as $s)
                        <li>{{ $s->size_id }}</li>
                    @endforeach
                </td>
                <td>{{ $p->cat_id }}</td>
                <td>{{ $p->quantity }}</td>
                <td>{{ $p->price }}</td>

                <td><img src="{{asset('images/products/'.$p->a_img)}}" height="35" width="30"></td>
                <td><img src="{{asset('images/products/'.$p->b_img)}}" height="35" width="30"></td>
                <td><img src="{{asset('images/products/'.$p->c_img)}}" height="35" width="30"></td>
                <td><a href="{{url('products',$p->id)}}" class="btn btn-primary">Read</a></td>
                <td><a href="{{route('products.edit',$p->id)}}" class="btn btn-warning">Update</a></td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route'=>['products.destroy', $p->id]]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $products->appends(Input::except('page'))->render() !!}
@endsection