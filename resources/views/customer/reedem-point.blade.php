@extends('layout')

@section('title', 'WhizCycle')

@section('content')

    <main id="main" class="main">
        <!-- Page Content  -->
        <div class="pagetitle">
            <h1>Redeem Point</h1>
        </div>

        <section class="section" id="main-reedem">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 card-img-container">
                                    <img src="https://nuts.com/images/rackcdn/ed910ae2d60f0d25bcb8-80550f96b5feb12604f4f720bfefb46d.ssl.cf1.rackcdn.com/5788%20Chocolate%20Gold%20-xnBkCoaB-zoom.jpg" alt="image" class="card-img">
                                </div>
                                <div class="col-md-6">
                                    <br><br><br>
                                    <h1>Poin kamu saat ini</h1>
                                    <input type="hidden" id="mypoint" value="<?= auth()->user()->total_points ?>">
                                    <h1 style="color:green;margin-left:70px;"><?= auth()->user()->total_points ?> Points</h1>
                                </div>
                                <div class="col-md-9">
                                    <h4>1 Kg sampah = 5 points</h4>
                                    <h5>Setor sampah lebih banyak untuk mendapatkan poin!</h5>
                                </div>
                                <div class="col-md-3">
                                <button class="btn btn-success" style="font-size: 20px; padding: 15px 25px;margin-left:50px;" onclick="history()">History</button>
                                    <br>
                                    <p style="color:green">ketuk untuk melihat riwaya tukar point</p>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php 
                        $arr = [50000,100000,200000,300000];
                    ?>
                    <div class="row">
                        @foreach($arr as $v)
                        <div class="col-md-6" style="position: relative;margin-top:10px;" onclick="openModal({{ $v }})" data-value="{{ $v }}">
                            <img src="{{ url('assets/img/voucher-bg.png') }}" style="width: 100%; z-index: -1;">
                            <div style="position: absolute; top: 50%; left: 35%; transform: translate(-50%, -50%); color: white; font-size: 28px;">
                                <p style="color:red;font-size:28px;margin-top:50px;">- MATAHARI </p>
                                <p style="margin-top:-20px;">Voucher Rp. <?= number_format($v) ?> Matahari.com</p>
                            </div>
                            <div style="position: absolute; top: 50%; left: 85%; transform: translate(-50%, -50%); color: white; font-size: 24px;">
                                <p style="margin-top:20px;">Pass <?= number_format($v/100) ?> Points</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        

        <section class="section" id="purchase-reedem" style="display:none;">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center" id="ss">
                                    <h2>eVoucher Purchase Successful</h2>
                                    <br>
                                    <button type="button" style="border-radius:25px;" class="btn btn-outline-primary">Successful</button>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6" style="position: relative;margin-top:10px;">
                                            <img src="{{ url('assets/img/voucher-bg.png') }}" style="width: 100%; z-index: -1;">
                                            <div style="position: absolute; top: 50%; left: 35%; transform: translate(-50%, -50%); color: white; font-size: 28px;">
                                                <p style="color:red;font-size:28px;margin-top:50px;">- MATAHARI </p>
                                                <p style="margin-top:-20px;" id="vc-nominal">Voucher Rp. <?= number_format($v) ?> Matahari.com</p>
                                            </div>
                                            <div style="position: absolute; top: 50%; left: 85%; transform: translate(-50%, -50%); color: white; font-size: 24px;">
                                                <p style="margin-top:20px;" id="vc-pass">Pass <?= number_format($v/100) ?> Points</p>
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <br>
                                                <div class="row">
                                                    <div class="col-md-6 text-left">Date</div>
                                                    <div class="col-md-6 text-right"><?= date('d/m/Y') ?></div>
                                                    <div class="dotted-line"></div>
                                                    <div class="col-md-6 text-left">Mobile Number</div>
                                                    <div class="col-md-6 text-right"><?= auth()->user()->phoneNo ?></div>
                                                    <div class="dotted-line"></div>
                                                    <div class="col-md-6 text-left">Information</div>
                                                    <div class="col-md-6 text-right" id="minus-point">-1000 Points</div>
                                                    <div class="dotted-line"></div>
                                                    
                                                    <div class="col-md-6">
                                                        <br><br>
                                                        <i class="bi bi-share bi-lg"></i>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <br><br>
                                                        <i class="bi bi-download bi-lg" id="download-icon"></i>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button onclick="back()" class="btn btn-info text-white" style="font-size: 20px; padding: 15px 150px;margin-left:50px;">Done</button>
                </div>
            </div>
        </section>
        
        <section class="section" id="history-reedem" style="display:none;">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-danger" onclick="back()">Back</button><br><br>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link nav-link2 active" aria-current="page" href="#all">All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link2" aria-current="page" href="#earn">Earn</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link2" aria-current="page" href="#redeem">Redeem</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <!-- All Content -->
                                        <div class="tab-pane fade show active" id="all">
                                            <br>
                                            <div class="row">
                                                @foreach($history as $v)
                                                <div class="col-md-12">
                                                   <div class="card" style="background-color:#DADADA;">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <img src="{{ url('assets/img/orange.png') }}" style="height:90%;;margin-top:10px;z-index: -1;">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <h4 style="margin-left:-70px;margin-top:20px;">Kamu telah melakukan redeem <?= $v->voucher ?></h4>
                                                                <h4 style="color:#968d8d;margin-left:-70px;margin-top:20px;"><?= date('d M Y',strtotime($v->created_at)) ?></h4>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h3 style="color:#d5a924;margin-top:30px;"> -<?= $v->point ?> Points</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                        <!-- Earn Content -->
                                        <div class="tab-pane fade" id="earn">
                                            <h3>Earn Content</h3>
                                            <p>This is the content for the Earn tab.</p>
                                        </div>
                                        
                                        <!-- Redeem Content -->
                                        <div class="tab-pane fade" id="redeem">
                                        <br>
                                            <div class="row">
                                                @foreach($history as $v)
                                                <div class="col-md-12">
                                                   <div class="card" style="background-color:#DADADA;">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <img src="{{ url('assets/img/orange.png') }}" style="height:90%;;margin-top:10px;z-index: -1;">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <h4 style="margin-left:-70px;margin-top:20px;">Kamu telah melakukan redeem <?= $v->voucher ?></h4>
                                                                <h4 style="color:#968d8d;margin-left:-70px;margin-top:20px;"><?= date('d M Y',strtotime($v->created_at)) ?></h4>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h3 style="color:#d5a924;margin-top:30px;"> -<?= $v->point ?> Points</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

<div class="modal fade" id="reedemModal" tabindex="-1" role="dialog" aria-labelledby="reedemModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reedemModalTitle">Redeem Point Confirmation</h5>
      </div>
      <div class="modal-body" id="content-modal">
         
      </div>
      <div class="modal-footer">
        <input type="hidden" id="point-pass" value="0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
        <button type="button" class="btn btn-primary" id="confirm-redeem" onclick="reedem()">Redeem</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    // Get all tab links
    const tabLinks = document.querySelectorAll('.nav-link2');

    // Add click event listener to each tab link
    tabLinks.forEach(function(tabLink) {
        tabLink.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            
            // Remove 'show active' class from all tab panes
            document.querySelectorAll('.tab-pane').forEach(function(tabPane) {
                tabPane.classList.remove('show', 'active');
            });
            
            // Get the target tab pane
            const targetId = tabLink.getAttribute('href').substring(1);
            const targetPane = document.getElementById(targetId);
            
            // Add 'show active' class to the target tab pane
            targetPane.classList.add('show', 'active');
            
            // Remove 'active' class from all tab links
            tabLinks.forEach(function(link) {
                link.classList.remove('active');
            });
            
            // Add 'active' class to the clicked tab link
            tabLink.classList.add('active');
        });
    });

    function downloadScreenshot() {
            // Get the shared content element
            const sharedContent = document.querySelector('#purchase-reedem');

            // Use html2canvas to capture the content as an image
            html2canvas(sharedContent, {
                onrendered: function(canvas) {
                    // Convert the canvas to a data URL
                    const dataUrl = canvas.toDataURL();

                    // Create a link element
                    const link = document.createElement('a');
                    link.href = dataUrl;
                    link.download = 'screenshot.png'; // Set the filename for the downloaded image

                    // Simulate a click on the link to trigger download
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            });
        }

        // Attach click event listener to the download icon
        document.getElementById('download-icon').addEventListener('click', downloadScreenshot);

    function openModal(value) {
        // alert(value);
        var mypoint = $("#mypoint").val();
        if (mypoint >= value/100) {
            $("#confirm-redeem").css("display","block");
            $("#content-modal").html("Apakah kamu yakin akan melakukan penukaran point dengan voucher ini?");
        }else{
            $("#confirm-redeem").css("display","none");
            $("#content-modal").html("Maaf point kamu tidak cukup :(");
        }
        $("#point-pass").val(value/100);
        $("#vc-nominal").html("Voucher Rp. "+numeral(value).format('0,0')+" Matahari.com");
        $("#vc-pass").html("Pass "+numeral(value/100).format('0,0')+" Points");
        $("#minus-point").html("-"+numeral(value/100).format('0,0')+" Points");
        $("#reedemModal").modal("show");   

    }
    function closeModal() {
        $("#reedemModal").modal("hide");
    }
    function reedem(){
        var param = {
            'voucher':$("#vc-nominal").html(),
            'point' :$("#point-pass").val()
        }
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '<?= url("store-redeem-point") ?>',
            type: 'POST',
            data: param,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (data) {
                console.log(data);
            }
        });

        closeModal();
        $("#main-reedem").css("display","none");
        $("#purchase-reedem").css("display","block");
    }
    function history(){
        $("#main-reedem").css("display","none");
        $("#history-reedem").css("display","block");        
    }
    function back(){
        location.reload();
        // $("#main-reedem").css("display","block");
        // $("#purchase-reedem").css("display","none");
    }
</script>
@endsection