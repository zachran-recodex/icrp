import Quill from 'quill';
import 'quill/dist/quill.snow.css';

// Global Quill editor manager
window.QuillManager = {
    instances: new Map(),
    
    init(editorId, options = {}) {
        // Destroy existing instance if any
        this.destroy(editorId);
        
        const editorElement = document.getElementById(editorId);
        if (!editorElement) {
            console.error(`Quill editor element with id "${editorId}" not found`);
            return null;
        }

        const defaultOptions = {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        };

        const mergedOptions = { ...defaultOptions, ...options };
        
        try {
            const quillInstance = new Quill(`#${editorId}`, mergedOptions);
            this.instances.set(editorId, quillInstance);
            
            console.log(`Quill editor initialized for: ${editorId}`);
            return quillInstance;
        } catch (error) {
            console.error(`Failed to initialize Quill editor for ${editorId}:`, error);
            return null;
        }
    },
    
    destroy(editorId) {
        if (this.instances.has(editorId)) {
            const instance = this.instances.get(editorId);
            try {
                // Clean up toolbar if it exists
                const toolbar = instance.getModule('toolbar');
                if (toolbar && toolbar.container) {
                    toolbar.container.remove();
                }
                // Clear the container
                if (instance.container) {
                    instance.container.innerHTML = '';
                }
                this.instances.delete(editorId);
                console.log(`Quill editor destroyed for: ${editorId}`);
            } catch (error) {
                console.error(`Error destroying Quill editor for ${editorId}:`, error);
            }
        }
    },
    
    getInstance(editorId) {
        return this.instances.get(editorId) || null;
    },
    
    setContent(editorId, content) {
        const instance = this.getInstance(editorId);
        if (instance && content) {
            try {
                instance.clipboard.dangerouslyPasteHTML(content);
                console.log(`Content loaded to editor: ${editorId}`);
            } catch (error) {
                console.error(`Error setting content for ${editorId}:`, error);
            }
        }
    },
    
    getContent(editorId) {
        const instance = this.getInstance(editorId);
        return instance ? instance.root.innerHTML : '';
    },
    
    onTextChange(editorId, callback) {
        const instance = this.getInstance(editorId);
        if (instance && typeof callback === 'function') {
            instance.on('text-change', callback);
        }
    },
    
    destroyAll() {
        this.instances.forEach((instance, editorId) => {
            this.destroy(editorId);
        });
    }
};

// Clean up instances when navigating away
window.addEventListener('beforeunload', () => {
    window.QuillManager.destroyAll();
});

// Re-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('Quill manager ready');
});