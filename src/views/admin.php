<?php
  new \App\Controllers\Admin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form action="/admin" method="POST">
    <input name="title" type="text" placeholder="Task title:" required>
    <textarea name="description" placeholder="Task description:" required></textarea>
    <select name="status" required>
      <option value="drafted">drafted</option>
      <option value="published">published</option>
    </select>
    <select name="difficulty" required>
      <option value="easy">easy</option>
      <option value="medium">medium</option>
      <option value="hard">hard</option>
    </select>
    <input name="deadline" type="number" placeholder="Deadline: " required>
    <div id="requirements">
      <input type="text" placeholder="requirements title: " name="requirements_titles[]" required>
      <input type="text" placeholder="requirements resourse: " name="requirements_resourse[]" required>
    </div>
    <div id="knowladge">
      <input type="text" placeholder="knowladge title:" name="knowledges_titles[]" required>
      <input type="text" placeholder="knowladge resourse:" name="knowledges_resourse[]" required>
    </div>
    <button type="submit">Add task</button>
  </form>
    <button id="addRequirements">Add requirements input</button>
    <button id="addKnowladge">Add Knowladge input</button>
</body>

<script>
    let requirements = document.getElementById("requirements");
    let knowladge = document.getElementById("knowladge");
    let addRequirements = document.getElementById("addRequirements");

    addRequirements.onclick = function () {
      requirements.insertAdjacentHTML("beforeend", `
        <br>
          <input type="text" name="requirements_titles[]" placeholder="requirements title" required>
          <input type="text" name="requirements_resourse[]" placeholder="requirements resourse" required>
        `);
    }
    addKnowladge.onclick = function() {
      knowladge.insertAdjacentHTML("beforeend", `
        <br>
          <input type="text" placeholder="knowladge title:" name="knowladge_title[]" required>
          <input type="text" placeholder="knowladge resourse:" name="knowladge_resourse[]" required>
        `)
    }
</script>
</html>
