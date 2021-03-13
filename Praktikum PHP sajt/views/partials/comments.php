<div class="komentar">
    <div class="komentar-header"><p class="imeIPrezime">User: <?=$r->ime?> <?=$r->prezime?></p><p class="datum"><?php echo date("d/m/Y H:i",$r->vreme) ?></p></div>
    <div class="tekst">
        <?=$r->tekst?>
    </div>
</div>