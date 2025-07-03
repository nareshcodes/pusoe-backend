        @extends('admin.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">semester/</span> Edit
            <a href="/semester"><button class="btn btn-primary float-end">Back</button></a>
        </h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit semester Details</h5>
                    </div>
                    <div class="card-body">
                        <form action ="/semester/{{ $semester->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("Put")
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-semester">semester</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-semester2" class="input-group-text"><i
                                            class="bx bx-buildings"></i></span>
                                    <input type="text" id="basic-icon-default-semester" class="form-control"
                                        placeholder="Enter semester Name" aria-label="semester"
                                        aria-describedby="basic-icon-default-semester2" name="title" value="{{ $semester->Title }}" />

                                </div>
                                <div class="span text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-logo">Photo</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-image'></i></span>
                                    <input type="file" id="basic-icon-default-logo" class="form-control"
                                        placeholder="Upload logo" aria-label="log"
                                        aria-describedby="basic-icon-default-logo" name="logo" value="{{$semester->photo}}" />

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
