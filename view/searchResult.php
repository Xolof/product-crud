<?php if ($this->searchResult): ?>
    <?php if (!array_key_exists("name", $this->searchResult)): ?>
        <section>
            <p class="warning">Kunde inte hitta produkten. Kontrollera din sökning.</p>
        </section>
    <?php endif; ?>
<?php endif; ?>
