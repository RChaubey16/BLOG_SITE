<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="../assets/sass/utilities/main.css">
</head>

<body>
    <section class="w3l-subscribe">
        <div class="main-w3 py-5">
            <div class="container py-lg-3">
                <div class="grids-forms text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="fa fa-envelope mb-3" aria-hidden="true"></span>
                            <div class="header-section text-center">
                                <h3>Keep up to date - Get Email updates</h3>
                                <p>Get our latest news straight into your inbox</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-md-5 mt-4">
                        <div class="col-lg-7 col-md-9 mx-auto main-midd-2">
                            <form onsubmit="return doSubscribe()" action="#" method="post" class="rightside-form">
                                <input id="email" type="email" name="email" placeholder="Input your e-mail" required="">
                                <button type="submit" name="subscribe" class="btn btn-primary theme-button">Subscribe</button>
                            </form>
                            <p id="message"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

    <script>
        function doSubscribe() {
            var email = document.getElementById("email").value;

            var ajax = new XMLHttpRequest();
            ajax.open("POST", "/components/do-subscribe.php", true);
            ajax.setRequestHeader(
                "Content-Type",
                "application/x-www-form-urlencoded"
            );
            ajax.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("message").innerHTML = "Subscription Successful";
                }
            };

            ajax.send("email=" + email);

            return false;
        }
    </script>
</body>

</html>