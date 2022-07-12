$(document).ready(function () {
    $(".product_sorting_btn").click(function () {
        let dataOption = $(this).attr("data-isotope-option");
        // let stringGet = "/{{route('showCategory',$category->alias)}}/" + dataOption.sortBy;
        $.ajax({
            url: "{{route('showCategory',$category->alias)}}",
            type: 'GET',
            data: {
                dataOption,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                console.log(data);
            },
        })
    })
});