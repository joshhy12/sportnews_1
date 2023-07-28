$(function () {
    const editorInstance = $("#contentEditor")
        .dxHtmlEditor({
            height: 300,
            toolbar: {
                items: [
                    "undo",
                    "redo",
                    "separator",
                    {
                        name: "header",
                        acceptedValues: [false, 1, 2, 3, 4, 5],
                    },
                    "separator",
                    {
                        name: "font",
                        acceptedValues: [
                            "Arial",
                            "Times New Roman",
                            "Verdana",
                            "Courier New",
                            "Tahoma",
                            "Helvetica",
                            "Georgia",
                            "Comic Sans MS",
                            "Impact",
                            "Lucida Sans Unicode",
                            "Trebuchet MS",
                            "Arial Black",
                            "Palatino Linotype",
                            "Tahoma",
                            "Book Antiqua",
                            "Arial Narrow",
                            "Century Gothic",
                            "Garamond",
                            "Calibri",
                            "Candara",
                            "Algerian",
                            "Snap ITC",
                            "Castellar",
                        ],
                    },
                    "bold",
                    "italic",
                    "strike",
                    "underline",
                    "separator",
                    "alignLeft",
                    "alignCenter",
                    "alignRight",
                    "alignJustify",
                    "separator",
                    "color",
                    "background",
                    "separator",
                    "orderedList",
                    "bulletList",
                    "separator",
                    "link",
                    "image",
                    "separator",
                    "codeBlock",
                    "blockquote",
                    "separator",
                ],
            },
            onValueChanged: function (e) {
                $("#content").val(e.value);
            },
        })
        .dxHtmlEditor("instance");

    // Separate function for font selection
    editorInstance.on("initialized", function (e) {
        var editor = e.component;
        editorInstance.getFormat("font").allowedValues = [
            "Arial",
            "Times New Roman",
            "Verdana",
            "Courier New",
            "Tahoma",
            "Helvetica",
            "Georgia",
            "Comic Sans MS",
            "Impact",
            "Lucida Sans Unicode",
            "Trebuchet MS",
            "Arial Black",
            "Palatino Linotype",
            "Tahoma",
            "Book Antiqua",
            "Arial Narrow",
            "Century Gothic",
            "Garamond",
            "Calibri",
            "Candara",
            "Algerian",
            "Snap ITC",
            "Castellar",
        ];
        editorInstance.registerFormats(editorInstance.getFormat("font"));
    });

    editorInstance.option("toolbar.items[6].onItemClick", function () {
        var editor = editorInstance;
        editorInstance.showDialog("font", true).done(function (dialogResult) {
            if (dialogResult) {
                editor.focus();
                editor.format("font", dialogResult);
            }
        });
    });
});
