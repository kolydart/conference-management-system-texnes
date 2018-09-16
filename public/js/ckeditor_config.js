CKEDITOR.editorConfig = function( config ) {
	// display characters (rawurldecode)
	config.htmlEncodeOutput = false;
	config.entities = false;
	// allow custom code (fontawesome, classes)
	config.protectedSource.push( /<i class[\s\S]*?\>/g );
	config.protectedSource.push( /<\/i>/g );
	config.allowedContent = true;
};
