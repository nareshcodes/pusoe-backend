@extends('admin.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Questions</span>

                <a href="/questions/create"><button class="btn btn-primary float-end">Create</button></a>
        </h4>
        <div class="row mb-5">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Questions</th>
                            <th>Semester</th>
                            <th>Image</th>
                             <th>Download</th>
                             <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($questions as $question)
                            <tr>

                                <td>{{ $question->title }}</td>
                                <td>{{ $question->semester->title }}</td>
                                <td><img height="60" width="50" src={{ asset($question->photo) }}></td>
                                 <td><a href={{ asset($question->document) }} class="text-decoration-none" > {{ $question->document }}</a></td>

                                <td>
                                    <form method="POST" action="/questions/{{ $question->id }}">
                                        @csrf
                                        @method('Delete')
                                        <a href="/questions/{{ $question->id }}/edit"><span
                                            class="badge rounded-pill bg-primary">Edit</span></a>
                                        <a href ="/questions" disabled class="show_confirm text-decoration-none"><span class="badge rounded-pill bg-danger ">Delete</span></a>
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
