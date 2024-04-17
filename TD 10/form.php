<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
</head>
<body>
    <h3>Login</h3>
    <form action="save_form.php" method="post" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <br><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <br><br>
        <label for="birthdate">Birthdate</label>
        <input type="date" name="birthdate" id="birthdate">
        <br><br>
        <label for="number_of_kids">Number of kids</label>
        <input type="number" name="number_of_kids" id="number_of_kids">
        <br><br>
        Gender:<br>
        <input type="radio" id="gender_m" name="gender" value="m">
        <label for="gender_m">Male</label><br>
        <input type="radio" id="gender_f" name="gender" value="f">
        <label for="gender_f">Female</label>
        <br><br>

        <label>Nationality:</label>
        <br>
        <label for="lb">Lebanon</label>
        <input type="checkbox" name="nationality[]" id="lb" value="lb" checked><br>
        <label for="fr">France</label>
        <input type="checkbox" name="nationality[]" id="fr" value="fr"><br>
        <label for="us">USA</label>
        <input type="checkbox" name="nationality[]" id="us" value="us" checked><br>

        <br><br>
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="30" rows="10"></textarea>
        <br><br>

        <label for="position">Position</label>
        <select name="position" id="position">
            <option value="manager" selected>manager</option>
            <option value="supervisor">supervisor</option>
            <option value="employee">employee</option>
        </select>
        <br><br>

        <label for="skills">Skills</label>
        <select name="skills[]" id="skills" multiple>
            <option value="word" selected>word</option>
            <option value="excel" selected>excel</option>
            <option value="programming" selected>programming</option>
        </select>
        <br><br>

        <label for="cv">CV</label>
        <input type="file" name="cv" id="cv" accept="application/pdf" required>
        <br><br>        

        <input type="submit" value="Submit">
    </form>
</body>
</html>