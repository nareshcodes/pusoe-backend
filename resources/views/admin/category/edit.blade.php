        @extends('admin.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">category/</span> Edit
            <a href="/category"><button class="btn btn-primary float-end">Back</button></a>
        </h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit category Details</h5>
                    </div>
                    <div class="card-body">
                        <form action ="/category/{{ $category->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("Put")
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-category">category</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-category2" class="input-group-text"><i
                                            class="bx bx-buildings"></i></span>
                                    <input type="text" id="basic-icon-default-category" class="form-control"
                                        placeholder="Enter category Name" aria-label="category"
                                        aria-describedby="basic-icon-default-category2" name="name" value="{{ $category->name }}" />

                                </div>
                                <div class="span text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
