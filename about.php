<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a CSS file -->
</head>
<body>    
    <?php include 'includes-2/navigation.php' ?>

    <?php
    $page="about";
    include 'includes-2/sidebar.php'
    ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="container mt-5">

        <header>
            <h1>About Us</h1>
            <nav>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Products</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </nav>
        </header>
        
        <main>
            <section>
                <h2>Our Story</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel nisl id lorem finibus blandit. Integer et ultricies ipsum, vitae consectetur tortor. Proin hendrerit urna a eros consequat, sit amet dapibus turpis rutrum.</p>
                <p>Nulla ut vehicula est. Pellentesque eget eros sed nunc vehicula hendrerit. Vivamus non tempor ligula. Sed sit amet lacinia neque. Fusce hendrerit eros nec arcu consequat, eget volutpat sem congue.</p>
            </section>

            <section>
                <h2>Our Team</h2>
                <ul>
                    <li>YOGARAJ RAJUVKARAN - CEO</li>
                    <li>MAYOORAN KUBIRTHAN - CTO</li>
                    <li>KUNAPALASINGHAM ISAIAMUDHAN - CFO</li>
                </ul>
            </section>

            <section>
                <h2>Our Mission</h2>
                <p>Our mission is to provide high-quality products and excellent customer service to our clients.</p>
            </section>
        </main>

        <footer>
            <p>&copy; 2024 RIK . All rights reserved.</p>
        </footer>
        </div>
    </div>
</body>
</html>
