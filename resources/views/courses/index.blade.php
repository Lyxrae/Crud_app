@extends('layout')

@section('content')
    <div class="d-flex justify-content-center mt-4 flex-column align-items-center">
        <h3 class="mb-3">Courses</h3>
        {{-- add course button --}}
        <button type="submit" class="btn btn-sm btn-success float-end mb-1" data-bs-toggle="modal"
            data-bs-target="#addModal">Add Course</button>
        {{-- add course modal --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- add course form --}}
                        <form action="{{ route('addcourse') }}  " method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Course Name</label>
                                <input type="text" class="form-control" name="course_name"
                                    placeholder="Enter Course Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" name="description"
                                    placeholder="Enter Description" required>
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
                    <th scope="col">Course Name</th>
                    <th scope="col">Description</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($courses) > 0)
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->description }}</td>
                            <td>
                                {{-- Edit course button --}}
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $course->id }}">Edit</button>
                            </td>
                            <td>
                                {{-- Delete course button --}}
                                <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal-{{ $course->id }}">Delete</button>
                            </td>

                            {{-- Edit student modal --}}
                            <div class="modal fade" id="editModal-{{ $course->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Course</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- Edit student form --}}
                                            <form action="{{ route('editcourse', $course->id) }}  " method="post">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Course Name</label>
                                                    <input type="text" class="form-control" name="course_name"
                                                        value="{{ $course->course_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <input type="text" class="form-control" name="description"
                                                        value="{{ $course->description }}" required>
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
                            <div class="modal fade" id="deleteModal-{{ $course->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Course</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <span>Do you want to delete <b>{{ $course->course_name }}</b>?</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="{{ route('deletecourse', $course->id) }}"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No Course found!</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
@endsection
