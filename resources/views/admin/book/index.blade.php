@extends('admin.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Books</span>

                <a href="/books/create"><button class="btn btn-primary float-end">Create</button></a>
        </h4>
        <div class="row mb-5">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Books</th>
                            <th>Semester</th>
                            <th>Image</th>
                             <th>Download</th>
                             <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($books as $book)
                            <tr>

                                <td>{{ $book->title }}</td>
                                <td>{{ $book->semester->title}}</td>
                                <td><img height="60" width="50" src={{ asset($book->photo) }}></td>
                                 <td><a href={{ asset($book->document) }} class="text-decoration-none" > {{ $book->document }}</a></td>

                                <td>
                                    <form method="POST" action="/books/{{ $book->id }}">
                                        @csrf
                                        @method('Delete')
                                        <a href="/books/{{ $book->id }}/edit"><span
                                            class="badge rounded-pill bg-primary">Edit</span></a>
                                        <a href ="/books" disabled class="show_confirm text-decoration-none"><span class="badge rounded-pill bg-danger ">Delete</span></a>
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
