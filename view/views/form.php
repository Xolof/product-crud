<?php require("header.php"); ?>
<?php require("messages.php"); ?>
<?php require("formVariables.php"); ?>

<section>
    <h3>Skapa, uppdatera eller radera produkt</h3>
    <form
        action="."
        method="POST"
    >
        <label for="name">Namn:</label>
        <input type="text" name="name" id="name" value="<?= htmlentities($formName) ?>" required>

        <label for="sku">Sku:</label>
        <input type="text" name="sku" id="sku" value="<?= htmlentities($formSku) ?>" required>

        <label for="price">Pris:</label>
        <input type="number" name="price" id="price" min="0" step="0.01" value="<?= htmlentities($formPrice) ?>" required>

        <button type="submit" name="action" value="save">Spara/Uppdatera</button>
        <button type="submit" name="action" value="delete">Delete</button>
    </form>
</section>

<?php require("searchResult.php"); ?>

<section>
    <h3>Visa produkt</h3>
    <form
        action="."
        method="GET"
    >
        <label for="sku">Sku:</label>
        <input type="text" name="sku" id="sku" required>
        <button type="submit" name="action" value="search">Visa</button>
    </form>
</section>

<?php require("footer.php"); ?>
