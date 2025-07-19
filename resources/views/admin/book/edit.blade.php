    @extends('admin.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Books/</span> Edit
            <a href="/books"><button class="btn btn-primary float-end">Back</button></a>
        </h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Update Book</h5>
                    </div>
                    <div class="card-body">
                        <form action ="/books/{{ $book->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("put")
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-book">Book</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-book2" class="input-group-text"><i
                                            class="bx bx-buildings"></i></span>
                                    <input type="text" id="basic-icon-default-book" class="form-control"
                                        placeholder="Enter book Name" aria-label="book"
                                        aria-describedby="basic-icon-default-book2" name="title" value="{{ $book->title }}"/>

                                </div>
                                <div class="span text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                           <div class="mb-3">
                        <label for="semester_id" class="form-label">Select Semester</label>
                        <select id="semester_id" class="form-select" name="semester_id" required>
                             <option value="" selected>Select Semester</option>
                          @foreach ($semesters as $sem)
                          <option value={{ $sem->id }} {{$sem->title == $book->semester->title?"selected":"" }}>{{ $sem->title }}</option>
                          @endforeach

                        </select>
                        <div class="span text-danger">
                                    @error('semester_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                      </div>
                      {{--===================== categoru================== --}}
                      <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Category</label>
                        <select id="defaultSelect" class="form-select" name="category_id">
                            <option value="">Select Category</option>
                          @foreach ($menus as $cat)
                          <option value={{ $cat->id }} {{ $cat->name== $book->category->name? "selected":""}}>{{ $cat->name }}</option>
                          @endforeach
                        </select>
                        <div class="span text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                      </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-image">Featured Image</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-image'></i></span>
                                    <input type="file" accept="image/*" id="basic-icon-default-image" class="form-control"
                                        placeholder="Upload image" aria-label="photo"
                                        aria-describedby="basic-icon-default-image" name="photo" />

                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-document">Upload Document</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-document'></i></span>
                                    <input type="file" id="basic-icon-default-document" class="form-control"
                                        placeholder="Upload Document" aria-label="document"
                                        aria-describedby="basic-icon-default-document" name="document" />

                                </div>
<div class="span text-danger">
                                    @error('document')
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
