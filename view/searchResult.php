<?php if ($searchResult): ?>
    <?php if (!array_key_exists("name", $searchResult)): ?>
        <section>
            <p class="warning">Kunde inte hitta produkten. Kontrollera din sökning.</p>
        </section>
    <?php endif; ?>
<?php endif; ?>
