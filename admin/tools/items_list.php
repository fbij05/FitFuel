<?php
$search = $_GET['search'] ?? '';

$query = "SELECT products.*, categories.category_name 
          FROM products 
          JOIN categories ON products.category_id = categories.category_id";

// search query
if (!empty($search)) {
    $query .= " WHERE products.name LIKE '%$search%' OR products.description LIKE '%$search%'";
}

// append sorting regardless of if its search or normal view
$query = $query . " ORDER BY products.product_id ASC";

$result = mysqli_query($db, $query);

// fetch categories for the add/edit modals
$categories_result = mysqli_query($db, "SELECT * FROM categories ORDER BY category_name ASC");
$categories = [];
while ($cat = mysqli_fetch_assoc($categories_result)) {
    $categories[] = $cat;
}
?>

<div id="items-header">
    <div id="contents-text">
        <h1>Products</h1>
        <?php
        if (!empty($search)) {
            echo "<i>".mysqli_num_rows($result)." result";
            if(mysqli_num_rows($result) > 1) {echo "s";}
            echo " found.</i>";
        }
        ?>
    </div>
    <div id="items-actions">
        <div id="items-search">
            <form method="get" action="account.php">
                <input type="hidden" name="show" value="items">
                <input type="search" name="search" placeholder="Search..." value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : '') ?>">
            </form>
        </div>
        <div id="items-management">
            <button id="add" type="button">Add</button>
            <button id="modify" type="button">Modify</button>
            <button id="remove" type="button">Remove</button>
        </div>
    </div>
</div>

<?php if (isset($_GET['success'])): ?>
    <div class="success-msg"><?= htmlspecialchars($_GET['success']) ?></div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<div>
    <table id="products-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Rating</th>
        </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) == 0): ?>
            <tr><td colspan="8">No products found.</td></tr>
        <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr data-id="<?= $row["product_id"] ?>"
                    data-name="<?= htmlspecialchars($row["name"]) ?>"
                    data-category="<?= $row["category_id"] ?>"
                    data-description="<?= htmlspecialchars($row["description"]) ?>"
                    data-price="<?= $row["price"] ?>"
                    data-stock="<?= $row["stock"] ?>"
                    data-rating="<?= $row["rating"] ?>"
                    data-image="<?= htmlspecialchars($row["image"]) ?>">
                    <td><?= $row["product_id"] ?></td>
                    <td><img src="../../img/<?= htmlspecialchars($row["image"]) ?>" width="60"></td>
                    <td><?= htmlspecialchars($row["name"]) ?></td>
                    <td><?= htmlspecialchars($row["category_name"]) ?></td>
                    <td><?= htmlspecialchars($row["description"]) ?></td>
                    <td><?= number_format($row["price"], 2) ?> SAR</td>
                    <td><?= $row["stock"] ?></td>
                    <td><?= $row["rating"] ?> / 5.0</td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- add modal -->
<div id="modal-add" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <h2>Add Product</h2>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="post" action="handle_product.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="add-name">Name</label>
                <input type="text" id="add-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="add-category">Category</label>
                <select id="add-category" name="category_id" required>
                    <option value="">Select category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="add-description">Description</label>
                <textarea id="add-description" name="description" rows="3"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="add-price">Price (SAR)</label>
                    <input type="number" id="add-price" name="price" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="add-stock">Stock</label>
                    <input type="number" id="add-stock" name="stock" min="0" required>
                </div>
            </div>
            <div class="form-group">
                <label for="add-image">Image</label>
                <input type="file" id="add-image" name="image" accept="image/*" required>
            </div>
            <div class="form-actions">
                <button type="button" class="cancel modal-close">Cancel</button>
                <button type="submit" class="confirm">Add Product</button>
            </div>
        </form>
    </div>
</div>

<!-- edit modal -->
<div id="modal-edit" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <h2>Modify Product</h2>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="post" action="handle_product.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="product_id" id="edit-id">
            <div class="form-group">
                <label for="edit-name">Name</label>
                <input type="text" id="edit-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="edit-category">Category</label>
                <select id="edit-category" name="category_id" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="edit-description">Description</label>
                <textarea id="edit-description" name="description" rows="3"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="edit-price">Price (SAR)</label>
                    <input type="number" id="edit-price" name="price" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="edit-stock">Stock</label>
                    <input type="number" id="edit-stock" name="stock" min="0" required>
                </div>
            </div>
            <div class="form-group">
                <label for="edit-image">Image</label>
                <span id="edit-current-image" class="comment"></span>
                <input type="file" id="edit-image" name="image" accept="image/*">
                <input type="hidden" id="edit-old-image" name="old_image">
            </div>
            <div class="form-actions">
                <button type="button" class="cancel modal-close">Cancel</button>
                <button type="submit" class="confirm">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- delete dialog -->
<div id="modal-delete" class="modal-overlay">
    <div class="modal modal-small">
        <div class="modal-header">
            <h2>Delete Product</h2>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <p id="delete-message">Are you sure you want to delete this product?</p>
        <form method="post" action="handle_product.php">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="product_id" id="delete-id">
            <div class="form-actions">
                <button type="button" class="cancel modal-close">Cancel</button>
                <button type="submit" class="danger">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let selectedRow = null;

    // row selection
    document.querySelectorAll("#products-table tbody tr[data-id]").forEach(row => {
        row.addEventListener("click", function () {
            if (selectedRow === this) {
                // deselect on second click
                this.classList.remove("selected");
                selectedRow = null;
                return;
            }
            if (selectedRow) selectedRow.classList.remove("selected");
            this.classList.add("selected");
            selectedRow = this;
        });
    });

    // modal openers/closers
    function openModal(id) {
        document.getElementById(id).classList.add("active");
    }

    function closeAllModals() {
        document.querySelectorAll(".modal-overlay").forEach(m => m.classList.remove("active"));
    }

    document.querySelectorAll(".modal-close").forEach(btn => {
        btn.addEventListener("click", closeAllModals);
    });

    // close when clicking the backdrop
    document.querySelectorAll(".modal-overlay").forEach(overlay => {
        overlay.addEventListener("click", function (e) {
            if (e.target === this) closeAllModals();
        });
    });

    // add button handler
    document.getElementById("add").addEventListener("click", function () {
        document.querySelector("#modal-add form").reset();
        openModal("modal-add");
    });

    // modify button handler
    document.getElementById("modify").addEventListener("click", function () {
        if (!selectedRow) {
            alert("Please select a product row first.");
            return;
        }
        // fill form from data attributes
        document.getElementById("edit-id").value          = selectedRow.dataset.id;
        document.getElementById("edit-name").value        = selectedRow.dataset.name;
        document.getElementById("edit-category").value    = selectedRow.dataset.category;
        document.getElementById("edit-description").value = selectedRow.dataset.description;
        document.getElementById("edit-price").value       = selectedRow.dataset.price;
        document.getElementById("edit-stock").value       = selectedRow.dataset.stock;
        document.getElementById("edit-old-image").value    = selectedRow.dataset.image;
        document.getElementById("edit-current-image").textContent = "Current: " + selectedRow.dataset.image;
        openModal("modal-edit");
    });

    // remove button handler
    document.getElementById("remove").addEventListener("click", function () {
        if (!selectedRow) {
            alert("Please select a product row first.");
            return;
        }
        document.getElementById("delete-id").value = selectedRow.dataset.id;
        document.getElementById("delete-message").textContent =
            'Are you sure you want to delete "' + selectedRow.dataset.name + '"?';
        openModal("modal-delete");
    });
});
</script>
