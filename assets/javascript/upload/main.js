/*
 * jQuery File Upload Plugin JS Example 6.11
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '../../../../phpupload/php/file.php'
		
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    if (window.location.hostname === 'blueimp.github.com') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            process: [
                {
                    action: 'load',
                    fileTypes: /^image\/(gif|jpeg|png)$/,
                    maxFileSize: 20000000 // 20MB
                },
                {
                    action: 'resize',
                    maxWidth: 1440,
                    maxHeight: 900
                },
                {
                    action: 'save'
                }
            ]
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
		
		//document.write(JSON.stringify(context));
        // Load existing files:
		//console.dir($('#fileupload')[0]);
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
			
			dataType: 'json',
            context: $('#fileupload')[0]
       		 }).done(function (result) {
					//document.write(JSON.stringify(result));
					if (result && result.length) {
						 $(this).fileupload('option', 'done').call(this, null, {result: result});
					}
        });
    }
///{"name":"1394533073IMG-20120320-00110 (1).jpg","size":407498,"url":"/upload/storage/album/8/1394533073IMG-20120320-00110%20%281%29.jpg","thumbnail_url":"/upload/storage/album/8/thumbnail/1394533073IMG-20120320-00110%20%281%29.jpg","delete_url":"http://localhost/ci_ss/phpupload/php/?file=1394533073IMG-20120320-00110%20%281%29.jpg","delete_type":"DELETE"}
});
