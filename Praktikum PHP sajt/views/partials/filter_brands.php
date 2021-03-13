<li class="filterBrand list-group-item" data-id="<?= $r->proizvodjac_id ?>"><?= $r->naziv ?>
    <span class="label <?php echo $nizClass[array_rand($nizClass)]; ?> pull-right"><?=$r->brojProizvoda?></span>
</li>