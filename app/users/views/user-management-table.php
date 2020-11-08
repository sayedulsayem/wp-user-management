<div class="wrap">
    <h1>WP User Management</h1>
    <?php
    $args = [
        'fields' => [
            // 'ID',
            // 'display_name',
            // 'login',
            // 'nicename',
            // 'email',
            // 'url',
            // 'registered',
            'all'
        ],
    ];
    $users = get_users(  );
    echo "<pre>"; print_r($users); echo "</pre>";
    ?>
    <div class="user-table-wrapper">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>