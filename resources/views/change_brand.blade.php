<script>
$('.brand_id').on('change',function(){
        get_models( $(this).val() );
});

function get_models(brand_id)
{
    var url = "{{route('car-models-of-brand' , ':id')}}";
    url = url.replace(':id', brand_id);
    $.ajax({
        type: "Get",
        url: url,
        datatype: 'JSON',
        success: function (data) {
            if (data.status == true) {
                $('.car_model_id').empty();

                data.data.car_models.forEach(function(car_model) {
                    var option = "<option value = '" + car_model.id +"'>" + car_model.name + "</option>"
                    $('.car_model_id').append(option);
                });

            }
            // alert(data);
        },
        error: function (reject) {
            alert(reject);
        }
    });
}

        
</script>