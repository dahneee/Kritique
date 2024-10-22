<x-app-layout>

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Homepage') }}
                        </x-nav-link>
                    </div>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48" height="6">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>


    <div class="flex justify-center pb-0 mt-4">
        <a href="#questions" class="text-[#A4D07A] font-semibold border-b-4 border-[#A4D07A] pb-1">
            {{ __('Questions') }}
        </a>
    </div>

    
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

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-16">
        <form action="{{ route('questionnaires-store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="teacher_id" class="block mb-2 text-sm font-medium text-gray-900">Select Teacher to Evaluate:</label>
                <select id="teacher_id" name="teacher_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->teacher_first_name }} {{ $teacher->teacher_last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="subject_id" class="block mb-2 text-sm font-medium text-gray-900">Select Subject:</label>
                <select id="subject_id" name="subject_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                    @endforeach
                </select>
            </div>

            @foreach($questions as $question)
                <div class="mb-6 bg-[#A4D07A] p-4 rounded-lg shadow-sm">
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

</x-app-layout>
