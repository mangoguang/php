$(function() {
  let url = location.href;
  if (url.indexOf('code') == -1) {
    location.href = 'http://zs.derucci.net/love-to-sleep/get-weixin-code.html?appid=wx879c920191311570&scope=snsapi_base&state=parsm&redirect_uri=' + url;
  }
  let arr = url.split('code=');
  arr = arr[1].split('&state');
  let code = arr[0];
  getOpenId(code);
})

function getOpenId(code) {
  console.log(code);
  $('.getOpenId').click(function() {
    $.ajax({
      type: 'post',
      url: '../../port/getOpenId.php',
      dataType: 'json',
      data: {
        code: code,
      },
      success: function(data) {
        console.log(data);
      },
      error: function(data) {
        alert('您的网络有问题。')
      },
    })
  })
}