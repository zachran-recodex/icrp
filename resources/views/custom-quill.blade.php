<div wire:ignore>
    <div
        id="{{ $quillId }}"
        class="{{ $classes }} {{ config('livewire-quill.editor_classes') }} livewire-quill"
        name="{{ $quillId }}"
        wire:key="quill-{{ $quillId }}"
    ></div>

    <link
        href="/vendor/livewire-quill/quill.snow.min.css"
        rel="stylesheet"
    >
    <script src="/vendor/livewire-quill/quill.js"></script>

    <script>
        var quillContainer = null;

        function initQuill(id, data, placeholder, toolbar) {
            var content = null;
            var init = true;

            // Custom YouTube embed handler
            function youtubeHandler() {
                const url = prompt('Enter YouTube URL:');
                if (url) {
                    const videoId = extractYouTubeID(url);
                    if (videoId) {
                        const embedHTML = `<div class="youtube-wrapper"><iframe src="https://www.youtube.com/embed/${videoId}" title="YouTube video player" frameborder="0" allowfullscreen></iframe></div>`;
                        const range = content.getSelection(true);
                        content.clipboard.dangerouslyPasteHTML(range.index, embedHTML);
                    } else {
                        alert('Invalid YouTube URL');
                    }
                }
            }

            // Extract YouTube video ID from URL
            function extractYouTubeID(url) {
                const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
                const match = url.match(regExp);
                return (match && match[7].length == 11) ? match[7] : false;
            }

            function selectLocalImage() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.click();

                // Listen upload local image and save to server
                input.onchange = () => {
                    const file = input.files[0];

                    // file type is only image.
                    if (/^image\//.test(file.type)) {
                        imageHandler(file);
                    } else {
                        alert('You can only upload images.');
                    }
                };
            }

            function imageHandler(image) {
                var uploadedImagesBefore = @this.quillUploadedImages;

                @this.uploadMultiple('quillImages', [image], (uploadedFilename) => {
                    // now get images after upload
                    var uploadedImagesAfterUpload = @this.quillUploadedImages;

                    var imageName = uploadedFilename;
                    var imageUrl = null;

                    for (var key in uploadedImagesAfterUpload) {
                        if (uploadedImagesAfterUpload.hasOwnProperty(key)) {
                            imageUrl = uploadedImagesAfterUpload[key];
                        }
                    }

                    if (imageUrl) {
                        imageUrl = '/storage/' + imageUrl;
                    }

                    insertToEditor(imageUrl, content);
                });
            }

            function insertToEditor(url, editor) {
                const range = editor.getSelection();
                editor.insertEmbed(range.index, 'image', url);
            }

            // Custom toolbar with YouTube button
            var customToolbar = toolbar;
            if (Array.isArray(customToolbar)) {
                // Add custom YouTube button
                customToolbar.push([{ 'youtube': 'YouTube' }]);
            }

            content = new Quill(`#${id}`, {
                modules: {
                    toolbar: {
                        container: customToolbar,
                        handlers: {
                            'youtube': youtubeHandler
                        }
                    },
                },
                placeholder: placeholder,
                theme: "snow",
            });

            content.getModule('toolbar').addHandler('image', () => {
                selectLocalImage();
            });

            content.on("text-change", (delta, oldDelta, source) => {
                if (source === "user") {
                    let currrentContents = content.getContents();
                    let diff = currrentContents.diff(oldDelta);
                    try {
                        // loop through diff.ops to find image
                        diff.ops.forEach((op) => {
                            if (op.hasOwnProperty('insert')) {
                                if (op.insert.hasOwnProperty('image')) {
                                    // get image url
                                    var imageUrl = op.insert.image;

                                    if (imageUrl) {
                                        @this.deleteImage(imageUrl);
                                    }
                                }
                            }
                        });
                    } catch (_error) {

                    }
                }
            });

            content.root.innerHTML = data;

            // on content change
            content.on("text-change", function(delta, oldDelta, source) {
                if (init) {
                    return;
                }

                // debounce it
                clearTimeout(quillContainer);

                // set a timeout to see if the user is still typing
                quillContainer = setTimeout(function() {
                    // set the content to the model
                    @this.dispatch('contentChanged', {
                        editorId: content.container.id,
                        content: content.root.innerHTML
                    })
                }, 500);
            });

            init = false;
        }

        document.addEventListener('livewire-quill:init', (event) => {
            var event = event.detail[0];

            var quillContainer = document.getElementById(event.quillId);

            if (!quillContainer.dataset.initialized) {
                initQuill(event.quillId, event.data, event.placeholder, event.toolbar);
                quillContainer.dataset.initialized = true;
            }
        });
    </script>
    
    <style>
        /* Custom YouTube button styling */
        .ql-youtube::before {
            content: "📺";
        }
        .ql-youtube {
            width: auto !important;
        }
    </style>
</div>