<?php include("Connection.php");?>

<!DOCTYPE html>
<html>
<head>
    <title>Multi-page Survey Form</title>
    <link rel="stylesheet" type="text/css" href="A.css">
</head>
<body>
<form id="survey-form" action="" method="POST">
    <fieldset id="page1" class="active">
        <h2>Personal Details</h2>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <div id="name-length">0 / 40 characters</div>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <div id="email-length">0 / 200 characters</div>

        <label for="mobile">Mobile:</label>
        <input type="tel" id="mobile" name="mobile" required><br>
        <div id="mobile-length">0 / 10 digits</div>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea><br>

        <label>Gender:</label>
        <input type="radio" id="male" name="gender" value="male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label><br>
    </fieldset>

    <fieldset id="page2">
        <h2>Studies</h2>

        <label for="college">College:</label>
        <input type="text" id="college" name="college" required><br>
        <div id="college-length">0 / 200 characters</div>

        <label for="education">Education:</label>
        <input type="text" id="education" name="education" required><br>
        <div id="education-length">0 / 200 characters</div>

        <label for="branch">Branch:</label>
        <input type="text" id="branch" name="branch" required><br>
        <div id="branch-length">0 / 200 characters</div>
    </fieldset>

    <fieldset id="page3">
        <h2>Other Details</h2>

        <label for="alternate-contact">Alternate Contact:</label>
        <input type="tel" id="alternate-contact" name="alternateContact"><br>
        <div id="alternate-contact-length">0 / 10 digits</div>

        <label for="interest">Interest:</label>
        <input type="text" id="interest" name="interest"><br>
        <div id="interest-length">0 / 200 characters</div>
    </fieldset>

    <button id="prev-button" type="button">Previous</button>
    <button id="next-button" type="button">Next</button>
    <button id="submit-button" type="submit" name="submit-button">Submit</button>
</form>

<script>
// Function to update character count for a field
function updateLength(fieldId, maxLength, maxDigits = 0) {
    const field = document.getElementById(fieldId);
    const lengthDisplay = document.getElementById(`${fieldId}-length`);

    const fieldValue = field.value;
    const fieldLength = fieldValue.length;
    const displayText = maxDigits ? `${fieldLength} / ${maxDigits} digits` : `${fieldLength} / ${maxLength} characters`;
    lengthDisplay.textContent = displayText;

    if (fieldLength > (maxDigits ? maxDigits : maxLength)) {
        lengthDisplay.style.color = "red";
    } else {
        lengthDisplay.style.color = "black";
    }
}

// Attach event listeners to update character count in real-time for all fields
const fields = [
    { id: "name", maxLength: 40 },
    { id: "email", maxLength: 200 },
    { id: "mobile", maxLength: 10, maxDigits: 10 },
    { id: "college", maxLength: 200 },
    { id: "education", maxLength: 200 },
    { id: "branch", maxLength: 200 },
    { id: "alternate-contact", maxLength: 10, maxDigits: 10 },
    { id: "interest", maxLength: 200 }
];

fields.forEach(field => {
    const { id, maxLength, maxDigits } = field;
    const inputField = document.getElementById(id);
    inputField.addEventListener("input", () => updateLength(id, maxLength, maxDigits));
    updateLength(id, maxLength, maxDigits);
});
</script>


  <script src="script.js"></script>

</body>
</html>






<?php
if(isset($_POST['submit-button']))
{
    // Define the SQL query with placeholders
    $query = "INSERT INTO survey_responses (Name, Email, Mobile, Address, Gender, College, Education, Branch, `Alternate Contact`, Interest) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssisssssis", $name, $email, $mobile, $address, $gender, $college, $education, $branch, $alternateContact, $interest);

    // Get the data from the POST request
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = (int)$_POST['mobile']; // Cast to integer
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $college = $_POST['college'];
    $education = $_POST['education'];
    $branch = $_POST['branch'];
    $alternateContact = (int)$_POST['alternateContact']; // Cast to integer
    $interest = $_POST['interest'];

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data Inserted into Database";
    } else {
        echo "Failed: " . mysqli_error($conn);
    }

    // Close the statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>




