    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Questionnaire</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="icon" href="/src/logow.png">
        <link rel="stylesheet" href="/css/nav.css">
        <link rel="stylesheet" href="/css/questionnaire.css">


    </head>

    <body>
        @include('sidebar')


        <!-- <nav class="navbar-admin navbar-light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="greet">Questionnaire</h3>
                </div>
            </div>
        </nav> -->


        <div class="content-ques">
        <nav class="navbar-admin navbar-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="greet">Hello, <span class="name-greet">{{ Auth::user()->first_name }}</span>. <span class="space">How are you feeling today?</span></h3>

                <div class="dropdown">
                    <div class="circle-image" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
            <header class="violet-header">
            <img src="/src/white.jpg" alt="Logo" class="header-logo">
            </header>
            
            <div class="questions-container">
            <div class="questions">

                <div class="question-form card p-4">
                   
                <div style="position: relative; display: inline-block; width: 100%;">
    <textarea id="newQuestionInput" class="form-control" placeholder="Type your question here" maxlength="200" rows="2" style="resize: none; width: 100%;" oninput="updateCharacterCount()"></textarea>
    <span id="charCount" style="position: absolute; top: 5px; right: 10px; color: #4a7c59; font-family: 'Poppins', sans-serif; font-size: 0.9rem;">
       
    </span>
</div>
<h5 class="add-text">Add Your Questions (Max 10):</h5>


                    <div class="list-group my-3" id="questionList"></div>

                    <div class="question-form-btns">
                        <button type="button" class="btn-add-q margin-3" id="addQuestionBtn">Add Question</button>
                        <button type="button" class="btn-save" id="saveChangesBtn">Save Changes</button>
                    </div>


                </div>

                <div class="dynamic-ques mt-4" id="dynamicQuestions">
                    @forelse ($questions as $question)
                    <div class="question-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <span class="question-number me-3">{{ $loop->index + 1 }}.</span>
                                <span class="question-text">{{ $question->text }}</span>
                            </div>
                            <div class="question-controls d-flex align-items-center">
                                <button class="btn btn-warning edit-question me-2" data-id="{{ $question->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger delete-question" data-id="{{ $question->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="shrug-icon text-center">🤷 No Questions Added Yet</div>
                    @endforelse
                </div>
            </div>
        </div>
        </div>


        <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea id="editQuestionInput" class="form-control" maxlength="200" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveEditQuestionBtn">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
        



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <div id="exceedLimitPopup" class="popup-notification d-none"></div>
        <p id="maxQuestionsWarning" class="text-danger d-none">You've reached the maximum number of questions allowed.</p>

        

    <script>
       function updateQuestionLimitText() {
    const maxQuestions = 10;
    const currentQuestionCount = $('#dynamicQuestions .question-item').length + $('#questionList .question-item-not-saved').length;
    const remainingQuestions = Math.max(maxQuestions - currentQuestionCount, 0);

    console.log("Current Question Count:", currentQuestionCount); 
    console.log("Remaining Questions:", remainingQuestions); 

  
    if (currentQuestionCount >= 10) {
        $('.add-text').text("Limit reached");
    } else {
        $('.add-text').text(`Add Your Questions (Max ${remainingQuestions}):`);
    }
          
            if (remainingQuestions === 0) {
                showExceedLimitPopup("You've reached the maximum number of questions allowed.");
            }
        }

        function showExceedLimitPopup(message) {
            const popup = $('#exceedLimitPopup');
            popup.text(message); 
            popup.removeClass('d-none').fadeIn(400);

        
            setTimeout(() => popup.fadeOut(400), 3000);
        }

        $(document).ready(function() {
            updateQuestionLimitText();

            $('#addQuestionBtn').click(function () {
                const questionText = $('#newQuestionInput').val().trim();
                const currentQuestionCount = $('#dynamicQuestions .question-item').length + $('#questionList .question-item-not-saved').length;

                if (currentQuestionCount >= 10) {
                
                    showExceedLimitPopup("You've added 10 questions already.");
                    return; 
                } else if (currentQuestionCount === 10) {
                    maxQuestionsWarning("You've reached the maximum number of questions allowed.");
                }

                if (questionText) {
                    $('#questionList').append(`
                        <div class="question-item-not-saved">
                            <p>${questionText}</p>
                            <div>
                                <button type="button" class="btn btn-sm btn-danger float-right remove-question">&times;</button>
                                <button type="button" class="btn btn-sm btn-warning float-right edit-question" style="margin-right: 5px;">Edit</button>
                            </div>
                        </div>`);
                    $('#newQuestionInput').val(''); 
                    updateQuestionLimitText();      
                }
            });

            $('#questionList').on('click', '.remove-question', function() {
                $(this).closest('div.question-item-not-saved').remove();
                updateQuestionLimitText();
            });

            $('#questionList').on('click', '.edit-question', function() {
                const questionItem = $(this).closest('.question-item-not-saved');
                const questionText = questionItem.find('p').text().trim();
                $('#newQuestionInput').val(questionText);
                questionItem.remove();
                updateQuestionLimitText();
            });

            $('#saveChangesBtn').click(function() {
                let questions = [];
                $('#questionList').children().each(function() {
                    const questionText = $(this).find('p').text().trim();
                    if (questionText) {
                        questions.push(questionText);
                    }
                });

                $.ajax({
                    url: '{{ route("save-questions") }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "questions": questions
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });

            $('.delete-question').click(function() {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this question?')) {
                    $.ajax({
                        url: '{{ route("delete-question", ":id") }}'.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                window.location.reload();
                            } else {
                                alert('Failed to delete the question. Please try again.');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('Failed to delete the question. Status: ' + xhr.status);
                        }
                    });
                }
            });

            let editingQuestionId = null;

            $('#dynamicQuestions').on('click', '.edit-question', function() {
                const questionText = $(this).closest('.question-item').find('.question-text').text().trim();
                editingQuestionId = $(this).data('id');
                $('#editQuestionInput').val(questionText);
                $('#editQuestionModal').modal('show');
            });

            $('#saveEditQuestionBtn').click(function() {
                const updatedText = $('#editQuestionInput').val().trim();
                if (updatedText) {
                    $.ajax({
                        url: '{{ route("update-question", ":id") }}'.replace(':id', editingQuestionId),
                        type: 'PUT',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "text": updatedText
                        },
                        success: function(response) {
                            if (response.success) {
                                $(`button[data-id="${editingQuestionId}"]`).closest('.question-item').find('.question-text').text(updatedText);
                                $('#editQuestionModal').modal('hide');
                            } else {
                                alert('Failed to update the question. Please try again.');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('Failed to update the question. Status: ' + xhr.status);
                        }
                    });
                } else {
                    alert('The question cannot be empty.');
                }
            });
        });
        function updateCharacterCount() {
        const input = document.getElementById('newQuestionInput');
        const charCount = input.value.length;
        const maxChars = input.getAttribute('maxlength');
        document.getElementById('charCount').textContent = `${charCount}/${maxChars}`;
    }
    </script>



    </body>

    </html>