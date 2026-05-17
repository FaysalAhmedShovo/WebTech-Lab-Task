<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<?php
$formId = (int)($old['id'] ?? ($editCategory['id'] ?? 0));
$formName = $old['name'] ?? ($editCategory['name'] ?? '');
$formParentId = $old['parent_id'] ?? ($editCategory['parent_id'] ?? '');
$isEdit = $formId > 0;
?>

<main class="container">
    <section class="section">
        <h1>Category & Sub-category Management</h1>
        <p class="muted">Create, edit, and delete categories. Parent category makes a sub-category.</p>
    </section>

    <section class="form-card wide">
        <h2><?= $isEdit ? 'Edit Category' : 'Add New Category' ?></h2>

        <form method="POST" action="index.php?page=admin-categories" onsubmit="return validateCategoryForm()" novalidate>
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="save_category">
            <input type="hidden" name="id" value="<?= e($formId) ?>">

            <label>Category Name</label>
            <input type="text" name="name" id="category_name" value="<?= e($formName) ?>" placeholder="Example: Storage">
            <small class="field-error"><?= e($errors['name'] ?? '') ?></small>

            <label>Parent Category</label>
            <select name="parent_id" id="category_parent_id">
                <option value="">No Parent / Top-level Category</option>
                <?php foreach ($categories as $category): ?>
                    <?php if ((int)$category['id'] === $formId) continue; ?>
                    <option value="<?= e($category['id']) ?>" <?= ((string)$formParentId === (string)$category['id']) ? 'selected' : '' ?>>
                        <?= e($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="field-error"><?= e($errors['parent_id'] ?? '') ?></small>

            <button type="submit"><?= $isEdit ? 'Update Category' : 'Create Category' ?></button>
            <?php if ($isEdit): ?>
                <a class="button-secondary" href="index.php?page=admin-categories">Cancel Edit</a>
            <?php endif; ?>
        </form>
    </section>

    <section class="section">
        <h2>All Categories</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categories)): ?>
                        <tr><td colspan="5">No category found.</td></tr>
                    <?php endif; ?>

                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= e($category['id']) ?></td>
                            <td><?= e($category['name']) ?></td>
                            <td><?= e($category['parent_name'] ?? 'Top-level') ?></td>
                            <td><?= e($category['created_at']) ?></td>
                            <td class="actions">
                                <a class="mini-btn" href="index.php?page=admin-categories&edit=<?= e($category['id']) ?>">Edit</a>

                                <form method="POST" action="index.php?page=admin-categories" class="inline-form" onsubmit="return confirm('Delete this category?')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="action" value="delete_category">
                                    <input type="hidden" name="id" value="<?= e($category['id']) ?>">
                                    <button type="submit" class="danger-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
