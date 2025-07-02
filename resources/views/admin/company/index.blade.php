@extends('admin.home')
@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Company</span>
            @if (empty($company))
                <a href="/company/create"><button class="btn btn-primary float-end">Create</button></a>
            @endif
            @if (!empty($company))
                <a href="/company/{{ $company->id }}/edit"><button class="btn btn-primary float-end">Edit</button></a>
            @endif
        </h4>
<div class="col-md-6 col-lg-4 mb-3 mx-auto mt-4">
                  @if(!empty($company))
                    <div class="card h-100">
                    <div class="card-body lh-1">
                        <div class="d-flex justify-center">
                            <img class="img-fluid d-flex mx-auto" object-fit="cover" src={{ asset($company->logo) }} alt="Card image cap" height="60px" width="60px">
                        </div>
                        <div class="text-center">
                      <h5 class="card-title">{{ $company->name}}</h5>
                      <h6 class="card-subtitle text-muted">{{ $company->address }}</h6>
                            </div>
                            <p class="card-text mt-4"><span class="fw-semibold fs-6"> Phone: </span>{{ $company->phone }}</p>
                            <p class="card-text"><span class="fw-semibold fs-6"> Email: </span>{{ $company->email }}</p>
                            <p class="card-text"><span class="fw-semibold fs-6"> Website: </span><a href={{ $company->website }}  target="_page" class="card-link">{{ $company->website }}</a></p>

                    </div>
                  </div>
                  @endif
                </div>
            </div>
@endsection
