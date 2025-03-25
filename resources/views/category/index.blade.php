@extends('master.main')

@section('pagetitle')
    <title>Category Listing</title>
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
            <div class="d-flex col-12 align-items-center">
                <h5 class="card-header col-8 box-border">Category Listing</h5>
                <div class="col-4 d-flex justify-content-end align-items-center pe-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Add Category</button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->id }}
                                </td>
                                <td>
                                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $category->category_name }}</strong>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" data-bs-toggle="modal" onclick="setCategory({{ $category }})"
                                                data-bs-target="#modalEdit"><i class="bx bx-edit-alt me-1"></i>
                                                Edit</button>
                                            <button class="dropdown-item" data-bs-toggle="modal" onclick="setCategoryId({{ $category->id }})"
                                                data-bs-target="#modalDelete"><i class="bx bx-trash me-1"></i>
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

    <!-- Modal Add -->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" action="{{ route("category.store") }}" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddTitle">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="category_name" class="form-label">Category Name:</label>
                            <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter Category Name" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <input type="submit" class="btn btn-primary" value="Save Category">
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" class="modal-content" id="editCategoryForm">
                @method('PUT')
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_category_name" class="form-label">Category Name:</label>
                            <input type="text" id="edit_category_name" name="category_name" class="form-control" placeholder="Enter Category Name" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <input type="submit" class="btn btn-primary" value="Save Category">
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" id="deleteCategoryForm">
                @method('DELETE')
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteTitle">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <p>Are you sure you to delete this category?</p>
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
        function setCategoryId(categoryID) {
            const form = document.getElementById('deleteCategoryForm');
            form.action = '/category/' + categoryID;
        }

        function setCategory(category) {
            const form = document.getElementById('editCategoryForm');
            form.action = '/category/' + category.id;
            // console.log(category);

            document.getElementById('edit_category_name').value = category.category_name;
        }
    </script>

@endsection
