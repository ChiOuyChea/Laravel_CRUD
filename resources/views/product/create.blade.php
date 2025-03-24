@extends('master.main')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Add Product</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">New Product</h5>
                        {{-- <small class="text-muted float-end">Merged input group</small> --}}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('product.store') }}" method="POST">
                            @csrf

                            @if ( session('success') )
                                <div class="mb-3">
                                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label" for="title">Product Name</label>
                                <div class="input-group input-group-merge">
                                    {{-- <span id="title2" class="input-group-text"><i
                                            class="bx bx-box"></i></span> --}}
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Coca Cola" aria-label="Coca Cola"
                                        aria-describedby="title2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price">Price</label>
                                <div class="input-group input-group-merge">
                                    {{-- <span id="price2" class="input-group-text"><i
                                            class="bx bx-purchase-tag"></i></span> --}}
                                    <input type="text" id="price" name="price" class="form-control"
                                        placeholder="1.99" aria-label="1.99"
                                        aria-describedby="price2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="quantity">Quantity</label>
                                <div class="input-group input-group-merge">
                                    {{-- <span id="quantity2" class="input-group-text"><i
                                            class="bx bx-buildings"></i></span> --}}
                                    <input type="text" id="quantity" name="quantity" class="form-control"
                                        placeholder="10" aria-label="10"
                                        aria-describedby="quantity2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="mt-2 mb-3">
                                    <label for="category_id" class="form-label">Large select</label>
                                    <select id="category_id" name="category_id" class="form-select form-select-lg">
                                        <option value="1" selected>One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description</label>
                                <div class="input-group input-group-merge">
                                    {{-- <span id="description2" class="input-group-text"><i
                                            class="bx bx-comment"></i></span> --}}
                                    <textarea id="description" name="description" class="form-control" placeholder="Made in Cambodia"
                                        aria-label="Made in Cambodia" aria-describedby="description2"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
