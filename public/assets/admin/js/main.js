$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id,url)
{
    if(confirm('Bạn có chắc muốn xóa không?')){
        $.ajax({
            type:'DELETE',
            datatype:'JSON',
            data: { id },
            url: url,
            success: function (result){
                if(result.error === false){
                    alert(result.message);
                    location.reload();
                }else{
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}

function autoTop() {
    document.body.scrollTop = 0; 
document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

$('#upload').change(function (){ 
    const form = new FormData();
    form.append('file',$(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function(results){
            if(results.error === false){
                $("#image_show").html('<a href="'+ results.url +'" target="_blank">' + '<img src="'+ results.url +'" width="100px"></a>');

                $("#thumb").val(results.url);
            } else {
                alert('Upload File lỗi');
            }
        }
    });
});

$(document).ready(function(){
    $('.add-delivery').click(function(){
        var city = $('.city').val();
        var district = $('.district').val();
        var fee =$('input[name="fee"]').val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
                
            url: '/admin/insert-delivery' ,
            method: 'POST',
            data:{
                city:city,
                district:district,
                fee:fee,
                _token:_token,
            },
            success:function(data){
                alert('Thanh cong')
            }
        });
    });

    $('.choose').change(function(){
        var action = $(this).attr('id');
        var city_id = $(this).val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var result = '';

        if(action == 'city') {
            result='district';
        }

        $.ajax({
            url: '/admin/select-delivery' ,
            method: 'POST',
            data:{
                action:action,
                city_id:city_id,
                _token:_token
            },
            success:function(data){
                $('#'+result).html(data);
            }
        });
   });


   $('.fee_edit').blur(function(){
        var id = $(this).data('id');
        var fee = $(this).text();
        
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/update-fee',
            type: 'POST',
            data:{
                id :id,
                fee:fee,
                _token:_token,
            },
            success: function(data){
                alert('thanh cong');
                location.reload();
            }
        });
   });

   $('.discount-edit').blur(function(){
        var id = $(this).data('id');
        var discount = $(this).text();
        
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/voucher/edit',
            type: 'POST',
            data:{
                id :id,
                discount:discount,
                _token:_token,
            },
            success: function(data){
                alert('thanh cong');
                $("#table-fee").load(location.href + " #table-fee");
            }
        });
    });

    
});