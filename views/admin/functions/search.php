<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\MembersController;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['member_data'])) {
    $search = trim($_POST['member_data']);
    $controller = new MembersController();
    $results = $controller->searchMember($search);

    if ($results && count($results) > 0) {
        echo '<table id="searchTable" class=" mt-3 table table-bordered table-striped display mt-2 hover" style="width: 100%; background-color: white;">
                <thead>
                    <tr>
                        <th>Member Name</th>
                        <th>Account Number</th>
                        <th>Address</th>
                        <th>Member OR</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($results as $row) {
            $id = htmlspecialchars($row['ConsumerId'] ?? '');
            $name = htmlspecialchars($row['Name'] ?? '');
            $address = htmlspecialchars($row['Address'] ?? '');
            $memberOr = htmlspecialchars($row['member_or'] ?? '');
            $accountNo = $row['TownCode'].'-'.$row['TownCode'].''.$row['RouteCode'].'-'.$row['AcctCode'];

            echo '<tr>
                <td>' . $name . '</td>
                <td>' . $accountNo . '</td>
                <td>' . $address . '</td>
                <td>' . $memberOr . '</td>
                <td>
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
