<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<link href="<?= base_url()?>assets/libs/choices.js/public/assets/styles/latestStyle.css" rel="stylesheet" type="text/css" />

<form action="<?= base_url() . 'ArticlesController/update_Article/'. $article['id'] ?>" method="post" enctype="multipart/form-data">
    <style>
        #container {
            width: 1000px;
            margin: 20px auto;
        }

        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }

        #thumnail {
            width: 100%;
            height: 300px;
            object-fit: cover;

            cursor: pointer;
        }

        #thumnail:hover {
            opacity: 0.7;

            transition: all 0.3s ease-in-out;
        }
    </style>


    <div id="container">
        <h1 id="title"><?= $article['title']?></h1>
        <h3 id="subtitle"><?= $article['subtitle']?></h3>

        <?php  $pathImage = $article['thumnail'] == 'Default_Image.jpg' ? 'Default_Image.jpg' : $article['id'].'/'.$article['thumnail']; ?>

        <img src="<?= base_url('uploads/Images/'.$pathImage)?>" alt="image" class="image-fluid img-thumbnail"
            id="thumnail">

        <textarea id="editor" name="editor">
            <?= $article['content']?>
            </textarea>

    </div>
    <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chose Tags and categories to your Article</h4>
                    <p class="card-title-desc">Tags and categories will help people to find your article</p>
                </div>

                <div class="card-body">
                    <div>
                       
                        <input name="Tags" id="Tags" value="<?php 
                        $res = '';
                            foreach($tags as $index => $tag)
                            {
                                //$res .= $tag['name'].',';
                                $res .= $tag['name'];
                                if($index != count($tags) - 1)
                                    $res .= ',';
                            }
                            echo $res;
                        ?>" type="text" placeholder="Enter something">
                        <select name="category" id="Categories">
                            <?php 
                                foreach($categories as $category)
                                {
                                    if($category['id'] == $article['category'])
                                        echo '<option selected value="'.$category['id'].'">'.$category['name'].'</option>';
                                    else
                                        echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                                }
                            ?>
                        </select>


                    </div>
                </div>
            </div>

    <input type="submit" value="Save" class="btn btn-primary">

</form>

<!--
            The "super-build" of CKEditor 5 served via CDN contains a large set of plugins and multiple editor types.
            See https://ckeditor.com/docs/ckeditor5/latest/installation/getting-started/quick-start.html#running-a-full-featured-editor-from-cdn
        -->
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>

<script>
    // This sample still does not showcase all CKEditor 5 features (!)
    // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'exportPDF', 'exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                },
                {
                    model: 'heading3',
                    view: 'h3',
                    title: 'Heading 3',
                    class: 'ck-heading_heading3'
                },
                {
                    model: 'heading4',
                    view: 'h4',
                    title: 'Heading 4',
                    class: 'ck-heading_heading4'
                },
                {
                    model: 'heading5',
                    view: 'h5',
                    title: 'Heading 5',
                    class: 'ck-heading_heading5'
                },
                {
                    model: 'heading6',
                    view: 'h6',
                    title: 'Heading 6',
                    class: 'ck-heading_heading6'
                }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Welcome to CKEditor 5!',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [{
                name: /.*/,
                attributes: true,
                classes: true,
                styles: true
            }]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [{
                marker: '@',
                feed: [
                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate',
                    '@cookie', '@cotton', '@cream',
                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi',
                    '@ice', '@jelly-o',
                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                    '@sesame', '@snaps', '@soufflé',
                    '@sugar', '@sweet', '@topping', '@wafer'
                ],
                minimumCharacters: 1
            }]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents'
        ]
    });
</script>



<script type="module" defer>
let form = document.querySelector('form');

document.addEventListener('keydown', () => {
    //on enter cancel form submit
    if (event.keyCode == 13) {
        event.preventDefault();
    }

})

let Title = new EditableText(document.querySelector('#title'));
let subTitle = new EditableText(document.querySelector('#subtitle'));

let thumnail = new ClickAbleImage(document.querySelector('#thumnail'));


let Categories = new EditableText(document.querySelector('#Categories'));

let CategoriesX = document.getElementById('Categories');

    let choices2 = new Choices(CategoriesX);



    var TagsInput = document.getElementById('Tags');
            var choices1 = new Choices(TagsInput, {
                delimiter: ',',
                editItems: true,
                maxItemCount: 5,
                removeItems: true,
                removeItemButton: true,
            });
</script>
<script src="<?= base_url() ?>assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>


<?= $this->endSection() ?>