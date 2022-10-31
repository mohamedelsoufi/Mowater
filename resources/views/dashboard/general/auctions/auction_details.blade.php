<script>
    $('.type').on('change', function () {
        get_organizations($(this).val());
    });

    $('.organization_id').on('change', function () {
        get_type_details($(this).val());
    });

    function get_organizations(id, city_id = null, area_id = null) {
        let url = "{{route('cities-of-country' , ':id')}}"
        url = url.replace(':id', id);

        $.ajax({
            type: "Get",
            url: url,
            datatype: 'JSON',
            success: function (data) {
                if (data.status == true) {
                    $('.city_id').empty();
                    let equal;
                    data.data.cities.forEach(function (city) {
                        equal = city_id == city.id ? "selected" : "";
                        var option = `<option value ="${city.id}" ${equal}>${city.name}</option>`;
                        $('.city_id').append(option);
                    });
                    get_type_details(id, area_id);
                }
            },
            error: function (reject) {
                alert(reject);
            }
        });
    }

    function get_areas(id, area_id = null) {
        var url = "{{route('areas-of-city' , ':id')}}"
        url = url.replace(':id', id);

        $.ajax({
            type: "Get",
            url: url,
            datatype: 'JSON',
            success: function (data) {
                if (data.status == true) {
                    $('.area_id').empty();
                    let equal;
                    data.data.areas.forEach(function (area) {
                        equal = area_id == area.id ? "selected" : "";
                        var option = `<option value ="${area.id}" ${equal}>${area.name}</option>`;
                        $('.area_id').append(option);
                    });

                }
            },
            error: function (reject) {
                alert(reject);
            }
        });
    }
</script>


