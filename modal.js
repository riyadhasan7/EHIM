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

// Add more no leave intervals
document.getElementById("addIntervalBtn").onclick = function() {
  var noLeaveIntervals = document.getElementById("no_leave_intervals");
  var index = noLeaveIntervals.children.length;

  var newInterval = document.createElement("div");
  newInterval.className = "input-row";
  newInterval.innerHTML = `
    <div class="input">
      <label for="no_leave_start_${index}">Start Time</label>
      <input type="time" name="no_leave_start[]" id="no_leave_start_${index}">
    </div>
    <div class="input">
      <label for="no_leave_end_${index}">End Time</label>
      <input type="time" name="no_leave_end[]" id="no_leave_end_${index}">
    `;
  noLeaveIntervals.appendChild(newInterval);
}
