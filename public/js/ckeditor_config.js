CKEDITOR.editorConfig = function( config ) {
	config.htmlEncodeOutput = false;
	config.entities = false;
	config.protectedSource.push( /<i class[\s\S]*?\>/g );
	config.protectedSource.push( /<\/i>/g );
};
