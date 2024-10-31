<head>
  <link rel="stylesheet" href="../css/backButton.css">
</head>
<button id="goBackButton">&nbsp;Go Back&nbsp;</button>
<script>
  const goBackButton = document.getElementById('goBackButton');
  goBackButton.addEventListener('click', function () {
    history.back();
  });
</script>