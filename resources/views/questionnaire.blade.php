<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Questionnaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/questionnaire.css">
</head>
<body>
    @include('sidebar')

    <div class="content">
        
        <h1>Questionnaire</h1>
        <form>
            <div class="ques-name mb-3">
                <label for="ques-name" class="form-label">Name</label>
                <input type="text" class="form-control" id="ques-name" name="ques-name" required>
            </div>
            <div class="ques-email mb-3">
                <label for="ques-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="ques-email" name="ques-email" required>
            </div>
            <div class="row mb-3">
                <div class="ques-gender col">
                    <label for="ques-gender" class="form-label">Gender</label>
                    <select class="form-select" id="ques-gender" name="ques-gender" required>
                        <option selected disabled>Choose...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Prefer not to say">Prefer not to say</option>
                    </select>
                </div>
                <div class="ques-year col">
                    <label for="ques-year" class="form-label">Year</label>
                    <select class="form-select" id="ques-year" name="ques-year" required>
                        <option selected disabled>Choose...</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>
                <div class="ques-block col">
                    <label for="ques-block" class="form-label">Block</label>
                    <select class="form-select" id="ques-block" name="ques-block" required>
                        <option selected disabled>Choose...</option>
                        <option value="A">1</option>
                        <option value="B">2</option>
                        <option value="C">3</option>
                        <option value="D">4</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="ques-department col">
                    <label for="ques-department" class="form-label">Department</label>
                    <select class="form-select" id="ques-department" name="ques-department" required>
                        <option selected disabled>Choose...</option>
                        <option value="Department1">Department 1</option>
                        <option value="Department2">Department 2</option>
                        <option value="Department3">Department 3</option>
                    </select>
                </div>
                <div class="ques-professor col">
                    <label for="ques-professor" class="form-label">Professor</label>
                    <select class="form-select" id="ques-professor" name="ques-professor" required>
                        <option selected disabled>Choose...</option>
                        <option value="Prof 1">Professor 1</option>
                        <option value="Prof 2">Professor 2</option>
                        <option value="Prof 3">Professor 3</option>
                    </select>
                </div>
                <div class="ques-subject col">
                    <label for="ques-subject" class="form-label">Subject</label>
                    <select class="form-select" id="ques-subject" name="ques-subject" required>
                        <option selected disabled>Choose...</option>
                        <option value="Subject1">Subject 1</option>
                        <option value="Subject2">Subject 2</option>
                        <option value="Subject3">Subject 3</option>
                        <option value="Subject4">Subject 4</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
