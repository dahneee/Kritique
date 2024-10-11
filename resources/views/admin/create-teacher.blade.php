<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="mb-0">Add Teacher</h1>
                <hr />
                @if (session()->has('error'))
                <div>
                    {{ session('error') }}
                </div>
                @endif
                <p><a href="{{ route('view-teachers') }}" class="btn btn-primary">Go Back</a></p>

                <form action="{{ route('save-teacher') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="teacher_first_name" class="form-control" placeholder="First Name" value="{{ old('teacher_first_name') }}">
                            @error('teacher_first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="teacher_middle_name" class="form-control" placeholder="Middle Name" value="{{ old('teacher_middle_name') }}">
                            @error('teacher_middle_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="teacher_last_name" class="form-control" placeholder="Last Name" value="{{ old('teacher_last_name') }}">
                            @error('teacher_last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="department" class="form-control" placeholder="Department" value="{{ old('department') }}">
                            @error('department')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-grid">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
