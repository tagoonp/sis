<div class="row">
    <div class="col-8" style="padding-top: 5px;"><h4 class="text-dark">Proposal examination</h4></div>
    <div class="col-4 text-right"><h6 class="btn  btn-icon text-dark mb-0"  data-toggle="modal" data-target="#modalPeStatus"><i class="bx bx-pencil"></i></h6></div>
</div>
<table class="table table-bordered table-sm">
    <tbody>
        <tr>
            <td style="width: 200px;">Status : </td>
            <td>
                <?php 
                if($resProgress){
                    echo $resProgress['sp_pe'];
                }else{
                    echo "N/A";
                }
                ?>   
            </td>
        </tr>
        <tr>
            <td style="width: 200px;">Pass date : </td>
            <td>
                <?php 
                if(($resProgress) && ($resProgress['sp_pe_passdatetime'] != null)){
                    echo $resProgress['sp_pe_passdatetime'];
                }else{
                    echo "-";
                }
                ?>   
            </td>
        </tr>
    </tbody>
</table>

<div class="row pt-2">
    <div class="col-8" style="padding-top: 5px;"><h4 class="text-dark">Proposal exam record</h4></div>
    <div class="col-4 text-right"><h6 class="btn  btn-icon text-dark mb-0"><i class="bx bx-plus"></i></h6></div>
</div>
<table class="table table-bordered">
    <thead>
        <tr class="bg-secondary">
            <th style="width: 50px;" class="text-white text-center">#</th>
            <th style="width: 200px;" class="text-white text-center">Exam date</th>
            <th class="text-white">Title</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center"></td>
            <td class="text-center">
                <?php 
                if($resProgress){
                    echo $resProgress['sp_pe'];
                }else{
                    echo "N/A";
                }
                ?>   
            </td>
            <td></td>
        </tr>
        
    </tbody>
</table>

<div class="modal fade" id="modalPeStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Proposal exam status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">
                    Croissant jelly-o halvah chocolate sesame snaps. Brownie caramels candy canes chocolate cake
                    marshmallow icing lollipop I love. Gummies macaroon donut caramels biscuit topping danish.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary ml-1" data-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </div>
    </div>
</div>