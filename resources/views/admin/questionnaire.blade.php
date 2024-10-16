<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Questionnaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/questionnaire.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="icon" href="/src/logow.png">
</head>

<body>
    @include('sidebar')
    <nav class="navbar-admin navbar-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="greet">Questionnaire</h3>
            </div>
        </div>
    </nav>

     <div class="content">
        <div class="questions">
            <div class="question-form">
                <h5>Add Your Questions (Max 10):</h5>
                <textarea id="newQuestionInput" class="form-control" placeholder="Type your question here" maxlength="200" rows="1"></textarea>
                <button type="button" class="btn btn-primary mt-3" id="addQuestionBtn">Add Question</button>
                <div class="list-group mt-3" id="questionList"></div>
                <button type="button" class="btn btn-success mt-3" id="saveChangesBtn">Save Changes</button>
            </div>

            <div class="dynamic-ques" id="dynamicQuestions">
                @forelse ($questions as $question)
                <div class="question-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <label class="form-label question-text">{{ $question->text }}</label>
                    <div class="btn-group mt-2">
                        <button class="btn btn-danger delete-question" data-id="{{ $question->id }}">Delete</button>
                        <button class="btn btn-warning edit-question" data-id="{{ $question->id }}" data-text="{{ $question->text }}">Edit</button>
                    </div>
                </div>
                @empty
                <div class="shrug-icon">🤷</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Edit Question Modal -->
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

    <script>
        $(document).ready(function() {
            $('#addQuestionBtn').click(function() {
                const questionText = $('#newQuestionInput').val().trim();
                if (questionText) {
                    const questionCount = $('#questionList').children().length;
                    if (questionCount < 10) {
                        $('#questionList').append(`
                            <div class="list-group-item">
                                ${questionText}
                                <button type="button" class="btn btn-sm btn-danger float-right remove-question">&times;</button>
                                <button type="button" class="btn btn-sm btn-warning float-right edit-question" style="margin-right: 5px;">Edit</button>
                            </div>`);
                        $('#newQuestionInput').val(''); 
                    } else {
                        alert('You can only add up to 10 questions.');
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