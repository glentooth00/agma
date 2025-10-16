<?php
$logoPath = file_exists('../../assets/images/logo.png')
    ? '../../assets/images/logo.png'
    : 'assets/images/logo.png';
?>
<div class="footer text-center text-white p-2 mt-2">
    <span>Privacy | Security | Feedback</span>
    <div class="justify-content-center p-3 d-flex gap-1">
        <div class="p-2 mt-1">
            <img width="23px" src="<?= $logoPath ?>">
        </div>
        <div class="p-2 mt-1 text-white">
            AGMA | IlecoIII
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<!-- Loading Overlay -->
<div id="loadingOverlay" style="
    display: none;
    position: fixed;
    top: 0em; left: 0;
    width: 100%; height: 100%;
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(4px);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
">
    <div role="status" class="mt-5">
        <img src='../../assets/images/search.gif' alt='Loading...' style="width: 400px;top:15px;">
    </div>
    <p class="mt-3 fw-bold" style="color: rgb(0, 82, 204); font-size: 1.2rem;">
        Fetching Data, please wait...
    </p>
</div>






</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!----- custom js ------->
<script src="../../assets/js/member.js"></script>