<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>UPDATE</h1>
                    <form action="{{ route('update-student', $students->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">User Type</label>
                                <select name="user_type" class="form-control">
                                    <option value="student" {{ $students->user_type == 'student' ? 'selected' : '' }}>Student</option>
                                    <option value="admin" {{ $students->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('user_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Student ID</label>
                                <input type="text" name="student_id" class="form-control" placeholder="Student ID" value="{{ $students->student_id }}">
                                @error('student_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $students->email }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ $students->first_name }}">
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="{{ $students->middle_name }}">
                                @error('middle_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ $students->last_name }}">
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Block</label>
                                <input type="text" name="block" class="form-control" placeholder="Block" value="{{ $students->block }}">
                                @error('block')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control" placeholder="Department" value="{{ $students->department }}">
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