<script>
    window.onload = function () {
        //Check File API support
        if (window.File && window.FileList && window.FileReader) {
            var filesInput = document.getElementById("files");
            // console.log(filesInput.value);
            filesInput.addEventListener("change", function (event) {

                var files = event.target.files; //FileList object
                document.getElementById("result").innerHTML = "";
                // output.className='row';
                var output = document.getElementById("result");

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    //Only pics
                    if (!file.type.match('image'))
                        continue;
                    var picReader = new FileReader();
                    picReader.addEventListener("load", function (event) {
                        var picFile = event.target;
                        var div = document.createElement("div");
                        div.className = 'col-md-3';
                        div.innerHTML = "<img class='img-thumbnail w-100' src='" + picFile.result + "'" +
                            "title='" + picFile.name + "'/>";
                        output.insertBefore(div, null);
                    });
                    //Read the image
                    picReader.readAsDataURL(file);
                }
            });
        } else {
            console.log("Your browser does not support File API");
        }
        document.getElementById('close').onclick = function () {
            this.parentNode.parentNode.parentNode
                .removeChild(this.parentNode.parentNode);
            return false;
        };
    }

    {{--    <script>--}}
    {{--        $(".multi-select").select2()--}}
    {{--    </script>--}}
</script>
