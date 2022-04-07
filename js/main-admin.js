// JavaScript Document
 $(document).ready(function() {
 $(".upload").upload({
	
  action: "../_functions/upload.php",
  }).on("start.upload", onStart)
.on("complete.upload", onComplete)
.on("filestart.upload", onFileStart)
.on("fileprogress.upload", onFileProgress)
.on("filecomplete.upload", onFileComplete)
.on("fileerror.upload", onFileError)
.on("queued.upload", onQueued);

$(".filelist.queue").on("click", ".cancel", onCancel);
$(".cancel_all").on("click", onCancelAll);
	 
	 
$('#summernote').summernote({
height: 200,
width: '100%',

onImageUpload: function(files) {
// upload image to server and create imgNode...
$('#summernote').summernote('insertImage', url, filename);
}
});
$('#summernote').on('summernote.image.upload', function(we, files) {
// upload image to server and create imgNode...
sendFile(files[0]);
});






        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);//You can append as many data as you want. Check mozilla docs for this
            $.ajax({
                data: data,
                type: "POST",
                url: PATH+'send/textEditorUpload',
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    $('#summernote').summernote('editor.insertImage', url);
                }
            });
        }
 
 });
 
  function onCancel(e) {
                        console.log("Cancel");
                        var index = $(this).parents("li").data("index");
                        $(this).parents("form").find(".upload").upload("abort", parseInt(index, 10));
                    }

                    function onCancelAll(e) {
                        console.log("Cancel All");
                        $(this).parents("form").find(".upload").upload("abort");
                    }

                    function onBeforeSend(formData, file) {
                        console.log("Before Send");
                        formData.append("test_field", "test_value");
                        // return (file.name.indexOf(".jpg") < -1) ? false : formData; // cancel all jpgs
                        return formData;
                    }

                    function onQueued(e, files, response) {
                        console.log(response);
                        var html = '';
                        for (var i = 0; i < files.length; i++) {
                           // html += '<li data-index="' + files[i].index + '"><span class="content"><img src="'+PATH+"uploads/"+response+'"> <span class="cancel">[x]</span><span class="progress">Queued</span></span><span class="bar"></span></li>';
                        }

                        $(this).parents("form").find(".filelist.queue")
                            .append(html);
                    }

                    function onStart(e, files) {
                        console.log("Start");
                        $(this).parents("form").find(".filelist.queue")
                            .find("li")
                            .find(".progress").text("Waiting");
                    }

                    function onComplete(e) {
                        console.log("Complete");
                        // All done!
						//alert("test");
                    }

                    function onFileStart(e, file) {
                        console.log("File Start");
                        $(this).parents("form").find(".filelist.queue")
                            .find("li[data-index=" + file.index + "]")
                            .find(".progress").text("0%");
                    }

                    function onFileProgress(e, file, percent) {
                        console.log("File Progress");
                        var $file = $(this).parents("form").find(".filelist.queue").find("li[data-index=" + file.index + "]");

                        $file.find(".progress").text(percent + "%")
                        $file.find(".bar").css("width", percent + "%");
                    }
i = 0;
						
                    function onFileComplete(e, file, response) {
                        console.log(e);
                        if (response.trim() === "" || response.toLowerCase().indexOf("error") > -1) {
                           //filterable-items
						    $(this).parents("form").find(".filelist.queue")
                                .find("li[data-index=" + file.index + "]").addClass("error")
                                .find(".progress").text(response.trim());
                        } else {
						i++;

                        $(document).find(".filelists").find(".filelist").append('<div class="card col-4 my-2"><img class="card-img-top" src="'+PATH+'uploads/'+response+'" alt="Images"><div class="card-body p-0 my-2"><textarea name="desc_'+i+'" /></textarea></div><div class="card-body p-0 my-0"><select name="type_'+i+'"><option value="band">BAND</option><option value="concert">CONCERT</option><option value="stuff">STUFF</option></select></div><input type="hidden" value="'+response+'" name="image_'+i+'"</div>');
                        }
						//alert(e);
						//
						/*$('.fs-upload-target').css('display', 'none');*/
						$('#img_upload').attr('src', PATH+'uploads/'+response);
						$('#img_upload').css('display', 'block');
						$('#img_upload_text').val(response);
                    }

                    function onFileError(e, file, error) {
                        console.log("File Error");
                        $(this).parents("form").find(".filelist.queue")
                            .find("li[data-index=" + file.index + "]").addClass("error")
                            .find(".progress").text("Error: " + error);
                    }