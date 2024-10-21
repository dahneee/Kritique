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
            <header class="violet-header d-flex justify-content-between align-items-center p-3">
            <img src="/src/white.jpg" alt="Logo" class="header-logo">


            </header>
            <div class="questions-container">
            <div class="questions">

                <div class="question-form card p-4">
                   
                    <textarea id="newQuestionInput" class="form-control" placeholder="Type your question here" maxlength="200" rows="2"></textarea>
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


        <div id="exceedLimitPopup" class="popup-notification">
            You cannot add more than 10 questions.
        </div>

        <!-- JavaScript for handling questions -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            function updateQuestionLimitText() {
    const currentQuestionCount = $('#dynamicQuestions .question-item').length + $('#questionList .list-group-item').length;
    const remainingQuestions = 10 - currentQuestionCount;
    $('.add-text').text(`Add Your Questions (Max ${remainingQuestions}):`);
}


updateQuestionLimitText();

$('#addQuestionBtn').click(function () {
    const questionText = $('#newQuestionInput').val().trim();
    const currentQuestionCount = $('#dynamicQuestions .question-item').length + $('#questionList .list-group-item').length;

    if (questionText) {
        if (currentQuestionCount < 10) {
            $('#questionList').append(`
                <div class="list-group-item">
                    ${questionText}
                    <div>
                    <button type="button" class="btn btn-sm btn-danger float-right remove-question">&times;</button>
                    <button type="button" class="btn btn-sm btn-warning float-right edit-question" style="margin-right: 5px;">Edit</button>
                </div>`);

            $('#newQuestionInput').val('');
            updateQuestionLimitText(); 
        } else {
            showExceedLimitPopup();
        }
    }
});

$('#questionList').on('click', '.remove-question', function() {
    $(this).parent().remove();
    updateQuestionLimitText();  
});

            $(document).ready(function() {
                function showExceedLimitPopup() {
                    const popup = $('#exceedLimitPopup');
                    popup.fadeIn(400);

                    setTimeout(function() {
                        popup.fadeOut(400);
                    }, 3000);
                }

                $('#addQuestionBtn').click(function () {
                    const questionText = $('#newQuestionInput').val().trim();
                    const currentQuestionCount = $('#dynamicQuestions .question-item').length + $('#questionList .list-group-item').length;

                    if (questionText) {
                        if (currentQuestionCount < 10) {
                            $('#questionList').append(`
                                <div class="list-group-item">
                                    ${questionText}
                                    <div>
                                    <button type="button" class="btn btn-sm btn-danger float-right remove-question">&times;</button>
                                    <button type="button" class="btn btn-sm btn-warning float-right edit-question" style="margin-right: 5px;">Edit</button>
                                </div>`);
                            $('#newQuestionInput').val('');
                        } else {
                            showExceedLimitPopup();
                        }
                    }
                }); 

                $('#saveChangesBtn').click(function() {
                    let questions = [];
                    $('#questionList').children().each(function() {
                        questions.push($(this).contents().filter(function() {
                            return this.nodeType === 3;
                        }).text().trim());
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

                $('#questionList').on('click', '.remove-question', function() {
                    $(this).parent().remove();
                });

                $('#questionList').on('click', '.edit-question', function() {
                    const questionItem = $(this).parent();
                    const questionText = questionItem.contents().filter(function() {
                        return this.nodeType === 3;
                    }).text().trim();

                    $('#newQuestionInput').val(questionText);
                    questionItem.remove();
                });

                $('.delete-question').click(function() {
                    const id = $(this).data('id');
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
                });

                let editingQuestionId = null;

                $('#dynamicQuestions').on('click', '.edit-question', function() {
                    const questionText = $(this).data('text');
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
        </script>
    </body>

    </html>