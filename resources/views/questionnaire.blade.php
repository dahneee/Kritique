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
                <button type="button" class="add-ques" data-bs-toggle="modal" data-bs-target="#zaiModal">Add Question</button>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="questions">
            <div class="modal fade" id="zaiModal" tabindex="-1" aria-labelledby="zaiModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="zaiModelLabel">Choose your set of questions:</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                               
                                <div class="form-check question-item modal-question" data-value="I find that the professor explains concepts clearly and in an easy-to-understand manner.">
                                    <span class="question-text">I find that the professor explains concepts clearly and in an easy-to-understand manner.</span>
                                </div>
                                <div class="form-check question-item modal-question" data-value="I feel that the professor effectively engages students during class sessions.">
                                    <span class="question-text">I feel that the professor effectively engages students during class sessions.</span>
                                </div>
                                <div class="form-check question-item modal-question" data-value="I believe the professor uses teaching methods that suit my learning needs.">
                                    <span class="question-text">I believe the professor uses teaching methods that suit my learning needs.</span>
                                </div>
                                <div class="form-check question-item modal-question" data-value="I find that the professor simplifies complex topics, making them easier for me to understand.">
                                    <span class="question-text">I find that the professor simplifies complex topics, making them easier for me to understand.</span>
                                </div>
                                <div class="form-check question-item modal-question" data-value="I feel encouraged by the professor to participate and engage in class discussions.">
                                    <span class="question-text">I feel encouraged by the professor to participate and engage in class discussions.</span>
                                </div>
                                <div class="form-check question-item modal-question" data-value="I think the professor’s lessons are well-organized and easy for me to follow.">
                                    <span class="question-text">I think the professor’s lessons are well-organized and easy for me to follow.</span>
                                </div>
                                <div class="form-check question-item modal-question" data-value="I find that the professor effectively uses teaching materials (e.g., slides, readings) to enhance my learning.">
                                    <span class="question-text">I find that the professor effectively uses teaching materials (e.g., slides, readings) to enhance my learning.</span>
                                </div>
                                <div class="form-check question-item modal-question" data-value="I feel motivated to learn and stay engaged with the subject due to the professor’s teaching style.">
                                    <span class="question-text">I feel motivated to learn and stay engaged with the subject due to the professor’s teaching style.</span>
                                </div>
                                <div class="form-check question-item modal-question" data-value="I believe the professor provides constructive feedback that helps improve my understanding of the subject.">
                                    <span class="question-text">I believe the professor provides constructive feedback that helps improve my understanding of the subject.</span>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="mfb-s " id="selectAllBtn">Select All</button>
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
          document.querySelector('.mfb-s').addEventListener('click', function() {
            this.classList.add('clicked'); 
        });
        $(document).ready(function() {
            $('.modal-question').on('click', function() {
                $(this).toggleClass('selected');
                const questionText = $(this).data('value');
                if ($(this).hasClass('selected')) {
                    $(this).attr('data-selected', true);
                } else {
                    $(this).removeAttr('data-selected');
                }
            });

            $('#selectAllBtn').on('click', function() {
                const allSelected = $('.modal-question[data-selected=true]').length === $('.modal-question').length;

                if (allSelected) {
                  
                    $('.modal-question').removeClass('selected').removeAttr('data-selected');
                    $(this).text('Select All').removeClass('btn-danger').addClass('btn-primary'); 
                } else {
                  
                    $('.modal-question').addClass('selected').attr('data-selected', true);
                    $(this).text('Deselect All').removeClass('btn-primary').addClass('btn-danger'); 
                }
            });

          
            $('#saveChangesBtn').on('click', function() {
                $('#dynamicQuestions').empty(); 
                $('.modal-question[data-selected=true]').each(function() {
                    const questionText = $(this).data('value');
                    const questionDiv = $('<div class="question-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></div>');
                    questionDiv.append('<label class="form-label">' + questionText + '</label>');
                    const dropdown = `
                        <select class="form-select" aria-label="Response to ${questionText}" style="width: 50%; font-family: 'Poppins', sans-serif;">
                            <option selected>Choose an option</option>
                            <option value="Strongly Disagree">Strongly Disagree</option>
                            <option value="Disagree">Disagree</option>
                            <option value="Agree">Agree</option>
                            <option value="Strongly Agree">Strongly Agree</option>
                        </select>
                    `;
                    questionDiv.append(dropdown);
                    $('#dynamicQuestions').append(questionDiv);
                });
                $('#zaiModal').modal('hide');
            });
        });
    </script>
</body>
</html>
