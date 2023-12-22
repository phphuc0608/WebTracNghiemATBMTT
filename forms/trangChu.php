<?php
include("../module/connect.php");
$sql = "SELECT * FROM cau_hoi";
$stmt = $conn->prepare($sql);
$query = $stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./styles/trangChu.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Trắc nghiệm</title>
</head>
<title>Trắc nghiệm</title>
</head>
<style>

</style>

<body>
  <div id="content">
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
      <div id="question-<?php echo $row['ma_cau_hoi'] ?>" class="question_box">
        <div class="question py-2">
          <h3>Câu hỏi: </h3><?php echo $row['noi_dung_cau_hoi'] ?>
        </div>
        <div class="answer">
          <form action="" method="post">
            <input class="py-2" type="radio" name="answer" value="A" id="A">
            <label class="py-2" for="A">A.</label><?php echo $row['A'] ?><br>
            <input class="py-2" type="radio" name="answer" value="B" id="B">
            <label class="py-2" for="B">B.</label><?php echo $row['B'] ?><br>
            <input class="py-2" type="radio" name="answer" value="C" id="C">
            <label class="py-2" for="C">C.</label><?php echo $row['C'] ?><br>
            <input class="py-2" type="radio" name="answer" value="D" id="D">
            <label class="py-2" for="D">D.</label> <?php echo $row['D'] ?><br>
          </form>
        </div>
        <div class="result_container">
          <h3>Kết quả: </h3>
          <p>Đáp án đúng: <span class="result"><?php echo $row['dap_an_dung'] ?></span></p>
        </div>
        <div class="btn">
          <button class="btn btn-primary cau_truoc">Câu trước</button>
          <button class="btn btn-primary cau_sau">Câu sau</button>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</body>
<script>
  let currentQuestion = 0; // Start with the first question

  // Hide all questions, except for the first one
  document.querySelectorAll('.question_box').forEach((elem, index) => {
    if (index !== currentQuestion) {
      elem.style.display = 'none';
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    var answers = document.querySelectorAll('input[name="answer"]');
    answers.forEach(function(answer) {
      answer.addEventListener('click', function() {
        var results = document.querySelectorAll('.result');
        results.forEach(function(result) {
          result.style.display = 'block';
        });
      });
    });
  });

  document.querySelectorAll('.cau_sau').forEach((btn, index) => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.question_box')[currentQuestion].style.display = 'none';
      currentQuestion++;
      if (currentQuestion === document.querySelectorAll('.question_box').length) {
        currentQuestion = 0;
      }
      document.querySelectorAll('.question_box')[currentQuestion].style.display = 'block';
    });
  });

  document.querySelectorAll('.cau_truoc').forEach((btn, index) => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.question_box')[currentQuestion].style.display = 'none';
      currentQuestion--;
      if (currentQuestion < 0) {
        currentQuestion = document.querySelectorAll('.question_box').length - 1;
      }
      document.querySelectorAll('.question_box')[currentQuestion].style.display = 'block';
    });
  });
</script>

</html>