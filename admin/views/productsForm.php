<!DOCTYPE html>
<?php require 'partials/head_assets.php'; ?>
<body class="index-body">
	<div class="container-fluid">
		<div class="row">
			<?php require ('partials/navigation.php'); ?>
			<div class="col-9 py-3">
				<?php if(isset($_SESSION['messages'])): ?>
					<?php foreach($_SESSION['messages'] as $message): ?>
						<?= $message ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<section class="ml-2">
					<h3>Formulaire <?= ($_GET['action'] == 'new' ? "ajout" : "édition") ?> de produit</h3><br>
					<form action="index.php?controller=products&action=<?= isset($product) ||  (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='. $_GET['id'] : 'add' ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="title">Nom</label>
							<input class="form-control" type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['name']) : '' ?><?= isset($product) ? htmlspecialchars($product['name']) : '' ?>" />
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<input class="form-control" type="text" name="description" id="description" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['description']) : '' ?><?= isset($product) ? htmlspecialchars($product['description']) : '' ?>" />
						</div>
						<div class="form-group">
							<label for="price">Prix à l'unité</label>
							<input class="form-control" type="number" step="0.01" name="price" id="price" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['price'] : '' ?><?= isset($product) ? $product['price'] : '' ?>" />
						</div>
						<div class="form-group">
							<label for="sizes_id">Tailles(s)</label>
							<select class="form-control form-control-sm" name="sizes_id[]" id="sizes_id" multiple>
								<?php $sizes_seen = array() ?>
								<?php foreach($sizes as $size): ?>
									<?php if(!empty($products_sizes)): ?>
										<?php foreach($products_sizes as $product_size): ?>
											<?php if($product_size['size_id'] == $size['id']): ?>
												<option value="<?= $size['id']; ?>" <?= ($size['id'] == $product_size['size_id']) ? 'selected' : '' ?>><?= $size['size'] ?></option>
											<?php array_push($sizes_seen, $size['id']); ?>
											<?php endif; ?>
										<?php endforeach; ?>
										<?php if(!in_array($size['id'], $sizes_seen)): ?>
											<option value="<?= $size['id']; ?>"><?= $size['size']; ?></option>
										<?php endif; ?>
									<?php else: ?>
									<option value="<?= $size['id']; ?>"><?= $size['size']; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>					
							</select>
						</div>
						<div class="form-group">
							<label for="amount">Nombre d'articles</label>
							<input class="form-control" type="number" name="amount" id="amount" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['amount'] : '' ?><?= isset($product) ? $product['amount'] : '' ?>" />
						</div>
						<div class="form-group">
							<label for="categories_id">Catégorie(s)</label>
							<select class="form-control form-control-sm" name="categories_id[]" id="categories_id" multiple>
								<option value="<?= null; ?>" <?= (empty($products_categories)) ? 'selected' : '' ?>>Aucune</option>
								<?php $categories_seen = array() ?>
								<?php foreach($categories as $category): ?>
									<?php if(!empty($products_categories)): ?>
										<?php foreach($products_categories as $product_category): ?>
											<?php if($product_category['category_id'] == $category['id']): ?>
												<option value="<?= $category['id']; ?>" <?= ($category['id'] == $product_category['category_id']) ? 'selected' : '' ?>><?= $category['name'] ?></option>
											<?php array_push($categories_seen, $category['id']); ?>
											<?php endif; ?>
										<?php endforeach; ?>
										<?php if(!in_array($category['id'], $categories_seen)): ?>
											<option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
										<?php endif; ?>
									<?php else: ?>
									<option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>					
							</select>
						</div>
						<div class="form-group">
							<label for="images">Image(s)</label>
							<input class="form-control" type="file" name="images[]" id="images" multiple />
							<p class="text-muted font-italic">Ne pas modifier pour garder les images actuelles</p>
						</div>
						<div class="form-group">
							<input type="checkbox" id="is_hidden" name="is_hidden" <?= (isset($_SESSION['old_inputs']['is_hidden']) && $_SESSION['old_inputs']['is_hidden'] != null) ? 'checked' : '' ?><?= (isset($product) && $product['is_hidden'] != null) ? 'checked' : '' ?> />
							<label class="form-check-label" for="is_hidden">Définir si le produit ne doit pas apparaître à la vente</label>
						</div>
						<div class="form-group">
							<input type="checkbox" id="is_archived" name="is_archived" <?= (isset($_SESSION['old_inputs']['is_archived']) && $_SESSION['old_inputs']['is_archived'] != null) ? 'checked' : '' ?><?= (isset($product) && $product['is_archived'] != null) ? 'checked' : '' ?> />
							<label class="form-check-label" for="is_archived">Définir si le produit doit être archivé</label>
						</div>
						<input  class="btn btn-outline-dark" type="submit" value="Enregistrer" />
						<button class="btn btn-dark"><a class="text-white text-decoration-none" href="index.php?controller=products&action=list">Retour</a></button>
					</form>
				</section>
			</div>
		</div>
	</div>
</body>
<?php require 'partials/js_assets.php'; ?>
</html>