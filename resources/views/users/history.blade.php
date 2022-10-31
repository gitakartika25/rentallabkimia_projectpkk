@extends('master.index_user')
@section('title', 'Detail Produk')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">History User</h4>
        <p class="card-description">
          Riwayat transaksi user
        </p>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>id</th>
                <th>image</th>
                <th>Product</th>
                <th>price</th>
                <th>quantity</th>
                <th>total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Jacob</td>
                <td>Photoshop</td>
                <td class="text-danger"> 28.76% <i class="ti-arrow-down"></i></td>
                <td><label class="badge badge-danger">Pending</label></td>
              </tr>
              <tr>
                <td>Messsy</td>
                <td>Flash</td>
                <td class="text-danger"> 21.06% <i class="ti-arrow-down"></i></td>
                <td><label class="badge badge-warning">In progress</label></td>
              </tr>
              <tr>
                <td>John</td>
                <td>Premier</td>
                <td class="text-danger"> 35.00% <i class="ti-arrow-down"></i></td>
                <td><label class="badge badge-info">Fixed</label></td>
              </tr>
              <tr>
                <td>Peter</td>
                <td>After effects</td>
                <td class="text-success"> 82.00% <i class="ti-arrow-up"></i></td>
                <td><label class="badge badge-success">Completed</label></td>
              </tr>
              <tr>
                <td>Dave</td>
                <td>53275535</td>
                <td class="text-success"> 98.05% <i class="ti-arrow-up"></i></td>
                <td><label class="badge badge-warning">In progress</label></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>








@endsection