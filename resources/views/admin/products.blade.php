@extends('master.index')
@section('title', 'product')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Product</h4>


            <div class="row ">
                <div class="ml-3">
                    <a href="{{ url('product/create') }}" class="btn btn-primary">Add Product</a>
                </div>
                <div class="ml-3">
                    <a href="/product/cetak_pdf" class="btn btn-success" target="_blank">CETAK PDF</a>
                </div>
                {{-- <div class="col-3">
                    <form action="" method="POST">
                    @csrf
                    <input class="form-control" style="border-radius: 12px" type="text" name="q"
                        placeholder="Search here..." />
                </div>
                <div class="col">
                        <button class="btn btn-primary">Search</button>
                    </form>
                </div> --}}
            </div>


            <div class="table-responsive">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>No</th>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Specification</th>
                            <th>Packaging</th>
                            <th>Material</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $p)
                            <tr>
                                <td class="">
                                    <div class="d-flex align-items-center list-user-action">
                                        <a class="btn btn-sm btn-icon btn-primary py-2"
                                            href="{{ url('product/' . $p->id . '/edit') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                            </svg>
                                        </a>
                                        <a>
                                            <form action="{{ route('product.destroy', $p->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-icon btn-danger mx-3"
                                                    onclick="return confirm('Are you sure you want to delete this item ?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </a>
                                    </div>
                                </td>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td> {{ $p->id }}</td>
                                <td> <img src="{{ asset('storage/' . $p->image) }}" alt=""></td>
                                <td> {{ $p->product_name }}</td>
                                <td> {{ $p->category->category }}</td>
                                <td> {{ $p->description }}</td>
                                <td> {{ $p->price }}</td>
                                <td> {{ $p->stock }}</td>
                                <td> {{ $p->specification }}</td>
                                <td> {{ $p->packaging }}</td>
                                <td> {{ $p->material }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="d-flex">
                    {{ $product->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
