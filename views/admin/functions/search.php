<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\MembersController;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['member_data'])) {

    $search = trim($_POST['member_data']);
    $controller = new MembersController();
    $results = $controller->searchMember($search);


    if ($results && count($results) > 0) {
        echo '<br><table id="searchTable" class="mt-3 table table-stripe table-bordered hover display" style="width: 100%; background-color: white;">
                <thead class="table-dark mt-2">
                    <tr>
                        <th>Member Name</th>
                        <th style="text-align:center;">Account Number</th>
                        <th style="text-align:center;">Address</th>
                        <th style="text-align:center;">Member OR</th>
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($results as $row) {
            $id = htmlspecialchars($row['ConsumerId'] ?? '');
            $name = htmlspecialchars($row['Name'] ?? '');
            $address = htmlspecialchars($row['Address'] ?? '');
            $memberOr = htmlspecialchars($row['member_or'] ?? '');
            $accountNo = $row['TownCode'] . '-' . $row['TownCode'] . '' . $row['RouteCode'] . '-' . $row['AcctCode'];

            echo '<tr>
                <td>' . $name . '</td>
                <td style="text-align:center;">' . $accountNo . '</td>
                <td style="text-align:center;">' . $address . '</td>
                <td>' . $memberOr . '</td>
                <td style="text-align:center;">
                    <div style="display: flex; gap: 5px; justify-content: center;">
                        <button
                            id="ViewBtn"
                            class="btn btn-sm btn-primary"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample"
                            aria-controls="offcanvasExample"
                            data-id="' . $id . '"
                            data-name="' . $name . '"
                            data-account="' . $accountNo . '"
                            data-address="' . $address . '"
                            
                        >
                            View
                        </button>
                        <button id="deleteBtn" class="btn btn-sm btn-danger" data-id="' . $id . '" onclick="deletePopup(this)">Delete</button>
                    </div>
                </td>
            </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No results found for <strong>' . htmlspecialchars($search) . '</strong>.</p>
              <br>
              <div style="text-align: center;">
                  <img src="../../assets/images/notfound.gif" width="25%" alt="Not Found"><br>
                  <h2>Not Found</h2>
              </div>';
    }
} else {
    echo '<p>Invalid request.</p>';
}
