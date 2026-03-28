<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    require_once '../classes/Sermon.php';
    require_once "../classes/utility.php";


    $sermon_title =  sanitize_input(trim($_POST['sermonTitle'])) ?? '';
    $pastor_id = sanitize_input(intval($_POST['Preacher'])) ?? 0;
    $sermon_date = sanitize_input(trim($_POST['SermonDate'])) ?? '';
    $sermon_type = sanitize_input(trim($_POST['sermonType'])) ?? '';
    $sermon_audio = sanitize_input(trim($_POST['audio'])) ?? '';
    $sermon_video = sanitize_input(trim($_POST['video'])) ?? '';

    
    $transcriptPath = null;
    $outlinePath = null;

    // Validate: Title, Preacher, and Date
    if (empty($sermon_title) || empty($pastor_id) || empty($sermon_date)) {
        echo json_encode(['success' => false, 'message' => 'Title, Preacher, and Date are required.']);
        exit;
    }

    // File validation
    $allowedFileTypes = ['application/pdf', 'text/plain',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ];

    // Handle transcript upload if provided
    if (!empty($_FILES['transcript']['name'])) {
        $transcriptFile = $_FILES['transcript'];
        if (!in_array($transcriptFile['type'], $allowedFileTypes)) {
            echo json_encode(['success' => false, 'message' => 'Transcript must be a PDF or TXT file.']);
            exit;
        }
        if ($transcriptFile['size'] > 2 * 1024 * 1024) { // 2 MB limit
            echo json_encode(['success' => false, 'message' => 'Transcript file size exceeds 2MB.']);
            exit;
        }
        $transcriptPath = '../uploads/sermons' . uniqid() . '-' . basename($transcriptFile['name']);
        move_uploaded_file($transcriptFile['tmp_name'], $transcriptPath);
    }

    // Handle sermon outline upload if provided
    if (!empty($_FILES['text']['name'])) {
        $outlineFile = $_FILES['text'];
        if (!in_array($outlineFile['type'], $allowedFileTypes)) {
            echo json_encode(['success' => false, 'message' => 'Outline must be a PDF or TXT file.']);
            exit;
        }
        if ($outlineFile['size'] > 2 * 1024 * 1024) { // 2 MB limit
            echo json_encode(['success' => false, 'message' => 'Outline file size exceeds 2MB.']);
            exit;
        }
        $outlinePath = '../uploads/sermons' . uniqid() . '-' . basename($outlineFile['name']);
        move_uploaded_file($outlineFile['tmp_name'], $outlinePath);
    }

    // Validate sermon type and associated fields
    if ($sermon_type === 'full') {
        if (empty($sermon_audio) || empty($sermon_video) || empty($transcriptPath)) {
            echo json_encode(['success' => false, 'message' => 'Audio, Video, and Transcript are required for Full sermons.']);
            exit;
        }
    } elseif ($sermon_type === 'audio') {
        if (empty($sermon_audio)) {
            echo json_encode(['success' => false, 'message' => 'Audio is required for Audio Only sermons.']);
            exit;
        }
    } elseif ($sermon_type === 'video') {
        if (empty($sermon_video)) {
            echo json_encode(['success' => false, 'message' => 'Video is required for Video Only sermons.']);
            exit;
        }
    } elseif ($sermon_type === 'text') {
        if (empty($outlinePath)) {
            echo json_encode(['success' => false, 'message' => 'Outline is required for Outline Only sermons.']);
            exit;
        }
    } elseif ($sermon_type === 'transcript') {
        if (empty($transcriptPath)) {
            echo json_encode(['success' => false, 'message' => 'Transcript is required for Transcript Only sermons.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid sermon type selected.']);
        exit;
    }


    // Save data to the database
    $sermon = new Sermon;
    $result = $sermon->add_sermon($sermon_title, $pastor_id, $sermon_date, $sermon_audio, $sermon_video, $transcriptPath, $outlinePath, $sermon_type);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Sermon added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add sermon. Please try again.']);
    }
}
