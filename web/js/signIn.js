$(function() {
  form();
})

function form() {
  $('.submit').click(function() {
    let name = $('#name').val(),
      phone = $('#phone').val(),
      password = $('#password').val();

    if (name.length > 1) {
      if (password.length == 6) {
        if (phone.length == 11) {
          $.ajax({
            type: 'post',
            url: '../../port/signIn.php',
            dataType: 'json',
            data: {
              name: name,
              password: password
            },
            success: function(data) {
              if (data.status == 'success') {
                alert('注册成功。')
                console.log(data);
                // location.href = './pages/home.html?name=' + name;
              } else {
                alert('该账号已存在。');
              }
            },
            error: function(data) {
              alert('您的网络有问题。');
            },
          })
        } else {
          alert('请填写正确的手机号！');
        }
      } else {
        alert('请填写六位数密码！');
      }
    } else {
      alert('请填写昵称！');
    }
  })
}