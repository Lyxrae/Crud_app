@extends('layout')

@section('content')
    <div class="d-flex justify-content-center mt-4 flex-column align-items-center">
        <h3 class="mb-3">Enroll Students in Courses</h3>

        {{-- Add Enrollment Button --}}
        <button type="button" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal" data-bs-target="#enrollModal">
            Enroll Student
        </button>

        {{-- Enroll Student Modal --}}
        <div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="enrollModalLabel">Enroll Student in Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Enrollment Form --}}
                        <form action="{{ route('enrollstudent') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Select Student:</label>
                                <select name="student_id" class="form-control" required>
                                    <option value="">-- Choose Student --</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->student_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Select Course:</label>
                                <select name="course_id" class="form-control" required>
                                    <option value="">-- Choose Course --</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Enroll</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Display Enrolled Students and Courses --}}
        <table class="table table-sm table-bordered table-striped" style="width: 80%; max-width: 800px;">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Student Name</th>
                    <th>Enrolled Courses</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($students) > 0)
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->student_name }}</td>
                            <td>
                                @if ($student->courses->isNotEmpty())
                                    <ul class="mb-0">
                                        @foreach ($student->courses as $course)
                                            <li>{{ $course->course_name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">No courses enrolled</span>
                                @endif
                            </td>
                            <td>
                                {{-- Unenroll Button --}}
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#unenrollModal-{{ $student->id }}">Unenroll</button>
                            </td>
                        </tr>

                        {{-- Unenroll Student Modal --}}
                        <div class="modal fade" id="unenrollModal-{{ $student->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Unenroll Student</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Remove <b>{{ $student->student_name }}</b> from enrolled courses?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <a href="{{ route('unenroll', $student->id) }}" class="btn btn-danger">Unenroll</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No students found!</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
