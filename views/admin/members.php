<?php
include_once __DIR__ . '../../../vendor/autoload.php';
use App\Controllers\MembersController;
$pagetitle = 'Dashboard';
include_once __DIR__ . '../../layouts/header.php';

$currentPage = 'Members';

$members = (new MembersController)->getAllMembers();

$userid = $_SESSION['data']['id'];
?>
<div class="card" id="deletePopup" style="display: none;
    position: absolute;
    z-index: 10;
    margin: 15em 50em 5em 45em;">

    <div>
        <h2 id="deleteTitle">Confirm Delete?</h2>
        <hr>
        <div>
            <p style="text-align:left;font-size:18px;">
                You are about to delete a consumer's data. Are you sure you want
                to continue?
            </p>
        </div>
        <div class="d-flex" style="padding: 10px;margin: 5px 55px 5px 30px;">
            <div style="padding:10px;">
                <button onclick="cancelDelete()" id="cancel">Cancel</button>
            </div>
            <div style="padding:10px;">
                <form method="post" action="functions/delete.php">
                    <input type="hidden" name="id" id="deleteIdValue">
                    <button type="submit" id="delete">Yes, Delete!</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="loaderOverlay">
    <dotlottie-player id="loadGif" src="https://lottie.host/5d12e74c-1f1f-4d67-9c84-5c294fdcb885/BRVkcbZ71H.lottie"
        speed="1" style="width: 300px; height: 300px" loop autoplay>
    </dotlottie-player>
</div>

<div id="pageContent" style="display: none;">

    <div class="app-container">

        <?php include_once __DIR__ . '/../components/top_panel.php'; ?>

        <div class="layout" style="background-color: #F5F5F5;">
            <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>
            <div class="content">
                <h3>Members</h3>
                <hr style="margin-bottom: 2rem; border-color: #e2e8f0;">
                <table id="table" class="table table-bordered table-striped display mt-2 hover">
                    <thead>
                        <tr>
                            <th scope="col" style="border: 1px solid #A9A9A9;">Member name</th>
                            <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Account No.</th>
                            <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Membership type</th>
                            <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Member OR #</th>
                            <th style="width:2em;text-align: center; border: 1px solid #A9A9A9;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($members)): ?>
                            <?php foreach ($members as $member): ?>
                                <tr>
                                    <td><?= htmlspecialchars($member['member_name'] ?? '') ?></td>
                                    <td id="tdData"><?= htmlspecialchars($member['account_no'] ?? '') ?></td>
                                    <td id="tdData"><?= htmlspecialchars($member['membership_type'] ?? '') ?></td>
                                    <td id="tdData"><?= htmlspecialchars($member['member_or'] ?? '') ?></td>
                                    <td id="tdData">
                                        <div class="gap-3" style="display: flex; align-items: center; justify-content: center;">
                                            <div>
                                                <button id="btn">View</button>
                                            </div>
                                            <div>
                                                <button data-id="<?= $member['id'] ?>" id="deletebtn"
                                                    onclick="deletePopup(this)">Delete</button>



                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No contracts found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



<?php include_once '../layouts/footer.php'; ?>

<!-- ✅ Loader Styles -->
<style>
    #loaderOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        /* Dimmed background */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    #tdData {
        text-align: center;
    }

    #btn {
        margin-right: 1em;
        display: inline-block;
        outline: 0;
        appearance: none;
        padding: 0px 12px;
        border: 0px solid transparent;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        background-color: rgb(9, 128, 76);
        box-shadow: rgb(19 170 82 / 40%) 0px 2px 3px;
        color: rgb(255, 255, 255);
        font-size: 14px;
        font-weight: 400;
        height: 36px;
        transition: all 150ms ease-in-out 0s;
    }

    #btn:hover {
        color: rgb(255, 255, 255);
        background-color: rgb(17, 97, 73);
        box-shadow: rgb(19 170 82 / 40%) 0px 2px 3px, rgb(195 231 202) 0px 0px 0px 3px;
    }

    #deletebtn {
        display: inline-block;
        outline: 0;
        appearance: none;
        padding: 0px 12px;
        border: 0px solid transparent;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        background-color: rgb(180 84 84);
        box-shadow: rgb(19 170 82 / 40%) 0px 2px 3px;
        color: rgb(255, 255, 255);
        font-size: 14px;
        font-weight: 400;
        height: 36px;
        transition: all 150ms ease-in-out 0s;
    }

    #deletebtn:hover {
        color: rgb(255, 255, 255);
        background-color: rgb(228 32 32);
        box-shadow: rgb(19 170 82 / 40%) 0px 2px 3px, rgb(195 231 202) 0px 0px 0px 3px;
    }

    #deletePopup {
        /* display: block; */
        background-color: #fffdfd;
        ;
        width: 25em;
        margin: 0 auto;
        text-align: center;
        box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 100em;
    }

    #deleteTitle {
        text-align: left;
    }

    #cancel {
        display: inline-block;
        outline: none;
        cursor: pointer;
        font-size: 16px;
        line-height: 20px;
        font-weight: 600;
        border-radius: 8px;
        padding: 13px 23px;
        border: 1px solid #222222;
        transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s;
        background: #fff;
        color: #222222;
    }

    #cancel:hover {
        border-color: #000000;
        background: #f7f7f7;
    }

    #delete {
        width: 9em;
        display: inline-block;
        outline: none;
        cursor: pointer;
        font-size: 16px;
        line-height: 20px;
        font-weight: 600;
        border-radius: 8px;
        padding: 14px 24px;
        border: none;
        transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s;
        background: linear-gradient(to right, rgb(230, 30, 77) 0%, rgb(227, 28, 95) 50%, rgb(215, 4, 102) 100%);
        color: #fff;
    }
</style>

<!-- ✅ Scripts -->
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>