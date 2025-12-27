<div class="container py-5">
    <div class="table-responsive orders-table-wrapper">
        <table class="table table-bordered table-hover text-center align-middle" id="usersTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Account</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="users-body">
                <?php
                if (!empty($users)) {
                    $index = 1;

                    foreach ($users as $user) {
                        $name = $user->fname . " " . $user->lname;
                        $user_type = ($user->is_guest == 1) ? 'Guest' : "Registered" . " " . $user->lname;
                        $accountInfo = $user->is_guest == 1 ?
                            '<span class="text-muted">Guest</span>' :
                            date('d M Y', strtotime($user->created_at));
                        $accountStatus = ($user->status == 1) ? '<sub class="text-success">(Active)</sub>' : '<sub class="text-danger">(Inactive)</sub>';
                        $action = ($user->status == 1) ? '<button class="btn btn-sm btn-danger userActionBtn" data-value="0" id="' . $user->id . '">Deactivate</button>' : '<button class="btn btn-sm btn-primary userActionBtn" id="' . $user->id . '" data-value="1">Activate</button>';
                ?>
                        <tr>
                            <td><?= $index++ ?></td>
                            <td><?= $user_type ?></td>
                            <td><?= ucfirst($name) ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->mobile ?></td>
                            <td><?= $accountInfo . $accountStatus ?></td>
                            <td><?= $action ?></td>
                        </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>
        <div id="pagination-container">
            <?= $links ?> <!-- Initial links from PHP -->
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        //action btn 
        $(".userActionBtn").on('click', function(e) {
            e.preventDefault();
            const user_id = $(this).attr('id');
            const value = $(this).data('value');
            const btn = $(this);

            console.log(value)
            $.ajax({
                url: "<?= base_url('admin/users/change_status') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    user_id: user_id,
                    status: value
                },
                success: function(res) {
                    if (res.success) {
                        toggleUserButton(btn, value)
                    } else {
                        alert('Status update failed');
                    }
                }
            });
        });

        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();

            let page_number = parseInt($(this).attr('data-ci-pagination-page'));
            let per_page = 3;

            let offset = (page_number - 1) * per_page;

            console.log('page:', page_number);
            console.log('offset:', offset);

            loadTable(offset);
        });

        loadTable(0);
    }); //main
    function loadTable(offset = 0) {
        $.ajax({
            url: '<?= base_url('admin/Users') ?>',
            type: "POST",
            data: {
                offset: offset,
            },
            dataType: "json",
            success: function(response) {
                console.log('inside load table func ' + response.offset)
                set_page(response);

                // $('.pagination').parent().html(response.links);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }


    function set_page(response) {
        if (response.users && response.users.length>0) {
            const user_body = document.getElementById('users-body');
            let html = '';
            let index = 1;

            console.log(response.offset);
            response.users.forEach(function(user) {

                let accountInfo = user.is_guest == 1 ?
                    '<span class="text-muted">Guest</span>' :
                    user.user_created_at;

                let userType = user.is_guest == 1 ? 'Guest' : 'Registered';

                let name = user.fname + " " + user.lname;
                let email = user.email;
                let phone = user.mobile;

                let statusBtn =
                    user.status == 1 ?
                    `<button class="btn btn-sm btn-primary userActionBtn"
                   data-id="${user.id}"
                   data-value="1">Active</button>` :
                    `<button class="btn btn-sm btn-danger userActionBtn"
                   data-id="${user.id}"
                   data-value="0">Deactivate</button>`;

                html += `
                                <tr>
                                    <td>${index++}</td>
                                    <td>${userType}</td>
                                    <td>${name}</td>
                                    <td>${email}</td>
                                    <td>${phone}</td>
                                    <td>${accountInfo}</td>
                                    <td>${statusBtn}</td>
                                </tr>
                            `;
            });

            user_body.innerHTML = html;
            $('#pagination-container').html(response.links);
        }else {
        // Optional: Handle empty users (e.g., clear table or show message)
        document.getElementById('users-body').innerHTML = '<tr><td colspan="7">No users found.</td></tr>';
        $('#pagination-container').html('');  // Clear pagination if no data
    }
    }

    function toggleUserButton(btn, currentValue) {
        if (currentValue == 1) {
            btn
                .removeClass('btn-primary')
                .addClass('btn-danger')
                .text('Deactivate')
                .data('value', 0);
        } else {
            btn
                .removeClass('btn-danger')
                .addClass('btn-primary')
                .text('Activate')
                .data('value', 1);
        }
    }
</script>