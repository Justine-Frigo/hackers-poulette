<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
$success_message = $_SESSION['success'] ?? '';
$error_message = $_SESSION['error'] ?? '';

// Clear session data
unset($_SESSION['errors'], $_SESSION['form_data'], $_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Support - Hackers Poulette™</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="wrapper">
        <div class="inner">
            <?php if ($success_message) : ?>
                <div class="success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if ($error_message) : ?>
                <div class="error"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form action="process_form.php" method="POST">
                <h3>Contact Us</h3>
                <p>Please contact us if you have any problems or comments about our products.</p>
                <label class="form-group">
                    <input class="form-control" type="text" id="name" name="name" placeholder="Firstname" value="<?php echo htmlspecialchars($form_data['name'] ?? ''); ?>">
                    <span class="error" id="name_error"><?php echo $errors['name'] ?? ''; ?></span>
                    <span class="border"></span>
                </label>

                <label class="form-group">
                    <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Lastname" value="<?php echo htmlspecialchars($form_data['lastname'] ?? ''); ?>">
                    <span class="error" id="lastname_error"><?php echo $errors['lastname'] ?? ''; ?></span>
                    <span class="border"></span>
                </label>

                <label class="form-group">
                    <select class="form-control" id="gender" name="gender">
                        <option value="">Gender</option>
                        <option value="male" <?php echo (isset($form_data['gender']) && $form_data['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo (isset($form_data['gender']) && $form_data['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value="other" <?php echo (isset($form_data['gender']) && $form_data['gender'] === 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                    <span class="error" id="gender_error"><?php echo $errors['gender'] ?? ''; ?></span>
                    <span class="border"></span>
                </label>

                <label class="form-group">
                    <input class="form-control" type="email" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>">
                    <span class="error" id="email_error"><?php echo $errors['email'] ?? ''; ?></span>
                    <span class="border"></span>
                </label>

                <label class="form-group">
                    <input class="form-control" type="text" id="country" name="country" placeholder="Country" value="<?php echo htmlspecialchars($form_data['country'] ?? ''); ?>">
                    <span class="error" id="country_error"><?php echo $errors['country'] ?? ''; ?></span>
                    <span class="border"></span>
                </label>

                <label class="form-group">
                    <select class="form-control" id="subject" name="subject">
                        <option value="" hidden>Subject</option>
                        <option value="support" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'support') ? 'selected' : ''; ?>>Support</option>
                        <option value="sales" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'sales') ? 'selected' : ''; ?>>Sales</option>
                        <option value="other" <?php echo (isset($form_data['subject']) && $form_data['subject'] === 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                    <span class="border"></span>
                </label>

                <label class="form-group">
                    <textarea class="form-control" id="message" name="message" placeholder="Message"><?php echo htmlspecialchars($form_data['message'] ?? ''); ?></textarea>
                    <span class="error" id="message_error"><?php echo $errors['message'] ?? ''; ?></span>
                    <span class="border"></span>
                </label>

                <!-- Honeypot field for anti-spam -->
                <div style="display:none;">
                    <label for="honeypot">Let this field empty</label>
                    <input type="text" id="honeypot" name="honeypot">
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>