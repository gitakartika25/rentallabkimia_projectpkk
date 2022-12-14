@extends('master.index_user')
@section('title', 'Store')

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Store</strong></div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <h2>Chemical's Tools</h2>
                {{-- <div class="col-lg-6">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                    <div id="slider-range" class="border-primary"></div>
                    <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white"
                        disabled="" />
                </div> --}}
                {{-- <div class="col-lg-6 text-lg-right">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter</h3>
                    <button type="button" class="btn btn-primary btn-md dropdown-toggle px-4" id="dropdownMenuReference"
                        data-toggle="dropdown">Reference</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                        <a class="dropdown-item" href="#">Relevance</a>
                        <a class="dropdown-item" href="#">Name, A to Z</a>
                        <a class="dropdown-item" href="#">Name, Z to A</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Price, low to high</a>
                        <a class="dropdown-item" href="#">Price, high to low</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="site-section bg-light">
        <div class="container col-12 ">
            <div class="row justify-content-center">
                @foreach ($product as $p)
                    <div class="card col-sm-3  text-center item mb-3 item-v2 mx-2" style="width: 20rem;">
                        <form action="{{ url('detailproduct/' . $p->id) }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            <span class="onsale">Rent</span>
                            <a href="{{ url('detailproduct/' . $p->id) }}"><img src="{{ asset('storage/' . $p->image) }}"
                                    style="width: 300px" class="card-img-top"></a>
                            <div class="card-body">
                                <h3 class="text-dark"><a
                                        href="{{ url('detailproduct/' . $p->id) }}"></a>{{ $p->product_name }}</h3>
                                <p class="price"> Rp{{ $p->price }}</p>
                                <a href="{{ url('detailproduct/' . $p->id) }}" class="btn btn-primary">Detail Product</a>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <div class="site-block-27">
                        <ul>
                            <li><a href="#">&lt;</a></li>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&gt;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
