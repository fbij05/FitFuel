<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FitFuel - Contact Us</title>


    <!-- css f -->
    <link rel="stylesheet" href="css/style.css">

    <!-- font aws -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">


    <style>
        #contact {
            max-width: 1000px;
            margin: 1em auto;

            h1 {
                text-align: center;
            }
        }
        address {
            display: flex;
            flex-direction: row;
            margin-top: 2em;
            gap: 2em;
            justify-content: left;
            align-items: center;
        }
        .details {
            padding: 0 1em;
        }
        iframe {
            max-width: 100%;
        }

        @media screen and (max-width: 800px) {
            address {
                flex-direction: column;
            }

        }
    </style>
</head>
<body>

<?php include "includes/header.php" ?>

<main id="contact">
    <h1>Contact Us!</h1>
    <address>
        <div class="map">
            <iframe width="750" height="500" src="https://maps.google.com/maps?width=650&height=400&hl=en&q=Riyadh&t=&z=14&ie=UTF8&iwloc=B&output=embed" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="details">
            <ul>
                <li>Email: <a href="mailto:000@000">support@fitfuel.com</a></li>
                <li>Phone: <a href="mailto:000@000">+966 11 234 5678</a></li>
                <li>WhatsApp: <a href="mailto:000@000">+966 50 123 4567</a></li>
                <br>
                <li>
                    <span>Address: King Fahd Road, Al Olaya District, Riyadh 12345, Saudi Arabia</span>
                </li>
                <br>
                <li>
                    <span>Working hours:<br>Sun-Thu 9:00 AM - 10:00 PM <br> Fri-Sat 2:00 PM - 10:00 PM</span>
                </li>
                <br>
                <li>
                    <span>Social media: @FitFuel (Twitter/X, Instagram, Snapchat)</span>
                </li>
            </ul>
        </div>
    </address>
</main>
<?php include "includes/footer.html" ?>
</body>
</html>