<?php
header('Content-Type: application/json');
require_once 'db.php';

// Helper function to handle local image uploads
function uploadLocalFile($fileData) {
    if (!isset($fileData) || $fileData['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    
    // Ensure the uploads directory exists
    $uploadDir = 'files/images/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmpPath = $fileData['tmp_name'];
    // Generate a unique filename to prevent overwriting
    $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", basename($fileData['name']));
    $destination = $uploadDir . $fileName;
    
    if (move_uploaded_file($fileTmpPath, $destination)) {
        return $destination; // Returns 'files/images/filename.jpg'
    }
    return false;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query('SELECT * FROM slides ORDER BY id ASC');
        $slides = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'success', 'data' => $slides]);
        break;

    case 'POST':
        // We use POST for both create and update because PHP handles multipart/form-data best via POST
        $data = $_POST;
        $id = $data['id'] ?? null;
        
        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $imagePath = uploadLocalFile($_FILES['image']);
            if (!$imagePath) {
                echo json_encode(['status' => 'error', 'message' => 'Image upload failed']);
                break;
            }
        }

        if ($id) {
            // Update
            if ($imagePath) {
                $stmt = $pdo->prepare('UPDATE slides SET tab_name=?, tab_icon_path=?, category=?, title=?, link=?, image_path=? WHERE id=?');
                $stmt->execute([
                    $data['tab_name'] ?? '',
                    $data['tab_icon_path'] ?? '',
                    $data['category'] ?? '',
                    $data['title'] ?? '',
                    $data['link'] ?? '#',
                    $imagePath,
                    $id
                ]);
            } else {
                $stmt = $pdo->prepare('UPDATE slides SET tab_name=?, tab_icon_path=?, category=?, title=?, link=? WHERE id=?');
                $stmt->execute([
                    $data['tab_name'] ?? '',
                    $data['tab_icon_path'] ?? '',
                    $data['category'] ?? '',
                    $data['title'] ?? '',
                    $data['link'] ?? '#',
                    $id
                ]);
            }
            echo json_encode(['status' => 'success']);
        } else {
            // Create
            $stmt = $pdo->prepare('INSERT INTO slides (tab_name, tab_icon_path, category, title, link, image_path) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([
                $data['tab_name'] ?? '',
                $data['tab_icon_path'] ?? '',
                $data['category'] ?? '',
                $data['title'] ?? '',
                $data['link'] ?? '#',
                $imagePath
            ]);
            echo json_encode(['status' => 'success', 'id' => $pdo->lastInsertId()]);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? (isset($_GET['id']) ? $_GET['id'] : null);
        if($id) {
            // Optional: You could unlink() the local file here to save space
            $stmt = $pdo->prepare('DELETE FROM slides WHERE id=?');
            $stmt->execute([$id]);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No ID provided']);
        }
        break;
}
?>
