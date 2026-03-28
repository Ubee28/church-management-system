<?php
require_once "../classes/Sermon.php";
require_once "../classes/utility.php";

$month = sanitize_input($_GET['month']) ?? null;
$search = sanitize_input($_GET['search']) ?? null;

$sermon = new Sermon();
$filteredSermons = $sermon->fetchFilteredSermons($month, $search);

if ($filteredSermons) {
    foreach ($filteredSermons as $ser) {
        echo "<tr>";
        echo "<td>{$ser['sermon_title']}</td>";
        echo "<td>{$ser['pastor_fullname']}</td>";
        echo "<td>{$ser['sermon_date']}</td>";
        echo "<td><a href='{$ser['sermon_audio']}' class='btn btn-info'>Listen</a></td>";
        echo "<td><a href='{$ser['sermon_video']}' class='btn btn-success'>Watch</a></td>";
        echo "<td><a href='../uploads/{$ser['sermon_audio']}' class='btn btn-primary' download>Download</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No sermons found.</td></tr>";
}
?>
