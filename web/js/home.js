$(function() {
  $.ajax({
    type: 'post',
    url: '../../map.php',
    dataType: 'json',
    data: {
      name: 'name',
      password: 'password'
    },
    success: function(data) {
      console.log(data);
    },
    error: function(data) {
      console.log(data);
    },
  })
})