//csrf配置
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//工具类配置
const u = {
    //提示
    toastr: toastr,

    //sweetalert
    confirm: function (cb, params = {}, options = {}, title = '确定操作吗?', type = 'info') {
        var ops = Object.assign({
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonColor: '#3e8ef7',
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: type,
            title: title,
            animation: false
        }, options);
        swal(ops).then(function (ret) {
            if (ret.value){
                cb(params);
            }
        });
    },

    //刷新当前页面
    reload: function (timeout = 0) {
        if (timeout === 0){ //reload now
            window.location.reload(true)
        } else {
            setTimeout(function () {
                window.location.reload(true)
            }, timeout)
        }
    },

    //表单验证
    formValidate: function (ele) {
        var forms = document.getElementsByClassName(ele);
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }
};