#!/usr/bin/env php
<?php

// cli.php

require_once __DIR__ . '/vendor/autoload.php'; // Include Composer's autoloader

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

$app = new Application('My CLI App');

// Define the generate:function command
$app->register('generate:function')
    ->setDefinition([
        new InputArgument('name', InputArgument::REQUIRED, 'The name of the function'),
    ])
    ->setDescription('Generate a new function file')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $functionName = $input->getArgument('name');
        $functionContent = <<<PHP
<?php

/*
|--------------------------------------------------------------------------
| Function Management
|--------------------------------------------------------------------------
|
| Here is where you can add all the functions for your application. These
| functions are connected by the corresponding table within your Database which
| is assigned in every "pages" group. Enjoy building your Functions!
|
*/

if (!defined('ACCESS')) {
    die('DIRECT ACCESS NOT ALLOWED');
}
 
function view$functionName() {
    global \$DB;

    \$query = \$DB->prepare("SELECT * FROM table_name");
    \$query->execute();
    \$result = \$query->get_result();

    if (\$result->num_rows > 0) {
        \$items = array();
        while (\$item = \$result->fetch_object()) {
            \$items[] = \$item;
        }
        return \$items;
    } else {
        return array();
    }
}

function create$functionName(\$item, \$created_at) {
    global \$DB;

    \$token = bin2hex(random_bytes(16));

    \$sql_insert = "INSERT INTO table_name SET item=?, token=?, created_at=? ";

    \$stmt_insert = \$DB->prepare(\$sql_insert);
    \$stmt_insert->bind_param("sss", \$item, \$token, \$created_at);

    if (\$stmt_insert->execute()) {
        set_message("Added Successfully.", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to add" . \$DB->error, 'danger');
        return false;
    }
}

function update$functionName(\$item, \$token) {
    global \$DB;

    \$sql_update = "UPDATE table_name SET item=? WHERE token=?";
    \$stmt_update = \$DB->prepare(\$sql_update);
    \$stmt_update->bind_param("ss", \$item, \$token);

    if (\$stmt_update->execute()) {
        set_message("<i class='fa fa-check'></i> Updated Successfully", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Update" . \$DB->error, 'danger');
        return false;
    }
}

function delete$functionName(\$token) {
    global \$DB;

    \$sql_delete = "DELETE FROM table_name WHERE token=?";
    \$stmt_delete = \$DB->prepare(\$sql_delete);
    \$stmt_delete->bind_param("s", \$token);

    if (\$stmt_delete->execute()) {
        set_message("<i class='fa fa-check'></i> Deleted Successfully", 'success');
        return true;
    } else {
        set_message("<i class='fa fa-times'></i> Failed to Delete" . \$DB->error, 'danger');
        return false;
    }
}

PHP;

        $filePath = __DIR__ . '/app/functions/' . $functionName . '.php';

        // Check if the file already exists
        if (file_exists($filePath)) {
            $output->writeln("Function file already exists.");
        } else {
            // Create the function file
            if (file_put_contents($filePath, $functionContent)) {
                $output->writeln("Function file created successfully.");
            } else {
                $output->writeln("Failed to create function file.");
            }
        }
    });

// Define the generate:action command
$app->register('generate:action')
    ->setDefinition([
        new InputArgument('name', InputArgument::REQUIRED, 'The name of the action'),
    ])
    ->setDescription('Generate a new action file')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $actionName = $input->getArgument('name');
        $actionContent = <<<PHP
<?php

/*
|--------------------------------------------------------------------------
| Actions Management
|--------------------------------------------------------------------------
|
| Here is where you can add all the actions for your application. These
| actions are connected by the corresponding functions within your "app/functions" folder which
| is assigned in every "pages" group. Enjoy building your Actions!
|
*/

if (!defined('ACCESS')) {
    die('DIRECT ACCESS NOT ALLOWED');
}

if (\$_SERVER['REQUEST_METHOD'] === 'POST') {

    validate_csrf_token();

    if (isset(\$_POST['btn-submit'])) {

        create$actionName();
        // Redirect or perform additional actions as needed
    }

    if (isset(\$_POST['btn-update'])) {

        update$actionName();
        // Redirect or perform additional actions as needed
    }

    if (isset(\$_POST['btn-delete'])) {
        \$token = \$_GET['token'];

        delete$actionName();
        // Redirect or perform additional actions as needed
    }
}

PHP;

        $filePath = __DIR__ . '/app/actions/' . $actionName . '.php';

        // Check if the file already exists
        if (file_exists($filePath)) {
            $output->writeln("Action file already exists.");
        } else {
            // Create the action file
            if (file_put_contents($filePath, $actionContent)) {
                $output->writeln("Action file created successfully.");
            } else {
                $output->writeln("Failed to create action file.");
            }
        }
    });

$app->run();
