<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/infoEdit.css">
</head>

<body>
    <div class="container">

        <form action="update_password.php" method="post">
            <table>
                <td><input type="hidden" name="email" value="<?php echo $email; ?>">
                    <tr>
                        <td><label for="name">Enter current password:</label></td>
                        <td><input type="password" id="currentpassword" name="current_password" value="" required></td>
                    </tr>

                    <tr>
                        <td><label for="phone">Enter new password:</label></td>
                        <td><input type="password" id="newPassword" name="new_password" value="" required
                                placeholder="Minimum 6 letters" minlength="6"></td>
                    </tr>

                    <tr>
                        <td><label for="address">Confirm your password:</label></td>
                        <td><input type="password" id="confirmPassword" name="confirm_password" value="" required
                                placeholder="Same as new password" minlength="6">
                        </td>
                    </tr>
            </table>
            <script>
                const confirmPasswordInput = document.getElementById('confirmPassword');

                confirmPasswordInput.addEventListener('keyup', () => {
                    const newPassword = document.getElementById('newPassword').value;
                    const confirmPassword = confirmPasswordInput.value;

                    // Check password length and match
                    if (newPassword.length < 6 || newPassword !== confirmPassword) {
                        confirmPasswordInput.style.borderColor = 'red';
                    } else {
                        confirmPasswordInput.style.borderColor = 'green';
                    }
                });
            </script>
            <br>
            <button class="orange-button" type="submit">Update</button>&nbsp;
            <button class="orange-button" id="blue" type=""><a href="index.php">Go Back</a></button>
        </form>

    </div>
</body>

</html>
<script>
    if (window.location.search.includes("pw_change=failed")) {
        alert("Current password you entered doesnot match");
        // to stop repeatedly alert on refresh
        window.history.pushState({}, "", window.location.pathname);
    }
</script>   