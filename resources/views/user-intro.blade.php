<title>Kritique</title>

<x-app-layout>

    <div class="flex flex-col justify-center items-center min-h-screen" style="background-color: #edf7ee; overflow: hidden; padding-bottom: 60px;"> <!-- Increased padding-bottom -->

        
        <div class="text-center mb-2">
            <img src="{{ asset('src/kritik.png') }}" alt="Kritique Logo" class="w-48 h-auto"> 
        </div>

        
        <div class="flex flex-wrap justify-center mb-8 space-x-4"> 
            
            <div class="card bg-white rounded-lg shadow-lg p-4 w-72 text-center transition duration-300 transform hover:scale-105">
                <h3 class="text-xl font-semibold mb-2">Getting Started</h3>
                <p class="text-gray-600">Press the "Begin" button to start the questionnaire.</p>
            </div>
            
            <div class="card bg-white rounded-lg shadow-lg p-4 w-72 text-center transition duration-300 transform hover:scale-105">
                <h3 class="text-xl font-semibold mb-2">Answering</h3>
                <p class="text-gray-600">Answer the questions honestly and to the best of your ability.</p>
            </div>
            
            <div class="card bg-white rounded-lg shadow-lg p-4 w-72 text-center transition duration-300 transform hover:scale-105">
                <h3 class="text-xl font-semibold mb-2">Submitting</h3>
                <p class="text-gray-600">Once done, submit the questionnaire for evaluation.</p>
            </div>
        </div>

        
        <div class="text-center mb-4">
            <a href="{{ route('questionnaires-create') }}" class="bg-[#b2de89] hover:bg-[#6f9c45] text-white font-bold block min-w-[320px] px-4 py-2 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                Begin
            </a>
        </div>

       
        <p class="text-lg text-gray-600 text-center mb-4">
            Ensure you're on a stable connection for the best experience.
        </p>

    </div>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .card {
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.1);
        }
    </style>
</x-app-layout>
