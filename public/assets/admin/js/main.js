$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id,url)
{
    Swal.fire({
        title: 'Cảnh báo! ',
        text: "Bạn muốn xóa dòng này?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Xóa!'
    }).then((result) => {
        if(result){
            $.ajax({
                type:'DELETE',
                datatype:'JSON',
                data: { id },
                url: url,
                success: function (result){
                    if(result.error === false){
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        location.reload();
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopsie woopsie',
                            text: 'Có lỗi!',
                          })
                    }
                }
            })
        }
    });
}

function autoTop() {
    document.body.scrollTop = 0; 
    document.documentElement.scrollTop = 0;
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
                Swal.fire(
                    'Good job!',
                    'Thêm thành công',
                    'success'
                  )
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
                Swal.fire(
                    'Good job!',
                    'Thành công',
                    'success'
                  )
                location.reload();
            }
        });
   });

   $('.discount-edit').blur(function(){
        var id = $(this).data('id');
        var discount = $(this).text();
        
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/voucher/edit',
            type: 'POST',
            data:{
                id :id,
                discount:discount,
                token:token,
            },
            success: function(data){
                Swal.fire(
                    'Good job!',
                    'Thành công',
                    'success'
                  )
                $("#table-fee").load(location.href + " #table-fee");
            }
        });
    });

    $('.btn-update-order').click(function(e){
        const id = $(this).data('id');
        const token = $('meta[name="csrf-token"]').attr('content');
        Swal.fire({
            title: '<strong>Chờ chút!</strong>',
            text:'Đang gửi mail tới khách hàng',
            icon: 'info',
            showConfirmButton: false,
        });
        $.ajax({
            url: '/admin/order/update',
            type: 'POST',
            data:{
                id:id,
                token,token
            },
            success: function(data){
                fetchorder();
            }
        })
    });

    
});
