<?php
require_once('../includes/config.php');

//if user is not logged in
if (!$user->is_logged_in()) {
    $_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
    header('location: ../components/login.php');
}



if (isset($_POST['submit'])) {
    $profile_img = $_FILES['profile_img'];

    $filename =  $profile_img['name'];
    $filename_tmp =  $profile_img['tmp_name'];

    $profile_ext = explode('.',  $filename);
    $filecheck = strtolower(end($profile_ext));

    $file_ext_stored = array('jpeg', 'png', 'jpg');

    if (in_array($filecheck, $file_ext_stored)) {
        $destinationFile = '../assets/uploads/' . $filename;
        move_uploaded_file($filename_tmp, $destinationFile);
    }

    extract($_POST);
    if ($articleTitle == '') {
        $error[] = 'Please enter Title';
    }
    if ($articleDesc == '') {
        $error[] = 'Please enter Description';
    }
    if ($articleContent == '') {
        $error[] = 'Please enter Content';
    }
    if ($articleAuthor == '') {
        $error[] = 'Please enter Author Name';
    }



    if (!isset($error)) {
        try {
            $stmt = $db->query("INSERT INTO article (articleTitle, articleDesc, articleContent, articleAuthor, profile_img) VALUES ('$articleTitle', '$articleDesc', '$articleContent', '$articleAuthor', '$destinationFile')");
            header('location:index.php?action=added');
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

if (isset($error)) {
    foreach ($error as $error) {
        echo '<p class="message>' . $error . '</p>';
    }
}
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="../assets/sass/utilities/main.css">




<title>Add new Article</title>
<?php
include("../layouts/header.php");
?>


<section class="w3l-contact" id="contact">
    <div class="container py-5">
        <div class="contacts12-main py-md-3">
            <div class="header-section text-center">
                <h3 class="mb-md-5 mb-4">Add Article
                </h3>
            </div>
            <form action="" method="post" class="" enctype="multipart/form-data">
                <div class="main-input">
                    <input type="text" name="articleTitle" class="contact-input" placeholder="Title" required="" autocomplete="off" value="<?php if (isset($error)) {
                                                                                                                                                echo $_POST['articleTitle'];
                                                                                                                                            } ?>">
                    <textarea class="contact-textarea contact-input" name="articleDesc" placeholder="Description" required="" value="<?php if (isset($error)) {
                                                                                                                                            echo $_POST['articleDesc'];
                                                                                                                                        } ?>"></textarea>
                    <textarea class="contact-textarea contact-input" name="articleContent" placeholder="Content" required="" value="<?php if (isset($error)) {
                                                                                                                                        echo $_POST['articleContent'];
                                                                                                                                    } ?>"></textarea>
                    <input type="text" name="articleAuthor" placeholder="Author" class="contact-input" required="" autocomplete="off" value="<?php if (isset($error)) {
                                                                                                                                                    echo $_POST['articleAuthor'];
                                                                                                                                                } ?>">
                    <input type="file" name="profile_img" class="contact-input" value="<?php echo $_POST['profile_img']; ?>">

                </div>
                <div class="text-right">
                    <button name="submit" class="btn-primary btn theme-button">+ Add</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include("../layouts/footer.php"); ?>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>