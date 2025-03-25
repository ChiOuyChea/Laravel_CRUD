@extends('master.main')

@section(section: 'pagetitle')
<title>Product Listiing</title>
@endsection

@section('content')
    <!-- Bordered Table -->
    <div class="container-xxl">
        @if (session('success'))
            <div class="mb-3 mt-3">
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            </div>
        @endif

        <div class="card mt-4">
            <h5 class="card-header">Products Listing</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $product->title }}</strong>
                                    </td>
                                    <td>
                                        {{ $product->price }}
                                    </td>
                                    <td>
                                        {{ $product->quantity }}
                                    </td>
                                    <td>
                                        {{ $product->category->category_name }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url("/product/$product->id/edit") }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <button class="dropdown-item" data-bs-toggle="modal" onclick="setProductId({{ $product->id }})"
                                                    data-bs-target="#modalCenter"><i class="bx bx-trash me-1"></i>
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->


    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" id="deleteProductForm">
                @method('DELETE')
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <p>Are you sure you to delete this product?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <input type="submit" class="btn btn-primary" style="color: white" value="Delete">
                </div>
            </form>
        </div>
    </div>


    <script>
        function setProductId(productId) {
            const form = document.getElementById('deleteProductForm');
            form.action = '/product/' + productId;
        }
    </script>


@endsection
