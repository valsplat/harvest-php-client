<?php

require 'vendor/autoload.php';

$connection = new \Valsplat\Harvest\Connection();

// grab token and account id here: https://id.getharvest.com/oauth2/access_tokens/new
$connection->setAccessToken('foo');
$connection->setAccountId('bar');

$harvest = new \Valsplat\Harvest\Harvest($connection);

// Example: get list of clients, limit 1
$lastClient = $harvest->client()->list([ 'is_active' => true, 'per_page' => 1, ])[0];
var_dump($lastClient);

// Example: create a new project
$project = $harvest->project();
$project->client_id = $lastClient->id;
$project->name = sprintf('Project for %s (%s)', $lastClient->name, time());
$project->is_billable = true;
$project->bill_by = 'Project';
$project->budget_by = 'project';
$project->budget = 10000;
$project->hourly_rate = 125;
$project->save();

$exampleProjectId = $project->id;

// Example: increase budget
$project = $harvest->project()->get($exampleProjectId);
assert($project->exists() === true);
$project->budget = 15000;
$project->save(); // will update instead of create now

// Example: delete a project
$project = $harvest->project()->get($exampleProjectId);
$project->delete();
