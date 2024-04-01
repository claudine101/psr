<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'templates/header.php'; ?>


<script src="https://cdn.asprise.com/scannerjs/scanner.js" type="text/javascript"></script>

    <script>
        //
        // Please read scanner.js developer's guide at: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
        //

        /** Scan and upload in one go */
        function scanAndUploadDirectly() {
            scanner.scan(displayServerResponse,
                {
                    "output_settings": [
                        {
                            "type": "upload",
                            "format": "pdf",
                            "upload_target": {
                                "url": "https://asprise.com/scan/applet/upload.php?action=dump",
                                "post_fields": {
                                    "sample-field": "Test scan"
                                },
                                "cookies": document.cookie,
                                "headers": [
                                    "Referer: " + window.location.href,
                                    "User-Agent: " + navigator.userAgent
                                ]
                            }
                        }
                    ]
                }
            );
        }

        function displayServerResponse(successful, mesg, response) {
            if(!successful) { // On error
                document.getElementById('server_response').innerHTML = 'Failed: ' + mesg;
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                document.getElementById('server_response').innerHTML = '';
                return;
            }

            document.getElementById('server_response').innerHTML = scanner.getUploadResponse(response);

            // alert(donness);

            console.log(scanner.getUploadResponse(response));
        }




        
    </script>

    <style>
        img.scanned {
            height: 200px; /** Sets the display size */
            margin-right: 12px;
        }

        div#images {
            margin-top: 20px;
        }
    </style>
</head>


<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include VIEWPATH.'templates/navbar.php'; ?>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include VIEWPATH.'templates/sidebar.php'; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
         <div class="col-sm-6 p-md-0">
 <div class="welcome-text">
    <h4 style='color:#fff'><?=$title?></h4>

     </div>
    </div>
       </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->
    <div class="col-md-12 col-xl-12 grid-margin stretch-card">
    <div class="row column1">
      <div class="col-md-12">
       <div class="white_shd full margin_bottom_10">
        <div class="full graph_head">
          <div class="row" style="margin-top: 0px">
               
         </div>
       </div>
      </div>
     </div>
    </div>





           <section class="content">

          <div class="col-md-12 col-xl-12 grid-margin stretch-card">

            <div class="card">

              <div class="card-body">

                <div class="col-md-12">

                                         
                            <!-- <h2 style="color:black;"></h2> -->

                            <form>
                              <div class="form-row">
                                <div class="col-md-4 mb-3">
                                  <label for="validationDefault01">Nom</label>
                                  <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                  <label for="validationDefault02">Prenom</label>
                                  <input type="text" class="form-control" id="validationDefault02" placeholder="Last name" value="" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                  <label for="validationDefaultUsername">NIF</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroupPrepend2">RB</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationDefaultUsername" placeholder="0002256" aria-describedby="inputGroupPrepend2" required>
                                  </div>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="col-md-3 mb-3">
                                  <label for="validationDefault03">Province</label>
                                  <input type="text" class="form-control" id="validationDefault03" placeholder="" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                  <label for="validationDefault03">Commune</label>
                                  <input type="text" class="form-control" id="validationDefault03" placeholder="" required>
                                </div>
                                <div class="col-md-2 mb-3">
                                  <label for="validationDefault04">Zone</label>
                                  <input type="text" class="form-control" id="validationDefault04" placeholder="" required>
                                </div>
                                <div class="col-md-2 mb-3">
                                  <label for="validationDefault05">colline</label>
                                  <input type="text" class="form-control" id="validationDefault05" placeholder="" required>
                                </div>
                                 <div class="col-md-2 mb-3">
                                  <label for="validationDefault05">N° du Dossier</label>
                                  <input type="text" class="form-control" id="validationDefault05" placeholder="" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <button type="button" onclick="scanAndUploadDirectly();" class="btn btn-info btn-sm" style="float: right;"><font color="#fff"><i class="fas fa-scanner"></i></font>📚 Scanner un document</button>
                              </div>


                              <button class="btn btn-primary" type="submit">Enregistrer</button>


                            </form>


                            <div id="server_response"></div>

                            <!-- HELP_LINKS_START help links at the bottom -->
                            <style>
                                .asprise-footer, .asprise-footer a:visited { font-family: Arial, Helvetica, sans-serif; color: #999; font-size: 13px; }
                                .asprise-footer a {  text-decoration: none; color: #999; }
                                .asprise-footer a:hover {  padding-bottom: 2px; border-bottom: solid 1px #9cd; color: #06c; }
                            </style>
                            <div class="asprise-footer" style="margin-top: 48px;">
                                <a href="http://mediabox.bi" target="_blank" title="Opens in new tab">Innovation team</a> |
                               <!--  <a href="http://asprise.com/scan/scannerjs/docs/html/scannerjs-javascript-guide.html" target="_blank" title="Opens in new tab">Developer's Guide to ScannerJs</a> -->
                                <a href="https://github.com/Asprise/scannerjs.javascript-scanner-access-in-browsers-chrome-ie.scanner.js" target="_blank" title="Opens in new tab">Mediabox</a>
                            </div>

                </div>


                <!--  VOS CODE ICI  -->



              </div>
            </div>
          </div>

      </div>

      <!-- PSR partie -->



      <!-- End PSR partie -->

    </div>
  </div>
  </div>
  </div>


  </section>




</div>
</div>







</div>
</div></div></div>
<div id="nouveau">

  </div>


</div>


</div>



    

<?php include VIEWPATH.'templates/footer.php'; ?>
</body>
</html>


 
<script> 



    var donness  = '{"output":[{"result":["<html><head><title>Asprise Upload Tester</title><link rel=\"stylesheet\" href=\"http://asprise.com/scan/applet/upload.css\" /></head><body><p class=\"url\">URL: http://asprise.com/scan/applet/upload.php?action=dump | <a href=\"http://asprise.com/scan/applet/upload.php?action=source\" target=_blank>Show source code</a></p><div id=\"main\"><div id=\"left\"><h2>Files Uploaded</h2><a href=\"https://asprise-files.s3.amazonaws.com/delete_in_1_day/asprise-1662553147637-0.pdf\" target=\"_blank\"><img src=\"http://asprise.com/scan/applet/icon-pdf.png\"></a></div><div id=\"right\"><h2>$_FILES</h2><pre>array(1) {\n  [\"asprise_scans\"]=>\n  array(5) {\n    [\"name\"]=>\n    string(27) \"asprise-1662553147637-0.pdf\"\n    [\"type\"]=>\n    string(15) \"application/pdf\"\n    [\"tmp_name\"]=>\n    string(14) \"/tmp/phpQDV5rP\"\n    [\"error\"]=>\n    int(0)\n    [\"size\"]=>\n    int(35977)\n  }\n}\n</pre><h2>$_POST</h2><pre>array(1) {\n  [\"sample-field\"]=>\n  string(9) \"Test scan\"\n}\n</pre><h2>$_GET</h2><pre>array(1) {\n  [\"action\"]=>\n  string(4) \"dump\"\n}\n</pre><h2>$_COOKIE</h2><pre>array(0) {\n}\n</pre><h2>Request Headers</h2><pre>array(23) {\n  [\"Host\"]=>\n  string(11) \"asprise.com\"\n  [\"User-Agent\"]=>\n  string(111) \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36\"\n  [\"X-Amz-Cf-Id\"]=>\n  string(56) \"qNzWuQ_wndgy4IYhhwjzy0QspQiKVtpgj5jFm3gDsGs2ZH3Q_YLJCg==\"\n  [\"Connection\"]=>\n  string(10) \"Keep-Alive\"\n  [\"Content-Length\"]=>\n  string(5) \"36306\"\n  [\"Via\"]=>\n  string(64) \"1.1 72fa6bb6402ca4bbe8bd4aeecbb56c4e.cloudfront.net (CloudFront)\"\n  [\"X-Forwarded-For\"]=>\n  string(13) \"154.117.216.4\"\n  [\"Accept\"]=>\n  string(3) \"/\"\n  [\"Referer\"]=>\n  string(43) \"https://app.mediabox.bi/psr/scanner/scanner\"\n  [\"X-Powered-By\"]=>\n  string(48) \"Asprise Scanning, Imaging and OCR by asprise.com\"\n  [\"Content-Type\"]=>\n  string(70) \"multipart/form-data; boundary=------------------------7e2309058824343d\"\n  [\"CloudFront-Is-Mobile-Viewer\"]=>\n  string(5) \"false\"\n  [\"CloudFront-Is-Tablet-Viewer\"]=>\n  string(5) \"false\"\n  [\"CloudFront-Is-Desktop-Viewer\"]=>\n  string(4) \"true\"\n  [\"CloudFront-Is-IOS-Viewer\"]=>\n  string(5) \"false\"\n  [\"CloudFront-Is-Android-Viewer\"]=>\n  string(5) \"false\"\n  [\"CloudFront-Viewer-Country\"]=>\n  string(2) \"BI\"\n  [\"CloudFront-Viewer-Country-Name\"]=>\n  string(7) \"Burundi\"\n  [\"CloudFront-Viewer-Country-Region\"]=>\n  string(2) \"BM\"\n  [\"CloudFront-Viewer-City\"]=>\n  string(9) \"Bujumbura\"\n  [\"CloudFront-Viewer-Time-Zone\"]=>\n  string(16) \"Africa/Bujumbura\"\n  [\"CloudFront-Forwarded-Proto\"]=>\n  string(5) \"https\"\n  [\"cdn-vendor\"]=>\n  string(3) \"aws\"\n}\n</pre></div></div><hr style=\"height: 1px; color: #999; font-size: 0; border: 0; background: #999; margin-top: 20px; margin-bottom: 10px;\"><span style=\"font-family: Arial; color: #999; font-size: 12px;\">ALL RIGHTS RESERVED BY LAB ASPRISE <a href=\"http://asprise.com/\" target=_blank>asprise.com</a> &copy; 2022.</span>"],"mime_type":"application/pdf","format":"pdf","type":"upload"}],"last_transfer_rc":6,"images":[{"extended_image_attrs":{"error":"<error: retrieveExtImageInfo skipped as info code size is 0.>"},"image_layout":{"Frame":"(0.0, 0.0, 0.0, 0.0)","PageNumber":1,"FrameNumber":1,"DocumentNumber":1},"time":1662553135000,"barcodes":null,"image_info":{"YResolution":300,"Compression":0,"XResolution":300,"SamplesPerPixel":3,"ImageWidth":640,"Planar":false,"ImageLength":480,"BitsPerPixel":24,"PixelType":2},"caps":{"ICAP_BITDEPTH":24,"ICAP_FRAMES":"(0.0, 0.0, 8.5, 11.0)","ICAP_PIXELTYPE":2,"ICAP_UNITS":0,"ICAP_XRESOLUTION":"300.0"}}],"response_id":"1662553147","image_count":1,"device":"HP HD Webcam TWAIN","request_id":null}';

    alert(donness);


















function get_rapport(){

    var mois=$('#mois').val();
    var jour=$('#jour').val();

    $.ajax({
        url : "<?=base_url()?>scanner/Scanner",
        type : "POST",
        dataType: "JSON",
        cache:false,
        data:{mois:mois, jour:jour},
        success:function(data){   
          $('#container').html("");             

       }            

   });  
}

</script> 


