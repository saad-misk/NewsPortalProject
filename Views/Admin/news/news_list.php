<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../unauthorized.php");
    exit;
}

require_once '../../../models/News.php';
$newsModel = new News();
$news = $newsModel->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage News | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .badge-status {
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <?php require_once '../nav.php' ?>

<div class="container mt-5 mb-5 pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>News List <span class="badge bg-secondary"><?= count($news) ?></span></h2>
        <a href="add_news.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add News</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Views</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news as $news_item): ?>
                <tr>
                    <td><?=$news_item['title']?></td>
                    <td><?=$news_item['author_name']?></td>
                    <td><?=$news_item['category_name']?></td>
                    <td><?= date('Y-m-d', strtotime($news_item['created_at'])) ?></td>
                    <td><?=$news_item['views'] ?></td>
                    <td>
                        <?php if ($news_item['is_featured']): ?>
                            <span class="badge bg-info">Yes</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">No</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                            $status = $news_item['status'];
                            $badgeClass = match($status) {
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger',
                                default => 'secondary'
                            };
                        ?>
                        <span class="badge bg-<?= $badgeClass ?> badge-status"><?= ucfirst($status) ?></span>
                    </td>
                    <td class="text-center">
                        <a href="edit_news.php?id=<?= $news_item['id'] ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="delete_news.php?id=<?= $news_item['id'] ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this news item?')">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($news)): ?>
                    <tr><td colspan="8" class="text-center text-muted">No news items found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="../admin_dashboard.php" class="btn btn-outline-secondary mt-4"><i class="bi bi-arrow-left-circle"></i> Back to Dashboard</a>
</div>

</body>
</html>
