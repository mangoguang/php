$(function() {
  $('button').click(function() {
    login();
  })
})

function login() {
  var name = $('.name').val(),
    password = $('.password').val();

  $.ajax({
    type: 'post',
    url: '../port/login.php',
    dataType: 'json',
    data: {
      name: name,
      password: password
    },
    success: function(data) {
      if (data.status == 'success') {
        location.href = './pages/home.html';
      } else {
        alert('账号或者密码错误！');
      }
    },
    error: function(data) {
      alert('您的网络有问题。');
    },
  })
}