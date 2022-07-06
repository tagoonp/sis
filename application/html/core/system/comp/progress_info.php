<?php 
$strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '$id' ";
$resProgress = $db->fetch($strSQL, false, false);

?>
<section id="nav-filled">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="text-white mb-0">Study progress</h3>
                </div>
                <div class="card-body pt-2">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pe-tab-fill" data-toggle="tab" href="#pe-fill" role="tab" aria-controls="pe-fill" aria-selected="true">
                               <?php 
                               if($resProgress){
                                    if($resProgress['sp_pe'] == 'pass'){ echo '<i class="bx bx-check-shield"></i>'; }
                               } 
                               ?> PE
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="eng-tab-fill" data-toggle="tab" href="#eng-fill" role="tab" aria-controls="eng-fill" aria-selected="false">
                            <?php 
                               if($resProgress){
                                    if($resProgress['sp_eng'] == 'pass'){ echo '<i class="bx bx-check-shield"></i>'; }
                               } 
                               ?> ENG
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="qe-tab-fill" data-toggle="tab" href="#qe-fill" role="tab" aria-controls="qe-fill" aria-selected="false">
                            <?php 
                               if($resProgress){
                                    if($resProgress['sp_qe'] == 'pass'){ echo '<i class="bx bx-check-shield"></i>'; }
                               } 
                               ?> QE
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ec-tab-fill" data-toggle="tab" href="#ec-fill" role="tab" aria-controls="ec-fill" aria-selected="false">
                            <?php 
                               if($resProgress){
                                    if($resProgress['sp_ec'] == 'pass'){ echo '<i class="bx bx-check-shield"></i>'; }
                               } 
                               ?> EC
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pub-tab-fill" data-toggle="tab" href="#pub-fill" role="tab" aria-controls="pub-fill" aria-selected="false">
                                <?php 
                               if($resProgress){
                                    if($resProgress['sp_pub'] == 'pass'){ echo '<i class="bx bx-check-shield"></i>'; }
                               } 
                               ?> PUB
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="te-tab-fill" data-toggle="tab" href="#te-fill" role="tab" aria-controls="te-fill" aria-selected="false">
                            <?php 
                               if($resProgress){
                                    if($resProgress['sp_te'] == 'pass'){ echo '<i class="bx bx-check-shield"></i>'; }
                               } 
                               ?> TE
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ce-tab-fill" data-toggle="tab" href="#ce-fill" role="tab" aria-controls="ce-fill" aria-selected="false">
                            <?php 
                               if($resProgress){
                                    if($resProgress['sp_ce'] == 'pass'){ echo '<i class="bx bx-check-shield"></i>'; }
                               } 
                               ?> CE
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content pt-1">
                        <div class="tab-pane active" id="pe-fill" role="tabpanel" aria-labelledby="pe-tab-fill">
                            <?php  require_once('./comp/progress_pe.php'); ?>
                        </div>
                        <div class="tab-pane" id="eng-fill" role="tabpanel" aria-labelledby="eng-tab-fill">
                            <h4 class="text-dark">English examination</h4>
                            <p>
                                Tootsie roll oat cake I love bear claw I love caramels caramels halvah chocolate bar. Cotton candy
                                gummi
                                bears pudding pie apple pie cookie. Cheesecake jujubes lemon drops danish dessert I love caramels
                                powder.
                            </p>
                        </div>
                        <div class="tab-pane" id="qe-fill" role="tabpanel" aria-labelledby="qe-tab-fill">
                            <h4 class="text-dark">Qualification examination</h4>
                            <p>
                                Biscuit powder jelly beans. Lollipop candy canes croissant icing chocolate cake. Cake fruitcake powder
                                pudding pastry.
                            </p>
                        </div>
                        <div class="tab-pane" id="ec-fill" role="tabpanel" aria-labelledby="ec-tab-fill">
                            <h4 class="text-dark">Ethics</h4>
                            <p>
                                Tootsie roll oat cake I love bear claw I love caramels caramels halvah chocolate bar. Cotton candy
                                gummi bears pudding pie apple pie cookie. Cheesecake jujubes lemon drops danish dessert I love
                                caramels powder.
                            </p>
                        </div>
                        <div class="tab-pane" id="pub-fill" role="tabpanel" aria-labelledby="pub-tab-fill">
                            <h4 class="text-dark">Publications</h4>
                            <p>
                                Tootsie roll oat cake I love bear claw I love caramels caramels halvah chocolate bar. Cotton candy
                                gummi bears pudding pie apple pie cookie. Cheesecake jujubes lemon drops danish dessert I love
                                caramels powder.
                            </p>
                        </div>
                        <div class="tab-pane" id="te-fill" role="tabpanel" aria-labelledby="te-tab-fill">
                            <h4 class="text-dark">Thesis examination</h4>
                            <p>
                                Tootsie roll oat cake I love bear claw I love caramels caramels halvah chocolate bar. Cotton candy
                                gummi bears pudding pie apple pie cookie. Cheesecake jujubes lemon drops danish dessert I love
                                caramels powder.
                            </p>
                        </div>
                        <div class="tab-pane" id="ce-fill" role="tabpanel" aria-labelledby="ce-tab-fill">
                            <h4 class="text-dark">Complehensive examination</h4>
                            <p>
                                Tootsie roll oat cake I love bear claw I love caramels caramels halvah chocolate bar. Cotton candy
                                gummi bears pudding pie apple pie cookie. Cheesecake jujubes lemon drops danish dessert I love
                                caramels powder.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>