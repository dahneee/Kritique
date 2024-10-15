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
</head>

<body>
    @include('sidebar')
    <nav class="navbar-admin navbar-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="greet">Questionnaire</h3>
                <button type="button" class="add-ques-one btn btn-success" data-bs-toggle="modal" data-bs-target="#zaiModal">Add Question</button>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="questions">
            <div class="modal fade" id="zaiModal" tabindex="-1" aria-labelledby="zaiModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="zaiModalLabel">Add Your Questions (Max 10):</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <textarea id="newQuestionInput" class="form-control" placeholder="Type your question here" maxlength="200" rows="1"></textarea>
                            <button type="button" class="btn btn-primary mt-3" id="addQuestionBtn">Add to List</button>
                            <div class="list-group mt-3" id="questionList"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="saveChangesBtn">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dynamic-ques" id="dynamicQuestions">
                @forelse ($questions as $question)
                <div class="question-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <label class="form-label question-text">{{ $question->text }}</label>
                    <div class="radios mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="response{{ $loop->index }}" value="Strongly Disagree">
                            <label class="form-check-label">Strongly Disagree</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="response{{ $loop->index }}" value="Disagree">
                            <label class="form-check-label">Disagree</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="response{{ $loop->index }}" value="Agree">
                            <label class="form-check-label">Agree</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="response{{ $loop->index }}" value="Strongly Agree">
                            <label class="form-check-label">Strongly Agree</label>
                        </div>
                    </div>
                    <div class="btn-group mt-2">
                        <button class="btn btn-danger delete-question" data-id="{{ $question->id }}">Delete</button>
                    </div>
                </div>
                @empty
                <div class="shrug-icon">🤷</div>
                @endforelse
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
                    $('#questionList').append(`<div class="list-group-item">${questionText}<button type="button" class="btn btn-sm btn-danger float-right remove-question"></button></div>`);
                    $('#newQuestionInput').val(''); 
                }
            });

            $('#saveChangesBtn').click(function() {
                let questions = [];
                $('#questionList').children().each(function() {
                    questions.push($(this).text().trim());
                });

                $.ajax({
                    url: '{{ route("saveQuestions") }}',
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

            $('.delete-question').click(function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `/admin/questionnaire/${id}/delete`,
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE"
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
</body>

</html>