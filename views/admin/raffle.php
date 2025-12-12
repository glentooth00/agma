<?php
use App\Controllers\AttendeesController;
include_once __DIR__ . '../../../vendor/autoload.php';

// Get participants
$participantsData = (new AttendeesController())->raffle();

// Extract only names (adjust 'name' to your DB column)
$participants = array_map(function($p) {
    return $p['consumer_name'];
}, $participantsData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Raffle Name Picker</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
    #raffleName {
        font-size: 2em; font-weight: bold; margin: 30px 0;
        height: 50px; line-height: 50px;
        color: #fff; background: #007bff; border-radius: 10px;
        transition: all 0.3s ease;
    }
    button { padding: 10px 20px; font-size: 1em; border: none; border-radius: 5px; cursor: pointer; background: #28a745; color: #fff; }
    button:hover { background: #218838; }
</style>
</head>
<body>

<h1>Raffle Name Picker</h1>
<div id="raffleName">?</div>
<button id="startBtn">Start Raffle</button>

<!-- Winner Modal -->
<div class="modal fade" id="winnerModal" tabindex="-1" aria-labelledby="winnerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="winnerModalLabel">🎉 Winner 🎉</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2 id="winnerName"></h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Pass PHP array to JS
const participants = <?php echo json_encode($participants); ?>;
let raffleInterval;

document.getElementById('startBtn').addEventListener('click', function() {
    const display = document.getElementById('raffleName');

    if (raffleInterval) clearInterval(raffleInterval);

    let count = 0;
    const maxCycles = 50;
    raffleInterval = setInterval(() => {
        const randomIndex = Math.floor(Math.random() * participants.length);
        display.textContent = participants[randomIndex];
        display.style.background = `hsl(${Math.random()*360}, 70%, 50%)`;
        display.style.transform = `scale(${1 + Math.random()*0.2})`;

        count++;
        if (count >= maxCycles) {
            clearInterval(raffleInterval);
            display.style.transform = "scale(1)";
            display.style.background = "#007bff";

            // Show winner in modal
            const winnerName = display.textContent;
            document.getElementById('winnerName').textContent = winnerName;
            const winnerModal = new bootstrap.Modal(document.getElementById('winnerModal'));
            winnerModal.show();
        }
    }, 100);
});
</script>

</body>
</html>
