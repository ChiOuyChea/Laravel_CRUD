@extends('master.main')

@section('headerResource')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/createProduct.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('pagetitle')
    <title>Edit Product</title>
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Edit Product</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">New Product</h5>
                        {{-- <small class="text-muted float-end">Merged input group</small> --}}
                    </div>
                    <div class="card-body">
                        <form action="{{ url("/product/$product->id" ) }}" method="POST" id="upload-form" class="dropzone" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            @if (session('fail'))
                                <div class="mb-3">
                                    <div class="alert alert-danger" role="alert">{{ session('fail') }}</div>
                                </div>
                            @endif

                            <!-- Move dz-message to the top -->
                            <div class="dz-message">
                                <button class="dz-button" type="button">Drop files here to upload</button>
                            </div>

                            <!-- this is were the previews should be shown. -->
                            <div class="previews dz-button dz-message" type="button"></div>

                            <div class="mb-3">
                                <label class="form-label" for="title">Product Name</label>
                                <div class="input-group input-group-merge">
                                    {{-- <span id="title2" class="input-group-text"><i
                                            class="bx bx-box"></i></span> --}}
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Coca Cola" aria-label="Coca Cola" value="{{ $product->title }}"
                                        aria-describedby="title2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price">Price</label>
                                <div class="input-group input-group-merge">
                                    {{-- <span id="price2" class="input-group-text"><i
                                            class="bx bx-purchase-tag"></i></span> --}}
                                    <input type="text" id="price" name="price" class="form-control" value="{{ $product->price }}"
                                        placeholder="1.99" aria-label="1.99"
                                        aria-describedby="price2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="quantity">Quantity</label>
                                <div class="input-group input-group-merge">
                                    {{-- <span id="quantity2" class="input-group-text"><i
                                            class="bx bx-buildings"></i></span> --}}
                                    <input type="text" id="quantity" name="quantity" class="form-control" value="{{ $product->quantity }}"
                                        placeholder="10" aria-label="10"
                                        aria-describedby="quantity2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="mt-2 mb-3">
                                    <label for="category_id" class="form-label">Large select</label>
                                    <select id="category_id" name="category_id" class="form-select form-select-lg">
                                        {{-- @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                        @endforeach --}}

                                        @if (count($categories) > 0)
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">None</option>
                                        @endif
                                        {{-- <option value="1" {{ $product->category_id == 1 ? 'selected' : '' }}>One</option>
                                        <option value="2" {{ $product->category_id == 2 ? 'selected' : '' }}>Two</option>
                                        <option value="3" {{ $product->category_id == 3 ? 'selected' : '' }}>Three</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description</label>
                                <div class="input-group input-group-merge">
                                    {{-- <span id="description2" class="input-group-text"><i
                                            class="bx bx-comment"></i></span> --}}
                                    <textarea id="description" name="description" class="form-control" placeholder="Made in Cambodia"
                                        aria-label="Made in Cambodia" aria-describedby="description2">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit-btn">Save Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        Dropzone.options.uploadForm = {
            url: "{{ route('product.update', $product->id) }}", // Ensure this is correct
            paramName: "image", // Name of the file input field in Laravel
            maxFilesize: 2, // Maximum file size in MB
            acceptedFiles: "image/*", // Allow only images
            autoProcessQueue: false, // Prevent auto-upload
            parallelUploads: 1, // Upload files one at a time
            addRemoveLinks: true, // Show remove button
            maxFiles: 1,
            previewsContainer: ".previews", // Ensures previews appear in the correct container

            // Custom Preview Template (Optional)
            previewTemplate: `
                <div class="dz-preview dz-file-preview">
                    <div class="dz-image">
                        <img data-dz-thumbnail />
                    </div>
                    <div class="dz-details">
                        <div class="dz-filename"><span data-dz-name></span></div>
                        <div class="dz-size" data-dz-size></div>
                    </div>
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    <button class="dz-remove btn btn-danger btn-sm" data-dz-remove>
                        <img src="/assets/img/elements/x_white.png">
                    </button>
                </div>
            `,


            init: function() {
                var myDropzone = this;
                var submitButton = document.querySelector("#submit-btn");

                // display existing image
                // image path: uploads/products/BrVPw1ki3fksxt796xvGCwZcdvouwD0TtglHsBJ5.jpg

                // Existing image path (from your database or elsewhere)
                var existingImagePath = "{{ asset('storage/' . $product->image) }}"; // Or adjust based on how you store the path
                console.log(existingImagePath);


                // Display existing image as a mock file in Dropzone
                var mockFile = {
                    name: "Existing Product Image",
                    size: 12345, // You can set a fake size, or use the real one
                    type: "image/jpeg", // Adjust based on your image type
                    url: existingImagePath
                };

                console.log('mockFile: ');
                console.log(mockFile);


                // Add the mock file to the Dropzone previews
                myDropzone.emit("addedfile", mockFile);
                myDropzone.emit("thumbnail", mockFile, existingImagePath); // Display the thumbnail

                // Optionally, if you need to mark it as accepted:
                myDropzone.emit("complete", mockFile);


                submitButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    } else {
                        document.querySelector("#upload-form").submit();
                    }
                });

                var message = document.querySelector(".dz-message");
                var previewsContainer = document.querySelector(".previews");

                // Function to toggle dz-message and previews visibility
                function updateUI() {
                    if (myDropzone.files.length === 0 && !mockFile) {
                        message.style.display = "block"; // Show dz-message
                        previewsContainer.style.display = "none"; // Hide previews
                    } else {
                        message.style.display = "none"; // Hide dz-message
                        previewsContainer.style.display = "flex"; // Show previews
                    }
                }

                updateUI();

                // Remove file event
                this.on("addedfile", function(file) {
                    updateUI();

                    file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                        myDropzone.removeFile(file);
                    });

                });

                // Show dz-message again when all files are removed
                this.on("removedfile", function () {
                    mockFile = null;
                    updateUI();
                });

                this.on("maxfilesexceeded", function(file) {
                    this.removeFile(file);
                    alert("Maximun image reached!!")
                });

                // Events for handling uploads
                this.on("sendingmultiple", function() {
                    console.log("Sending files...");
                });
                this.on("successmultiple", function(files, response) {
                    console.log("Upload successful");
                });
                this.on("errormultiple", function(files, response) {
                    console.log("Error uploading files");
                });
                this.on("sending", function (file, xhr, formData) {
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute("content"));
                    formData.append("title", document.querySelector("#title").value);
                    formData.append("price", document.querySelector("#price").value);
                    formData.append("quantity", document.querySelector("#quantity").value);
                    formData.append("category_id", document.querySelector("#category_id").value);
                    formData.append("description", document.querySelector("#description").value);
                });
                this.on("success", function (file, response) {
                    // console.log("File uploaded successfully:", response);
                    // console.log(response);

                    if (response.success) {
                        window.location.href = '/product'
                    }
                });
            }
        };

        function clearInput() {
            document.querySelector("#title").value = '';
            document.querySelector("#price").value = '';
            document.querySelector("#quantity").value = '';
            document.querySelector("#category_id").value = '';
            document.querySelector("#description").value = '';
            myDropzone.removeAllFiles();
        }
    </script>
    <!-- / Content -->
@endsection
