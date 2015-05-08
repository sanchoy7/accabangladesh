<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php echo html::script('modules/tinymce/tiny_mce/tiny_mce.js') ?>
<script type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme: 'advanced',
	skin : "s7n",
	plugins : "safari",
	entity_encoding : "raw",
	convert_urls : false,
	valid_elements: "*[*]",

	// Theme options
	theme_advanced_buttons1 : "pagebreak,bold,italic,strikethrough,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,|,link,unlink,|,image,imageupload,|,code",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",

	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "none",
	theme_advanced_resizing : false,
	
    setup : function(ed) {
        // Add a custom button
        ed.addButton('imageupload', {
            title : 'Image Upload',
            class : 'mce_image',
            onclick : function() {
            	$('#uploader').dialog('option','insertin', ed);
            	$('#uploader').dialog('open');
            }
        });
	}
});
</script>