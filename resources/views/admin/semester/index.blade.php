@extends('admin.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Semester</span>
            @if (count($semesters) < 8)
                <a href="/semester/create"><button class="btn btn-primary float-end">Create</button></a>
            @endif
        </h4>
        <div class="row mb-5">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Semester</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($semesters as $semester)
                            <tr>

                                <td>{{ $semester->Title }}</td>
                                <td><img height="60" width="50" src={{ asset($semester->photo) }}></td>
                                <td>
                                    <form method="POST" action="/semester/{{ $semester->id }}">
                                        @csrf
                                        @method('Delete')
                                        <a href="/semester/{{ $semester->id }}/edit"><span
                                            class="badge rounded-pill bg-primary">Edit</span></a>
                                        <a href ="/semester" disabled class="show_confirm text-decoration-none"><span class="badge rounded-pill bg-danger ">Delete</span></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
