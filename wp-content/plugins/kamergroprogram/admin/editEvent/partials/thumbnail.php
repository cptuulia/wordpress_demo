<div id="upload-demo"></div>      
<strong>Select image to crop:</strong>
<input type="file" id="image">
<button class="btn-upload-image" style="margin-top:2%">Upload Image</button>    
<script type="text/javascript">


var resize = jQuery('#upload-demo').croppie({
    enableExif: true,
    enableOrientation: true,    
    viewport: { // Default { width: 100, height: 100, type: 'square' } 
        width: 600,
        height: 400,
        type: 'square' //square
    },
    boundary: {
        width: 600,
        height: 400
    }
});


jQuery('#image').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      resize.croppie('bind',{
        url: e.target.result
      }).then(function(){
      });
    }
    reader.readAsDataURL(this.files[0]);
});


jQuery('.btn-upload-image').on('click', function (ev) {
    ev.preventDefault();
   jQuery('.btn-upload-image').hide();
  
  resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
    jQuery.ajax({
      url: "/wp-content/plugins/kamergroprogram/admin/ajax/eventThumpbnailUpload.php",
      type: "POST",
      data: {
            "image":img, 
            'id': "<?php echo $media['id']?>",
            'itemId': "<?php echo $media['item_id']?>",
             'name' : '<?php echo $media['name']?>',
        },
      success: function (data) {
         jQuery('.btn-upload-image').show();
        let r = (Math.random() + 1).toString(36).substring(7);
        jQuery('#categoryItemThumbnail').attr("src", data + '?random=' + r);
      }
    });
  });
});


</script>       
