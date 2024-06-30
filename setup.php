<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Information Setup Page</title>
  <?php include("config.php"); ?>
  <style>
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Information Setup Page</title>
  <?php 
    include("config.php"); 
    include("uploadSetupinfo.php");
    // Fetch data from the database
    $query = "SELECT id, proc FROM loc_pro";
    $result = mysqli_query($con, $query);
  ?>
  <style>
    /* Additional CSS for the modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0,0,0);
      background-color: rgba(0,0,0,0.4);
      padding-top: 60px;
    }
    .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      border-radius: 10px;
      width: 60%;
    }
    .close {
      color: #aaa;
      float: right;
      padding: 2px;
      font-size: 35px;
      font-weight: bold;
    }
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
    .select-multiple {
      width: 100%;
      height: 150px;
      padding: 5px;
      margin: 10px;
      overflow-y: scroll;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="box form-box">
    <header class="header">Set Data</header>
    <form action="uploadSetupInfo.php" method="POST">
      <div class="field input">
        <label for="module_name">Module Name</label>
        <input type="text" name="module_name" id="module_name" required>
      </div>
      <div class="field input">
        <label for="exam_date">Exam Date</label>
        <input type="date" name="exam_date" id="exam_date" required>
      </div>
      <div class="field input-row">
        <div class="input">
          <label for="start_time">Start Time</label>
          <input type="time" name="start_time" id="start_time" required>
        </div>
        <div class="input">
          <label for="end_time">End Time</label>
          <input type="time" name="end_time" id="end_time" required>
        </div>
      </div>

      <div class="field">
        <input class="btn" type="button" id="openModalBtn" value="select exam procedure">
      </div>

      <div class="field">
        <input class="btn" type="submit" name="submit" id="submit" value="Submit">
      </div>

      <input type="hidden" name="selected_proc" id="selected_proc">
    </form>
  </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="modalForm">
      <div class="select-multiple">
        <?php
          // Check if there are results and display them
          if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo '<label><input type="checkbox" name="procedures[]" value="'. $row['id'] .'"> '. $row['proc'] .'</label><br>';
            }
          } else {
            echo 'No procedures found.';
          }
        ?>
      </div>
      <div class="field">
        <input type="button" class="btn" id="saveProcBtn" value="Save">
      </div>
    </form>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Save selected procedures and close the modal
document.getElementById("saveProcBtn").onclick = function() {
  var checkboxes = document.querySelectorAll("input[name='procedures[]']");
  var selected_proc = "";
  checkboxes.forEach(function(checkbox) {
    selected_proc += checkbox.checked ? "1" : "0";
  });
  document.getElementById("selected_proc").value = selected_proc;
  modal.style.display = "none";
}
</script>

</body>
</html>

    
  </style>
</head>
<body>

<div class="container">
  <!-- Image on the left side -->
  
  <!-- <div class="img left-sided">
    <img src="https://img.freepik.com/free-photo/international-day-education-dark-style_23-2151013409.jpg?t=st=1719506016~exp=1719509616~hmac=3100cffba209508058ed7e90513aacc79ccfb4780ab53bf120168c36c50ea1af&w=740" alt="Exam Image">
  </div> -->
  <div class="box form-box">
  
    <header class="header">Exam Registration</header>
    <form action="registration.php" method="POST">
      <div class="field input">
        <label for="module_name">Module Name</label>
        <input type="text" name="module_name" id="module_name" required>
      </div>
      <div class="field input">
        <label for="exam_date">Exam Date</label>
        <input type="date" name="exam_date" id="exam_date" required>
      </div>
      <div class="field input-row">
        <div class="input">
          <label for="start_time">Start Time</label>
          <input type="time" name="start_time" id="start_time" required>
        </div>
        <div class="input">
          <label for="end_time">End Time</label>
          <input type="time" name="end_time" id="end_time" required>
        </div>
      </div>

      <div class="field">
        <input class ="btn" type="button" id="openModalBtn" value="select exam procedure">
      </div>

      <div class="field">
        <input class="btn" type="submit" name="submit" id="submit" value="Submit">
      </div>
      
      
    </form>
  </div>
</div>


<div id="proc-select-modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form>
      <div class="select-multiple">
        <label><input type="checkbox" name="option1" value="Option 1"> Option 1</label><br>
        <label><input type="checkbox" name="option2" value="Option 2"> Option 2</label><br>
        <label><input type="checkbox" name="option3" value="Option 3"> Option 3</label><br>
        <label><input type="checkbox" name="option4" value="Option 4"> Option 4</label><br>
        <label><input type="checkbox" name="option5" value="Option 5"> Option 5</label><br>
        <label><input type="checkbox" name="option6" value="Option 6"> Option 6</label><br>
        <label><input type="checkbox" name="option7" value="Option 7"> Option 7</label><br>
        <label><input type="checkbox" name="option8" value="Option 8"> Option 8</label><br>
        <label><input type="checkbox" name="option9" value="Option 9"> Option 9</label><br>
        <label><input type="checkbox" name="option10" value="Option 10"> Option 10</label><br>
      </div>
      <div class="field">
        <input type="submit" class="btn" value="save">
      </div>
    </form>
  </div>
</div>

<script src="modal.js">  
</script>

</body>
</html>
