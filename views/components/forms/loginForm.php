<div class="loginContainer bg-white p-2 rounded card">
    <h3 class="p-3">Login </h3>
    <div class="LoginForm p-2">
        <form action="views/scripts/login.php" method="post">
            <div class="p-2">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="p-2 mb-2 position-relative">
                <input type="password" class="form-control" name="password" id="passwordField" placeholder="Password"
                    required>
                <i class="fa-solid fa-eye position-absolute" id="togglePassword"
                    style="top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer;"></i>
            </div>
            <div class="p-2">
                <!-- <button class="btn btn-block text-white">Login</button> -->
                <button class="button-29" role="button">Login</button>
            </div>
        </form>
    </div>
</div>
<?php if (!empty($_SESSION['notification'])): ?>
    <div class="error border-danger text-danger dm-sans-error" id="errorMessage" title="Error">
        <button id="closeError"
            style="position: absolute; top: 8px; right: 12px; background: none; border: none; font-size: 18px; cursor: pointer;">&times;</button>
        <h5><?= $_SESSION['notification']['message'] ?></h5>
    </div>
<?php endif; ?>

<style>
    #username,
    #passwordField {
        width: 100%;
        height: 36px;
        border-radius: 4px;
        padding-left: 12px;
        font-size: 14px;
        font-weight: normal;
        border: 1px solid rgb(137, 151, 155);
        transition: border-color 150ms ease-in-out 0s;
        outline: none;
        color: rgb(33, 49, 60);
        background-color: rgb(255, 255, 255);
        padding-right: 12px;
    }

    #username,
    #passwordField :hover {
        box-shadow: rgb(231 238 236) 0px 0px 0px 3px;
    }


    #errorMessage {
        position: absolute;
        top: 5%;
        left: 50%;
        transform: translate(-50%, -50%);

        width: 30em;
        padding: 1.5em;

        background-color: white;
        color: red;
        text-align: center;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const $msg = $('#errorMessage');

        if ($msg.length) {
            // Fade in from top
            setTimeout(() => {
                $msg.css({
                    opacity: 1,
                    transform: 'translate(-50%, 0)'
                });
            }, 100);

            // Auto close after 6 seconds
            setTimeout(() => {
                $msg.fadeOut(400);

                // Clear the session notification silently
                fetch('views/scripts/clear_notification.php', {
                    method: 'POST'
                });
            }, 6000);
        }

        // Manual close
        $('#closeError').on('click', function () {
            $msg.fadeOut(300);
            fetch('views/scripts/clear_notification.php', {
                method: 'POST'
            });
        });
    });
</script>