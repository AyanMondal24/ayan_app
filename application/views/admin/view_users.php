<div class="container mt-2">

    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">All Users</h5>
    </div>
    <div class="table-responsive orders-table-wrapper shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Left: entries -->
            <div class="d-flex align-items-center gap-2 p-2">
                <select class="form-select form-select-sm w-auto" id="entriesSelect">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                </select>
                <span>entries per page</span>
            </div>
            <!-- filter  -->
            <div class="d-flex align-items-center gap-2">
                <label class="mb-0">User Type:</label>
                <select class="form-select form-select-sm w-auto" id="userTypeFilter">
                    <option value="">All</option>
                    <option value="0">Registered</option>
                    <option value="1">Guest</option>
                </select>
            </div>

            <!-- Right: search -->
            <div class="d-flex align-items-center gap-2 p-2">
                <label class="mb-0">Search:</label>
                <input type="text" class="form-control" name="search" id="tableSearch" />
            </div>
        </div>

        <table class="table table-bordered table-hover text-center align-middle" id="usersTable">
            <thead class="table-dark">
                <tr>
                    <th width="10" class="sortable" data-column="id">#</th>
                    <th width="15">User Type</th>
                    <th width="20" class="sortable" data-column="name">Name</th>
                    <th width="20" class="sortable" data-column="email">Email</th>
                    <th width="15" class="sortable" data-column="mobile">Phone No.</th>
                    <th width="15" class="sortable" data-column="created_at">Account</th>
                    <th width="15">Action</th>
                </tr>
            </thead>
            <tbody id="users-body">
                <?php
                if (!empty($users)) {
                    $index = 1;

                    foreach ($users as $user) {
                        $name = $user->fname . " " . $user->lname;
                        $user_type = ($user->is_guest == 1) ? 'Guest' : "Registered";
                        $accountInfo = date('d M Y', strtotime($user->created_at));
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
        <div class="d-flex justify-content-between align-items-end mt-3">
            <div id="showing-entries" class="fs-6 text-black text-start small">
                <!-- Showing text will come here -->
            </div>
            <div id="pagination-container">
                <!-- pagination links -->
            </div>

        </div>


    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let sortColumn = '';
        let sortOrder = 'asc';
        let searchval = '';
        let pageno = 1;
        let userType = '';
        let per_page = 5;

        // get entries per page
        $.ajax({
            url: "<?= base_url('admin/Users/getEntriesPerPage') ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    const total = parseInt(response.total);
                    const entriesSelect = $("#entriesSelect");

                    let options = '';
                    const baseOptions = [5, 10, 25, 50, 100];

                    baseOptions.forEach(function(val) {
                        if (val < total) {
                            options += `<option value="${val}">${val}</option>`;
                        }
                    });

                    // add total as last option
                    options += `<option value="${total}">${total}</option>`;

                    entriesSelect.html(options);
                    loadTable(pageno, searchval, sortColumn, sortOrder, userType, per_page);
                }
            }
        });

        //per page
        $(document).on('change', '#entriesSelect', function() {
            per_page = parseInt($(this).val(), 10);
            pageno = 1;
            loadTable(pageno, searchval, sortColumn, sortOrder, userType, per_page);
        });

        // sorting
        $(document).on('click', 'th.sortable', function(e) {
            e.preventDefault();
            const column = $(this).data('column');
            if (sortColumn === column) {
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = column;
                sortOrder = 'asc';
            }

            $('th.sortable').removeClass('asc desc');
            $(this).addClass(sortOrder);
            searchval = $('#tableSearch').val();
            loadTable(1, searchval, sortColumn, sortOrder, userType, per_page);
        });

        // searching
        $('#tableSearch').on('keyup', function(e) {
            searchval = $(this).val();
            loadTable(pageno, searchval, sortColumn, sortOrder, userType);
        });

        // filter
        $('#userTypeFilter').on('change', function() {
            userType = $(this).val();
            loadTable(pageno, searchval, sortColumn, sortOrder, userType)
        });

        //pagination
        $(document).on('click', '#pagination-container a', function(e) {
            e.preventDefault();

            pageno = $(this).data('id');

            loadTable(pageno, searchval, sortColumn, sortOrder, userType);
        });

        //action btn change active to deactive
        $(document).on('click', '.userActionBtn', function(e) {
            e.preventDefault();
            const user_id = $(this).attr('id');
            const value = $(this).data('value');
            const btn = $(this);

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
                        loadTable(pageno, searchval, sortColumn, sortOrder, userType, per_page);
                    }
                }
            });
        });
        loadTable(pageno);
    }); //main
    function loadTable(pageno, searchval, sortColumn, sortOrder, userType, per_page) {
        $.ajax({
            url: '<?= base_url('admin/Users') ?>',
            type: "POST",
            data: {
                pageno: pageno,
                searchval: searchval,
                sortColumn: sortColumn,
                sortOrder: sortOrder,
                userType: userType,
                per_page: per_page
            },
            dataType: "json",
            success: function(response) {
                set_page(response);

                // $('.pagination').parent().html(response.links);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }


    function set_page(response) {
        if (response.users && response.users.length > 0) {
            const user_body = document.getElementById('users-body');
            let html = '';
            let index;
            const total = parseInt(response.total_item);
            const offset = parseInt(response.offset);
            const perPage = parseInt(response.per_page);

            if (response.sortOrder === 'desc') {
                index = total - offset;
                start = total - offset;
                end = Math.max(total - (offset + perPage) + 1, 1);
            } else {
                index = offset + 1;
                start = offset + 1;
                end = Math.min(offset + perPage, total);
            }
            // console.log(index)
            //  start = total === 0 ? 0 : offset + 1;
            end = Math.min(offset + perPage, total);

            $('#showing-entries').text(
                `Showing ${index} to ${end} of ${total} entries`
            );

            response.users.forEach(function(user) {
                let accountInfo =
                    new Date(user.created_at).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    });
                let accountStatus = (user.status == 1) ? '<sub class="text-success">(Active)</sub>' : '<sub class="text-danger">(Inactive)</sub>';


                let userType = user.is_guest == 1 ? 'Guest' : 'Registered';

                let name = user.fname + " " + user.lname;
                let email = user.email;
                let phone = user.mobile;

                let statusBtn =
                    user.status == 1 ?
                    `<button class="btn btn-sm btn-danger userActionBtn"
                   id="${user.id}"
                   data-value="0">Deactivate</button>` :
                    `<button class="btn btn-sm btn-primary userActionBtn"
                   id="${user.id}"
                   data-value="1">Activate</button>`;

                html += `
                                <tr>
                                    <td>${response.sortOrder === 'desc' ? index-- : index++}</td>
                                    <td>${userType}</td>
                                    <td>${name}</td>
                                    <td>${email}</td>
                                    <td>${phone}</td>
                                    <td>${accountInfo+accountStatus}</td>
                                    <td>${statusBtn}</td>
                                </tr>
                            `;
            });

            user_body.innerHTML = html;
            $('#pagination-container').html(response.pagination);
        } else {
            // Optional: Handle empty users (e.g., clear table or show message)
            document.getElementById('users-body').innerHTML = '<tr><td colspan="7">No users found.</td></tr>';
            $('#pagination-container').html(''); // Clear pagination if no data
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
