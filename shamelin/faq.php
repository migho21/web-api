<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shamelin Bestari Complaint Management System FAQ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .faq-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        .faq-question {
            font-weight: bold;
            cursor: pointer;
            color: #333;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }
        .faq-question:hover {
            color: #555;
        }
        .faq-answer {
            display: none;
            color: #666;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Shamelin Bestari Complaint Management System FAQ</h1>

        <?php
        // Define FAQ items as an associative array where the key is the question and the value is the answer
        $faqItems = array(
            "What is the Shamelin Bestari Complaint Management System?" => "The Shamelin Bestari Complaint Management System is a platform designed to facilitate the reporting and resolution of issues within the Shamelin Bestari community.",
            "How can I access the Complaint Management System?" => "You can access the system by visiting our website or using the dedicated mobile application.",
            "Is there a fee for using the system?" => "No, the use of the Complaint Management System is free for all residents of Shamelin Bestari.",
            "What kind of issues can I report?" => "You can report various issues such as maintenance problems, security concerns, cleanliness issues, and other community-related matters.",
            "How do I submit a complaint?" => "To submit a complaint, log in to your account on the website or mobile app, and navigate to the 'Submit Complaint' section. Fill out the necessary details and submit your complaint.",
            "Can I track the status of my complaint?" => "Yes, you can track the status of your complaint by logging in to your account and checking the 'My Complaints' section.",
            "How long does it take to resolve a complaint?" => "The time taken to resolve a complaint depends on the nature and severity of the issue. Our team aims to address complaints in a timely manner.",
            "What happens after I submit a complaint?" => "After you submit a complaint, our team will review it and take appropriate action. You will be notified of the progress and resolution of your complaint.",
            "What if I'm not satisfied with the resolution?" => "If you're not satisfied with the resolution provided, you can escalate your complaint through the system, and it will be reviewed by higher authorities.",
            "What should I do if I encounter technical issues with the system?" => "If you encounter any technical issues, please contact our technical support team at support@shamelinbestari.com for assistance.",
            "How can I reset my password?" => "To reset your password, click on the 'Forgot Password' link on the login page and follow the instructions provided.",
            "How do I update my contact information?" => "You can update your contact information by accessing your account settings and editing the relevant details."
        );

        // Function to display FAQ items
        function displayFAQ($faqItems) {
            foreach ($faqItems as $question => $answer) {
                echo '<div class="faq-item">';
                echo '<div class="faq-question" onclick="toggleAnswer(this)">' . $question . '<span>+</span></div>';
                echo '<div class="faq-answer">' . $answer . '</div>';
                echo '</div>';
            }
        }

        // Display FAQ items
        displayFAQ($faqItems);
        ?>

    </div>

    <script>
        // Function to toggle FAQ answer visibility
        function toggleAnswer(element) {
            var answer = element.nextElementSibling;
            var icon = element.querySelector('span');
            if (answer.style.display === "none") {
                answer.style.display = "block";
                icon.textContent = "-";
            } else {
                answer.style.display = "none";
                icon.textContent = "+";
            }
        }
    </script>
</body>
</html>
