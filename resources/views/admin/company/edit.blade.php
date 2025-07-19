    @extends('admin.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Company/</span> Edit
            <a href="/company"><button class="btn btn-primary float-end">Back</button></a>
        </h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Company Details</h5>
                    </div>
                    <div class="card-body">
                        <form action ="/company/{{ $company->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("Put")
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Company</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text"><i
                                            class="bx bx-buildings"></i></span>
                                    <input type="text" id="basic-icon-default-company" class="form-control"
                                        placeholder="Enter Company Name" aria-label="Company"
                                        aria-describedby="basic-icon-default-company2" name="name" value="{{ $company->name }}" />

                                </div>
                                <div class="span text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-address">Address</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-address" class="input-group-text"><i
                                            class='bx bxs-map'></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-address"
                                        placeholder="Enter company address" aria-label="John Doe"
                                        aria-describedby="basic-icon-default-address" name="address" value="{{ $company->address }}"/>
                                </div>
                                <div class="span text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i
                                            class="bx bx-phone"></i></span>
                                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                                        placeholder="Enter Phone Number" aria-label="phone"
                                        aria-describedby="basic-icon-default-phone2" name="phone" value="{{ $company->phone }}"/>
                                </div>
                                <div class="span text-danger">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="text" id="basic-icon-default-email" class="form-control"
                                        placeholder="Enter Company email" aria-label="email"
                                        aria-describedby="basic-icon-default-email2" name="email" value="{{$company->email}}" />

                                </div>
                                <div class="span text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-website">website</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-globe'></i></span>
                                    <input type="text" id="basic-icon-default-website" class="form-control"
                                        placeholder="https://www.example.com" aria-label="john.doe"
                                        aria-describedby="basic-icon-default-website2" name="website" value="{{ $company->website }}"/>

                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-logo">logo</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-image'></i></span>
                                    <input type="file" accept="image/*" id="basic-icon-default-logo" class="form-control"
                                        placeholder="Upload logo" aria-label="log"
                                        aria-describedby="basic-icon-default-logo" name="logo" value="{{$company->logo}}" />

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
