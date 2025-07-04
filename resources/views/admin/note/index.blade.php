@extends('admin.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Notes</span>

                <a href="/notes/create"><button class="btn btn-primary float-end">Create</button></a>
        </h4>
        <div class="row mb-5">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Notes</th>
                            <th>Semester</th>
                            <th>Image</th>
                             <th>Download</th>
                             <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($notes as $note)
                            <tr>

                                <td>{{ $note->title }}</td>
                                <td>{{ $note->semester->title }}</td>
                                <td><img height="60" width="50" src={{ asset($note->photo) }}></td>
                                 <td><a href={{ asset($note->document) }} class="text-decoration-none" > {{ $note->document }}</a></td>

                                <td>
                                    <form method="POST" action="/notes/{{ $note->id }}">
                                        @csrf
                                        @method('Delete')
                                        <a href="/notes/{{ $note->id }}/edit"><span
                                            class="badge rounded-pill bg-primary">Edit</span></a>
                                        <a href ="/notes" disabled class="show_confirm text-decoration-none"><span class="badge rounded-pill bg-danger ">Delete</span></a>
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
