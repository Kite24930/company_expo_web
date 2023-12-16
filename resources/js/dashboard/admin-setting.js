import '../common.js';
import Editor from "@toast-ui/editor";
import '@toast-ui/editor/dist/i18n/ja-jp';
import colorPlugin from "@toast-ui/editor-plugin-color-syntax";
import tableMergedCellPlugin from "@toast-ui/editor-plugin-table-merged-cell";
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor-plugin-color-syntax/dist/toastui-editor-plugin-color-syntax.css';

document.querySelectorAll('.editor').forEach((editorEl) => {
    const editor = new Editor({
        el: editorEl,
        height: '300px',
        initialEditType: 'markdown',
        previewStyle: 'vertical',
        initialValue: editorEl.getAttribute('data-value'),
        language: 'ja',
        toolbarItems: [
            ['heading', 'bold', 'italic', 'strike'],
            ['hr', 'quote'],
            ['ul', 'ol', 'task', 'indent', 'outdent'],
            ['table', 'image', 'link'],
            ['code', 'codeblock'],
        ],
        plugins: [colorPlugin, tableMergedCellPlugin],
        events: {
            change: () => {
                document.getElementById(editorEl.getAttribute('data-target')).value = editor.getMarkdown();
            }
        }
    })
});
