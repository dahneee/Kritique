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
                <button type="button" class="add-ques-one" data-bs-toggle="modal" data-bs-target="#zaiModal">Add Question</button>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="questions">
            <div class="modal fade" id="zaiModal" tabindex="-1" aria-labelledby="zaiModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="zaiModelLabel">Add Your Questions (Max 10):</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <textarea id="newQuestionInput" class="form-control" placeholder="Type your question here" maxlength="200" rows="1"></textarea>
                                </div>
                                <button type="button" class="add-ques-two" id="addQuestionBtn">Add Question</button>
                                <div class="mt-3 ques-list" id="questionList"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="mfb-sc" id="saveChangesBtn">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dynamic-ques" id="dynamicQuestions">
                <div class="shrug-icon">🤷</div> 
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#newQuestionInput').on('input', function() {
                this.style.height = 'auto'; 
                this.style.height = this.scrollHeight + 'px';
            });

            let questionCount = 0;
            const maxQuestions = 10;

            $('#addQuestionBtn').on('click', function() {
                const newQuestion = $('#newQuestionInput').val().trim();

                if (newQuestion !== '' && questionCount < maxQuestions) {
                    questionCount++;
                    addQuestionToList(newQuestion);
                    $('#newQuestionInput').val('');  
                    $('#newQuestionInput').css('height', 'auto'); 
                } else if (questionCount >= maxQuestions) {
                    alert('You can only add up to 10 questions.');
                }
            });

            $('#saveChangesBtn').on('click', function() {
                $('#dynamicQuestions').empty();  
                $('.modal-question').each(function(index) {
                    const questionText = $(this).data('value');
                    addQuestionToDynamicList(questionText, index);
                });

                if ($('#dynamicQuestions').children().length === 0) {
                    $('#dynamicQuestions').html('<div class="shrug-icon">🤷</div>');
                } else {
                    $('#dynamicQuestions .shrug-icon').remove();
                    const submitBtn = $('<button type="button" class="sub-save mt-3 float-end" id="submitBtn">Submit</button>');
                    $('#dynamicQuestions').append(submitBtn); 
                }

                $('#zaiModal').modal('hide');
            });

            $(document).on('click', '.remove-question', function() {
                $(this).closest('.modal-question').remove(); 
                questionCount--; 
            });

            $(document).on('click', '#submitBtn', function() {
                alert('Form submitted!');
            });

            
            function addQuestionToList(question) {
                const questionDiv = $('<div class="form-check question-item modal-question" data-value="' + question + '" data-selected="true"></div>');
                questionDiv.append('<span class="question-text">' + question + '</span>');
                questionDiv.append('<button class="remove-question" type="button"><i class="fas fa-times"></i></button>'); 
                $('#questionList').append(questionDiv);
            }

          
            function addQuestionToDynamicList(questionText, index) {
                const questionDiv = $('<div class="question-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></div>');
                questionDiv.append('<label class="form-label question-text">' + questionText + '</label>');

                const radioGroup = `
                <div class="radios">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="response${index}" id="response${index}1" value="Strongly Disagree">
                        <label class="form-check-label" for="response${index}1">Strongly Disagree</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="response${index}" id="response${index}2" value="Disagree">
                        <label class="form-check-label" for="response${index}2">Disagree</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="response${index}" id="response${index}3" value="Agree">
                        <label class="form-check-label" for="response${index}3">Agree</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="response${index}" id="response${index}4" value="Strongly Agree">
                        <label class="form-check-label" for="response${index}4">Strongly Agree</label>
                    </div>
                </div>
                `;
                questionDiv.append(radioGroup);
                $('#dynamicQuestions').append(questionDiv);
            }

            // Double-click to edit question text
            $(document).on('dblclick', '.modal-question', function() {
                const questionItem = $(this);
                const currentText = questionItem.find('.question-text').text();
                const textarea = $('<textarea class="form-control edit-textarea" maxlength="200" rows="1"></textarea>').val(currentText);

                questionItem.find('.question-text').replaceWith(textarea);
                textarea.focus();

                textarea.on('blur', function() {
                    const newText = $(this).val().trim();
                    if (newText) {
                        questionItem.data('value', newText);
                        const newQuestionText = $('<span class="question-text">' + newText + '</span>');
                        questionItem.prepend(newQuestionText);
                    } else {
                        questionItem.prepend('<span class="question-text">' + currentText + '</span>'); 
                    }
                    $(this).remove(); 
                });

                textarea.on('keydown', function(e) {
                    if (e.key === 'Enter') {
                        $(this).blur(); 
                    }
                });
            });
        });
    </script>
</body>
</html>
