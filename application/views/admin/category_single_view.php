<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .category-img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #eee;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
            width: 140px;
        }

        .btn-back {
            border-radius: 8px;
            padding: 8px 20px;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="card mx-auto" style="max-width: 700px;">
            <div class="card-header bg-dark text-white text-center">
                <h4 class="mb-0">Category Details</h4>
            </div>
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <img src="<?= base_url('assets/uploads/category/' . $category->image); ?>" alt="Category Image" class="category-img">
                    <h5 class="mt-3 text-primary fw-bold"><?= $category->name; ?></h5>
                </div>
              
                <div class="d-flex mb-2">
                    <div class="info-label">Created On:</div>
                    <div><?= date('d M Y, h:i A', strtotime($category->created_at)); ?></div>
                </div>
            </div>

            <div class="card-footer text-center bg-light">
                <a href="<?= base_url('admin/Category'); ?>" class="btn btn-secondary btn-back">
                    ← Back to List
                </a>
                <a href="<?= base_url('admin/Category/edit/' . $category->id); ?>" class="btn btn-warning btn-back text-white">
                    ✏️ Edit
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>