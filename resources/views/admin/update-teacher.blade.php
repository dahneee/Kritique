<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1>UPDATE TEACHER</h1>
                <form action="{{ route('update-teacher', $teacher->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First Name</label>
                            <input type="text" name="teacher_first_name" class="form-control" placeholder="First Name" value="{{ $teacher->teacher_first_name }}">
                            @error('teacher_first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="teacher_middle_name" class="form-control" placeholder="Middle Name" value="{{ $teacher->teacher_middle_name }}">
                            @error('teacher_middle_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="teacher_last_name" class="form-control" placeholder="Last Name" value="{{ $teacher->teacher_last_name }}">
                            @error('teacher_last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $teacher->email }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Department</label>
                            <input type="text" name="department" class="form-control" placeholder="Department" value="{{ $teacher->department }}">
                            @error('department')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-grid">
                            <button class="btn btn-warning">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
