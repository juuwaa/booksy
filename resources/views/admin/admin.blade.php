<?php
session_start();

// Initialize books array in session if not exists
if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [
        [
            'id' => 1,
            'title' => 'Atomic Habits',
            'author' => 'James Clear',
            'stock' => 10, // Added stock
            'cover' => 'images/atomic habits.jpg'
        ],
        [
            'id' => 2,
            'title' => '1984',
            'author' => 'George Orwell',
            'stock' => 5, // Added stock
            'cover' => 'images/1984.jpg'
        ],
        [
            'id' => 3,
            'title' => 'Hello',
            'author' => 'Tere Liye',
            'stock' => 15, // Added stock
            'cover' => 'images/hello.jpg'
        ],
        [
            'id' => 4,
            'title' => 'Dunia Sophie',
            'author' => 'Jonstein Gaarder',
            'stock' => 8, // Added stock
            'cover' => 'images/dunia sophie.jpg'
        ]
    ];
}

$message = "";
$edit_book = null;

// Function to handle file upload
function handleFileUpload($file) {
    $upload_dir = 'uploads/';
    
    // Create uploads directory if it doesn't exist
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Check if file was uploaded without errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Upload failed with error code ' . $file['error']);
    }
    
    // Validate file type
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    $file_type = $file['type'];
    
    if (!in_array($file_type, $allowed_types)) {
        throw new Exception('Invalid file type. Only JPG, PNG, GIF, and WebP are allowed.');
    }
    
    // Validate file size (max 5MB)
    $max_size = 5 * 1024 * 1024; // 5MB in bytes
    if ($file['size'] > $max_size) {
        throw new Exception('File size too large. Maximum size is 5MB.');
    }
    
    // Generate unique filename
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $unique_filename = uniqid('book_cover_') . '.' . $file_extension;
    $upload_path = $upload_dir . $unique_filename;
    
    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
        throw new Exception('Failed to move uploaded file.');
    }
    
    return $upload_path;
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        try {
            switch ($_POST['action']) {
                case 'add':
                    // Check if file was uploaded
                    if (!isset($_FILES['cover_file']) || $_FILES['cover_file']['size'] == 0) {
                        throw new Exception('Please upload a cover image.');
                    }
                    
                    $cover_path = handleFileUpload($_FILES['cover_file']);
                    
                    $new_id = empty($_SESSION['books']) ? 1 : max(array_column($_SESSION['books'], 'id')) + 1;
                    $_SESSION['books'][] = [
                        'id' => $new_id,
                        'title' => $_POST['title'],
                        'author' => $_POST['author'],
                        'stock' => (int)$_POST['stock'], // Cast to integer
                        'cover' => $cover_path
                    ];
                    $message = "Book added successfully!";
                    break;
                    
                case 'edit':
                    $cover_path = null;
                    
                    // Get current book cover path
                    foreach ($_SESSION['books'] as $book) {
                        if ($book['id'] == $_POST['book_id']) {
                            $cover_path = $book['cover'];
                            break;
                        }
                    }
                    
                    // Check if new file was uploaded
                    if (isset($_FILES['cover_file']) && $_FILES['cover_file']['size'] > 0) {
                        // Delete old file if it's in uploads directory
                        if ($cover_path && strpos($cover_path, 'uploads/') === 0 && file_exists($cover_path)) {
                            unlink($cover_path);
                        }
                        $cover_path = handleFileUpload($_FILES['cover_file']);
                    }
                    
                    foreach ($_SESSION['books'] as &$book) {
                        if ($book['id'] == $_POST['book_id']) {
                            $book['title'] = $_POST['title'];
                            $book['author'] = $_POST['author'];
                            $book['stock'] = (int)$_POST['stock']; // Cast to integer
                            $book['cover'] = $cover_path;
                            break;
                        }
                    }
                    $message = "Book updated successfully!";
                    break;
                    
                case 'delete':
                    // Delete associated file if it's in uploads directory
                    foreach ($_SESSION['books'] as $book) {
                        if ($book['id'] == $_POST['book_id'] && strpos($book['cover'], 'uploads/') === 0) {
                            if (file_exists($book['cover'])) {
                                unlink($book['cover']);
                            }
                            break;
                        }
                    }
                    
                    $_SESSION['books'] = array_filter($_SESSION['books'], function($book) {
                        return $book['id'] != $_POST['book_id'];
                    });
                    $_SESSION['books'] = array_values($_SESSION['books']); // Reindex array
                    $message = "Book deleted successfully!";
                    break;
            }
        } catch (Exception $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}

// Handle edit request
if (isset($_GET['edit'])) {
    foreach ($_SESSION['books'] as $book) {
        if ($book['id'] == $_GET['edit']) {
            $edit_book = $book;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booksy Admin - Manage Books</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(to right bottom, #896040, #3A1F08);
            min-height: 100vh;
            padding: 100px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-container {
            background: #F8EEE1;
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            text-align: center;
            margin-bottom: 30px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .logo {
            max-width: 200px;
            height: auto;
            filter: drop-shadow(3px 3px 6px rgba(0, 0, 0, 0.4));
            margin-bottom: 20px;
        }

        .page-title {
            color: #4a3b2e;
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #4a3b2e;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .admin-panel {
            background-color: #F8EEE1;
            border-radius: 25px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.3);
        }

        .form-section {
            margin-bottom: 10px;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4a3b2e;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #4a3b2e;
        }

        .form-group input[type="text"], 
        .form-group input[type="file"],
        .form-group input[type="number"] { /* Added number type */
            width: 100%;
            padding: 12px 15px;
            border-radius: 12px;
            border: 1px solid #ccc;
            background-color: #fefcf9;
            font-size: 16px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #a17c5f;
            box-shadow: 0 0 5px rgba(161, 124, 95, 0.5);
        }

        .file-upload-container {
            border: 2px dashed #a17c5f;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background-color: #faf7f2;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-container:hover {
            border-color: #5C4033;
            background-color: #f5f1ea;
        }

        .file-upload-container.dragover {
            border-color: #5C4033;
            background-color: #f0e8d8;
            transform: scale(1.02);
        }

        .upload-icon {
            font-size: 3rem;
            color: #a17c5f;
            margin-bottom: 10px;
        }

        .upload-text {
            color: #4a3b2e;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .upload-subtext {
            color: #8b7355;
            font-size: 0.9rem;
        }

        .file-input-hidden {
            display: none;
        }

        .image-preview {
            max-width: 200px;
            max-height: 250px;
            margin: 15px auto;
            display: block;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .preview-container {
            text-align: center;
            margin-top: 15px;
        }

        .remove-image {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            cursor: pointer;
            margin-top: 10px;
        }

        .remove-image:hover {
            background-color: #c82333;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 25px;
            border: none;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #5C4033;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a1f08;
            transform: scale(1.05);
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .message {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .books-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            color: #F8EEE1;
            font-size: 2.2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .star {
            color: rgb(255, 215, 115);
            font-size: 1.8rem;
        }

        .books-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .book-item {
            width: 280px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 2px solid rgba(255, 255, 255, 0.2);
            position: relative;
        }

        .book-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .book-cover {
            margin: 0 auto 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 140px;
            height: 200px;
            background-color: #f0f0f0;
            overflow: hidden;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .book-info h3 {
            font-size: 1.1rem;
            color: #f8eee1;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .book-info p {
            color: #f8eee1;
            font-size: 0.9rem;
            margin-bottom: 5px; /* Adjusted margin */
        }
        
        .book-info .stock { /* New style for stock */
            color: #f8eee1;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 15px;
        }


        .book-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .books-grid {
                justify-content: center;
                gap: 20px;
            }
            
            .book-item {
                width: 260px;
            }

            .page-title {
                font-size: 2.2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }
        }

        /* New style for the export button container below the grid */
        .export-buttons-bottom {
            text-align: center;
            margin-top: 30px; /* Add some space above the button */
        }

        .nav-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: transparent;
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            height: 80px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 20px;
            transition: background 0.3s;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .profile-icon {
            width: 35px;
            height: 35px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8B4513;
            font-weight: bold;
        }

        .search-bar {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.364);
            width: 300px;
            outline: none;
            color: white;
            font-weight: 500;
            font-family: 'Montserrat', sans-serif;
        }

        .logo-img {
            height: 40px;
            width: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
        <img src="images/booksyyy.png" alt="Booksy Logo" class="logo-img" />
        <div class="nav-container">
            <nav class="nav-links">
                <a href="#">Home</a>
                <a href="#collection">Update</a>
                <a href="profile.php" class="profile-icon">👤</a>
            </nav>
        </div>
    </header>
        <div class="header-container">
            <h1 class="page-title">Admin Dashboard</h1>
            <p class="page-subtitle">Management System</p>
        </div>

        <div class="admin-panel">
            <?php if ($message): ?>
                <div class="message <?php echo strpos($message, 'Error:') === 0 ? 'error' : 'success'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="form-section">
                <h2 class="form-title">
                    <?php echo $edit_book ? 'Edit Book' : 'Add New Book'; ?>
                </h2>
                
                <form method="POST" action="" enctype="multipart/form-data" id="bookForm">
                    <input type="hidden" name="action" value="<?php echo $edit_book ? 'edit' : 'add'; ?>">
                    <?php if ($edit_book): ?>
                        <input type="hidden" name="book_id" value="<?php echo $edit_book['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title">Book Title</label>
                            <input type="text" id="title" name="title" 
                                   value="<?php echo $edit_book ? htmlspecialchars($edit_book['title']) : ''; ?>" 
                                   placeholder="Enter book title" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" id="author" name="author" 
                                   value="<?php echo $edit_book ? htmlspecialchars($edit_book['author']) : ''; ?>" 
                                   placeholder="Enter author name" required>
                        </div>
                    </div>
                    
                    <div class="form-row"> <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" 
                                   value="<?php echo $edit_book ? htmlspecialchars($edit_book['stock']) : '0'; ?>" 
                                   placeholder="Enter stock quantity" min="0" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Book Cover Image</label>
                        
                        <div class="file-upload-container" onclick="document.getElementById('cover_file').click()">
                            <div class="upload-icon">📁</div>
                            <div class="upload-text">Click to upload or drag & drop</div>
                            <div class="upload-subtext">Supports: JPG, PNG, GIF, WebP (Max: 5MB)</div>
                        </div>
                        <input type="file" id="cover_file" name="cover_file" accept="image/*" class="file-input-hidden" <?php echo !$edit_book ? 'required' : ''; ?>>
                        
                        <div class="preview-container" id="preview-container" style="display: none;">
                            <img id="image-preview" class="image-preview" src="" alt="Preview">
                            <br>
                            <button type="button" class="remove-image" onclick="removeImage()">Remove Image</button>
                        </div>
                        
                        <?php if ($edit_book): ?>
                            <div class="preview-container" id="current-image" style="display: block;">
                                <p style="color: #4a3b2e; font-weight: 600; margin-bottom: 10px;">Current Image:</p>
                                <img class="image-preview" src="<?php echo htmlspecialchars($edit_book['cover']); ?>" 
                                     alt="Current cover" 
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjI1MCIgdmlld0JveD0iMCAwIDIwMCAyNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIyMDAiIGhlaWdodD0iMjUwIiBmaWxsPSIjZjBmMGYwIi8+Cjx0ZXh0IHg9IjEwMCIgeT0iMTI1IiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiM5OTkiIHRleHQtYW5jaG9yPSJtaWRkbGUiPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4='">
                                <p style="color: #8b7355; font-size: 0.9rem; margin-top: 10px;">Leave empty to keep current image, or upload a new one to replace it.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary">
                            <?php echo $edit_book ? 'Update Book' : 'Add Book'; ?>
                        </button>
                        <?php if ($edit_book): ?>
                            <a href="admin.php" class="btn btn-secondary">Cancel</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="books-section">
            <h2 class="section-title">
                <span class="star">★</span>
                Book Collection Management
                <span class="star">★</span>
            </h2>

            <div class="books-grid">
                <?php foreach ($_SESSION['books'] as $book): ?>
                    <div class="book-item">
                        <div class="book-cover">
                            <img src="<?php echo htmlspecialchars($book['cover']); ?>" 
                                 alt="<?php echo htmlspecialchars($book['title']); ?>"
                                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCA0MCAxNDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxNDAiIGhlaWdodD0iMjAwIiBmaWxsPSIjZjBmMGYwIi8+Cjx0ZXh0IHg9IjcwIiB5PSIxMDAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9PSJtaWRkbGUiPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4='">
                        </div>
                        <div class="book-info">
                            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p>by <?php echo htmlspecialchars($book['author']); ?></p>
                            <p class="stock" data-stock="<?php echo htmlspecialchars($book['stock']); ?>">Stock: <?php echo htmlspecialchars($book['stock']); ?></p>
                        </div>
                        <div class="book-actions">
                            <a href="admin.php?edit=<?php echo $book['id']; ?>" class="btn btn-warning">Edit</a>
                            <form method="POST" action="" style="display: inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this book?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <?php if (empty($_SESSION['books'])): ?>
                    <div style="text-align: center; color: #F8EEE1; font-size: 1.2rem; width: 100%;">
                        No books available.
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($_SESSION['books'])): // Cek jika ada data buku?>
            <div class="export-buttons-bottom">
                <button type="button" id="exportPdfBtn" class="btn btn-secondary">Export as PDF</button>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // File upload functionality
        const fileInput = document.getElementById('cover_file');
        const uploadContainer = document.querySelector('.file-upload-container');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const currentImageContainer = document.getElementById('current-image');

        // Handle file input change
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                handleFilePreview(file);
            }
        });

        // Handle drag and drop
        uploadContainer.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadContainer.classList.add('dragover');
        });

        uploadContainer.addEventListener('dragleave', function(e) {
            e.preventDefault();
            uploadContainer.classList.remove('dragover');
        });

        uploadContainer.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadContainer.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    fileInput.files = files;
                    handleFilePreview(file);
                } else {
                    alert('Please drop an image file.');
                }
            }
        });

        function handleFilePreview(file) {
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                alert('Invalid file type. Only JPG, PNG, GIF, and WebP are allowed.');
                fileInput.value = '';
                return;
            }

            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size too large. Maximum size is 5MB.');
                fileInput.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.style.display = 'block';
                
                // Hide current image if in edit mode
                if (currentImageContainer) {
                    currentImageContainer.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }

        function removeImage() {
            fileInput.value = '';
            previewContainer.style.display = 'none';
            imagePreview.src = '';
            
            // Show current image again if in edit mode
            if (currentImageContainer) {
                currentImageContainer.style.display = 'block';
            }
        }

        // Form validation
        document.getElementById('bookForm').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const author = document.getElementById('author').value.trim();
            const stock = document.getElementById('stock').value.trim(); // Get stock value
            const coverFile = fileInput.files[0];
            const isEditMode = document.querySelector('input[name="book_id"]') !== null;

            if (!title || !author || stock === '' || isNaN(stock) || parseInt(stock) < 0) {
                alert('Please fill in title, author, and a valid non-negative stock quantity.');
                e.preventDefault();
                return;
            }

            // For add mode, require file upload
            if (!isEditMode && !coverFile) {
                alert('Please upload a cover image.');
                e.preventDefault();
                return;
            }
        });

        // jsPDF integration for Export as PDF button
        const { jsPDF } = window.jspdf; // Mendapatkan objek jsPDF

        document.addEventListener('DOMContentLoaded', function() {
            const exportPdfBtn = document.getElementById('exportPdfBtn');

            // Hanya tambahkan event listener jika tombol ada (sudah dicek di PHP)
            if (exportPdfBtn) {
                exportPdfBtn.addEventListener('click', function() {
                    const doc = new jsPDF("p", "mm", "a4");
                    const pageWidth = doc.internal.pageSize.getWidth();
                    let yOffset = 20;

                    // Header
                    doc.setFont("helvetica", "bold");
                    doc.setFontSize(20);
                    doc.text("Booksy", pageWidth / 2, yOffset, { align: "center" });
                    yOffset += 8;

                    doc.setFont("helvetica", "normal");
                    doc.setFontSize(15);
                    doc.text("Book Collection Report", pageWidth / 2, yOffset, { align: "center" });
                    yOffset += 12;

                    doc.setLineWidth(0.5);
                    doc.line(20, yOffset, pageWidth - 20, yOffset);
                    yOffset += 10;

                    // Table Headers
                    doc.setFont("helvetica", "bold");
                    doc.setFontSize(12);
                    doc.text("ID", 20, yOffset);
                    doc.text("Title", 40, yOffset);
                    doc.text("Author", 110, yOffset); // Adjusted X for Author
                    doc.text("Stock", 170, yOffset); // New Stock header
                    yOffset += 7;

                    doc.setLineWidth(0.2);
                    doc.line(20, yOffset, pageWidth - 20, yOffset);
                    yOffset += 5;

                    // Get book data from the displayed elements
                    const bookItems = document.querySelectorAll('.book-item');
                    if (bookItems.length === 0) {
                        alert('No books to export.');
                        return;
                    }

                    doc.setFont("helvetica", "normal");
                    doc.setFontSize(11);

                    bookItems.forEach((item, index) => {
                        const id = index + 1; // ID ini hanya dari urutan yang ditampilkan.
                        const title = item.querySelector('.book-info h3').textContent;
                        const author = item.querySelector('.book-info p').textContent.replace('by ', '');
                        // Get stock from the data-stock attribute or text content
                        const stockElement = item.querySelector('.book-info .stock');
                        const stock = stockElement ? stockElement.getAttribute('data-stock') : 'N/A'; // Get from data-attribute

                        // Handle page breaks
                        if (yOffset > doc.internal.pageSize.getHeight() - 30) {
                            doc.addPage();
                            yOffset = 20; // Reset yOffset for new page
                            // Redraw headers on new page
                            doc.setFont("helvetica", "bold");
                            doc.setFontSize(12);
                            doc.text("ID", 20, yOffset);
                            doc.text("Title", 40, yOffset);
                            doc.text("Author", 110, yOffset); // Adjusted X for Author
                            doc.text("Stock", 170, yOffset); // New Stock header
                            yOffset += 7;
                            doc.setLineWidth(0.2);
                            doc.line(15, yOffset, pageWidth - 15, yOffset);
                            yOffset += 5;
                            doc.setFont("helvetica", "normal");
                            doc.setFontSize(11);
                        }

                        doc.text(String(id), 20, yOffset);
                        doc.text(title, 40, yOffset);
                        doc.text(author, 110, yOffset); // Adjusted X for Author
                        doc.text(String(stock), 170, yOffset); // Add stock value
                        yOffset += 7; // Line spacing
                    });

                    // Footer dengan tanggal cetak
                    doc.setFontSize(10);
                    doc.setTextColor(100);
                    const today = new Date().toLocaleDateString();
                    doc.text(`Printed on: ${today}`, 20, doc.internal.pageSize.getHeight() - 15);

                    // Simpan file
                    doc.save(`Booksy_Book_Collection.pdf`);
                });
            }
        });
    </script>

</body>
</html>