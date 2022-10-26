$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id,url){
    var token = $('meta[name="csrf-token"]').attr('content');
    Swal.fire({
        title: "Bạn có muốn xóa không?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Đồng ý!",
        closeOnConfirm: false
    }).then((WillDelete) =>{
       if(WillDelete){
            $.ajax({
                type:'DELETE',
                datatype:'JSON',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    id,
                    token:token 
                },
                url: url,
                success: function (result){
                    if(result.error === false){
                        Swal.fire(
                            'Deleted!',
                            'Xóa thành công.',
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
            });  
       }   
       else {
            Swal.fire({
                title:'Hủy!',
                icon:'info',
            });
       }
    });
}




$(document).ready(function(){
    $('.notify-button').click(function(){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/check_notify',
            method:'POST',
            data:{
                _token:_token,
            },
            success:function(){
                $('.display').text('0');
            }
        });
    });

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
            url: '/select-delivery' ,
            method: 'POST',
            data:{
                action : action,
                city_id:city_id,
                _token:_token
            },
            success:function(data){
                $('#'+result).html(data);
            }
        });
    });

    $('.fee_edit').keyup(function(){
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

    $('.discount-edit').keyup(function(){
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
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                id:id,
                token,token
            },
            success: function(data){
                location.reload();
            }
        })
    });

    $('.btn-delete-user').click(function(e){
        const id =$(this).parents("tr").attr("data-id");
        const token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/account/destroy',
            type: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                id:id,
                token,token
            },
            success: function(data){
                location.reload();
            }
        })
    });
    
    $('.search-product').keyup(function(e){
        const search =$('input[name="search_product"]').val();
        const token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'get',
            dataType: 'JSON',
            url:'admin/search_product',
            data:{
                search:search,
                token:token,
            },
            success:function(data){
                console.log(data);

            }
        })
    });
    
    $('#file').change(function(e){
        e.preventDefault();
        const thumb = URL.createObjectURL(e.target.files[0]);
        $('#image_show').html('<img src="'+ thumb +'" width="100px"></a>');
    });

    $('.upload_image_mul').change(function(e){
        e.preventDefault();
        var total_file= $(this)[0].files.length;
        for(var i=0;i<total_file;i++)
        {
            $('.preview-image').append("<img src='"+URL.createObjectURL(e.target.files[i])+"' style='width:100px'><br>");
        }
    });

    $(".remove-comment").click(function (e) {
        e.preventDefault();
        const ele = $(this);
        const id = ele.parents("tr").attr("data-id");
        const _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/comment/destroy',
            method: "DELETE",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                _token: _token, 
                id: id, 
            },
            success: function (response) {
                $('#comment'+id).remove();
            }
        });
    });

    $('.switch-comment').change(function(e){
        e.preventDefault();
        const ele = $(this);
        const id = ele.parents("tr").attr("data-id");
        const _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/comment/edit',
            method: 'patch',
            data:{
                _token:_token,
                id:id,
            },
        })
    });
    
});

