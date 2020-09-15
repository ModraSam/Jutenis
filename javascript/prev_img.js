$(function(){

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#imgPreview').attr('src', e.target.result);
      $('#imgPreview').css('display', 'block');
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$(".impImg").change(function() {
  readURL(this);
});


});