@extends('layout')

@section('content')
    <div class="d-flex justify-content-center mt-4 flex-column align-items-center">
        <h3 class="mb-3">Students</h3>
        {{-- add student button --}}
        <button type="submit" class="btn btn-sm btn-success float-end mb-1" data-bs-toggle="modal"
            data-bs-target="#addModal">Add Student</button>
        {{-- add student modal --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- add student form --}}
                        <form action="{{ route('addstudent') }}  " method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">student Name</label>
                                <input type="text" class="form-control" name="student_name" placeholder="Enter Name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="phone" class="form-control" name="phone" placeholder="Enter Phone"
                                    required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <table class="table table-sm table-bordered table-striped" style="width: 80%; max-width: 600px;">
            <thead>
                <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if (count($students) > 0)
                        @foreach ($students as $student)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->student_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>
                                {{-- Edit student button --}}
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $student->id }}">Edit</button>
                            </td>
                            <td>
                                {{-- Delete student button --}}
                                <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal-{{ $student->id }}">Delete</button>
                            </td>

                            {{-- Edit student modal --}}
                            <div class="modal fade" id="editModal-{{ $student->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- Edit student form --}}
                                            <form action="{{ route('editstudent', $student->id) }}  " method="post">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">student Name</label>
                                                    <input type="text" class="form-control" name="student_name"
                                                        value="{{ $student->student_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ $student->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="phone" class="form-control" name="phone"
                                                        value="{{ $student->phone }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Delete student modal --}}
                            <div class="modal fade" id="deleteModal-{{ $student->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <span>Do you want to delete <b>{{ $student->student_name }}</b>?</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="{{ route('deletestudent', $student->id) }}"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                <tr>
                    <td colspan="5" class="text-center">No Student found!</td>
                </tr>
                @endif
                </tr>
            </tbody>
        </table>
    </div>
@endsection
