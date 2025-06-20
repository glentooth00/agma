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

</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!----- custom js ------->
<script src="../../assets/js/member.js"></script>