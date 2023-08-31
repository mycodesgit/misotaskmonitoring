<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar nav-compact flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Main Navigation</li>

        <li class="nav-item">
            <a href="<?= $home_link ?>" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'dashboard' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-grip-horizontal"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <?php if ($_SESSION['usertype'] == 'Administrator' || $_SESSION['usertype'] == 'Staff' || $_SESSION['usertype'] == 'MIS Officer') { ?>


        <li class="nav-item">
            <a href="<?= $gantt_chart_link ?>" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'list' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Gantt Chart</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= $daily_task_link ?>" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'daily') !== false || strpos($_SERVER['REQUEST_URI'], 'daily?month') !== false) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-tasks"></i>
                <p>Daily Task</p>
            </a>
        </li>

        <!-- <li class="nav-item">
            <a href="<?= $ticketing_link ?>" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'viewTicket' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p>Ticketing</p>
            </a>
        </li> -->
        <?php }?>

        <?php if($_SESSION['usertype'] == 'User') {?>
        <li class="nav-item">
            <a href="<?= $ticket_link ?>" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'viewContent?id=' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p>Ticketing</p>
            </a>
        </li>
        <?php }?>


        <?php if ($_SESSION['usertype'] == 'Administrator' || $_SESSION['usertype'] == 'Staff' || $_SESSION['usertype'] == 'MIS Officer') { ?>

        <!-- <li class="nav-item">
            <a href="<?= $notes_link ?>" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'nlist' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-file"></i>
                <p>Notes</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="<?= $todo_link ?>" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'viewEvent' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Calendar</p>
            </a>
        </li> -->

        <li class="nav-header">Reports</li>
        
        <li class="nav-item">
            <a href="<?= $reports_link ?>" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'generate' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-file-pdf"></i>
                <p>Reports</p>
            </a>
        </li>
        
        <?php }?>

        <?php if($_SESSION['usertype'] == 'Administrator') {?>
        <li class="nav-header">Configuration</li>

        <li class="nav-item">
            <a href="<?= $option_link ?>" class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'view' ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-bars"></i>
                <p>Task Option</p>
            </a>
        </li>

        <li class="nav-header">Users Management</li>

        <li class="nav-item">
            <a href="<?= $users_link ?>" class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'ulist') !== false || strpos($_SERVER['REQUEST_URI'], 'edit') !== false) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
            </a>
        </li>
        <?php }?>
    </ul>
</nav>