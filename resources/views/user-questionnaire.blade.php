<x-app-layout>
    <!-- Add Select2 CSS -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Questionnaire</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="/css/nav.css">
        <link rel="stylesheet" href="/css/user-questionnaire.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>

    <div class="content-ques">
        <nav class="navbar-admin navbar-light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="greet">Hello, <span class="name-greet">{{ Auth::user()->first_name }}</span>. <span class="space">How are you feeling today?</span></h3>

                    <div class="dropdown">
                        <!-- Add 'dropdown-toggle' class to enable Bootstrap JS dropdown behavior -->
                        <div class="circle-image dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/src/default.png" alt="Profile Image">
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <header class="violet-header mb-0" style="margin-bottom: 0;">
    <img src="/src/white.jpg" alt="Logo" class="header-logo">
</header>

<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-0" style="margin-top: 0;">


            <form action="{{ route('questionnaires-store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="teacher_id" class="block mb-2 text-sm font-medium text-gray-900">Select Teacher to Evaluate:</label>
                    <select id="teacher_id" name="teacher_id" class="w-full p-2 border border-gray-300 rounded-lg searchable-dropdown" required>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->teacher_first_name }} {{ $teacher->teacher_last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="subject_id" class="block mb-2 text-sm font-medium text-gray-900">Select Subject:</label>
                    <select id="subject_id" name="subject_id" class="w-full p-2 border border-gray-300 rounded-lg searchable-dropdown" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                </div>

                @foreach($questions as $question)
                    <div class="mb-6 bg-[#white] p-4 rounded-lg shadow-sm">
                        <label for="question_{{ $question->id }}" class="block mb-2 text-lg font-medium text-gray-800">{{ $question->text }}</label>
                        <div class="flex items-center space-x-4">
                            @foreach(['Strongly Agree' => 1, 'Agree' => 2, 'Neutral' => 3, 'Disagree' => 4, 'Strongly Disagree' => 5] as $label => $value)
                                <div>
                                    <input type="radio" id="answer_{{ $value }}_{{ $question->id }}" name="answers[{{ $question->id }}]" value="{{ $value }}" class="mr-2" required>
                                    <label for="answer_{{ $value }}_{{ $question->id }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="text-right">
                    <button type="submit" class="px-6 py-2 text-white bg-[#A4D07A] rounded-lg shadow-md hover:bg-[#92BF68]">
                        Submit
                    </button>
                </div>
            </form>
        </div>

        <!-- Add jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Add Bootstrap JS for dropdown functionality -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Add Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Initialize Select2 -->
        <script>
            $(document).ready(function() {
                $('.searchable-dropdown').select2({
                    placeholder: "Select an option",
                    allowClear: true
                });
            });
        </script>
    </x-app-layout>
