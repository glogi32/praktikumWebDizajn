

<div class="container">
    <div class="row">
        
            <h1 class="admin-naslov">ADMIN PAGE</h1>
            <p class="addNew"><i class="fas fa-user-plus"></i> Add new user</p>
            <div class="table-responsive-sm table-responsive-md" id="admin-tabela-okvir">
                <table class="table table-striped" id="table-users">
                    
                    
                </table>
            </div>
        
    </div>
</div>
<div class="container">
    <div class="row">
        
            <h4 class="admin-naslov">Statistika sajta</h4>
            <div class="table-responsive-sm table-responsive-md" id="admin-tabela-okvir">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Pocetna</th>
                            <th>Admin</th>
                            <th>Details</th>
                            <th>O autoru</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $open = fopen(LOG_FAJL, "r");
                            if($open){
                                $sviPodaci = file(LOG_FAJL);
                                $procenatPocetna = 0;
                                $procenatAdmin = 0;
                                $procenatOAutoru = 0;
                                $procenatDetails = 0;
                                $ukupno = 0;
                                
                                $timestamp = time()-(60*60*24);
                                foreach($sviPodaci as $p){
                                    $red = explode("\t",$p);
                                    
                                    $vreme = explode(" ",$red[1]);

                                    $dani = explode("-",$vreme[0]);
                                    $sati = explode(":",$vreme[1]);
                                    $timestampLog = mktime($sati[0],$sati[1],$sati[2],$dani[1],$dani[0],$dani[2]);
                                    
                                    
                                    if($timestampLog > $timestamp){
                                        
                                        switch(trim($red[3])){
                                            case "pocetna":
                                                $procenatPocetna++;
                                                $ukupno++;
                                                break;
                                            case "admin":
                                                $procenatAdmin++;
                                                $ukupno++;
                                                break;
                                            case "oAutoru":
                                                $procenatOAutoru++;
                                                $ukupno++;
                                                break;
                                            case "details":
                                                $procenatDetails++;
                                                $ukupno++;
                                                break;
                                        }
                                    }
                                }
                            }
                            fclose($open);
                        ?>
                        <tr>
                            <td><?=number_format(($procenatPocetna*100)/$ukupno,2)?>%</td>
                            <td><?=number_format(($procenatAdmin*100)/$ukupno,2)?>%</td>
                            <td><?=number_format(($procenatDetails*100)/$ukupno,2)?>%</td>
                            <td><?=number_format(($procenatOAutoru*100)/$ukupno,2)?>%</td>
                        <tr>
                    </tbody>
                </table>
                <div id="info">
                    <p class="info-tekst"> Get all informations about products in excel file</p>
                    <a href="models/admin/download_excel.php"><p id="info-excel" class="addNew info-btn">Info download</p></a>
                </div>
            </div>
        
    </div>
</div>