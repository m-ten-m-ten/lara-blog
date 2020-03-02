import hljs from 'highlight.js/lib/highlight';
import 'highlight.js/styles/dracula.css';

import javascript from 'highlight.js/lib/languages/javascript';
import php from 'highlight.js/lib/languages/php';
import css from 'highlight.js/lib/languages/css';

export function highlight(){

  hljs.registerLanguage('javascript', javascript);
  hljs.registerLanguage('php', php);
  hljs.registerLanguage('css', css);

  $('pre code').each( (i, block) => {
    hljs.highlightBlock(block);
  });
}
