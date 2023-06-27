<?php
if (!function_exists('generate_menu_link')) {
    function generate_menu_link($current_url, $menu_url, $default_link) {
        if (strpos($current_url, $menu_url) !== false) {
            return $current_url;
        } else {
            return $default_link;
        }
    }
}

$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

/* Dashboard */
$home_url = '/home/dashboard';
$home_link = (strpos($current_url, $home_url) !== false) ? $current_url : '../home/dashboard';

/* GanttChart */
$gantt_chart_url = '/ganttChart/list';
$gantt_chart_link = (strpos($current_url, $gantt_chart_url) !== false) ? $current_url : '../ganttChart/list';

/* Daily Task */
$daily_task_url = '/accomplishment/daily';
$daily_task_link = (strpos($current_url, $daily_task_url) !== false) ? $current_url : '../accomplishment/daily';

/* Notes */
$notes_url = '/notes/nlist';
$notes_link = (strpos($current_url, $notes_url) !== false) ? $current_url : '../notes/nlist';

/* Reports */
$reports_url = '/reports/generate';
$reports_link = (strpos($current_url, $reports_url) !== false) ? $current_url : '../reports/generate';

$reportPDF_url = '/reports/generate_pdf';
$reportPDF_link = (strpos($current_url, $reportPDF_url) !== false) ? $current_url : '../reports/generate_pdf';

/* Users */
$option_url = '/option/view';
$option_link = (strpos($current_url, $option_url) !== false) ? $current_url : '../option/view';

/* Users */
$users_url = '/users/ulist';
$users_link = (strpos($current_url, $users_url) !== false) ? $current_url : '../users/ulist';

$user_edit_url = '/users/edit-user';
$userEditLink = (strpos($current_url, $user_edit_url) !== false) ? $current_url : '../users/edit-user';

/* Profile */
$profile_url = '/profile/info';
$profile_link = (strpos($current_url, $profile_url) !== false) ? $current_url : '../profile/info';
?>
