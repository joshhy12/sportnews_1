$(function() {
    const editorInstance = $('#contentEditor').dxHtmlEditor({
        height: 300,
        toolbar: {
            items: [
                'undo', 'redo', 'separator',
                {
                    name: 'header',
                    acceptedValues: [false, 1, 2, 3, 4, 5],
                }, 'separator',
                'bold', 'italic', 'strike', 'underline', 'separator',
                'alignLeft', 'alignCenter', 'alignRight', 'alignJustify', 'separator',
                {
                    formatName: 'font',
                    formatValues: [
                        'Arial',
                        'Times New Roman',
                        'Verdana',
                        'Courier New',
                        'Tahoma'
                    ]
                },
                'color', 'background', 'separator',
                'orderedList', 'bulletList', 'separator',
                'link', 'image', 'separator',
                'codeBlock', 'blockquote', 'separator',
            ],
        },
        onValueChanged: function(e) {
            $('#content').val(e.value);
        },
    }).dxHtmlEditor('instance');

    // Separate function for font selection
    editorInstance.option('toolbar.items[6].onItemClick', function() {
        var editor = editorInstance;
        editorInstance.showDialog('font', true).done(function(dialogResult) {
            if (dialogResult) {
                editor.focus();
                editor.format('font', dialogResult);
            }
        });
    });
});
