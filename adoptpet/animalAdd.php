<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Adoption</title>
    <link rel="stylesheet" href="animalAdd.css">
</head>
<body>
    <header>
        <div id="branding">
            <h1>Animal Adoption</h1>
        </div>
        <nav>
            <ul>
                <li><a href="Home.php">Back</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <fieldset>
            <legend>ADD / LIST Pet</legend>
            <form method="post" action="connect.php" onsubmit="return validateForm()" enctype="multipart/form-data">
                
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter name" required>

                <label for="category">Category:</label>
                <select name="category" id="category" required>
                    <option value="">Select category</option>
                    <option value="Dog">Dog</option>
                    <option value="Cat">Cat</option>
                    <option value="Rabbit">Rabbit</option>
                    <option value="Cow">Cow</option>
                </select>

                <label for="breed">Breed:</label>
                <select name="breed" id="breed">
                    <option value="">Select breed</option>
                    <option value="German shepherd">German shepherd</option>
                    <option value="Bulldog">Bulldog</option>
                    <option value="Labrador">Labrador</option>
                    <option value="Golden Retriever">Golden Retriever</option>
                </select>

                <label for="age">Age:</label>
                <input type="number" name="age" id="age" placeholder="Enter age" required>

                <label>Is it Stray:</label>
                <input type="radio" name="is_stray" value="Yes" required> Yes
                <input type="radio" name="is_stray" value="No"> No
                <br><br>

                <label for="pinInput">Pin code:</label>
                <input type="text" id="pinInput" name="pin_code" placeholder="Enter pin code" maxlength="6" required>

                <label for="phoneInput">Contact Number:</label>
                <input type="text" id="phoneInput" name="contact_no" placeholder="Enter contact number" maxlength="10" required>

                <label>Gender:</label>
                <input type="radio" name="gender" value="Male" required> Male
                <input type="radio" name="gender" value="Female"> Female
                <br><br>

                <label for="animal_image">Upload Animal Profile Image:</label>
                <input type="file" name="animal_image" id="animal_image" accept="image/*">

                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="5" placeholder="Enter a brief description"></textarea>

                <button type="submit" class="submitit">Submit</button>
            </form>
        </fieldset>
    </main>

    <footer>
        &copy; 2024 Animal Adoption Platform
    </footer>

    <script>
        function validateForm() {
            // You can add custom validation here if needed
            return true;
        }
    </script>
</body>
</html>
