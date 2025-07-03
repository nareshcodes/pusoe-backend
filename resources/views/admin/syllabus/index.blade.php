@extends('admin.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Syllabus</span>

                <a href="/syllabus/create"><button class="btn btn-primary float-end">Create</button></a>
        </h4>
        <div class="row mb-5">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Syllabus</th>
                            <th>Semester</th>
                            <th>Image</th>
                             <th>Download</th>
                             <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($syllabi as $syllabus)
                            <tr>

                                <td>{{ $syllabus->title }}</td>
                                <td>{{ $syllabus->semester->title }}</td>
                                <td><img height="60" width="50" src={{ asset($syllabus->photo) }}></td>
                                 <td><a href={{ asset($syllabus->document) }} class="text-decoration-none" > {{ $syllabus->document }}</a></td>

                                <td>
                                    <form method="POST" action="/syllabus/{{ $syllabus->id }}">
                                        @csrf
                                        @method('Delete')
                                        <a href="/syllabus/{{ $syllabus->id }}/edit"><span
                                            class="badge rounded-pill bg-primary">Edit</span></a>
                                        <a href ="/syllabus" disabled class="show_confirm text-decoration-none"><span class="badge rounded-pill bg-danger ">Delete</span></a>
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
