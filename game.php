<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="scorestyle.css">
    <link rel="stylesheet" href="finalstyle.css">
    <title>Elicitation Mastermind</title>
</head>
<body>
    <div class=img>
        <img src="img/scene.png">
    </div>
    <?php
        include 'conversation.php';
        $score = isset($_GET['score']) ? $_GET['score'] : 0;
        function displayScore($score) {
            echo '<div class="score-container">
                    <input class="input-btn" type="radio">
                    <label class="neon-btn">
                        <span class="span"></span>
                        <span class="txt">SCORE:  ' . $score . '</span>
                    </label>
                </div>';
        }
        displayScore($score);
    ?>

    <div id="container">
        <?php
            $conversation = getConversation();

            function displayQuestion($conversation, $currentNode) {
                echo '<p>' . $conversation[$currentNode]['question'] . '</p>';
                echo '<div>';
                foreach ($conversation[$currentNode]['options'] as $optionKey => $option) {
                    echo '<button class="option-btn" onclick="selectOption(\'' . $optionKey . '\', \'' . $option['next'] . '\', \'' . $option['point'] . '\')">' . $option['text'] . '</button>';
                }
                echo '</div>';
            }

            function displayAnswer($conversation, $currentNode) {
                echo '<p>' . $conversation[$currentNode]['answer'] . '</p>';
                if ($currentNode === 'GAGAL'|| $currentNode === 'GAGAL.1' || $currentNode === 'GAGAL.2' || $currentNode === 'GAGAL.3' || $currentNode === 'GAGAL.4' || $currentNode === 'GAGAL.5' || $currentNode === 'GAGAL.6' || $currentNode === 'GAGAL.7' || $currentNode === 'GAGAL.8') {
                    echo '<div id="options">
                            <button class="choice-button" onclick="retryGame()">Mengulang</button>
                            <button class="choice-button" onclick="goToHomePage()">Pergi ke Halaman Home</button>
                        </div>';
                }

                if ($currentNode === 'end' || $currentNode === 'end.n') {
                    echo '<div id="options">
                            <button class="choice-button" onclick="breakdown()">Lihat Breakdown</button>
                            <button class="choice-button" onclick="retryGame()">Ulang Game</button>
                            <button class="choice-button" onclick="goToHomePage()">Kembali ke Halaman Home</button>
                        </div>';
                }
            }

            $currentNode = isset($_GET['node']) ? $_GET['node'] : '1';

            if (isset($conversation[$currentNode]['question'])) {
                displayQuestion($conversation, $currentNode);
            } else {
                displayAnswer($conversation, $currentNode);
            }
        ?>

    </div>

    <div class="exit-button-container">
        <button class="retry-btn" onclick="retryGame()"><img src="img/retry.png"/></button>
        <button class="exit-btn"onclick="goToHomePage()"><img src="img/exit.png"/></button>
    </div>

        <?php
            $popupContent = [
                '1.1' => ['A', 'Creating a Friendly Atmosphere', 'Membuka suasana persahabatan, dan membuka perbincangan dengan sesuatu yang umum dan ringan dengan suasana ramah'],
                '1.2' => ['B', 'Initiating Conversation with a Small Talk', 'Membuka perbincangan dengan sesuatu yang umum dan ringan'],
                '1.3' => ['A', 'Deliberate Assumed Statements', 'Menyampaikan sesuatu yang belum diketahui kebenarannya agar target bisa mengoreksinya'],
                '1.4' => ['A', 'Mutual Experiences & The Leading Question', 'Sampaikan kemiripan dengan target berdasarkan minat, hobi, atau pengalaman bersama, sebagai cara untuk mendapatkan informasi atau membangun hubungan sebelum meminta informasi. Ajukan pertanyaan yang jawabannya "ya" atau "tidak" tetapi mengandung setidaknya satu asumsi'],
                '2'   => ['B', 'Can you top this?', 'Ceritakan kisah yang menarik dengan harapan target ingin melampauinya dengan menceritakan kisah miliknya yang mungkin berisi informasi yang diinginkan.'],
                '2.1' => ['B', 'Control and Maintain', 'Kendalikan dan pertahankan pembicaraan agar target tidak merasa diarahkan pada topik tertentu, Makro ke Mikro kembali ke Makro'],
                '2.2' => ['A', 'Exploitation of Tendency to Complain', 'Mengeluh dapat menarik empati dari target sehingga memungkinkan target menyampaikan keluhan miliknya yang mungkin berisi informasi pribadi dengan tujuan saling berbagi beban'],
                '2.3' => ['A', 'Flattery & Feigning Ignorance', 'Pujian dapat menghasilkan berbagai respons seperti membual tentang pekerjaan, atau kecenderungan untuk memberi penghargaan kepada orang lain atas pekerjaan. Seorang elisitor dapat menunjukkan ketidaktahuannya agar target "mengajari" mereka tentang suatu topik. Taktik ini sering digunakan di dunia akademis. Ini mengeksploitasi kebiasaan mengajar dan dapat menempatkan akademisi ke dalam kerangka berpikir yang familiar untuk berbagi informasi'],
                '2.4' => ['B', 'Take Advantage of Target Openness', 'Saat target merasa tidak keberatan untuk berbicara tentang suatu topik pribadi, manfaatkan kesempatan tersebut untuk mendapatkan informasi'],
                '2.5' => ['C', 'Deliberate False Statements', 'Seorang elisitor dapat dengan sengaja membuat pernyataan yang salah dengan harapan target akan mengoreksinya dengan pernyataan yang benar'],
                '2.6' => ['B', 'Deliberate Assumed Knowledge', 'Berpura-pura memiliki pengetahuan atau asosiasi yang sama dengan seseorang'],
                '3'   => ['B', 'Deliberate Assumed Question', 'Mengajukan pertanyaan yang berdasarkan asumsi dengan harapan target tertarik untuk menjawabnya dengan jawaban yang sesungguhnya'],
                '3.1' => ['B', 'Quid Pro Quo or Confidential Bait', 'Dalam quid pro quo, elisitor memberikan informasi berharga atau terbatas kepada target. Tujuannya adalah membuat target merasa berkewajiban untuk membalas budi dan memberikan informasi berharga atau terbatas kepada elisitor'],
                '3.2' => ['A', 'Criticism', 'Mengkritik hal-hal yang diminati target dengan harapan target akan melakukan pembelaan dengan mengungkapkan informasi penting sebagai pembelaan. Banyak orang akan membela dengan keras hal-hal yang mereka minati'],
                '3.3' => ['C', 'Bracketing', 'Daripada langsung meminta nilai spesifik, elicitor dapat menanyakan target tentang nilai sensitif menggunakan perkiraan untuk mendapatkan nilai yang lebih spesifik'],
                'end' => ['B', 'Leave a Good Impression', 'Akhiri percakapan secara natural dengan kembali ke makro agar tidak terkesan terburu-buru mengakhiri percakapan setelah mendapatkan informasi dan mencegah kecurigaan target serta memberikan kesan yang baik'],
            ];

            if (isset($popupContent[$currentNode]) && isset($_GET['option']) && $_GET['option'] === $popupContent[$currentNode][0]) {
                echo '<div class="overlay"></div>';
                echo '<div class="form-popup" id="correct">
                        <div class="form-container">
                            <button type="button" disabled class="checklist">&#10004</button>
                            <h3>' . $popupContent[$currentNode][1] . '</h3>
                            <h4>' . $popupContent[$currentNode][2] . '</h4>
                            <button type="button" class="close-button" onclick="closePopup()">&#x2716</button>
                        </div>
                    </div>';
            }
        ?>

        <script>
            function displayPopup() {
                var overlay = document.querySelector(".overlay");
                var popup = document.getElementById("correct");
                overlay.style.display = "block";
                popup.style.display = "block";
                setTimeout(function() {
                    overlay.classList.add("active");
                    popup.classList.add("active");
                }, 500);
            }

            document.addEventListener("DOMContentLoaded", function() {
                displayPopup();
            });

            function closePopup() {
                var overlay = document.querySelector(".overlay");
                var popup = document.getElementById("correct");
                overlay.classList.remove("active");
                popup.classList.remove("active");
                setTimeout(function() {
                    overlay.style.display = "none";
                    popup.style.display = "none";
                }, 500);
            }

            function selectOption(option, nextNode, point) {
                var newScore = parseInt('<?php echo $score; ?>') + parseInt(point);
                    window.location.href = 'game.php?node=' + nextNode + '&score=' + newScore + '&option=' + option;
            }

            function retryGame() {
                window.location.href = 'game.php?node=1';
            }

            function goToHomePage() {
                window.location.href = 'index.html';
            }

            function breakdown() {
                window.location.href = 'breakdown.html';
            }
        </script>

    <?php
        // Function to calculate predicate based on the final score
        function calculatePredicate($finalScore) {
            if ($finalScore >= 160) {
                return 'S';
            } elseif ($finalScore >= 129) {
                return 'A';
            } elseif ($finalScore >= 99) {
                return 'B';
            } elseif ($finalScore >= 67) {
                return 'C';
            } else {
                return 'D';
            }
        }

        // Check if the game is completed and display the popup with the final score and predicate
        if ($currentNode === 'end' || $currentNode === 'end.n') {
            $finalScore = isset($_GET['score']) ? $_GET['score'] : 0;
            $finalPredicate = calculatePredicate($finalScore);

            echo '<div class="myCard">
                    <div class="innerCard">
                        <div class="frontSide">
                            <p class="judul">Elicitor&#39;s Rating</p>
                            <p class="rate">' . $finalPredicate . '</p>
                        </div>
                        <div class="backSide">
                            <p class="judul">SCORE</p>
                            <p class="skor">' . $finalScore . '/<br>160</p>
                        </div>
                    </div>
                </div>';

        }
    ?>
</body>
</html>
